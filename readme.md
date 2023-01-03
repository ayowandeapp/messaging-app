
## About Messaging App

Messaging App is a fully functioning real time chat and private messaging app designed with vuejs,vuex and laravel. it makes use of Pusher to broadcast user updates to the directed user. 

The chat page makes use of pusher driver, laravel-echo and pusher-js. however, due to the cost involved we decided to employ Laravel Websocket (beyoundcode) to bypass this.

The private message page makes use Laravel Websocket (beyoundcode), pusher driver, laravel-echo, pusher-js

## Tech Stack (Dependencies)

 * **PHP**, **Apache**,  **VueJs**, **Vuex** and **MSQLI** - as our server language and our database of choice
 * Web socket (https://beyondco.de/docs/laravel-websockets/getting-started/installation)
 * Pusher driver (https://pusher.com/)


 You can download and install the dependencies mentioned above as:

- Download and install WAMP 
- Download and install composer from https://getcomposer.org
- Update Composer
	``` composer update ```
- start the Apache and Mysqli
- Install Vuex
	``` npm install vuex --save ```

## Development Setup

1. **Clone or Fork the project starter code locally in to the ``` C:\wamp64\www ```**
2. create an .env file
3. **Run the development server:**
	```php artisan serve```
