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
}