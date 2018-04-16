<?php
/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace YTLinker;

use Symfony\Component\Finder\Finder;
use Propel\Runtime\Connection\ConnectionInterface;
use Thelia\Install\Database;
use Thelia\Model\Resource;
use Thelia\Model\ResourceQuery;
use Thelia\Module\BaseModule;
use YTLinker\Model\YtlinkerQuery;
//use YTLinker\Model\Base\Ytlinker;
use YTLinker\Model\Base\YtlinkerI18n;

class YTLinker extends BaseModule
{
    /** @var string */
    const DOMAIN_NAME = 'ytlinker';
    const ROUTER = 'router.selection';

    public function postActivation(ConnectionInterface $con = null)
    {
        try {
            YtlinkerQuery::create()->findOne();
        } catch (\Exception $e) {
            $database = new Database($con);
            $database->insertSql(null, [__DIR__ . '/Config/thelia.sql']);
        }
    }
}
