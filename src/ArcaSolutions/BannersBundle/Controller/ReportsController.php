<?php

namespace ArcaSolutions\BannersBundle\Controller;

use ArcaSolutions\ReportsBundle\Services\ReportHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportsController extends Controller
{
    public function redirectAction($bannerId)
    {
        $bannerId = $this->get('url_encryption')->decrypt($bannerId);

        $banner = $this->getDoctrine()->getRepository('BannersBundle:Banner')->find($bannerId);

        $this->get("reporthandler")->addBannerReport($bannerId, ReportHandler::BANNER_CLICK);

        return $this->redirect($banner->getDestinationProtocol().$banner->getDestinationUrl(), 301);
    }
}
