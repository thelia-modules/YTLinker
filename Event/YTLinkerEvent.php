<?php
/**
 * Created by PhpStorm.
 * User: lurivar
 * Date: 09/04/18
 * Time: 11:35
 */

namespace YTLinker\Event;


use Thelia\Core\Event\ActionEvent;
use YTLinker\Model\Ytlinker;

class YTLinkerEvent extends ActionEvent
{
    /*---- GENERAL parts */
    protected $id;
    protected $title;
    protected $link;
    protected $description;
    protected $position;

    /*---- LOCAL parts */
    protected $locale;
    protected $currentLocale;

    /*---- YTLinker OBJECT parts */
    /** @var YTLinker $ytlinker  */
    protected $ytlinker;

    /*----------------------------- General parts */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /*----------------------------- YTLinker object Parts*/
    public function __construct(YTLinker $ytlinker = null)
    {
        $this->ytlinker = $ytlinker;
    }

    public function getYTLinker()
    {
        return $this->ytlinker;
    }

    public function setYTLinker($ytlinker)
    {
        $this->ytlinker = $ytlinker;

        return $this;
    }

    public function hasYTLinker()
    {

        return ! is_null($this->ytlinker);
    }
}