<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%song}}`.
 */
class m220620_021540_create_song_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%song}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'artist' => $this->string()->notNull(),
            'lyrics' => $this->json()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%song}}');
    }
}
