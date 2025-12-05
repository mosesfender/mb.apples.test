<?php

namespace svs\apples\models;

use common\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $user_id Связь по ID пользователя
 * @property string|null $tree_name Личное имя дерева-сессии
 * @property int|null $create_time Время создания сессии
 * @property int|null $time_scale Временная шкала сессии
 * @property int|null $_flags Битовые флаги
 *
 * @property Apple[] $appleApples
 * @property User $user
 */
class Session extends ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'svs_session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tree_name', 'create_time', 'time_scale'], 'default', 'value' => null],
            [['_flags'], 'default', 'value' => 0],
            [['user_id'], 'required'],
            [['user_id', 'create_time', 'time_scale', '_flags'], 'integer'],
            [['tree_name'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Связь по ID пользователя',
            'tree_name' => 'Личное имя дерева-сессии',
            'create_time' => 'Время создания сессии',
            'time_scale' => 'Временная шкала сессии',
            '_flags' => 'Битовые флаги',
        ];
    }

    /**
     * Gets query for [[AppleApples]].
     *
     * @return \yii\db\ActiveQuery|AppleQuery
     */
    public function getAppleApples()
    {
        return $this->hasMany(Apple::class, ['session_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return SessionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SessionQuery(get_called_class());
    }

}
