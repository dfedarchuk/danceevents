<?php

namespace ArcaSolutions\WebBundle\Controller;

use ArcaSolutions\WebBundle\Form\Type\ReviewsType;
use ArcaSolutions\WebBundle\Services\TimelineHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ReviewController
 *
 * @package ArcaSolutions\WebBundle\Controller
 */
class ReviewController extends Controller
{
    /**
     * Rate a review: adds like or dislike
     *
     * @param $type
     * @param $id
     *
     * @return Response
     */
    public function rateAction($type, $id)
    {
        /* gets review */
        $review = $this->get('doctrine')->getRepository('WebBundle:Review')->find($id);

        /* if it was not found returns an error */
        if (!$review) {
            $response = new Response();
            $response->setStatusCode(503);

            return $response->send();
        }

        /* gets IP and keep it ready to use */
        $userIP = '||' . $this->get('request')->getClientIp() . '||';

        /* Like type */
        if ('like' == $type) {
            /* verify if user already voted using its IP */
            if (false !== strpos($review->getLikeIps(), $userIP)) {
                /* returns message */
                return JsonResponse::create([
                    'status' => 0,
                    'message' => $this->get('translator')->trans('Already voted'),
                ]);
            }

            if (false !== strpos($review->getDislikeIps(), $userIP)) {
                /* workaround to not leave comma in column */
                $ip_removed = str_replace(',' . $userIP, '', $review->getDislikeIps());
                $ip_removed = str_replace($userIP, '', $ip_removed);
                $review->setDislikeIps($ip_removed);

                /* decrease dislike */
                $review->setDislike($review->getDislike() - 1);
            }

            /* saves quantity of likes */
            $review->setLike($review->getLike() + 1);
            /* adding IP */
            /* saves user IP following edirectory pattern */
            $ip = $userIP;
            /* concatenates with olders IPs */
            if ($review->getLikeIps()) {
                $ip = $review->getLikeIps() . ',' . $ip;
            }
            /* sets IP */
            $review->setLikeIps($ip);
        }

        if ('dislike' == $type) {
            /* verify if user already voted using its IP */
            if (false !== strpos($review->getDislikeIps(), $userIP)) {
                /* returns message */
                return JsonResponse::create([
                    'status' => 0,
                    'message' => $this->get('translator')->trans('Already voted'),
                ]);
            }

            if (false !== strpos($review->getLikeIps(), $userIP)) {
                /* workaround to not leave comma in column */
                $ip_removed = str_replace(',' . $userIP, '', $review->getLikeIps());
                $ip_removed = str_replace($userIP, '', $ip_removed);
                $review->setLikeIps($ip_removed);

                /* decrease like */
                $review->setLike($review->getLike() - 1);
            }

            /* saves quantity of dislikes */
            $review->setDislike($review->getDislike() + 1);
            /* adding IP */
            /* following edir pattern */
            $ip = $userIP;
            /* concatenates with olders IPs */
            if ($review->getDislikeIps()) {
                $ip = $review->getDislikeIps() . ',' . $ip;
            }
            /* sets IP */
            $review->setDislikeIps($ip);
        }

        /* prepares save */
        $this->get('doctrine')->getManager()->persist($review);
        /* executes save */
        $this->get('doctrine')->getManager()->flush();

        /* Adds to sitemanager's timeline */
        $this->get("timelinehandler")->add(
            $review->getId(),
            TimelineHandler::ITEMTYPE_REVIEW,
            TimelineHandler::ACTION_NEW
        );

        return JsonResponse::create([
            'status' => 1,
            'message' => $this->get('translator')->trans('Voted'),
            'like' => $review->getLike(),
            'dislike' => $review->getDislike(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function addReviewAction(Request $request)
    {
        $response = [
            "status" => false,
            "content" => null,
        ];

        /* Decrypts "info" post into json, decodes JSON into an object containing id and module, assures both id and
         * module exists and guarantees module is either listing or article. Yeah, its a big motherfucking if
         */
        $settings = $this->get("settings");

        if ($info = json_decode($this->get("url_encryption")->decrypt($request->request->get("info")))
            and $id = (empty($info->id) ? null : $info->id)
            and $module = (empty($info->module) ? null : $info->module)
            and (
                $module == "listing" && $settings->getDomainSetting("review_listing_enabled")
                or $module == "article" && $settings->getDomainSetting("review_article_enabled")
            )
        ) {
            $userId = $request->getSession()->get('SESS_ACCOUNT_ID');
            $reviewHandler = $this->get('review.handler');

            $forceLogin = $reviewHandler->forceLogin($module);

            if (is_null($userId) and $forceLogin) {
                return $this->redirect('/profile/login.php?userperm=1');
            }

            $memberAccount = null;
            if ($userId) {
                $memberAccount = $this->getDoctrine()->getRepository('WebBundle:Accountprofilecontact')->find($userId);

                $review = $this->getDoctrine()->getRepository("WebBundle:Review")->findOneBy([
                    "memberId" => $userId,
                    "itemType" => $module,
                    "itemId" => $id,
                ]);
            }

            if (isset($review) and $review) {
                $response["content"] = $this->get('translator')->trans("You already reviewed this.");
            } else {
                $form = $this->createForm(new ReviewsType($memberAccount, $this->getDoctrine()));

                /* Adds a captcha if not exist user logged */
                if (null === $request->getSession()->get('SESS_ACCOUNT_ID')) {
                    $form->add('captcha', 'edirectory_captcha', []);
                }

                $form->handleRequest($request);

                if ($form->isValid()) {
                    try {
                        $reviewHandler->save($module, $id, $memberAccount, $form);

                        $response = [
                            "status" => true,
                            "content" => $reviewHandler->successMessage()
                        ];
                    } catch (\Exception $e) {
                        $logger = $this->get('logger');
                        $logger->addError('Add new Review: ' . $e->getMessage());
                        $response["content"] = $this->get('translator')->trans('An error occurred, try again');
                    }
                } else {
                    $response = [
                        "status" => false,
                        "content" => $this->get("twig")->render('::blocks/modals/modal-write-review.html.twig', [
                            'module' => $module,
                            'id' => $id,
                            'form' => $form->createView(),
                        ]),
                    ];
                }
            }
        }

        return new JsonResponse($response);
    }
}
