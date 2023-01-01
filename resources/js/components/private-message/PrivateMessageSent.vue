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
			        <table class="table table-hover table-condensed">
			        	<thead>
			        		<tr>			        			
				        		<th>Receiver Name</th>
				        		<th>Subject</th>
				        		<th>Created_at</th>
			        		</tr>
			        	</thead>
	                    <tbody>
	                    	<tr v-for="message in messageStore.messagesSent" :key="message.id">
		                        <td class="col-md-3">{{message.receiver.name}}</td>
		                        <td class="col-md-7"><router-link :to="{name: 'ViewPrivateMessage',params: {id:message.id}}">{{message.subject}}</router-link></td>
		                        <td class="col-md-2">{{message.created_at}}</td>
	                    	</tr>
	                    </tbody>
	                </table>
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
			this.$store.dispatch('sentUserMessages');
		},
		methods:{

		}


	}

</script>