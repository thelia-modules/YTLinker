<?php
/**
 * Created by PhpStorm.
 * User: lurivar
 * Date: 06/04/18
 * Time: 19:15
 */

namespace YTLinker\Action;

use Propel\Runtime\Propel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Thelia\Action\BaseAction;
use Thelia\Core\Event\UpdateSeoEvent;
use YTLinker\Event\YTLinkerEvent;
use YTLinker\Event\YTLinkerEvents;
use YTLinker\Model\Map\YtlinkerTableMap;
use YTLinker\Model\Map\YtlinkerI18nTableMap;
use YTLinker\Model\Ytlinker;
use YTLinker\Model\YtlinkerI18n;
use YTLinker\Model\YtlinkerQuery;
use YTLinker\Form\YTLinkerUpdateForm;
use YTLinker\Utilities\YTLinkerUtilities;

class YTLinkerAction extends BaseAction implements EventSubscriberInterface
{
    public function create(YTLinkerEvent $event)
    {
        $this->createOrUpdate($event, new YTLinker());
    }

    public function update(YTLinkerEvent $event)
    {
        $model = $this->getYTLinker($event);

        $this->createOrUpdate($event, $model);
    }

    /**
     * Change YTLinker SEO
     *
     * @param UpdateSeoEvent $event
     * @param $eventName
     * @param EventDispatcherInterface $dispatcher
     * @return Object
     */
    public function updateSeo(UpdateSeoEvent $event, $eventName, EventDispatcherInterface $dispatcher)
    {
        return $this->genericUpdateSeo(YtlinkerQuery::create(), $event, $dispatcher);
    }

    public function delete(YTLinkerEvent $event)
    {
        $this->getYTLinker($event)->delete();
    }

    protected function getYTLinker(YTLinkerEvent $event)
    {
        $model = YTLinkerQuery::create()
            ->findPk($event->getId());

        if ($model == null) {
            throw new \RuntimeException(sprintf(
                "The ID '%d' doesn't exist.",
                $event->getId()
            ));
        }
        return $model;
    }

    protected function createOrUpdate($event, YTLinker $model)
    {
        $temp       = new YTLinkerUtilities();
        $connect    = Propel::getConnection(YtlinkerI18nTableMap::DATABASE_NAME);
        $connect->beginTransaction();
        try {
            if (null !== $locale = $event->getCurrentLocale()) {
                $model->setLocale($locale);
            }
            if (null !== $id = $event->getId()) {
                $model->setId($id);
            }
            if (null !== $title = $event->getTitle()) {
                $model->setTitle($title);
            }
            if (null !== $link = $event->getLink()) {
                if (($linkShortened = ($temp->getYoutubeId($link))) == false) {
                    $linkShortened = $link;
                }
                $model->setLink($linkShortened);
            }
            if (null !== $description = $event->getDescription()) {
                $model->setDescription($description);
            }
            if (null !== $position = $event->getPosition()) {
                $model->setPosition($position);
            }

            $model->save();

            $event->setYTLinker($model);

            $connect->commit();
        } catch (\Exception $err) {
            $connect->rollBack();

            throw $err;
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            YTLinkerEvents::YTLINKER_CREATE              => array("create", 128),
            YTLinkerEvents::YTLINKER_UPDATE              => array("update", 128),
            YTLinkerEvents::YTLINKER_DELETE              => array("delete", 128),
            YTLinkerEvents::YTLINKER_UPDATE_SEO          => array("updateSeo", 128),
        );
    }
}