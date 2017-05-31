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

<?php the_content(); ?>

<?php endwhile;	?>
<?php get_footer(); ?>
