<?php

use yii\db\Migration;

class m251203_034554_table_apple extends Migration
{
    const TABLE_SESSION = 'svs_session';
    const TABLE_APPLE   = 'svs_apple';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_SESSION, [
            'id'          => $this->primaryKey(),
            'user_id'     => $this->integer()->notNull()->comment('Связь по ID пользователя'),
            'tree_name'   => $this->text()->null()->comment('Личное имя дерева-сессии'),
            'create_time' => $this->integer()->unsigned()->comment('Время создания сессии'),
            'time_scale'  => $this->integer()->unsigned()->comment('Временная шкала сессии'),
            '_flags'      => $this->integer()->defaultValue(0)->unsigned()->comment('Битовые флаги'),
        ], 'COMMENT="Таблица деревьев, принадлежащих пользователям."');
        $this->addForeignKey('FK_user_session', self::TABLE_SESSION, 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');

        $this->createTable(self::TABLE_APPLE, [
            'id'          => $this->primaryKey(),
            'session_id'  => $this->integer()->notNull()->comment('Связь с деревом-сессией'),
            'apple_size'  => $this->smallInteger(2)->defaultValue(100)->unsigned()
                                  ->comment('Текущий размер яблока, в процентах'),
            'apple_color' => $this->text()->comment('Цвет яблока. RGB-код'),
            'create_time' => $this->integer()->unsigned()->comment('Время появления яблока'),
            'drop_time'   => $this->integer()->unsigned()->comment('Время падения яблока с дерева'),
            '_flags'      => $this->integer()->defaultValue(0)->unsigned()->comment('Битовые флаги'),
        ], 'COMMENT="Таблица яблок для соответствующих деревьев."');
        $this->addForeignKey('FK_apple_session', self::TABLE_APPLE, 'session_id', self::TABLE_SESSION, 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_apple_session', self::TABLE_APPLE);
        $this->dropTable(self::TABLE_APPLE);
        $this->dropForeignKey('FK_user_session', self::TABLE_SESSION);
        $this->dropTable(self::TABLE_SESSION);
    }
}
