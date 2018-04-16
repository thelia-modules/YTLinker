<?php
/**
 * Created by PhpStorm.
 * User: lurivar
 * Date: 05/04/18
 * Time: 18:30
 */

 namespace YTLinker\Loop;

 use Propel\Runtime\ActiveQuery\Criteria;
 use Thelia\Core\Template\Element\BaseI18nLoop;
 use Thelia\Core\Template\Element\LoopResult;
 use Thelia\Core\Template\Element\LoopResultRow;
 use Thelia\Core\Template\Element\PropelSearchLoopInterface;
 use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
 use Thelia\Core\Template\Loop\Argument\Argument;
 use Thelia\Core\Template\Element\StandardI18nFieldsSearchTrait;
 use Thelia\Core\Template\Element\SearchLoopInterface;
 use YTLinker\Model\Ytlinker;
 use YTLinker\Model\YtlinkerQuery;
 use YTLinker\Model\Map\YtlinkerI18nTableMap;
 use YTLinker\Model\YtlinkerI18nQuery;

 /**
  * Class YTLinker
  *
  * @package Module/YTLinker
  * @author Luc Normandon <lucnormandon@openstudio.fr>
  *
  * {@inheritdoc}
  * @method int[] getId()
  * @method string getTitle()
  * @method int getPosition()
  */
 class MySuperLoop extends BaseI18nLoop implements PropelSearchLoopInterface, SearchLoopInterface
 {
     use StandardI18nFieldsSearchTrait;

     public $countable = true;
     public $timestampable = false;
     public $versionable = false;

     /***
      * @return ArgumentCollection
      */
     public function getArgDefinitions()
     {
         return new ArgumentCollection(
             Argument::createIntListTypeArgument('id'),
             Argument::createAnyTypeArgument('title'),
             Argument::createAnyTypeArgument('link'),
             Argument::createAnyTypeArgument('description'),
             Argument::createIntListTypeArgument('position')
         );
     }

     /**
      * @return array of available field to search in
      */
     public function getSearchIn()
     {
         return $this->getStandardI18nSearchFields();
     }

     /**
      * @param YtlinkerQuery $search
      * @param string $searchTerm
      * @param array $searchIn
      * @param string $searchCriteria
      */
     public function doSearch(&$search, $searchTerm, $searchIn, $searchCriteria)
     {
         $search->_and();

         $this->addStandardI18nSearch($search, $searchTerm, $searchCriteria);
     }

     /**
      * @return \Propel\Runtime\ActiveQuery\ModelCriteria|YTLinkerQuery
      * @throws \Propel\Runtime\Exception\PropelException
      */
     public function buildModelCriteria()
     {
         $search = YtlinkerQuery::create();

         /* manage translations */
         $this->configureI18nProcessing(
             $search,
             ['TITLE', 'LINK', 'DESCRIPTION']
         );

         $id = $this->getId();
         if (!is_null($id)) {
             $search->filterById($id, Criteria::IN);
         }

         $title = $this->getTitle();
         if (!is_null($title)) {
             $this->addSearchInI18nColumn($search, 'TITLE', Criteria::LIKE, "%".$title."%");
         }

         $position = $this->getPosition();
         if (!is_null($position)) {
             $search->filterByPosition($position, Criteria::ASC);
         }

         return $search;
//         return $search->orderByPosition(Criteria::ASC);
     }

     /**
      * @param LoopResult $loopResult
      *
      * @return LoopResult
      */
     public function parseResults(LoopResult $loopResult)
     {
         foreach ($loopResult->getResultDataCollection() as $ytlinker) {

             /** @var Ytlinker $ytlinker */
             $loopResultRow = new LoopResultRow($ytlinker);

             $loopResultRow
                 ->set("ID", $ytlinker->getID())
                 ->set("TITLE", $ytlinker->getVirtualColumn('i18n_TITLE'))
                 ->set("LINK", $ytlinker->getVirtualColumn('i18n_LINK'))
                 ->set("DESC", $ytlinker->getVirtualColumn('i18n_DESCRIPTION'))
//                 ->set("TITLE", $ytlinker->geti18n_TITLE())
//                 ->set("LINK", $ytlinker->geti18n_LINK())
//                 ->set("DESC", $ytlinker->geti18n_DESCRIPTION())
//                 ->set("TITLE", $ytlinker->getTitle())
//                 ->set("LINK", $ytlinker->getLink())
//                 ->set("DESC", $ytlinker->getDescription())
                 ->set("POSITION", $ytlinker->getPosition())
                 ->set("URL", $this->getReturnUrl() ? $ytlinker->getUrl($this->locale) : null)
             ;

             $loopResult->addRow($loopResultRow);
         }

         return $loopResult;
     }

 }