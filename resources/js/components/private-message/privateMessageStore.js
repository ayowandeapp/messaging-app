import Vue from 'vue';
import axios from 'axios';

export default {

	state: {
		notifications: [],
		messagesRec: [],
		messagesSent: [],
		message: {
			subject:'',
			message:'',
			sender:''
			},
		users:[],
		auth:'',
		sendMessage:'',
	},
	mutations:{
		messagesRec(state,message){
			state.messagesRec = message;
		},
		messagesSent(state,message){
			state.messagesSent = message;
		},
		message(state,message){
			state.message = message;
		},
		clearMessage(state){
			state.message = {
				subject:'',
				message:'',
				sender:''
			};
		},
		getUsers(state,users){
			state.users = users;
		},
		auth(state,user){
			state.auth = user;
		},
		sendMessage(state,message){
			state.sendMessage = message;
		}

	},
	actions:{
		getUserMessageRec({commit}){
			axios.get('/get-private-messages').then(response=>{
				commit('messagesRec',response.data.data);
			})
		},
		sentUserMessages({commit}){
			axios.get('/get-private-messages-sent').then(response=>{
				commit('messagesSent',response.data.data);
			})

		},
		getMessageById({commit}, id){
			axios.post('/get-private-message',{id:id}).then(response=>{
				commit('message',response.data.data);
			})

		},
		clearMessageView({commit}){
			commit('clearMessage');
		},
		getUsers({commit}){
			axios.get('/get-users').then(response=>{
				console.log(response.data);
				commit('getUsers',response.data.data);
				commit('auth',response.data.authUser);
			})

		},
		sendPrivateMessage({commit}, data){
			axios.post('/send-private-message',data).then(response=>{
				console.log(response.data.data);
				commit('sendMessage',response.data.data);
			})

		}


	}
}