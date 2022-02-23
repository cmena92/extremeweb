
const app_cpulistmodal = new Vue({
		el: '#app_cpulistmodal',
		data: {
			cpus: [],
			cpu:{
				type:'all',
				nodata:true
			}
		},
		methods: {
			nodata:function(){
				this.cpu.nodata = true
			},
			refresh:function(elements){
				this.cpus = elements
				this.cpu.nodata = false
			},
			setCpu:function(el){
				app_armatupc.cpu =	this.cpus[el]
				app_armatupc.cpu.havecpu =	true
				app_armatupc.cpu.type =	this.cpus[el].fields.cpu_brandtype
				if(this.cpu.type!='all')
					app_armatupc.cpu.typeUrl =	'/wp-content/uploads/2022/01/'+this.cpu.type+'.png'
			},
			notSelect:function(){
				
			},
			getCpu:function(event){
				const xhttp = new XMLHttpRequest();
				xhttp.onload = function() {
					if(this.status == 204){
						app_cpulistmodal.refresh([])
						app_cpulistmodal.nodata()
					}
					else
						app_cpulistmodal.refresh(JSON.parse(this.responseText))
				}
				xhttp.open("POST", "http://extremetech.loc/wp-json/armatupc/v1/cpu?cpu_brandtype="+this.cpu.type+'&cpu_title=prueba');
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
				xhttp.send("cpu_brandtype="+pcArmada.cpuBrand)
			},
		}
	})
	
	function searchCpu(){
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function() {
			app_cpulistmodal.refresh(JSON.parse(this.responseText))
		}
		xhttp.open("POST", "http://extremetech.loc/wp-json/armatupc/v1/cpu?cpu_brandtype=intel");
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		xhttp.send("cpu_brandtype="+pcArmada.cpuBrand)
	}
		