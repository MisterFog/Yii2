<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "festivals".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title_ru
 * @property string $title_en
 * @property string $caption_ru
 * @property string $caption_en
 * @property string $content_ru
 * @property string $content_en
 * @property string $contacts
 * @property string $emails
 * @property string $logo
 * @property string $brand
 * @property int $country_id
 * @property int $genre_id
 * @property string $media_photo
 * @property string $media_video
 * @property string $files
 * @property string $start_date
 * @property string $end_date
 * @property string $coord
 */
class Festivals extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'festivals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'country_id', 'genre_id'], 'integer'],
            [['title_ru', 'title_en', 'genre_id'], 'required'],
            [['caption_ru', 'caption_en', 'content_ru', 'content_en', 'contacts', 'emails', 'logo', 'brand', 'media_photo', 'media_video', 'files', 'coord'], 'string'],
            [['start_date', 'end_date'], 'safe'],
            [['title_ru', 'title_en'], 'string', 'max' => 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title_ru' => 'Title Ru',
            'title_en' => 'Title En',
            'caption_ru' => 'Caption Ru',
            'caption_en' => 'Caption En',
            'content_ru' => 'Content Ru',
            'content_en' => 'Content En',
            'contacts' => 'Contacts',
            'emails' => 'Emails',
            'logo' => 'Logo',
            'brand' => 'Brand',
            'country_id' => 'Country ID',
            'genre_id' => 'Genre ID',
            'media_photo' => 'Media Photo',
            'media_video' => 'Media Video',
            'files' => 'Files',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'coord' => 'Coord',
        ];
    }
}
