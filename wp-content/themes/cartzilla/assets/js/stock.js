
	import { initializeApp  } from "https://www.gstatic.com/firebasejs/9.6.3/firebase-app.js"
	import { getDatabase,ref,onValue,push,set} from "https://www.gstatic.com/firebasejs/9.6.3/firebase-database.js"

	var firebaseConfig = {
	apiKey: "AIzaSyCexVbnVJYAfH06ahcaxX4CI26zQqq42jE",
	authDomain: "extremetech-4c535.firebaseapp.com",
	databaseURL: "https://extremetech-4c535-default-rtdb.firebaseio.com",
	projectId: "extremetech-4c535",
	storageBucket: "extremetech-4c535.appspot.com",
	messagingSenderId: "585953492042",
	appId: "1:585953492042:web:1989c7f8bcd70210677ab3",
	measurementId: "G-YEFYX4VMG3"
	};
	const app = initializeApp(firebaseConfig);
	const database = getDatabase();

	var app_stock = new Vue({
	el: '#app_stock',
	data: {
	stocks: [
	]
	},
	methods: {
	refresh:function(elements){
	this.stocks = elements			
	}		
	}
	})

	const starCountRef = ref(database, 'stocks/'+'USB0126');

	onValue(starCountRef, (snapshot) => {
	const data = snapshot.val();
	app_stock.refresh(data)
	});