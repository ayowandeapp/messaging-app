<template>
	<div class="row">
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
	        		<form @submit.prevent="handleForm()" method="post">
	        			<div class="form-group mb-0">
        					<label class="col-form-label">Select User(s)</label>
	    					<select class="form-control" v-model="formvalue.receiver">
	                            <option>Select User</option>
    							<option v-for="user in messageStore.users" :value="user" v-if="user.id !=messageStore.auth">{{user.name}}</option>
	                        </select>	  
	        			</div>	        			
	        			<div class="form-group mb-0">
        					<label class="mb-2 pb-1">Subject</label>
        					<input type="text" class="form-control"  v-model="formvalue.subject" placeholder="Enter Subject">
        			</div>	        			
	        			<div class="form-group mb-0">
        					<label class="mb-2 pb-1">Message</label>
        					<textarea v-model="formvalue.message" placeholder="Enter Message" class="form-control" rows="2"></textarea> 
	        			</div>
	        			<div class="form-group mb-0">
	        				<input type="submit" name="Send" class="btn btn-primary"> 
	        			</div>
	        		</form>

	            </div>
	        </div>
		</div>
		
	</div>
</template>
<script>
	import {mapState} from 'vuex';
	export default {
		data(){
			return{
				formvalue:{
					receiver:'',
					subject:'',
					message:''
				}

			}
		},
		computed:{
			...mapState({
				//this will return empty since the initial state is empty;
				//we need to trigger the action first which will then fill our list
				messageStore:(state) => state.privateMessageStore,
			})
		},
		created(){
			this.$store.dispatch('getUsers');
		},
		methods:{
			handleForm(){
				let data = {
					'receiver_id': this.formvalue.receiver.id,
					'message': this.formvalue.message,
					'subject': this.formvalue.subject
				}
				this.$store.dispatch('sendPrivateMessage',data).then(response=>{
					this.$router.push({name:'PrivateMessage'});
				});
				console.log(this.formvalue);
			}

		}
	}
</script>