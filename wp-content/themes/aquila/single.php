<?php

/**
 * Single Post page template
 * @Package:aquila

 */

get_header();
?>

<style>
  #respond {
    /* background-color: gray; */
  }

  li {
    list-style: none;
  }

  .slider {
    width: 100%;
    margin: 100px auto;
  }

  .slick-slide {
    margin: 0px 20px;
  }

  .slick-slide img {
    width: 100%;
  }

  .slick-prev:before,
  .slick-next:before {
    color: black;
  }


  .slick-slide {
    transition: all ease-in-out .3s;
    opacity: .2;
  }

  .slick-active {
    opacity: .5;
  }

  .slick-current {
    opacity: 1;
  }
</style>

<div class="section-2">

  <div class="container">

    <div class="row items">
      <div class="col-md-10">
        <?php
        

        if (have_posts()) {
          while (have_posts()) {
            the_post();
            get_template_part('template-parts/contentsingle');

        ?>

        <?php
          };
        }
        ?>
<nav>
        <ul class="pagination">
          <li class="page-item mr-2"><?php previous_post_link('%link', '&laquo Prev Post', TRUE, '13'); ?></li>         
         
          <li class="page-item ml-2"><?php next_post_link('%link', 'Next Post &raquo', TRUE, '13'); ?></li>
        </ul>
        </nav>

        
        <div class="container">

          <section class="regular slider">
            <?php
            $args = array(
              'post_type' => 'post',
              'posts_per_page' => 4,
          );
      
          $post_query = new WP_Query($args);
            if ($post_query->have_posts()) {
              while ($post_query->have_posts()) {
                $post_query->the_post();   ?>
                
                <div>
                <a href="<?php echo esc_url( get_permalink() ); ?>">
                
            <?php the_post_custom_thumbnail(
              
              $post_query->post_id(),
                'featured-thumbnail',
                [
                    'sizes' => '(max-width: 350) 350px, 233px',
                    'class' => 'featured-attachment'
                ]
            ); echo the_title(); ?>
              </a>
                  <!-- <img src="http://placehold.it/350x300?text=1"> -->
                </div>
                
            <?php }
            }
            wp_reset_postdata(); ?>

          </section>
          
        </div>
        <div class="container">
          <?php comment_form(); ?>
        </div>




      </div>
      <div class="col-md-2">
        <?php
        get_sidebar('sidebar-1');
        

        ?>
      </div>


    </div>
  </div>

</div>


<?php get_footer('other'); ?>