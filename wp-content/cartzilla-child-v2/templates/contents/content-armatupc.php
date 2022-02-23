<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Cartzilla
 */
$additional_class = 'page-armatupc';


  global $post;
  $thumbID = get_post_thumbnail_id( $post->ID );
  $imgDestacada = wp_get_attachment_image_src( $thumbID, 'full' ); // Sustituir por thumbnail, medium, large o full
  if($imgDestacada)
	$pathImgDestacada = $imgDestacada[0];
  
?>


<div class="container" style='margin:25px; max-width: 94%;' id="post-<?php the_ID(); ?>" <?php post_class( $additional_class ); ?>>

<section class="section-content padding-y" style='margin-left:25px'>
<header class="section-header">
	
	
		<h2 class="section-title">Arma tu PC </h2>
</header>

	<article id="app_armatupc">
	<!--
	-->
	
	<div class="row">		
		<div class="col">		
			<div class="alert alert-danger" role="alert">
			 <h4 class="alert-heading">Incompatibilidad!</h4>
			  <p>Existen componentes seleccionados que no pueden armarse en este pedio.</p>
			  <hr>
			  <p class="mb-0">Verifique los componentes con la alerta disponible.</p>
			</div>
		</div>
		<div class="col"> 
			<h5><i class="navbar-tool-icon czi-battery"></i> Potencia estimada :<span class="badge badge-secondary">450 W</span></h5>
			<h5><i class="navbar-tool-icon czi-wallet"></i> Costo estimado :<span class="badge badge-secondary">$ 1200</span></h5>
			<h5><i class="navbar-tool-icon czi-check-circle"></i> En stock :<span class="badge badge-secondary success">Si</span></h5>
		</div>
	</div>
	
   <table table table-striped>
    <thead class="thead-dark">
         <tr>
            <th><b>Componente</b></th>
            <th><b>Producto</b></th>
            <th><b>Descripción</b></th>
            <th style='width:12%;'><b>Precio</b></th>
            <th style='width:7%;'><b>Link</b></th>
            <th><b>Eliminar</b></th>
         </tr>
  </thead>
      <tbody >
         <tr>
            <td><b>Tipo de Procesador</b></td>
            <td>
			</td> 
				<td>
				<div class="col-md-12">
					<div class="row">							
						<div v-if="cpu.havecpu" class="col-md-4">
							<img class="img-thumbnail" :src="cpu.typeUrl"/>	
						</div>
						<div class="col-md-8">
						</div>
					</div>
				</div>
			</td>			
         </tr>
         <tr>
            <td><b>CPU</b></td>
            <td>
				<button  
					onClick="app_cpulistmodal.getCpu()" type="button" 
					class="btn  btn-dark btn-sm" data-toggle="modal" data-target="#cpuModal">
					 CPU <i class="navbar-tool-icon czi-add"></i>
				</button>
					
			</td>  
			<td>
			
				<div v-if="cpu.havecpu" class="col-md-12">					
					<div class="row">
						<div class="col-md-4">
							<img class="img-thumbnail" :src="cpu.img"/>								
						</div>
						<div class="col-md-8">
								<p>
									<h4><a href="#" class="title mt-2 h5">{{cpu.obj.post_title}}</a></h4>
									
										<li>Frecuencia: {{cpu.fields.cpu_frequency}}</li>
										<li>Hilos: {{cpu.fields.cpu_threads}}</li>
										<li>Cache: {{cpu.fields.cpu_cache}}</li>
									</ul>
								</p>
								<footer class="blockquote-footer">
									<!--Someone famous in <cite>Source Title</cite>-->
								</footer>
						</div>
					</div>
				</div>
			</td>
            <td><span v-if="cpu.havecpu" class="price h5">{{cpu.price | currency}}</span></td>
            <td>
				<a 
					v-if="cpu.havecpu" 
					target="_blank" 
					v-bind:href="cpu.permalink"> Consultar <i class="navbar-tool-icon czi-search"></i></a></td>
            <td>
				<button type="button" class="btn btn-danger">
					 Quitar
					</button>
			</td>
         </tr>
         <tr>
            <td><b>CPU Cooler</b></td>
            <td>
				<button type="button" class="btn  btn-dark btn-sm" data-toggle="modal" data-target="#coolerModal">
					 CPU Cooler <b><i class="navbar-tool-icon czi-add"></i> </b>
					</button>
					
			</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td><b>Motherboard</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td><b>Memory</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td><b>Storage</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td><b>Video Card</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td><b>Case</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td><b>Power Supply</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td><b>Monitor</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td><b>Expansion Cards / Networking</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td><b>Peripherals</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td><b>Accesories / Other</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
      </tbody>
   </table>
   </article>
 </div>
 <script>
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
	
	
 </script>
 
<?php
	get_template_part( 'templates/contents/modals/md', 'cpubrand' );
	get_template_part( 'templates/contents/modals/md', 'cpu' );
	/*
	
	get_template_part( 'templates/contents/modals', 'cooler' );
	get_template_part( 'templates/contents/modals', 'motherboard' );
	get_template_part( 'templates/contents/modals', 'memory' );
	get_template_part( 'templates/contents/modals', 'storage' );
	get_template_part( 'templates/contents/modals', 'videocard' );
	get_template_part( 'templates/contents/modals', 'case' );
	get_template_part( 'templates/contents/modals', 'powersupply' );
	get_template_part( 'templates/contents/modals', 'monitors' );
	get_template_part( 'templates/contents/modals', 'expancioncards' );
	get_template_part( 'templates/contents/modals', 'pheripherals' );
	get_template_part( 'templates/contents/modals', 'other' );*/

