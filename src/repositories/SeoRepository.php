<?php
/**
 * @link https://github.com/yiimaker/yii2-email-templates
 * @copyright Copyright (c) 2017-2018 Yii Maker
 * @license BSD 3-Clause License
 */

namespace boryshaiduchuk\seo\repositories;

use backend\modules\seo\models\Seo;
use Yii;
use yii\base\BaseObject;
use yii\di\Instance;
use yii\db\Connection;

class SeoRepository extends BaseObject implements SeoRepositoryInterface
{
    /**
     * @var string|array|Connection
     */
    private $_db = 'db';


    /**
     * @param string|array|Connection $db
     */
    public function setDb($db)
    {
        $this->_db = $db;
    }

    /**
     * Initialize connection to database.
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        $this->_db = Instance::ensure($this->_db, Connection::class);
    }

    /**
     * Find seo data.
     * @param int $id
     * @return Seo|null
     */
    public function getById($id)
    {
        return Seo::find()
            ->where(['id' => $id])
            ->one();
    }


    public function getBayParams($params = [])
    {
        return Seo::findOne($params);
    }
}
