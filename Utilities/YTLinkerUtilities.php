<?php
/**
 * Created by PhpStorm.
 * User: lurivar
 * Date: 10/04/18
 * Time: 16:52
 */

namespace YTLinker\Utilities;


class YTLinkerUtilities
{

    /***
     * Check a link passed as parameter. Returns the youtube video ID if found, a hard copy of what was entered
     * if not, and a false boolean if what was entered was too broken to be read.
     *
     * @param $url
     * @return bool
     */
    public function getYoutubeId($url)
    {
        $parts = parse_url($url);
        if (isset($parts['host'])) {
            $host = $parts['host'];
            if (
                false === strpos($host, 'youtube') &&
                false === strpos($host, 'youtu.be')
            ) {
                return false;
            }
        }
        if (isset($parts['query'])) {
            parse_str($parts['query'], $qs);
            if (isset($qs['v'])) {
                return $qs['v'];
            }
            else if (isset($qs['vi'])) {
                return $qs['vi'];
            }
        }
        if (isset($parts['path'])) {
            $path = explode('/', trim($parts['path'], '/'));
            return $path[count($path) - 1];
        }
        return false;
    }

}