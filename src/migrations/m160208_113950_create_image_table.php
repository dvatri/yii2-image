<?php

use yii\db\Schema;
use yii\db\Migration;

class m160208_113950_create_image_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'active' => $this->boolean()->notNull()->defaultValue(1),
            'alt' => $this->string(128)->notNull(),
            'parent_id' => $this->integer(),
            'parent_model' => $this->string(64),
            'type' => $this->integer(),
            'sort' => $this->integer(),
            'mime_type' => $this->string(16)->notNull(),
            'byte_size' => $this->integer()->notNull(),
            'ext' => $this->string(8)->notNull(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('image_active', '{{%image}}', 'active');
        $this->createIndex('image_sort', '{{%image}}', 'sort');
        $this->createIndex('image_parent', '{{%image}}', ['parent_id', 'parent_model']);
        $this->createIndex('FK_image_author', '{{%image}}', 'created_by');
        $this->createIndex('FK_image_editor', '{{%image}}', 'updated_by');
        $this->addForeignKey(
            'FK_image_author', '{{%image}}', 'created_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE'
        );
        $this->addForeignKey(
            'FK_image_editor', '{{%image}}', 'updated_by', '{{%user}}', 'id', 'SET NULL', 'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('FK_image_author', '{{%image}}');
        $this->dropForeignKey('FK_image_editor', '{{%image}}');
        $this->dropIndex('FK_image_author', '{{%image}}');
        $this->dropIndex('FK_image_editor', '{{%image}}');
        $this->dropIndex('image_parent', '{{%image}}');
        $this->dropIndex('image_sort', '{{%image}}');
        $this->dropIndex('image_active', '{{%image}}');
        $this->dropTable('{{%image}}');
    }
    
}
