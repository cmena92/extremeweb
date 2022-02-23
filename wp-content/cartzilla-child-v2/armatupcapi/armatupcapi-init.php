<?php
/*
https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/


*/
add_action( 'rest_api_init', function () {
	register_rest_route( 'armatupc/v1', '/cpu/',
        array(
            'methods' => 'POST', 
            'callback' => 'getcomponentscpus'
        )
    );
   register_rest_route( 'armatupc/v1', '/coolers/',
        array(
            'methods' => 'POST', 
            'callback' => 'getcomponentcoolers'
        )
    );
	
   register_rest_route( 'armatupc/v1', '/mainboard/',
        array(
            'methods' => 'POST', 
            'callback' => 'getcomponentmainboard'
        )
    );
	
   register_rest_route( 'armatupc/v1', '/ram/',
        array(
            'methods' => 'POST', 
            'callback' => 'getcomponentram'
        )
    );
	
   register_rest_route( 'armatupc/v1', '/storage/',
        array(
            'methods' => 'POST', 
            'callback' => 'getcomponentstorage'
        )
    );
});

function getcomponentscpus( WP_REST_Request $request ){	
	$parameters = $request->get_query_params();	
	
	if ( empty( $parameters ) ) {
		return new WP_Error( 'no_params', 'Invalid params', array( 'status' => 404 ) );
	}	
	
	$meta_query = ['relation'=>'AND'];
	
	if($parameters['cpu_brandtype'] == 'all'){
		array_push($meta_query,[
			'key'	 	=> 'cpu_brandtype',
			'value'	  	=> array('intel','amd'),
			'compare' 	=> 'IN',
		]);
	}else{
		array_push($meta_query,[
			'key'	 	=> 'cpu_brandtype',
			'value'	  	=> $parameters['cpu_brandtype'],
			'compare' 	=> 'IN',
		]);
	}
	
	if($parameters['cpu_socket'] !== ''){
		array_push($meta_query,[
			'key'	 	=> 'cpu_socket',
			'value'	  	=> $parameters['cpu_socket'],
			'compare' 	=> 'IN',
		]);
	}
	
	if($parameters['cpu_cooling'] !== 'all'){
		array_push($meta_query,[
			'key'	 	=> 'cpu_cooling',
			'value'	  	=> $parameters['cpu_cooling'],
			'compare' 	=> '=',
		]);
	}
		
	$args = array (
		'post_type'     => 'product',
		'posts_per_page'    => -1,
		'meta_query'	=> $meta_query,
		
	);
	
	if(!empty($parameters['cpu_title'])){
		$args['s'] = $parameters['cpu_title'];
	}	
	
	$posts = get_posts($args);
	$response = [];
	foreach($posts as $post){
		$thumbID = get_post_thumbnail_id( $post->ID );
		$imgDestacada = wp_get_attachment_image_src( $thumbID, 'thumbnail' ); // Sustituir por thumbnail, medium, large o full
		$newCpu = [];		
		if($imgDestacada){
			$pathImgDestacada = $imgDestacada[0];		
			$newCpu['img'] = $pathImgDestacada;
		}else{
			$newCpu['img'] = '/wp-content/uploads/woocommerce-placeholder.png';
		}
		
		$fields = get_fields($post->ID);
		$product = wc_get_product($post->ID);
		$newCpu['obj'] = $post->to_array();
		$newCpu['fields'] = $fields;
		
		
		$newCpu['price'] = $product->get_price();	
		$newCpu['permalink'] = get_permalink($post->ID);
		array_push($response,$newCpu);
	}
	if(empty($response)){
		return new WP_Error( 'no_results', 'Sin resultados', array( 'status' => 204 ) );
	}
	return $response;

}

