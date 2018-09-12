<?php
namespace app\models;

use yii\web\Link;
use yii\web\Linkable;
use yii\helpers\Url;
use yii\db\ActiveRecord;

class Message extends ActiveRecord implements Linkable
{
	public function fields(){
		return ['text','user', 'chat'];
	}
	
	public function getLinks(){
		return [
			Link::REL_SELF => Url::to(['message/view', 'id' => $this->id], true),
		];
	}
}