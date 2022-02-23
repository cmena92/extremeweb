
<!-- Modal -->

	<style>		
		.card.card_armatupc {
			margin-top: 19px;
			padding-top: 23px;
		}
		
/* Flashing */
.hover13 figure:hover img {
	opacity: 1;
	-webkit-animation: flash 1.5s;
	animation: flash 1.5s;
}
@-webkit-keyframes flash {
	0% {
		opacity: .4;
	}
	100% {
		opacity: 1;
	}
}
@keyframes flash {
	0% {
		opacity: .4;
	}
	100% {
		opacity: 1;
	}
}

	</style>
	
<div class="modal fade" id="cpuModal" tabindex="-1" role="dialog" aria-labelledby="cpuModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cpuModalLabel">Procesadores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
      <div class="modal-body" id="app_cpulistmodal">	

  <div class="row">
    <div class="col-sm-4 col-lm-4 col-md-4">


		<form>
		<div class="form-group">
			<label for="exampleFormControlSelect1">Fabricante</label>
			<select @change="getCpu($event)" v-model="cpu.type" class="form-control" id="exampleFormControlSelect1">
			  <option value="all">Todos</option>
			  <option value="intel">Intel</option>
			  <option value="amd" >AMD</option>
			</select>
		  </div>
		 <div class="form-group">
			<label for="nameCPU">Buscador por texto</label>
			<input @change="getCpu($event)" v-model="cpu.title" id="nameCPU" type="text" class="form-control" placeholder="Escriba aquí">
			<small id="nameCPUHelp" class="form-text text-muted">Nombre, campos, descripción, etc.</small>
		  </div>
			  
		  <div class="form-group">
			<label for="sockedCpu">Socket</label>
			<input @change="getCpu($event)" v-model="cpu.cpu_socket" id="sockedCpu" type="text" class="form-control" placeholder="Socket">
		  </div>
		  
		  <div class="form-group">
			<label for="exampleFormControlSelect1">Incluye enfriamiento</label>
			<select @change="getCpu($event)" v-model="cpu.cpu_cooling"  class="form-control" id="exampleFormControlSelect1">
			  <option value="all">Todos</option>
			  <option value="si">Si</option>
			  <option value="no" >No</option>
			</select>
		  </div>
		   
		  
			  
		   
		</form>
	
	</div>
	
	
	<div class="col">
		<div class="container-fluid" style='background-color: rgb(238, 238, 238);' >
			<div class="row" style='margin-bottom:5px' v-for="(cpu, index) in cpus" :key="index">
				<div class="col-sm-12" >					
					<div class="row">
						<div class="card card_armatupc">
						  <div class="col-sm-12">						  
						   <div class="row">
						   <div class="col">
								<h4><a :href="cpu.permalink" target='_blank' class="title mt-2 h5">{{cpu.obj.post_title}}</a></h4>
							</div>
							 <div class="col">
							 <span class="price h5 float-right">{{cpu.price | currency}}</span>
							 </div>
							</div>
							
							<div class="row">
							
								
		
							
							<div v-if="cpu.img" class="hover13 col-4 col-sm-4">
							  <div>
								<figure>
								<a :href="cpu.permalink" target='_blank' class="title mt-2 h5"> 
									<i class="navbar-tool-icon czi-eye"></i> 
									<img :src="cpu.img"/>
								</a>
								</figure>
							  </div>
							</div>
 
							 
							  <div class="col-8 col-sm-8">
								<span 
									v-if="statusAcf(cpu.fields.cpu_frequency)" 
									>
									<span class="text-primary"> • </span>
									Frecuencia: {{cpu.fields.cpu_frequency}}
									<br>
								 </span>
								 
								 <span 
									v-if="statusAcf(cpu.fields.cpu_socket)" 
									>
									<span class="text-primary"> • </span>
									Socket: {{cpu.fields.cpu_socket}}
								 <br>
								 </span>
								 
								 <span 
									v-if="statusAcf(cpu.fields.cpu_chipset)" 
									>
									<span class="text-primary"> • </span>
									Chipset: {{cpu.fields.cpu_chipset}}
								 <br>
								 </span>
								 	
								
									
							  <div class="collapse" v-bind:id="cpu.collapseTarget">
								 
								  <span 
									v-if="statusAcf(cpu.fields.cpu_threads)" 
									>
									<span class="text-primary"> • </span>
									Hilos: {{cpu.fields.cpu_threads}}
								 <br>
								 </span>
								  
								  <span 
									v-if="statusAcf(cpu.fields.cpu_cache)" 
									>
									<span class="text-primary"> • </span>
									Cache: {{cpu.fields.cpu_cache}}
								 <br>
								 </span>
								  
								  <span 
									v-if="statusAcf(cpu.fields.cpu_energycost)" 
									>
									<span class="text-primary"> • </span>
									Consumo: {{cpu.fields.cpu_energycost}}
								 <br>
								 </span>
								  
								  <span 
									v-if="statusAcf(cpu.fields.cpu_cooling)" 
									>
									<span class="text-primary"> • </span>
									Inc. Enfriamiento: {{cpu.fields.cpu_cooling}}
								 <br>
								 </span>
								 
								</div>
								 <span >
									<a type="button" data-toggle="collapse" v-bind:data-target="cpu.collapseTargetId" aria-expanded="false" aria-controls="collapseExample">
									Ver más 
										<i class="navbar-tool-icon czi-arrow-down"></i>  
										<!-- <i class="navbar-tool-icon czi-arrow-up"></i>  -->
								  </a>
								 <br>
								 </span>
								 
								  <div style="width: 100%;padding-right: 10px;padding-bottom: 10px;"> 
								  
								   
								  <button 
								  
											type="button" 
											class="btn btn-outline-primary btn-sm float-right" 
											@click="setCpu(index)" 
											data-dismiss="modal"
											>Armar  <i class="navbar-tool-icon czi-add"></i>
									</button>
								  <button 
								  
											type="button" 
											class="btn btn-primary btn-sm float-right" 
											@click="setCpu(index)" 
											data-dismiss="modal"
											>Ver detalles <i class="navbar-tool-icon czi-eye"></i>
									</button>
									
								
									
									

											
										
								</div>
											
							  </div>
							  
							</div>
						  </div>
						 </div>
					</div>	

					
				</div>
			</div>	
			
				<div class="col-sm-6" v-if="cpu.nodata" >
					<div class="row center">
						<p>Sin resultados</p>
					</div>
				</div>
				<div class="col-sm-6" v-if="cpu.wait" >
					<div class="row center">
						<p>Cargando...</p>
					</div>
				</div>
			
			
			




			
		  </div>
		  </div>
      </div>
	  
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
  
	
  <script  >
	
