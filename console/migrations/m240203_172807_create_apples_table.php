<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apples}}`.
 */
class m240203_172807_create_apples_table extends Migration
{

    public function safeUp(): void
    {
        $this->createTable('{{%apples}}', [
            'id' => $this->primaryKey(),
            'color' => 'ENUM(\'red\', \'green\', \'yellow\') not null',
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'fell_at' => $this->integer(),
            'status' => $this->integer(1)->notNull(),
            'size' => $this->decimal(3  , 2)->notNull(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%apples}}');
    }
}
