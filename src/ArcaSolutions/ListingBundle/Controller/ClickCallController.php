<?php

namespace ArcaSolutions\ListingBundle\Controller;

use ArcaSolutions\ReportsBundle\Services\ReportHandler;
use Services_Twilio;
use Services_Twilio_RestException;
use Services_Twilio_Twiml;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ClickCallController
 *
 * @package ArcaSolutions\ListingBundle\Controller
 */
class ClickCallController extends Controller
{
    /**
     * @param Request $request
     * @param Integer $id
     *
     * @return JsonResponse
     */
    public function indexAction(Request $request, $id)
    {
        $form = $this->createFormBuilder();
        $form->setAction($request->getUri());
        $form->add('phone', 'text', array('label' => 'Type you Phone'));
        $form->add('call', 'submit', array('label' => 'Call'));

        $form = $form->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $sid = $this->get('settings')->getDomainSetting('twilio_account_sid');
            $token = $this->get('settings')->getDomainSetting('twilio_auth_token');

            $listing = $this->get('doctrine')->getRepository('ListingBundle:Listing')->find($id);

            $redirect = $this->generateUrl('listing_clickcall_callback',
                array('id' => $id, 'number' => $listing->getClicktocallNumber(), '_format' => 'xml'),
                UrlGeneratorInterface::ABSOLUTE_URL);

            $client = new Services_Twilio($sid, $token);

            $return = array('status' => 0, 'msg' => $this->get('translator')->trans('An error occurred, try again'));

            try {
                $client->account->calls->create(
                    $listing->getClicktocallNumber(),
                    $form->get('phone')->getData(),
                    $redirect
                );

                $return['status'] = 1;
                $return['msg'] = 'Calling';

                $this->container->get('reporthandler')->addListingReport($listing->getId(), ReportHandler::LISTING_CLICK_CALL);
            } catch (Services_Twilio_RestException $e) {
                $logger = $this->get('logger');
                $logger->error('An error occurred in click to call function (' . $e->getMessage() . ')');
            }

            return JsonResponse::create($return);
        }

        return $this->render('::blocks/modals/modal-click-call.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
            'info' => array(
                'subtitle' => 'Enter your phone to call the listing owner with no cost',
                'example' => 'Phone (000) 000-0000',
                'comment' => 'For numbers outsite the USA, you need to put your country code first',
            ),
        ));
    }

    /**
     * @param $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function callbackAction($id)
    {
        $listing = $this->get('doctrine')->getRepository('ListingBundle:Listing')->find($id);

        if (!$listing) {
            return $this->createNotFoundException('Listing not found');
        }

        $message = $this->get('settings')->getDomainSetting('twilio_clicktocall_message');
        $message = str_replace("[ITEM_TITLE]", $listing->getTitle(), $message);

        $twilioWiml = new Services_Twilio_Twiml();
        $twilioWiml->say($message, array('voice' => "man"));
        $twilioWiml->dial($listing->getClicktocallNumber());

        return new Response($twilioWiml, 200, array('Content-Type' => 'text/xml'));
    }
}
