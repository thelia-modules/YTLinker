<?php
/**
 * Created by PhpStorm.
 * User: lurivar
 * Date: 06/04/18
 * Time: 18:23
 */

namespace YTLinker\Controller;

use YTLinker\Event\YTLinkerEvent;
use YTLinker\Event\YTLinkerEvents;
use YTLinker\Form\YTLinkerCreateForm;
use YTLinker\Form\YTLinkerUpdateForm;
use YTLinker\Model\Ytlinker;
use YTLinker\Model\YtlinkerI18nQuery;
use YTLinker\Model\YtlinkerQuery;
use YTLinker\Utilities\YTLinkerUtilities;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Thelia\Controller\Admin\AbstractSeoCrudController;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Tools\URL;
use Propel\Runtime\ActiveQuery\Criteria;


class YTLinkerUpdateController extends AbstractSeoCrudController
{
    protected $currentRouter = "router.YTLinker";

    /**
     * Save content after checking the link validity
     *
     * @return \Symfony\Component\HttpFoundation\Response|\Thelia\Core\HttpFoundation\Response
     * @throws \Propel\Runtime\Exception\PropelException
     */

    public function saveYTLinker()
    {
        $form = new YTLinkerUpdateForm($this->getRequest());

        $validForm  =   $this->validateForm($form);
        $data       =   $validForm->getData();
        $temptest   =   new YTLinkerUtilities();
        $was_url    =   true;

        $ytlinkerID            = $data['ytlinker_id'];
        $ytlinkerTitle         = $data['ytlinker_title'];
        if (($ytlinkerLink = ($temptest->getYoutubeId($data['ytlinker_link']))) == false) {
            $ytlinkerLink = $data['ytlinker_link'];
            $was_url = false;
        }
        $ytlinkerDescription   = $data['ytlinker_description'];

        $lang = $this->getRequest()->getSession()->get('thelia.current.lang');

        $aYTLinker = YTLinkerI18nQuery::create()
            ->filterById($ytlinkerID)
            ->filterByLocale($lang->getLocale())
            ->findOne();

        $aYTLinker
            ->setTitle($ytlinkerTitle)
            ->setLink($ytlinkerLink)
            ->setDescription($ytlinkerDescription);

        $aYTLinker->save();

        if ($was_url == true) {
            $message = ['message' => 'Youtube video : "' . $ytlinkerTitle . '" has been modified correctly.'];
        } else {
            $message = ['message' => $ytlinkerLink . ' is not a valid Youtube link. "' . $ytlinkerTitle . '" has been modified with the full link you entered.'];
        }

        return $this->render("ytlinkerlist", $message);
    }

    /***
     * Create the form and assigns the values entered by the user after checking the link validity
     *
     * @return \Thelia\Core\HttpFoundation\Response
     */
    public function createYTLinker()
    {
        $form       = new YTLinkerCreateForm($this->getRequest());

        $validForm  = $this->validateForm($form);
        $data       = $validForm->getData();
        $temptest   = new YTLinkerUtilities();
        $was_url    = true;

        $ytlinkerTitle      = $data['ytlinker_title'];
        if (($ytlinkerLink = $temptest->getYoutubeId($data['ytlinker_link'])) == false) {
            $ytlinkerLink = $data['ytlinker_link'];
            $was_url = false;
        }
        $ytlinkerDesc       = $data['ytlinker_description'];

        $lang       = $this->getRequest()->getSession()->get('thelia.current.lang');

        /*------------------------- Add in Linker table */
        $ytlinker   = new YTLinker();
        $lastYTLinker   = YTLinkerQuery::create()->orderByPosition(Criteria::DESC)->findOne();

        $date       = new \DateTime(null, new \DateTimeZone('Europe/Paris'));

        if ($lastYTLinker !== null) {
            $position = $lastYTLinker->getPosition() + 1;
        } else {
            $position = 1;
        }

        try {
            $ytlinker
                ->setCreatedAt($date->format("Y-m-d H:i:s"))
                ->setUpdatedAt($date->format("Y-m-d H:i:s"))
                ->setLocale($lang->getLocale())
                ->setPosition($position)
                ->setLink($ytlinkerLink)
                ->setTitle($ytlinkerTitle)
                ->setDescription($ytlinkerDesc);

            $ytlinker->save();

            if ($was_url == true) {
                $message = ['message' => 'Youtube video : "' . $ytlinkerTitle . '" has been added and has been assigned to ID ' . $ytlinker->getId()];
            } else {
                $message = ['message' => $ytlinkerLink . ' is not a valid Youtube link. "' . $ytlinkerTitle . '" has been added with the full link you entered, and has been assigned to ID ' . $ytlinker->getId()];
            }
        } catch (\Exception $e) {
            $message = ['message' => $e->getMessage()];
        }

        return $this->render("ytlinkerlist", $message);
    }