function getcomponentcoolers( WP_REST_Request $request ){
	//Get de parametros
	$parameters = $request->get_query_params();
	
	if ( empty( $parameters ) ) {
		return new WP_Error( 'no_params', 'Invalid params', array( 'status' => 404 ) );
	}
	// Set the arguments based on our get parameters
	$args = array (
		'post_type'     => 'product',
		'posts_per_page'    => -1,
		/*
		'meta_key'		=> 'enf_compatible',
		'meta_value'	=> $parameters['enf_compatible']
		*/
		'meta_query'	=> array(
		'relation'		=> 'OR',
			array(
				'key'		=> 'enf_compatible',
				'value'		=> $parameters['enf_compatible'],
				'compare'	=> 'LIKE'
			)
		)
	);
	
	$posts = get_posts($args);
	$response = [];
	foreach($posts as $post){
		$fields = get_fields($post->ID);
		$response[$post->ID] = $post->to_array();
		$response[$post->ID]['fields'] = $fields;
	}
	
	return new WP_REST_Response( $response, 200 );

}


function getcomponentmainboard( WP_REST_Request $request ){
	//Get de parametros
	$parameters = $request->get_query_params();
	
	if ( empty( $parameters ) ) {
		return new WP_Error( 'no_params', 'Invalid params', array( 'status' => 404 ) );
	}
	// Set the arguments based on our get parameters
	$args = array (
		'post_type'     => 'product',
		'posts_per_page'    => -1,		
		'meta_query'	=> array(
		'relation'		=> 'and',
			array(
				'key'		=> 'mb_chipset',
				'value'		=> $parameters['mb_chipset'],
				'compare'	=> 'LIKE'
			),
			array(
				'key'		=> 'mb_socket',
				'value'		=> $parameters['mb_socket'],
				'compare'	=> 'LIKE'
			)
		)
	);
	
	$posts = get_posts($args);
	$response = [];
	foreach($posts as $post){
		$fields = get_fields($post->ID);
		$response[$post->ID] = $post->to_array();
		$response[$post->ID]['fields'] = $fields;
	}
	
	return new WP_REST_Response( $response, 200 );

}


function getcomponentstorage( WP_REST_Request $request ){
	//Get de parametros
	$parameters = $request->get_query_params();
	
	if ( empty( $parameters ) ) {
		return new WP_Error( 'no_params', 'Invalid params', array( 'status' => 404 ) );
	}
	
	if(isset($parameters['hd_interface_m2'])){		
		$args = array (
			'post_type'     => 'product',
			'posts_per_page'    => -1,
			'meta_query'	=> array(
				'relation'		=> 'AND',
				array(
					'relation'		=> 'AND',
					array(
							'key'		=> 'hd_interface',
							'value'		=> 'm2',
							'compare'	=> 'LIKE'
						)
				),
				array(
					'relation'		=> 'OR',
					array(
						'key'		=> 'hd_format',
						'value'		=> 'ssd',
						'compare'	=> 'LIKE'
					),
					array(
						'key'		=> 'hd_format',
						'value'		=> 'exter',
						'compare'	=> 'LIKE'
					),
				)			
			)
		);
	}else{		
		$args = array (
			'post_type'     => 'product',
			'posts_per_page'    => -1,
			'meta_query'	=> array(
			'relation'		=> 'OR',
				array(
					'key'		=> 'hd_format',
					'value'		=> 'ssd',
					'compare'	=> 'LIKE'
				),
				array(
					'key'		=> 'hd_format',
					'value'		=> 'exter',
					'compare'	=> 'LIKE'
				),
				array(
					'key'		=> 'hd_interface',
					'value'		=> $parameters['hd_interface'],
					'compare'	=> 'LIKE'
				),
			)
		);
	}
	
	$posts = get_posts($args);
	$response = [];
	foreach($posts as $post){
		$fields = get_fields($post->ID);
		$response[$post->ID] = $post->to_array();
		$response[$post->ID]['fields'] = $fields;
	}	
	return new WP_REST_Response( $response, 200 );
}

 