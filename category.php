<?php
/**
 * category template 
 */

get_header(); ?>
<?php

$term = get_queried_object();
//echo $term->term_id;
//echo $term->slug;
//var_dump($term);

?>
 <div class="page_location">
   <div class="container">
     <div class="row">
		<div class="breadcrumbs location_here" typeof="BreadcrumbList">
		  You are here: <span class="capital_area">
			<?php if(function_exists('bcn_display'))
			{
				bcn_display();
			}?>
			</span>
		</div>
     </div>
   </div>
  </div>
  
  <div class="main_news_article">
   <div class="container">
     <div class="row">
	   
       <div class="col-md-3">
	    <?php wp_nav_menu( array( 'container' => '' ,'link_before' => '<i></i>','items_wrap'=>'<ul class="category-list"> %3$s </ul>','theme_location'  => 'blog_sidebar')); ?>
	   </div>
	   <div class="col-md-9">
	    <div class="articles_title_here">		 
		<h2><?php echo $term->name;?></h2> 
		</div>
	    <div class="articles_are_here">
        <?php $subcategory_products = new WP_Query( array( 'post_type' => 'post', 'cat' => $term->term_id, 'posts_per_page'=>-1) );
            if($subcategory_products->have_posts()):
             $t=1;?>
      
            <?php while ( $subcategory_products->have_posts() ) : $subcategory_products->the_post(); ?>
          <?php if($t%3==1){echo '<div class="row">'; }?>
			<div class="col-sm-4">
			    <div class="advance_tab_part">
				  <div class="advance_tab_upper">
			      <h3><?php the_title(); ?></h3>
				  <p><?php the_excerpt(); ?></p>
				  </div>
				  <div class="find_out_more"><a href="<?php echo get_permalink( $subcategory_products->post->ID ) ?>">FIND OUT MORE</a></div>
			    </div>
			   </div>
			   
             <?php $t=$t+1; ?>
			 <?php if($t%3==1 && $t!=1){echo '</div>'; }?>
            <?php endwhile;?>   
            <?php if($t%3!=1 && $t!=1){echo '</div>'; }?>			
    <?php endif; wp_reset_query(); // Remember to reset ?>
         </div>
		</div>
     </div>
   </div>
 </div>
<?php get_footer(); ?>