    /***
     * Delete a stored link.
     *
     * @return \Thelia\Core\HttpFoundation\Response
     */
    public function deleteYTLinker()
    {
        $ytlinkerID = $this->getRequest()->get('ytlinker_ID');

        try {
            $ytlinker = YTLinkerQuery::create()
                ->findOneById($ytlinkerID);
            if ($ytlinker !== null) {
                $ytlinker->delete();
                $message = ['message' => "YT Link #".$ytlinkerID." has been deleted."];
            } else {
                $message = ['message' => "YT Link #".$ytlinkerID." doesn't exists. Aborting deletion process."];
            }
        } catch (\Exception $e) {
            $message = ['message' => $e->getMessage()];
        }

        return $this->render("ytlinkerlist", $message);
    }

    /*--------------------------    Part Controller SEO */
    public function __construct()
    {
        parent::__construct(
            'ytlinker',
            'ytlinker_id',
            'order',
            AdminResources::MODULE,
            YTLinkerEvents::YTLINKER_CREATE,
            YTLinkerEvents::YTLINKER_UPDATE,
            YTLinkerEvents::YTLINKER_DELETE,
            null,
            null,
            YTLinkerEvents::YTLINKER_UPDATE_SEO,
            'YTLinker'
        );
    }
    
    protected function getCreationForm()
    {
        return $this->createForm('admin.ytlinker.update');
    }

    protected function getUpdateForm($data = array())
    {
        if (!is_array($data)) {
            $data = array();
        }

        return $this->createForm('admin.ytlinker.update', 'form', $data);
    }

    protected function hydrateObjectForm($object)
    {
        $this->hydrateSeoForm($object);

        $data = array(
            'ytlinker_id'           => $object->getId(),
            'id'                    => $object->getId(),
            'locale'                => $object->getLocale(),
            'ytlinker_title'        => $object->getTitle(),
            'ytlinker_link'         => $object->getLink(),
            'ytlinker_description'  => $object->getDescription(),
            'ytlinker_position'     => $object->getPosition(),
            'current_id'            => $object->getId(),
        );

        return $this->getUpdateForm($data);
    }

    protected function getCreationEvent($formData)
    {
        $event = new YTLinkerEvent();

        $event->setId($formData['ytlinker_id']);
        $event->setTitle($formData['ytlinker_title']);
        $event->setLink($formData['ytlinker_link']);
        $event->setDescription($formData['ytlinker_description']);

        return $event;
    }

    protected function getUpdateEvent($formData)
    {
        $ytlinker = YTLinkerQuery::create()->findPk($formData['ytlinker_id']);
        $event = new YTLinkerEvent($ytlinker);

        $event->setId($formData['ytlinker_id']);
        $event->setTitle($formData['ytlinker_title']);
        $event->setLink($formData['ytlinker_link']);
        $event->setDescription($formData['ytlinker_description']);
        $event->setLocale($this->getRequest()->getSession()->get('thelia.current.lang')->getLocale());
        return $event;
    }

    protected function getDeleteEvent()
    {
        $event = new YTLinkerEvent();

        $event->setId($this->getRequest()->request->get('ytlinker_id'));

        return $event;
    }

    protected function eventContainsObject($event)
    {
        return $event->hasYTLinker();
    }

    protected function getObjectFromEvent($event)
    {
        return $event->getYTLinker();
    }

    protected function getExistingObject()
    {
        $ytlinker = YTLinkerQuery::create()
            ->findPk($this->getRequest()->get('ytlinkerId', 0));

        if (null !== $ytlinker) {
            $ytlinker->setLocale($this->getCurrentEditionLocale());
        }

        return $ytlinker;
    }

    protected function getObjectLabel($object)
    {
        return '';
    }

    protected function getObjectId($object)
    {
        return $object->getId();
    }

    protected function renderListTemplate($currentOrder)
    {
        $this->getParser()
            ->assign("order", $currentOrder);

        return $this->render('ytlinkerlist');
    }

    protected function renderEditionTemplate()
    {
        $this->getParserContext()
            ->set(
                'ytlinker_id',
                $this->getRequest()->get('ytlinkerId')
            );

        return $this->render('ytlinker-edit');
    }

    protected function redirectToEditionTemplate()
    {
        $id = $this->getRequest()->get('ytlinker_id');

        return new RedirectResponse(
            URL::getInstance()->absoluteUrl(
                "/admin/ytlinker/update/".$id
            )
        );
    }

    protected function redirectToListTemplate()
    {
        return new RedirectResponse(
            URL::getInstance()->absoluteUrl("/admin/YTLinker")
        );
    }
}
