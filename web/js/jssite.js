class QueryToServer{
	constructor(){
		this.site_url = "localhost";
	}
	
	GetAllChats(){
		var xhr = new XMLHttpRequest();
		xhr.open('GET', 'http://' + this.site_url + '/site/get-all-chats', false);
		xhr.send();
		return $.parseJSON(xhr.responseText);
	}
}

var qts = new QueryToServer();

var app = new Vue({
  el: '#app',
  data: {
    all_chats: qts.GetAllChats(),
	user_in_chat: null,
	chat_window: null,
	all_user_chats: null,
  }
})
