
<!-- Modal -->
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
			<label for="nameCPU">CPU</label>
			<input @change="getCpu($event)" v-model="cpu.title" id="nameCPU" type="text" class="form-control" placeholder="Nombre">
			<small id="nameCPUHelp" class="form-text text-muted">Busqueda por nombre de cpu.</small>
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
		<div class="container-fluid" >
			<div class="row" style='margin-bottom:5px' v-for="(cpu, index) in cpus" :key="index">
				<div class="col-sm-12" >					
					<div class="row">
						<div class="card">
						  <div class="col-sm-12">						  
							<h4><a :href="cpu.permalink" target='_blank' class="title mt-2 h5">{{cpu.obj.post_title}}</a></h4>
							 		
							<div class="row">
							  <div v-if="cpu.img" class="col-4 col-sm-4">
								
								<a :href="cpu.permalink" target='_blank' class="title mt-2 h5"> 
									<i class="navbar-tool-icon czi-search"></i> 
									<img :src="cpu.img"/>
								</a>
							  </div>
							  <div class="col-8 col-sm-8">					
									<div class="">
										<div class="">
											<span class="price h5">{{cpu.price | currency}}</span>
										</div>				
									</div>
									<ul class="list-bullet">
										<li>Frecuencia: {{cpu.fields.cpu_frequency}}</li>
										<li>Hilos: {{cpu.fields.cpu_threads}}</li>
										<li>Cache: {{cpu.fields.cpu_cache}}</li>
										<li>Socket: {{cpu.fields.cpu_socket}}</li>
										<li>Consumo: {{cpu.fields.cpu_energycost}}</li>
										<li>Chipset: {{cpu.fields.cpu_chipset}}</li>
										<li>Inc. Enfriamiento: {{cpu.fields.cpu_cooling}}</li>
									</ul>
							  </div>
							  <div style="width: 100%;padding-right: 10px;padding-bottom: 10px;"> 
							  <button 
							  
										type="button" 
										class="btn btn-success btn-sm float-right" 
										@click="setCpu(index)" 
										data-dismiss="modal"
										><i class="navbar-tool-icon czi-add"> Armar</i></button>
									
							
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
			nodata:function(){
				this.cpu.nodata = true
			},
			refresh:function(elements){
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
				var url = 'http://extremetech.loc/wp-json/armatupc/v1/cpu?'+u;
				
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
  