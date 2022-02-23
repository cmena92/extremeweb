<?php

?>
<style>
.container_img {
  position: relative;
  width: 50%;
}

.image {
  display: block;
  width: 100%;
  height: auto;
}

.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .5s ease;
}

.container_img:hover .overlay {
  opacity: 1;
}

.text {
  color: white;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
}
</style>
  

    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div style="height:58px" class="container-fluid">
			
	
  <?php
	if( have_rows('brands_repeater', 'option') ): ?>
    <?php while( have_rows('brands_repeater', 'option') ): the_row(); ?>		 
	  <a 
		<?php if(get_sub_field('brands_targetblank')){ echo 'target="_blank"'; } ?>		
		href="<?php the_sub_field('brands_linke'); ?>" 
		class="navbar-brand d-none d-sm-block mr-4 order-lg-1 custom-logo-link"
		rel="home" 
		style="width: 214px;">

		<div class="container_img">		 
			<img 
				width="428" 
				height="146" 
				src="<?php the_sub_field('brands_opacity_image'); ?>" 
				class="custom-logo" 
				alt="alt extremetechcr">

			<div class="overlay">			
				<img 
					width="428" 
					height="146" 
					src="<?php the_sub_field('brands_color_image'); ?>" 
					class="custom-logo" 
					alt="alt extremetechcr">
			</div>
		</div>
	</a>
  
    <?php endwhile; ?>
<?php endif; ?>
 
	</div>
	</div>
 