<?php
/**
 * The main template file
 */

get_header(); ?>
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
      <div class="pagination_here"><a href=""><  Back</a></div>
     </div>
   </div>
  </div>
<?php while ( have_posts() ) : the_post();?>

  <div class="main_news_article">
   <div class="container">
     <div class="row">
		<div class="articles_are_here">
		<h2><?php the_title(); ?></h2> 
		<?php if ( has_post_thumbnail() ) : ?>
		<img src="<?php the_post_thumbnail_url(); ?>" style="max-width: 100%;"/>
		<?php endif; ?>
         <?php the_content(); ?>
		 
        </div>
     </div>
   </div>
 </div>
<?php endwhile;	?>
<?php get_footer(); ?>
