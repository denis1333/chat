<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>

<script type="text/x-template" id="modal-template">
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header">
              default header
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
              default body
            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              <button class="modal-default-button" @click="$emit('close')">
                Cancel
              </button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</script>
<div class="site-index">
	<div id="app">
		<nav>
			<div class="nick">{{ nick }}</div>
			<div @click="showModal = true, modalType=true" class="btn btnReg">Sign up</div>
			<div @click="showModal = true, modalType=false" class="btn btnLog">Sign in</div>
		</nav>
		<div class="col-1">
			<div class="all-chats">
				<p v-for="chat in all_chats" @click="click"> {{chat.name}} </p>
			</div>
			<div class="user-in-chat">
				<p v-for="val in user_in_chat"> {{val.nick}} </p>
			</div>
		</div>
		<div class="col-2">
			<div class="chat-window">
					<div class="message-output">
						<p v-for="val in chat_messages"> {{val.text}} </p>
					</div>
				<div class="wrapper">
					<div class="message-input">
						<input type="textarea"/>
						<div class="submit-btn" @click = "makeMessage">Отправить</div>
					</div>
				</div>
			</div>
		</div>
		<modal v-if="showModal" @close="showModal = false">
			<template v-if="modalType">
				<h3 slot="header">Sign up</h3>
				<div slot="body">
				  <p>Your Nick</b></p>
				  <p><input  type="text" name="nick"><Br>
				  <p>Your Mail</b></p>
				  <input  type="text" name="mail" ><Br>
				  <p>Your Pass</b></p>
				  <input  type="text" name="pass" ></p>
				  <p><input type="submit" @click="registration(); showModal = false;"></p>
				 </div>
			</template>
			<template v-else>
				<h3 slot="header">Sign in</h3>
				<div slot="body">
				  <p>Your Mail</b></p>
				  <input  type="text" name="mail" ><Br>
				  <p>Your Pass</b></p>
				  <input  type="text" name="pass" ></p>
				  <p><input type="submit" @click="authorization(); showModal = false;"></p>
				 </div>
			</template>
	    </modal>	
	</div>
</div>
