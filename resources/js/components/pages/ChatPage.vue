<template>
	<div>
		<div class="card-header">
			<ul>
				<li><router-link :to="{name:'Dashboard'}">Home</router-link></li>
				<li><router-link :to="{name:'ChatPage'}">Chat</router-link></li>
			</ul>
		</div>

	    <div class="card-body">
	        <!-- @if (session('status')) -->
	            <!-- <div class="alert alert-success" role="alert">
	                 {{ session('status') }} 
	             </div> 
	             @endif -->
	        <div class="row">
	        	<div class="col-md-4">
	        		<ul class="list-group">
	        			<li :class="{active: userActiveChat(user)}" @click="showChatUser(user)" v-if="user.id !=setUserList.authUser " class="list-group-item" v-for="user in setUserList.data">{{user.name}}</li>
	        		</ul>
	        	</div>
		        <div class="col-md-8">
		        	<ul class="list-group" id="chat">
			        	<li v-for="chat in conversations" class="list-group-item">
			        		<div class="sender-data clearfix">
			        			<div>{{chat.sender.name}}</div>
			        			<div>{{chat.created_at}}</div>
			        		</div>
			        		<div class="chat-body">
			        			{{chat.chat}}
			        			
			        		</div>
			        	</li>
		        	</ul>
		        	<div>
		        		<add-chat></add-chat>
		        	</div>
		        </div>
	        </div>
		</div>
		

	</div>
</template>

<script>
	import {mapActions} from 'vuex';
	import {mapState} from 'vuex';
	import AddChat from './AddChat'

	export default{
		components:{
			'add-chat' : AddChat,

		},
		data(){
			return {

			}
		},
		computed:{
			...mapState({
				//this will return empty since the initial state is empty;
				//we need to trigger the action first which will then fill our list
				setUserList:(state) => state.userList,
				currentChatUser:(state) => state.currentChatUser,
				conversations:(state) => state.conversations,

			})
		},
		created(){
			this.$store.dispatch('setUserList');
		},
		methods:{
			userActiveChat(user){
				if(this.currentChatUser == null) {
					return false;
				}
				if(this.currentChatUser.id === user.id){
					return true;
				}
				return false;

			},	
			showChatUser(user){
				//console.log(user);
				this.$store.dispatch('showChatUser', user);

			},
		}
	}
</script>