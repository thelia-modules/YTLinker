<?php

namespace YTLinker\Model;

use YTLinker\Model\Base\Ytlinker as BaseYtlinker;
use Thelia\Model\Tools\ModelEventDispatcherTrait;
use Thelia\Model\Tools\UrlRewritingTrait;

class Ytlinker extends BaseYtlinker
{
    use ModelEventDispatcherTrait;
    use UrlRewritingTrait;

    /**
     * {@inheritDoc}
     */
    public function getRewrittenUrlViewName()
    {
        return 'ytlinker';
    }

}
