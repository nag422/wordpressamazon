<?php
/**
* Home page template
*@Package:aquila

*/

get_header();
?>
<style>
#blogcontainer {
  margin-top: -5%;
}
@media screen and (max-width: 480px){
  #blogcontainer {
  margin-top: auto;
}



}
</style>
<div class="section-2">
           
      <div class="container" id="blogcontainer">
        <div class="row">
          <div class="col-12">
            <div class="head-intro ver-1" data-position="center" data-max-width="700">
              <span class="subtitle" data-color="secondary">Products</span>
              <h2>Make Your Project Reality!</h2>

            </div>
          </div>
        </div>
        <div class="row items">
        <?php 
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        query_posts(array('showposts'=> 4, 'paged' =>$paged));
        if ( have_posts() ) {

          $count = 0;
          
            while ( have_posts() ) {
                the_post(); 
                get_template_part('template-parts/content');       
                $count ++;    
                
         
                
          
            };
           
                  
            
        
        }
        
        
        else{
            _e('sorry Noposts');
            if(is_home() && current_user_can('publish_posts')) {
              ?>
              <p>
                <?php
                    printf(
                      wp_kses(
                        __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>','aquila' ),
                        [
                           'a' => [
                             'href' => []
                           ]
                        ]
                           ),
                           esc_url(admin_url( 'post-new.php'))
                    )
                ?>
              </p>
              <?php
              
            }
            elseif ( is_search()){
              esc_html_e('No matching Found.', 'aquila');
              get_search_form();
            }
        }
        ?>
        
        </div>
      </div>
      <?php
 function pagination_bar() {
  global $wp_query;

  $total_pages = $wp_query->max_num_pages;

  if ($total_pages > 1){
      $current_page = max(1, get_query_var('paged'));

      echo paginate_links(array(
          'base' => get_pagenum_link(1) . '%_%',
          'format' => 'page/%#%',
          'current' => $current_page,
          'total' => $total_pages,
      ));
  }
}?>
<div class="text-center mt-5" style="margin-left:25%">
<nav aria-label="Page navigation example">
<ul class="pagination">
<?php
pagination_bar();
      ?>
</ul>
</nav>
    </div>

    <?php get_footer('other'); ?>