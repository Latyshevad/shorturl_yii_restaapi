<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "urls".
 *
 * @property integer $id
 * @property string $label
 * @property string $link
 * @property string $date
 */
class Urls extends \yii\db\ActiveRecord
{
    private static $chars = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM'; // Можно заменить полноценным словарём, но пока этого более чем достаточно
    private static $countChars = 6; // Длина используемого сократителя

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'urls';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label', 'link'], 'required'],
            [['link'], 'url', 'defaultScheme' => 'http'],
            [['date'], 'safe'],
            [['label'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'link' => 'Link',
            'date' => 'Date',
        ];
    }

    public function fields()
    {
        return [
            'id',
            'label',
            'link'
        ];
    }

    public function extraFields()
    {
        return ['date'];
    }

    /**
     * Проверяет есть ли такая ссылка в БД
     * @param $link
     * @return bool
     */
    public static function existLink($link)
    {

        $label = Urls::find()->where(['link' => $link])->one();
        if ($label) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Простейшая функция генерации строки с проверкой наличия её в БД
     * @return mixed|string
     */
    public static function genUrl()
    {
        $result = '';
        $size = strlen(Urls::$chars) - 1;
        $countChar = Urls::$countChars;
        while ($countChar--) {
            $result .= URLS::$chars[rand(0, $size)];
        }
        return Urls::existLink($result) ? Urls::genUrl() : $result;
    }

    /**
     * Проверяем правильность URL и возвращаем массив ошибок
     * @param $link
     * @return array
     */
    public static function getErrorLink($link)
    {
        $res = preg_match('/^(?:([a-z]+):(?:([a-z]*):)?\/\/)?(?:([^:@]*)(?::([^:@]*))?@)?((?:[a-z0-9_-]+\.)+[a-z]{2,}|localhost|(?:(?:[01]?\d\d?|2[0-4]\d|25[0-5])\.){3}(?:(?:[01]?\d\d?|2[0-4]\d|25[0-5])))(?::(\d+))?(?:([^:\?\#]+))?(?:\?([^\#]+))?(?:\#([^\s]+))?$/i', $link);
        return ($res==1) ? ['error' => false, 'errMess' => ''] : ['error' => true, 'errMess' => 'Не верный URL адресс!'];
    }
}
