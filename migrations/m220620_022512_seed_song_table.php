<?php

use yii\db\Migration;

/**
 * Class m220620_022512_seed_song_table
 */
class m220620_022512_seed_song_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insertFakeSongs();
    }

    private function insertFakeSongs()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 50; $i++) {
            $this->insert(
                'song',
                [
                    'title' => $faker->name,
                    'artist' => $faker->name,
                    'lyrics' => json_encode([$faker->sentence, $faker->sentence, $faker->sentence]),
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "no rows deleted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220620_022512_seed_song_table cannot be reverted.\n";

        return false;
    }
    */
}
