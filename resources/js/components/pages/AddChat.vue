<template>
	<div>
		<form @submit.prevent = "handleAddChat()" method="post">
			<div class="form-group">
				<div class="m-t-20">
                    <p class="text-muted mb-3 font-13">
                        Reply
                    </p>
                    <textarea id="textarea" v-model="sendchat" class="form-control" rows="3" placeholder="Reply."></textarea>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Send</button>
                </div>
            </div>
        </form>		
	</div>
</template>


<script>
	import {mapState} from 'vuex';
	import Echo from 'laravel-echo';

	export default{
		created(){

			let that = this;
			// this.pusher = new Pusher('051efabfe6e28ffcffaf',{
			// 	cluster: 'mt1'
			// })
			// this.channel = this.pusher.subscribe('chats');
		 //    this.channel.bind('chat.created', function(data) {
		    window.Echo.channel('chats').listen('.chat.created', event => {
		    	that.$emit('incoming_chat',event)
		      //app.messages.push(JSON.stringify(data));
		        //console.log(event);
		      //this.$store.dispatch('addNewChat', data);
		    });
		    this.$on('incoming_chat', function (chatMessage) {
		    	this.incomingChat(chatMessage)
		    })

		},
		computed:{
			...mapState({
				currentChatUser:(state)=>state.currentChatUser,
			})
			
		},
		data(){
			return {
				sendchat:'',
				pusher:'',
				channel:''
			}
		},
		methods:{
			handleAddChat(){
				if(this.sendchat != ''){
					let data = {
						receiver_id: this.currentChatUser.id,
						chat:this.sendchat,
					}
					//console.log(data);
					this.$store.dispatch('addNewChat', data)
						.then(response=>{
						this.sendchat ='';
					});					

				}
			},
			incomingChat(chatMessage){
				if(this.currentChatUser.id === chatMessage.chat.sender_id){
					//console.log('chatMessage', chatMessage);
					this.$store.dispatch('newIncomingChat', chatMessage).then(res=>{
						let element = document.getElementById('chat')
						element.scrollIntoView(false)
					})
				}
			}

		}

	}
</script>