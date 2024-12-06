<?php
namespace app\models;
use Yii;
/**
 * @property int $id
 * @property string $file_name
 * @property string $file_path
 * @property string|null $uploaded_at
 */
class FileUpload extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_upload';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_name'], 'required'],
            [['file_path'], 'string'],
            [['file_path'], 'default', 'value' => null],
            [
                ['file_path'],
                'file',
                'skipOnEmpty' => true,
                'extensions' => 'png, jpg, jpeg, gif, pdf',
                'checkExtensionByMimeType' => true,
                'maxSize' => 1024 * 1024 * 5
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_name' => 'File Name',
            'file_path' => 'File Path',
            'uploaded_at' => 'Uploaded At',
        ];
    }
}
