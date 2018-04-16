<?php

namespace YTLinker\Model\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use YTLinker\Model\YtlinkerI18n;
use YTLinker\Model\YtlinkerI18nQuery;


/**
 * This class defines the structure of the 'ytlinker_i18n' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class YtlinkerI18nTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;
    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'YTLinker.Model.Map.YtlinkerI18nTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'thelia';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'ytlinker_i18n';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\YTLinker\\Model\\YtlinkerI18n';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'YTLinker.Model.YtlinkerI18n';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the ID field
     */
    const ID = 'ytlinker_i18n.ID';

    /**
     * the column name for the LOCALE field
     */
    const LOCALE = 'ytlinker_i18n.LOCALE';

    /**
     * the column name for the TITLE field
     */
    const TITLE = 'ytlinker_i18n.TITLE';

    /**
     * the column name for the LINK field
     */
    const LINK = 'ytlinker_i18n.LINK';

    /**
     * the column name for the DESCRIPTION field
     */
    const DESCRIPTION = 'ytlinker_i18n.DESCRIPTION';

    /**
     * the column name for the META_TITLE field
     */
    const META_TITLE = 'ytlinker_i18n.META_TITLE';

    /**
     * the column name for the META_DESCRIPTION field
     */
    const META_DESCRIPTION = 'ytlinker_i18n.META_DESCRIPTION';

    /**
     * the column name for the META_KEYWORDS field
     */
    const META_KEYWORDS = 'ytlinker_i18n.META_KEYWORDS';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Locale', 'Title', 'Link', 'Description', 'MetaTitle', 'MetaDescription', 'MetaKeywords', ),
        self::TYPE_STUDLYPHPNAME => array('id', 'locale', 'title', 'link', 'description', 'metaTitle', 'metaDescription', 'metaKeywords', ),
        self::TYPE_COLNAME       => array(YtlinkerI18nTableMap::ID, YtlinkerI18nTableMap::LOCALE, YtlinkerI18nTableMap::TITLE, YtlinkerI18nTableMap::LINK, YtlinkerI18nTableMap::DESCRIPTION, YtlinkerI18nTableMap::META_TITLE, YtlinkerI18nTableMap::META_DESCRIPTION, YtlinkerI18nTableMap::META_KEYWORDS, ),
        self::TYPE_RAW_COLNAME   => array('ID', 'LOCALE', 'TITLE', 'LINK', 'DESCRIPTION', 'META_TITLE', 'META_DESCRIPTION', 'META_KEYWORDS', ),
        self::TYPE_FIELDNAME     => array('id', 'locale', 'title', 'link', 'description', 'meta_title', 'meta_description', 'meta_keywords', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Locale' => 1, 'Title' => 2, 'Link' => 3, 'Description' => 4, 'MetaTitle' => 5, 'MetaDescription' => 6, 'MetaKeywords' => 7, ),
        self::TYPE_STUDLYPHPNAME => array('id' => 0, 'locale' => 1, 'title' => 2, 'link' => 3, 'description' => 4, 'metaTitle' => 5, 'metaDescription' => 6, 'metaKeywords' => 7, ),
        self::TYPE_COLNAME       => array(YtlinkerI18nTableMap::ID => 0, YtlinkerI18nTableMap::LOCALE => 1, YtlinkerI18nTableMap::TITLE => 2, YtlinkerI18nTableMap::LINK => 3, YtlinkerI18nTableMap::DESCRIPTION => 4, YtlinkerI18nTableMap::META_TITLE => 5, YtlinkerI18nTableMap::META_DESCRIPTION => 6, YtlinkerI18nTableMap::META_KEYWORDS => 7, ),
        self::TYPE_RAW_COLNAME   => array('ID' => 0, 'LOCALE' => 1, 'TITLE' => 2, 'LINK' => 3, 'DESCRIPTION' => 4, 'META_TITLE' => 5, 'META_DESCRIPTION' => 6, 'META_KEYWORDS' => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'locale' => 1, 'title' => 2, 'link' => 3, 'description' => 4, 'meta_title' => 5, 'meta_description' => 6, 'meta_keywords' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('ytlinker_i18n');
        $this->setPhpName('YtlinkerI18n');
        $this->setClassName('\\YTLinker\\Model\\YtlinkerI18n');
        $this->setPackage('YTLinker.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('ID', 'Id', 'INTEGER' , 'ytlinker', 'ID', true, null, null);
        $this->addPrimaryKey('LOCALE', 'Locale', 'VARCHAR', true, 5, 'en_US');
        $this->addColumn('TITLE', 'Title', 'VARCHAR', true, 255, null);
        $this->addColumn('LINK', 'Link', 'LONGVARCHAR', true, null, null);
        $this->addColumn('DESCRIPTION', 'Description', 'CLOB', false, null, null);
        $this->addColumn('META_TITLE', 'MetaTitle', 'VARCHAR', false, 255, null);
        $this->addColumn('META_DESCRIPTION', 'MetaDescription', 'LONGVARCHAR', false, null, null);
        $this->addColumn('META_KEYWORDS', 'MetaKeywords', 'LONGVARCHAR', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Ytlinker', '\\YTLinker\\Model\\Ytlinker', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \YTLinker\Model\YtlinkerI18n $obj A \YTLinker\Model\YtlinkerI18n object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize(array((string) $obj->getId(), (string) $obj->getLocale()));
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \YTLinker\Model\YtlinkerI18n object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \YTLinker\Model\YtlinkerI18n) {
                $key = serialize(array((string) $value->getId(), (string) $value->getLocale()));

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \YTLinker\Model\YtlinkerI18n object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Locale', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize(array((string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('Locale', TableMap::TYPE_PHPNAME, $indexType)]));
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {

            return $pks;
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? YtlinkerI18nTableMap::CLASS_DEFAULT : YtlinkerI18nTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     * @return array (YtlinkerI18n object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = YtlinkerI18nTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = YtlinkerI18nTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + YtlinkerI18nTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = YtlinkerI18nTableMap::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            YtlinkerI18nTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = YtlinkerI18nTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = YtlinkerI18nTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                YtlinkerI18nTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(YtlinkerI18nTableMap::ID);
            $criteria->addSelectColumn(YtlinkerI18nTableMap::LOCALE);
            $criteria->addSelectColumn(YtlinkerI18nTableMap::TITLE);
            $criteria->addSelectColumn(YtlinkerI18nTableMap::LINK);
            $criteria->addSelectColumn(YtlinkerI18nTableMap::DESCRIPTION);
            $criteria->addSelectColumn(YtlinkerI18nTableMap::META_TITLE);
            $criteria->addSelectColumn(YtlinkerI18nTableMap::META_DESCRIPTION);
            $criteria->addSelectColumn(YtlinkerI18nTableMap::META_KEYWORDS);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.LOCALE');
            $criteria->addSelectColumn($alias . '.TITLE');
            $criteria->addSelectColumn($alias . '.LINK');
            $criteria->addSelectColumn($alias . '.DESCRIPTION');
            $criteria->addSelectColumn($alias . '.META_TITLE');
            $criteria->addSelectColumn($alias . '.META_DESCRIPTION');
            $criteria->addSelectColumn($alias . '.META_KEYWORDS');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(YtlinkerI18nTableMap::DATABASE_NAME)->getTable(YtlinkerI18nTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getServiceContainer()->getDatabaseMap(YtlinkerI18nTableMap::DATABASE_NAME);
      if (!$dbMap->hasTable(YtlinkerI18nTableMap::TABLE_NAME)) {
        $dbMap->addTableObject(new YtlinkerI18nTableMap());
      }
    }

    /**
     * Performs a DELETE on the database, given a YtlinkerI18n or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or YtlinkerI18n object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(YtlinkerI18nTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \YTLinker\Model\YtlinkerI18n) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(YtlinkerI18nTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(YtlinkerI18nTableMap::ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(YtlinkerI18nTableMap::LOCALE, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = YtlinkerI18nQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) { YtlinkerI18nTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) { YtlinkerI18nTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the ytlinker_i18n table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return YtlinkerI18nQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a YtlinkerI18n or Criteria object.
     *
     * @param mixed               $criteria Criteria or YtlinkerI18n object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(YtlinkerI18nTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from YtlinkerI18n object
        }


        // Set the correct dbName
        $query = YtlinkerI18nQuery::create()->mergeWith($criteria);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = $query->doInsert($con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

} // YtlinkerI18nTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
YtlinkerI18nTableMap::buildTableMap();
