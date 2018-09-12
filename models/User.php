<?php

namespace app\models;

use yii\web\Link;
use yii\web\Linkable;
use yii\helpers\Url;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements Linkable
{
	public function fields(){
		return ['nick', 'mail'];
	}
	
	public function getLinks(){
		return [
			Link::REL_SELF => Url::to(['user/view', 'id' => $this->id], true),
		];
	}
}