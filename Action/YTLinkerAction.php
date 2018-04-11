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
use YTLinker\Event\YTLinkerEvent;
use YTLinker\Event\YTLinkerEvents;
use YTLinker\Model\Map\YtlinkerTableMap;
use YTLinker\Model\Ytlinker;
use YTLinker\Model\YtlinkerQuery;
use YTLinker\Form\YTLinkerUpdateForm;

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

    protected function createOrUpdate(YTLinkerEvent $event, YTLinker $model)
    {
        $connect = Propel::getConnection(YTLinkerTableMap::DATABASE_NAME);
        $connect->beginTransaction();
        try {
            if ($locale = $event->getLocale() !== null) {
                $model->setLocale($locale);
            }
            if ($id = $event->getId() !== null) {
                $model->setId($id);
            }
            if ($title = $event->getTitle() !== null) {
                $model->setTitle($title);
            }
            if ($link = $event->getLink() !== null) {
                $model->setLink($link);
            }
            if ($description = $event->getDescription() !== null) {
                $model->setDescription($description);
            }
            if ($position = $event->getPosition() !== null) {
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