const app_cpulistmodal = new Vue({
		el: '#app_cpulistmodal',
		data: {
			cpus: [],
			cpu:{
				title:'',
				type:'all',
				cpu_socket:'',
				cpu_cooling:'all',
				nodata:false,
				wait:true
			}
		},
		methods: {
			statusAcf:function(val){
				if(val)
					return true
				return false
			},
			nodata:function(){
				this.cpu.nodata = true
			},
			refresh:function(elements){
				elements.map((item,i) =>{
					item.collapseTarget = 'collapseCpuDetails_' + i
					item.collapseTargetId = '#collapseCpuDetails_' + i
				})
				this.cpus = elements
				
				this.cpu.nodata = false
				this.cpu.wait = false
			},
			setCpu:function(el){
				app_armatupc.cpu =	this.cpus[el]
				app_armatupc.cpu.havecpu =	true
				app_armatupc.cpu.type =	this.cpus[el].fields.cpu_brandtype
				if(app_armatupc.cpu.type!='all')
					app_armatupc.cpu.typeUrl =	'/wp-content/uploads/2022/01/'+app_armatupc.cpu.type+'.png'
			},
			notSelect:function(){
				
			},
			getCpu:function(event){
				this.cpu.wait = true
															
				var data = {}
				data.cpu_brandtype = this.cpu.type
				data.cpu_title = this.cpu.title
				data.cpu_socket = this.cpu.cpu_socket				
				data.cpu_cooling = this.cpu.cpu_cooling
				
				
				let u = new URLSearchParams(data).toString();				
				var url = '/wp-json/armatupc/v1/cpu?'+u;
				
				const xhttp = new XMLHttpRequest();
				xhttp.onload = function() {
					app_cpulistmodal.cpu.wait = false
					if(xhttp.status == 204){
						app_cpulistmodal.refresh([])
						app_cpulistmodal.nodata()
					}else if(xhttp.status == 200)
						app_cpulistmodal.refresh(JSON.parse(this.responseText))
					else
						console.log(xhttp.status + 'Cargando cpus en getCpu')
				}
				xhttp.open("POST", url);
				xhttp.setRequestHeader("cache-control", "no-cache");
				xhttp.send(null)


			},
		}
	})
		
  </script>
  
  </div>
  