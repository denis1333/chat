<?php
namespace app\models;

use yii\web\Link;
use yii\web\Linkable;
use yii\helpers\Url;
use yii\db\ActiveRecord;

class Chat extends ActiveRecord implements Linkable
{
	public function fields(){
		return ['name',];
	}
	
	public function getLinks(){
		return [
			Link::REL_SELF => Url::to(['chat/view', 'id' => $this->id], true),
		];
	}
}