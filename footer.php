<?php
/**
 * The template for displaying the footer
 *

 */
?>
  <footer> 
    <div class="subscribe_here">
    <div class="container">
     <div class="row">
	   <div class="login-form-container"> 
	   <?php dynamic_sidebar( 'home_subscribe_and_login' ); ?>
		</div> 
		<div class="clearfy"></div>
	  </div>
	</div>
  </div>
  
   <div class="event">
   <div class="container">
     <div class="row">
		<div class="event_here">
		<h2>EVENTS</h2>
		</div>
     </div>
	 <div class="row">
	     <?php
		 $args = array( 'post_type' => 'events', 'order'   => 'ASC','posts_per_page'=>3 );
		$loop = new WP_Query( $args );
		$i=0;
		while ( $loop->have_posts() ) : $loop->the_post();
		 $src = wp_get_attachment_image_src( get_post_thumbnail_id($loop->ID), 'event_thumb', false, '' );
		 $alt = get_post_meta($loop->ID, '_wp_attachment_image_alt', true);
		 ?>
		<div class="col-sm-4 event_parts">
		<img src="<?php  echo $src[0]; ?>" alt="<?php echo $alt ;?>"/>
		<h4><?php the_title() ;?></h4>
		<div class="date"><?php echo get_the_time("F")." ".get_the_time("d").":".get_the_time("Y"); ?></div>
		<div class="event_excerpt">
		<?php echo get_the_excerpt($loop->ID);?>
		</div>
		<a href="<?php echo get_permalink( $loop->ID ) ?>">
		<div  class="attend_event">
		attend this event
		</div>
		</a>
		</div>
		<?php
		endwhile;
		?>
		</div>
	 <br/><br/>
   </div>
  </div>
  
  
  <div class="news">
   <div class="container">
     <div class="row">
		<div class="news_here">
		<h2>NEWS</h2>
		</div>
     </div>
	 <div class="row">
	       <?php
		 $args = array( 'post_type' => 'news', 'order'   => 'ASC', 'posts_per_page'=>3 );
		$loop = new WP_Query( $args );
		$i=0;
		while ( $loop->have_posts() ) : $loop->the_post();
		 $link1 = get_post_meta($post->ID, 'link1', true);
		 $link2 = get_post_meta($post->ID, 'link2', true);
		 $link3 = get_post_meta($post->ID, 'link3', true);
		 ?>	 
		<div class="col-sm-4 news_parts">
		<h4><?php the_title() ;?></h4>
		<div class="news_excerpt">
		<?php echo get_the_excerpt($loop->ID);?>
		</div>
		<a href="<?php echo get_permalink( $loop->ID ) ?>">
		<div  class="read_more">
		Read More
		</div>
		</a>
		<div class="date"><?php echo get_the_time("F")." ".get_the_time("d").":".get_the_time("Y"); ?></div>
		<div class="social_link">
		<ul>
		  <li><a href="<?php echo $link1;?>"  style="padding: 8px 17px;"><i class="fa fa-facebook"></i></a></li>
		  <li><a href="<?php echo $link2;?>"><i class="fa fa-linkedin"></i></a></li>
		  <li><a href="<?php echo $link3;?>"><i class="fa fa-twitter"></i></a></li>
		</ul>
		</div>
		</div>
		<?php
		endwhile;
		?>
	 </div>	
   </div>
  </div>

  <div class="main_footer">
   <div class="container">
     <div class="row footer_top">
	  <div class="col-sm-8">
		<div class="news_here1">
		<h2>Aspiring Solicitors</h2>
		</div>
	     <div class="footer_menu">
		  <?php 
		  $sep = '|';
         $menu = wp_nav_menu( array('theme_location'  => 'footer_primary_menu', 'items_wrap'   => '<ul>%3$s</ul>', 'container' => '','echo' => 0)); 
         $parts = preg_split('#</li>.+?<li#s',$menu);
         $newmenu = implode("</li>\n$sep\n<li",$parts);
		 echo $newmenu;
		  ?>
		 </div>
	  </div> 
	 <div class="col-sm-4">
		<div class="news_here2">
		<h2>Follow Us</h2>
		</div>
	   <?php dynamic_sidebar( 'follow_us' ); ?>
	  </div> 
	 </div>
	 <div class="row">
	   <div class="col-sm-12">
	     <div class="footer_menu2">
		   <ul><li>&copy; Copyright Aspiring Solicitors 2015</li>|
		   <?php 
		  $sep = '|';
		  $menu = wp_nav_menu( array('theme_location'  => 'footer_secondary_menu', 'items_wrap'   => '%3$s', 'container' => '','echo' => 0));
          $parts = preg_split('#</li>.+?<li#s',$menu);
          $newmenu = implode("</li>\n$sep\n<li",$parts);
		  echo $newmenu;
		  ?>
		  </ul>
		  </div>
	   </div>
	 </div>
   </div>
  </div>
  
  </footer>
	
  
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.min.js"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/bootstrap.min.js"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.backstretch.min.js"></script>
	<script>

