<?php

namespace svs\apples\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $session_id  Связь с деревом-сессией
 * @property int|null $apple_size  Текущий размер яблока, в процентах
 * @property string|null $apple_color Цвет яблока. RGB-код
 * @property int|null $create_time Время появления яблока
 * @property int|null $drop_time   Время падения яблока с дерева
 * @property int|null $_flags      Битовые флаги
 *
 * @property Session $session
 */
class Apple extends ActiveRecord
{

    /** Флаги состояние яблока */
    const AS_ON_TREE   = 0x1; // На дереве
    const AS_DROPPED   = 0x2; // Упало с дерева
    const AS_ROTTED    = 0x4; // Сгнило
    const AS_COMPOSTED = 0x8; // Выкинуто в компост

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'svs_apple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apple_color', 'create_time', 'drop_time'], 'default', 'value' => null],
            [['apple_size'], 'default', 'value' => 100],
            [['_flags'], 'default', 'value' => 0],
            [['session_id'], 'required'],
            [['session_id', 'apple_size', 'create_time', 'drop_time', '_flags'], 'integer'],
            [['apple_color'], 'string'],
            [['session_id'], 'exist', 'skipOnError' => true, 'targetClass' => Session::class,
             'targetAttribute'                      => ['session_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'session_id'  => 'Связь с деревом-сессией',
            'apple_size'  => 'Текущий размер яблока, в процентах',
            'apple_color' => 'Цвет яблока. RGB-код',
            'create_time' => 'Время появления яблока',
            'drop_time'   => 'Время падения яблока с дерева',
            '_flags'      => 'Битовые флаги',
        ];
    }

    /**
     * Gets query for [[Session]].
     *
     * @return \yii\db\ActiveQuery|SessionQuery
     */
    public function getSession()
    {
        return $this->hasOne(Session::class, ['id' => 'session_id']);
    }

    /**
     * {@inheritdoc}
     * @return AppleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppleQuery(get_called_class());
    }

}
