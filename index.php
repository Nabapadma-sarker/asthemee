<?php
/**
 * The main template file
 */

get_header('home'); ?>


  
  <div class="company_logo hide_one_div">
   <div class="container">
     <div class="row">
		<ul>
			<?php
			 $args = array( 'post_type' => 'company_logos', 'order'   => 'ASC','posts_per_page'=>-1 );
			$loop = new WP_Query( $args );
			$count_pages =$loop->post_count;
			$i=0;
			while ( $loop->have_posts() ) : $loop->the_post();
			 $src = wp_get_attachment_image_src( get_post_thumbnail_id($loop->ID), 'company_thumb', false, '' );
			 $alt = get_post_meta($loop->ID, '_wp_attachment_image_alt', true);
			 ?>
			   <li><a href="<?php the_title() ;?>"><img src="<?php  echo $src[0]; ?>" alt="<?php echo $alt ;?>" /></a></li>
		   <?php 
			endwhile;
			?>	
		</ul>
     </div>
   </div>
  </div>
  
  <div class="company_logo hide_one_div1">
   <div class="container">
       <div class="col-md-12">
            <div id="myCarousel1" class="carousel slide">
                
                <!-- Carousel items -->
                <div class="carousel-inner">
				   <div class="item active">
                       <div class="row">
							<ul>
					 <?php
					 $args = array( 'post_type' => 'company_logos', 'order'   => 'ASC','posts_per_page'=>-1 );
					$loop = new WP_Query( $args );
					$count_pages =$loop->post_count;
					$i=0;
					while ( $loop->have_posts() ) : $loop->the_post();
					 $src = wp_get_attachment_image_src( get_post_thumbnail_id($loop->ID), 'company_thumb', false, '' );
					 $alt = get_post_meta($loop->ID, '_wp_attachment_image_alt', true);
					 ?>
                    
							 <li><a href="<?php the_title() ;?>"><img src="<?php  echo $src[0]; ?>" alt="<?php echo $alt ;?>" /></a></li>
					<?php 
					$i=$i+1;
					if($i%4==0&&$i!=0&&$i!=$count_pages)	
                      {?>					
						   </ul>
					</div> 
					</div> 
					<div class="item">
                       <div class="row">
							<ul>
					<?php
					}
					if($i==$count_pages)
					{?>
					  </ul>
					</div> 
				</div> 
					<?php }
					endwhile;
					?>	
             </div>
<a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel1" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
     </div>
     </div>
   </div>
  </div>  
  

  <script>
$(document).ready(function() {
	$('#myCarousel1').carousel({
	interval: false;
	})
    
    $('#myCarousel1').on('slid.bs.carousel', function() {
    	//alert("slid");
	});
    
    
});


</script>
  

<?php get_footer('home'); ?>
