<?php

namespace app\controllers;

use Yii;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\rest\ActiveController;
use app\models\Urls;

class UrlsController extends ActiveController
{
    public $modelClass = 'app\models\Urls';

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => Cors::className(),
            ],
        ]);
    }

    public function actionSearch()
    {
        $label = Yii::$app->request->post('label');
        $urls = Urls::find()->where(['label' => $label])->one();

        if($urls){
            return ['status' => 'ok', 'urls' => $urls->link];
        }else{
            return ['status' => 'err', 'mess' => 'No link!'];
        }
    }

    public function actionCreurl()
    {
        $error = false;
        $link = Yii::$app->request->post('link');

        $error = Urls::getErrorLink($link);

        $statLink = Urls::existLink($link);
        if($statLink==true){
            $url = Urls::find()->where(['link' => $link])->one();
            $label = $url->label;
        }else{
            $label = Urls::genUrl();
            $urls = new Urls();
            $urls->label = $label;
            $urls->link = $link;
            $urls->date = date("Y-m-d H:i:s");
            $urls->save();
        }

        return [
            'errors' => $error,
            'link' => (!$error['error']) ? $label : false,
            'status' => $statLink
        ];
    }
}
