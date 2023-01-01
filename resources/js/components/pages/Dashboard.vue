<template>
	<div>

	    <div class="card-header">
	    	<ul>
				<li><router-link :to="{name:'Dashboard'}">Dashboard</router-link></li>
				<li><router-link :to="{name:'ChatPage'}">Chat</router-link></li>
				<li><router-link :to="{name:'PrivateMessage'}">Inbox</router-link></li>
			</ul>
	    </div>

	    <div class="card-body">
	        <!-- @if (session('status')) -->
	            <!-- <div class="alert alert-success" role="alert">
	                 {{ session('status') }} -->
	            <!-- </div>  -->
	        <!-- @endif -->

	        You are logged in!

		    </div>
	</div>

	
</template>
<script>
	export default{

	}
</script>