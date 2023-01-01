<template>
	<div>
		<div class="card-header">
			<ul>
				<li><router-link :to="{name:'Dashboard'}">Home</router-link></li>
				<li><router-link :to="{name:'ChatPage'}">Chat</router-link></li>
				<li><router-link :to="{name:'PrivateMessage'}">Inbox</router-link></li>
			</ul>
		</div>
		<div class="card-body">
			<div class="row">
				<h3 class="page-title"> Private Messages <small>my private messages</small> </h3>
			</div>
	        <div class="row">
	        	<div class="col-md-4">
	        		<ul class="list-group">
	        			<li class="list-group-item"><router-link :to="{name: 'PrivateMessage'}">Inbox</router-link></li>
	        			<li class="list-group-item"><router-link :to="{name: 'PrivateMessageCompose'}">Send Msg.</router-link></li>
	        			<li class="list-group-item"><router-link :to="{name: 'PrivateMessageSent'}">Sent</router-link></li>
	        		</ul>
	        	</div>
	        	<div class="col-md-8">		        
			        <h3>{{ messageStore.message.subject }}</h3>
			        <p>From: {{ messageStore.message.sender.email }}<span class="pull-right">{{ messageStore.message.created_at }}</span></p>
			        <div class="message">
			        	{{ messageStore.message.message }}
			        	
			        </div>
	            </div>
	        </div>
		</div>
		
	</div>
</template>
<script>
	import {mapState} from 'vuex';
	export default {

		computed:{
			...mapState({
				//this will return empty since the initial state is empty;
				//we need to trigger the action first which will then fill our list
				messageStore:(state) => state.privateMessageStore,
			})
		},
		created(){
			this.$store.dispatch('getMessageById',this.$route.params.id);
		},
		destroyed(){
			this.$store.dispatch('clearMessageView');

		}
	}
</script>