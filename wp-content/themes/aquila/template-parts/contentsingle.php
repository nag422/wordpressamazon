<?php

/**
 * Content template
 * 
 * @package aquila
 */
?>
<div class="col-lg-12 col-md-12" id="post-<?php the_ID(); ?>" <?php post_class( 'mb-6' ); ?>>
<?php 

    get_template_part( 'template-parts/components/blog/entry-singleheader');
    
    get_template_part( 'template-parts/components/blog/entry-content');
    get_template_part( 'template-parts/components/blog/entry-footer');
?>
    
</div>

