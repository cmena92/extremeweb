

	Vue.filter('currency', function (value) {
		var val = (value / 1).toFixed(2).replace('.', ',');
		return '₡ ' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
	});
	
	
	const app_armatupc = new Vue({
		el: '#app_armatupc',
		data: {
			cpu:{
				havecpu:false
			}
		},
		methods: {
			
		}
	})
	
	var pcArmada = [];
	
	function selectCpuBrand(type){
		app_armatupc.cpubrand.type = type
		app_armatupc.cpubrand.havetype = true
	}
	