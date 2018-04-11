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
 use YTLinker\Model\Ytlinker;
 use YTLinker\Model\YtlinkerQuery;

 class MySuperLoop extends BaseI18nLoop implements PropelSearchLoopInterface {

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
      * @return \Propel\Runtime\ActiveQuery\ModelCriteria|YTLinkerQuery
      * @throws \Propel\Runtime\Exception\PropelException
      */
     public function buildModelCriteria()
     {
         $search = YtlinkerQuery::create();

         return $search->orderByPosition(Criteria::ASC);
     }

     public function parseResults(LoopResult $loopResult)
     {
         foreach ($loopResult->getResultDataCollection() as $ytlinker) {

             /** @var Ytlinker $ytlinker */
             $loopResultRow = new LoopResultRow($ytlinker);

             $loopResultRow
                 ->set("ID", $ytlinker->getID())
                 ->set("TITLE", $ytlinker->getTitle())
                 ->set("LINK", $ytlinker->getLink())
                 ->set("DESC", $ytlinker->getDescription())
                 ->set("POSITION", $ytlinker->getPosition())
             ;

             $loopResult->addRow($loopResultRow);
         }

         return $loopResult;
     }

 }