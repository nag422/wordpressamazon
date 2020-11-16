<?php
/**
 * Template for post entry header
 * 
 * @package aquila
 */
$the_post_id   = get_the_ID();
$hide_title    = get_post_meta( $the_post_id, '_hide_page_title', true );
$heading_class = ( ! empty( $hide_title ) && 'yes' === $hide_title ) ? 'hide d-none' : '';
$has_post_thumbnail = get_the_post_thumbnail( $the_post_id );
?> 

    <?php 
     // Title
	if ( is_single() || is_page() ) {
		printf(
			'<h1 class="page-title text-dark %1$s">%2$s</h1>',
			esc_attr( $heading_class ),
			wp_kses_post( get_the_title() )
        );
        get_template_part( 'template-parts/components/blog/entry-meta');
        
	} else {
		printf(
			'<h2 class="entry-title mb-3"><a class="text-dark" href="%1$s">%2$s</a></h2>',
			esc_url( get_the_permalink() ),
			wp_kses_post( get_the_title() )
		);
	}
        if ( $has_post_thumbnail ) {
          ?>  
          <div class="card ver-1">
              <a href="<?php echo esc_url( get_permalink() ); ?>">
            <?php the_post_custom_thumbnail(
                $the_post_id,
                'featured-image',
                [
                    'sizes' => '(max-width: 250) 350px, 153px',
                    'class' => 'singlepostthumbnail'
                ]
            ); ?>
              </a>
          </div>
    <?php
        }
       
    ?>




