<?php

namespace ArcaSolutions\WebBundle\Tests\Services;

use ArcaSolutions\CoreBundle\Helper\ModuleHelper;
use ArcaSolutions\CoreBundle\Services\Settings;
use ArcaSolutions\MultiDomainBundle\Doctrine\DoctrineRegistry;
use ArcaSolutions\WebBundle\Form\Type\ReviewsType;
use ArcaSolutions\WebBundle\Services\EmailNotificationService;
use ArcaSolutions\WebBundle\Services\ReviewHandler;
use ArcaSolutions\WebBundle\Services\TimelineHandler;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Translation\TranslatorInterface;

class ReviewHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Exception
     * @dataProvider modulesNotAllowed
     */
    public function test_is_module_enabled_exception($module)
    {
        $reviewHandler = $this->getReviewHandlerWithoutChangingDIClasses();

        $reviewHandler->isModuleEnabled($module);
    }

    /**
     * @dataProvider modulesAllowedEnabledByDatabaseFlag
     */
    public function test_is_module_enabled_checking_database_flag_off($module, $flag)
    {
        $doctrineMock = $this->getMockBuilder(DoctrineRegistry::class)
            ->disableOriginalConstructor()
            ->getMock();

        $requestStackMock = $this->getMockBuilder(RequestStack::class)
            ->disableOriginalConstructor()
            ->getMock();

        $translatorMock = $this->getMock(TranslatorInterface::class);

        $timelineMock = $this->getMockBuilder(TimelineHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $settingsCoreMock = $this->getMockBuilder(Settings::class)
            ->disableOriginalConstructor()
            ->getMock();

        $emailNotification = $this->getMockBuilder(EmailNotificationService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $settingsMulti = $this->getMockBuilder(\ArcaSolutions\MultiDomainBundle\Services\Settings::class)
            ->disableOriginalConstructor()
            ->getMock();

        $moduleHelper = $this->getMockBuilder(ModuleHelper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $swift = $this->getMockBuilder(\Swift_Mailer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $logger = $this->getMockBuilder(Logger::class)
            ->disableOriginalConstructor()
            ->getMock();

        $settingsCoreMock->method('getDomainSetting')
            ->with($this->equalTo($flag))
            ->will($this->returnValue(''));

        $reviewHandler = new ReviewHandler(
            $doctrineMock,
            $requestStackMock,
            $translatorMock,
            $timelineMock,
            $settingsCoreMock,
            $emailNotification,
            $settingsMulti,
            $moduleHelper,
            $swift,
            $logger
        );

        $this->assertFalse($reviewHandler->isModuleEnabled($module));
    }

    /**
     * @dataProvider modulesAllowedEnabledByDatabaseFlag
     */
    public function test_is_module_enabled_checking_database_flag_on($module, $flag)
    {
        $doctrineMock = $this->getMockBuilder(DoctrineRegistry::class)
            ->disableOriginalConstructor()
            ->getMock();

        $requestStackMock = $this->getMockBuilder(RequestStack::class)
            ->disableOriginalConstructor()
            ->getMock();

        $translatorMock = $this->getMock(TranslatorInterface::class);

        $timelineMock = $this->getMockBuilder(TimelineHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $settingsCoreMock = $this->getMockBuilder(Settings::class)
            ->disableOriginalConstructor()
            ->getMock();

        $emailNotification = $this->getMockBuilder(EmailNotificationService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $settingsMulti = $this->getMockBuilder(\ArcaSolutions\MultiDomainBundle\Services\Settings::class)
            ->disableOriginalConstructor()
            ->getMock();

        $moduleHelper = $this->getMockBuilder(ModuleHelper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $swift = $this->getMockBuilder(\Swift_Mailer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $logger = $this->getMockBuilder(Logger::class)
            ->disableOriginalConstructor()
            ->getMock();

        $settingsCoreMock->method('getDomainSetting')
            ->with($this->equalTo($flag))
            ->will($this->returnValue('on'));

        $reviewHandler = new ReviewHandler(
            $doctrineMock,
            $requestStackMock,
            $translatorMock,
            $timelineMock,
            $settingsCoreMock,
            $emailNotification,
            $settingsMulti,
            $moduleHelper,
            $swift,
            $logger
        );

        $this->assertTrue($reviewHandler->isModuleEnabled($module));
    }

    public function test_success_message_review_that_depends_on_approve_flag_database()
    {
        $doctrineMock = $this->getMockBuilder(DoctrineRegistry::class)
            ->disableOriginalConstructor()
            ->getMock();

        $requestStackMock = $this->getMockBuilder(RequestStack::class)
            ->disableOriginalConstructor()
            ->getMock();

        $translatorMock = $this->getMock(TranslatorInterface::class);

        $timelineMock = $this->getMockBuilder(TimelineHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $settingsCoreMock = $this->getMockBuilder(Settings::class)
            ->disableOriginalConstructor()
            ->getMock();

        $emailNotification = $this->getMockBuilder(EmailNotificationService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $multiDomainInfo = $this->getMockBuilder(\ArcaSolutions\MultiDomainBundle\Services\Settings::class)
            ->disableOriginalConstructor()
            ->getMock();

        $moduleHelper = $this->getMockBuilder(ModuleHelper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $swift = $this->getMockBuilder(\Swift_Mailer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $logger = $this->getMockBuilder(Logger::class)
            ->disableOriginalConstructor()
            ->getMock();

        $translatorMock->method('trans')
            ->willReturnCallback(
                function ($str) {
                    return $str;
                }
            );

        $settingsCoreMock->method('getDomainSetting')
            ->with($this->equalTo('review_approve'))
            ->will($this->onConsecutiveCalls('on', ''));

        $reviewHandler = new ReviewHandler(
            $doctrineMock,
            $requestStackMock,
            $translatorMock,
            $timelineMock,
            $settingsCoreMock,
            $emailNotification,
            $multiDomainInfo,
            $moduleHelper,
            $swift,
            $logger
        );

        $this->assertEquals(
            'Your review has been submitted for approval.',
            $reviewHandler->successMessage(),
            '"Your review has been submitted for approval." changed'
        );
        $this->assertEquals(
            'Thank you for submitting your review!',
            $reviewHandler->successMessage(),
            '"Thank you for submitting your review!" changed'
        );
    }

    /**
     * @dataProvider modulesNotAllowed
     * @expectedException \Exception
     */
    public function test_exception_force_login_with_not_allowed_modules($module)
    {
        $reviewHandler = $this->getReviewHandlerWithoutChangingDIClasses();

        $reviewHandler->forceLogin($module);
    }

    /**
     * @dataProvider modulesAllowedWithForceLoginDatabaseFlag
     */
    public function test_force_login_database_flag_by_module($module, $forceLoginFlag)
    {
        $doctrineMock = $this->getMockBuilder(DoctrineRegistry::class)
            ->disableOriginalConstructor()
            ->getMock();

        $requestStackMock = $this->getMockBuilder(RequestStack::class)
            ->disableOriginalConstructor()
            ->getMock();

        $translatorMock = $this->getMock(TranslatorInterface::class);

        $timelineMock = $this->getMockBuilder(TimelineHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $settingsCoreMock = $this->getMockBuilder(Settings::class)
            ->disableOriginalConstructor()
            ->getMock();

        $emailNotification = $this->getMockBuilder(EmailNotificationService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $multiDomainInfo = $this->getMockBuilder(\ArcaSolutions\MultiDomainBundle\Services\Settings::class)
            ->disableOriginalConstructor()
            ->getMock();

        $moduleHelper = $this->getMockBuilder(ModuleHelper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $swift = $this->getMockBuilder(\Swift_Mailer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $logger = $this->getMockBuilder(Logger::class)
            ->disableOriginalConstructor()
            ->getMock();

        $settingsCoreMock->method('getSettingSocialNetwork')
            ->with($this->equalTo($forceLoginFlag))
            ->will($this->onConsecutiveCalls('no', 'yes'));

        $reviewHandler = new ReviewHandler(
            $doctrineMock,
            $requestStackMock,
            $translatorMock,
            $timelineMock,
            $settingsCoreMock,
            $emailNotification,
            $multiDomainInfo,
            $moduleHelper,
            $swift,
            $logger
        );

        $this->assertFalse(
            $reviewHandler->forceLogin($module),
            'Force Login is not returning the right value when it is not enabled'
        );
        $this->assertTrue(
            $reviewHandler->forceLogin($module),
            'Force Login is not returning the right value when it is enabled'
        );
    }

    public function modulesNotAllowed()
    {
        return [
            ['blog'],
            ['classified'],
            ['event'],
            ['deal'],
        ];
    }

    public function modulesAllowedEnabledByDatabaseFlag()
    {
        return [
            ['listing', 'review_listing_enabled'],
            ['article', 'review_article_enabled'],
        ];
    }

    public function modulesAllowedWithForceLoginDatabaseFlag()
    {
        return [
            ['listing', 'listing_rate'],
            ['article', 'article_rate'],
        ];
    }

    /**
     * @return ReviewHandler
     */
    private function getReviewHandlerWithoutChangingDIClasses()
    {
        $doctrineMock = $this->getMockBuilder(DoctrineRegistry::class)
            ->disableOriginalConstructor()
            ->getMock();

        $requestStackMock = $this->getMockBuilder(RequestStack::class)
            ->disableOriginalConstructor()
            ->getMock();

        $translatorMock = $this->getMock(TranslatorInterface::class);

        $timelineMock = $this->getMockBuilder(TimelineHandler::class)
            ->disableOriginalConstructor()
            ->getMock();

        $settingsCoreMock = $this->getMockBuilder(Settings::class)
            ->disableOriginalConstructor()
            ->getMock();

        $emailNotification = $this->getMockBuilder(EmailNotificationService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $multiDomainInfo = $this->getMockBuilder(\ArcaSolutions\MultiDomainBundle\Services\Settings::class)
            ->disableOriginalConstructor()
            ->getMock();

        $moduleHelper = $this->getMockBuilder(ModuleHelper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $swift = $this->getMockBuilder(\Swift_Mailer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $logger = $this->getMockBuilder(Logger::class)
            ->disableOriginalConstructor()
            ->getMock();

        return new ReviewHandler(
            $doctrineMock,
            $requestStackMock,
            $translatorMock,
            $timelineMock,
            $settingsCoreMock,
            $emailNotification,
            $multiDomainInfo,
            $moduleHelper,
            $swift,
            $logger
        );
    }
}