img_width=1366;
img_height=581;
function jqUpdateSize(){
    var width = $(window).width();
    var height = $(window).height();
    dwidth= width*.94;
	dheight=(581/1366)*dwidth;    // Display the width
    $('.mobile_home').css('height',dheight);    // Display the width
	if(dwidth>730)
	{
	$('.home header').css('height',dheight);
	}
		if(dwidth<730)
	{
	$('.home header').css('height','auto');
	}

};
$(document).ready(jqUpdateSize);    // When the page first loads
$(window).resize(jqUpdateSize);     // When the browser changes size


  $('#searchform #searchformswitch').click(function(e) {
  e.preventDefault();
  $('#searchform  #searchsubmit').slideToggle("slow");
  $('#searchform input[type="search"]').slideToggle("slow");
   });
	</script>
	<style>
<?php if ( is_user_logged_in() ) {?>
@media (min-width: 771px){
    body {
    margin-top: 32px;
    padding-top: 0px;
    }
	}
@media (max-width: 770px){
    body {
    padding-top: 50px;
    }
}	
<?php
}?>
	</style>
	
		    <script>
$(document).ready(function() {
	$('#myCarousel2').carousel({
	interval: 5000,
	 pause: "false"
	});

    
    
});
$(document).ready(function() {
	$('#myCarousel3').carousel({
	interval: 5000,
	 pause: "false"
	});
    
});


  	$(document).ready(function() {

if($(window).width() >767) {
$('.home header').backstretch([
         <?php
					 $args = array( 'post_type' => 'banners', 'order'   => 'ASC', 'posts_per_page'=>3 );
					$loop = new WP_Query( $args );
					$i=0;
					while ( $loop->have_posts() ) : $loop->the_post();
					 $src = wp_get_attachment_image_src( get_post_thumbnail_id($loop->ID), 'full', false, '' );
					 ?>
                   "<?php  echo $src[0]; ?>",
	              <?php
					endwhile;
					?>
  ], {duration: 4200, fade: 800});
  }
  });

</script>
	<script>			
		$("li.minimise").click(function (e) {
			e.preventDefault();
			$(this).parent( ".nav-tabs" ).parent( ".advance_tab" ).children(".tab-content").children(".active").slideToggle("slow");
			($(this).children("a").text() === "+") ? $(this).children("a").text("-") : $(this).children("a").text("+");
		});
			$(".advance_tab li").click(function (e) {
			e.preventDefault();
			$(this).parent( ".nav-tabs" ).parent( ".advance_tab" ).children(".tab-content").children(".active").attr('style', function(i, style)
			{
				return style.replace(/display[^;]+;?/g, '');
			});;
			
		});

  $(document).ready(function() {
     var title = $( '.capital_area span[property="itemListElement"]:nth-last-child(2) a' ).attr( "href" );
	  $(".pagination_here a").attr( "href",title );
    });
	</script>	
<?php wp_footer(); ?>

</body>
</html>
