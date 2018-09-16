<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="site-index">
	<div id="app">
		<div class="col-1">
			<div class="all-chats">
				<p v-for="chat in all_chats"> {{chat.name}} </p>
			</div>
			<div class="user-in-chat"></div>
		</div>
		<div class="col-2">
			<div class="chat-window">
				<div class="message-output"></div>
				<div class="message-input">
					<input type="textarea"/>
					<div class="submit-btn">Отправить</div>
				</div>
			</div>
		</div>
		<div class="col-3">
			<div class="all-user-chats">
			</div>
		</div>
	</div>
</div>
