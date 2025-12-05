<?php

namespace svs\apples\models;

use apples\models\Apple;

/**
 * This is the ActiveQuery class for [[Apple]].
 *
 * @see Apple
 */
class AppleQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Apple[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Apple|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
