<?php
namespace ArcaSolutions\WebBundle\Controller;

use ArcaSolutions\ReportsBundle\Services\ReportHandler;
use ArcaSolutions\WebBundle\Form\Type\SendMailType;
use ArcaSolutions\WebBundle\Services\EmailNotificationService;
use ArcaSolutions\WebBundle\Services\LeadHandler;
use ArcaSolutions\WebBundle\Services\TimelineHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SendMailController extends Controller
{
    /**
     * Send email to the item owner (Listing, Classified, Event)
     *
     * @param Request $request
     * @param string $id
     * @param string $module
     *
     * @return \Symfony\Component\HttpFoundation\Response|static
     * @throws \Exception When a module is allowed or not selected
     */
    public function indexAction(Request $request, $id = '', $module = '')
    {
        $translator = $this->get('translator');

        /* Default error response for this action */
        $response = [
            'status' => false,
            'title' => $translator->trans('Error'),
            'content' => $translator->trans('The item you are trying to contact does not exist.')
        ];

        if (is_numeric($id) && $id > 0) {
            $doctrine = $this->get('doctrine');

            switch ($module) {
                case 'listing':
                    $item = $doctrine->getRepository('ListingBundle:Listing')->find($id);
                    break;
                case 'event':
                    $item = $doctrine->getRepository('EventBundle:Event')->find($id);
                    break;
                case 'classified':
                    $item = $doctrine->getRepository('ClassifiedBundle:Classified')->find($id);
                    break;
                default:
                    $item = null;
                    break;
            }

            if ($item) {
                $form = $this->createForm(new SendMailType());

                /* Adds a captcha if not exist user logged */
                if (null === $request->getSession()->get('SESS_ACCOUNT_ID')) {
                    $form->add('captcha', 'edirectory_captcha', []);
                }

                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {

                    /* creating response default */
                    $response = [
                        'status' => false,
                        'title' => $translator->trans('Message'),
                        'content' => $translator->trans('We can not send your email. Try again, please.'),
                    ];

                    $send = $this->get('sendmail.module')->send($item, $form);
                    $send and $response = [
                        'status' => true,
                        'title' => $translator->trans('Message'),
                        'content' => $translator->trans('Your e-mail has been sent. Thank you.'),
                    ];

                } else {
                    $response = [
                        'status' => false,
                        'title' => $translator->trans("Send E-mail"),
                        'content' => $this->get("twig")->render('::blocks/modals/modal-send-email.html.twig', [
                            'form' => $form->createView(),
                            'item' => $item
                        ])
                    ];
                }
            }
        }

        return JsonResponse::create($response);
    }
}
