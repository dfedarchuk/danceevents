<?php

namespace ArcaSolutions\CoreBundle\Form\Type;

use EWZ\Bundle\RecaptchaBundle\Form\Type\RecaptchaType;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as True;

/**
 * A field for entering a captcha.
 */
class CaptchaType extends AbstractType
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var \Gregwar\CaptchaBundle\Type\CaptchaType | RecaptchaType
     */
    private $captcha;

    /**
     * CaptchaType constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;

        /** If google recaptcha is active */
        if ($this->container->get('settings')->getSettingGoogle('recaptcha_status') === 'on') {
            $this->captcha = new RecaptchaType(
                $this->container->get('settings')->getSettingGoogle('recaptcha_sitekey'),
                $this->container->getParameter('ewz_recaptcha.enabled'),
                $this->container->getParameter('ewz_recaptcha.ajax'),
                $this->container->get('multi_domain.information')->getLocale()
            );
        } else {
            $this->captcha = new \Gregwar\CaptchaBundle\Type\CaptchaType(
                $this->container->get('session'),
                $this->container->get('gregwar_captcha.generator'),
                $this->container->get('translator'),
                $this->container->getParameter('gregwar_captcha.config')
            );
        }
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (method_exists($this->captcha, 'buildForm')) {
            $this->captcha->buildForm($builder, $options);
        }
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (method_exists($this->captcha, 'buildView')) {
            $this->captcha->buildView($view, $form, $options);
        }

        $view->vars = array_merge($view->vars, [
            'captcha_type' => $this->captcha instanceof RecaptchaType ? 'google' : 'own',
        ]);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        if (method_exists($this->captcha, 'setDefaultOptions')) {
            $this->captcha->setDefaultOptions($resolver);
        }

        if ($this->captcha instanceof RecaptchaType) {
            $resolver->setDefaults([
                'constraints' => [new True()],
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        if (method_exists($this->captcha, 'configureOptions')) {
            $this->captcha->configureOptions($resolver);
        }
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        if (method_exists($this->captcha, 'finishView')) {
            $this->captcha->finishView($view, $form, $options);
        }
    }

    public function getParent()
    {
        return $this->captcha instanceof RecaptchaType ? 'form' : 'text';
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "edirectory_captcha";
    }
}
