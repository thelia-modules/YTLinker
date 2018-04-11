<?php
/**
 * Created by PhpStorm.
 * User: lurivar
 * Date: 06/04/18
 * Time: 16:35
 */

namespace YTLinker\Hook;
use YTLinker\YTLinker;
use Thelia\Core\Event\Hook\HookRenderBlockEvent;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;
use Thelia\Core\Hook\Fragment;
use Thelia\Tools\URL;

/***
 * Class MySuperHook
 * @package YTLinker\Hook
 * @author Luc NORMANDON <lucnormandon@openstudio.fr>
 */

class MySuperHook extends BaseHook
{
    /***
     * Hook YTLinker module to the sidebar in tools menu
     *
     * @param HookRenderBlockEvent $event
     */
    public function onMainTopMenuTools(HookRenderBlockEvent $event)
    {
        $event->add(
            [
                'id' => 'tools_menu_ytlinker',
                'class' => '',
                'url' => URL::getInstance()->absoluteUrl('/admin/YTLinker'),
                'title' => $this->trans('YTLinker', [], YTLinker::DOMAIN_NAME)
            ]
        );
    }


    // This function was supposed to add a link + button to admin/tools.
    // The hook doesn't seem to be able to do that. Keeping the function for posterity, just in case
    /*
    public function onToolsCol1Bottom(HookRenderEvent $event)
    {
        $content = URL::getInstance()->absoluteUrl('/admin/YTLinker');
        $event->add($content);
    }
    */
}