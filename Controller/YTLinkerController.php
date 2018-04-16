<?php

namespace YTLinker\Controller;

use Thelia\Controller\Admin\BaseAdminController;
use YTLinker\Model\YtlinkerI18nQuery;

class YTLinkerController extends BaseAdminController
{
    /**
     * Show the default template : ytlinkerList
     *
     * @return \Thelia\Core\HttpFoundation\Response
     */
    public function viewAction()
    {
        return $this->render("ytlinkerlist");
    }

    /**
     * @return \Thelia\Core\HttpFoundation\Response
     * @throws \Exception
     */
    public function updateAction()
    {
        $ytlinkerID = $this->getRequest()->get('ytlinkerId');
        $response = array();

        try {
            $ytlinker = YtlinkerI18nQuery::create()
                ->filterById($ytlinkerID)
                ->findOne();

            if ($ytlinker !== null) {
                $id             = $ytlinker->getId();
                $title          = $ytlinker->getTitle();
                $link           = $ytlinker->getLink();
                $description    = $ytlinker->getDescription();
                $locale = $this->getRequest()->getSession()->get('thelia.current.lang')->getLocale();


                $response = [
                    'id'            => $id,
                    'title'         => $title,
                    'link'          => $link,
                    'description'   => $description,
                ];
                $YTLinkerSeo = new YTLinkerUpdateController();
                $YTLinkerSeo->updateAction(
                    $id,
                    $locale = $this->getRequest()
                        ->getSession()
                        ->get('thelia.current.lang')
                        ->getLocale()
                );
            }
        } catch (\Exception $exc) {
            throw $exc;
        }

        return $this->render("ytlinker-edit", $response);
    }
}