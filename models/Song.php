<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Song".
 *
 * @property int $id
 * @property string $title
 * @property string $artist
 * @property string $lyrics
 */
class Song extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Song';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'artist', 'lyrics'], 'required'],
            [['lyrics'], 'string'],
            [['title', 'artist'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'artist' => 'Artist',
            'lyrics' => 'Lyrics',
        ];
    }
}
