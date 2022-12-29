import Vue from 'vue';

import Vuex from 'vuex';

import axios from 'axios';

Vue.use(Vuex);

export const store = new Vuex.Store({
	state: {
		userList: [],
		currentChatUser: '',
		conversations: '',

	},
	mutations:{
		setUserList(state,userList){
			state.userList = userList;
		},
		showChatUser(state, user){
			state.currentChatUser = user;
		},
		showConversations(state, conversations){
			state.conversations = conversations;
		},
		addChatToConversation(state, chat){
			state.conversations.push(chat);
		}


	},
	actions:{
		setUserList({commit},userList){
			axios.get('/get-users').then(response=>{
				//console.log(response);
				if(response.status === 200){
					commit('setUserList',response.data);
					return response.data;
				}
			})

		},
		showChatUser({commit},user){
			commit('showChatUser',user);
			let data = {id:user.id};
			axios.post('/get-user-conversation',data).then(response=>{
				//console.log(response);
				if(response.status === 200){
				//console.log(response.data);					
					//commit('showChatUser',user);
					commit('showConversations',response.data);
				}
			})
		},
		addNewChat({commit},data){
			axios.post('/add-new-chat',data).then(response=>{
				// console.log(response);
				if(response.status === 200){
					//console.log(response.data);			
					commit('addChatToConversation',response.data);
				}
			})
		},
		newIncomingChat({commit}, message){
			//console.log(message.chat);
			commit('addChatToConversation',message.chat);

		}
	}
})