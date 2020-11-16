<?php
 
class Youtube_Subs_Widget extends WP_Widget {
 
    function __construct() {
 
        parent::__construct(
            'youtubesubs_widget',  // Base ID
            esc_html__('YouTube Subs Title', 'yts_domain'),   // Name
            array( 'description' => esc_html__( 'Widget to dispay YouTube subs', 'yts_domain' ),) // Args
        );
 
        add_action( 'widgets_init', function() {
            register_widget( 'Youtube_Subs_Widget' );
        });
 
    }
 
    public $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div></div>'
    );
 
    public function widget( $args, $instance ) {
 
        echo $args['before_widget'];
 
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
 
        echo '<div class="ytswidget">';
 
        echo esc_html__( $instance['text'], 'yts_domain' );

        echo '<div class="g-ytsubscribe" data-channelid="'.$instance['channel'].'" data-layout="'.$instance['layout'].'" data-count="default"></div>';
 
        echo '</div>';
 
        echo $args['after_widget'];
 
    }
 
    public function form( $instance ) {
 
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'youtubesubs title of form', 'yts_domain' );
        $text = ! empty( $instance['text'] ) ? $instance['text'] : esc_html__( '', 'yts_domain' );
        $channel = ! empty( $instance['channel'] ) ? $instance['channel'] : esc_html__( 'techguyweb', 'yts_domain' );
        $layout = ! empty( $instance['layout'] ) ? $instance['layout'] : esc_html__( 'default', 'yts_domain' );
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'yts_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'Text' ) ); ?>"><?php echo esc_html__( 'Text:', 'yts_domain' ); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" cols="30" rows="10"><?php echo esc_attr( $text ); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'channel' ) ); ?>"><?php echo esc_html__( 'Channel:', 'yts_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'channel' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'channel' ) ); ?>" type="text" value="<?php echo esc_attr( $channel ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php echo esc_html__( 'Layout:', 'yts_domain' ); ?></label>
            <select class="widefat" 
            id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" 
            name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>">
            <option value="default" <?php echo ($layout == "default") ? "selected" : ""; ?>>
            Default
            </option>
            <option value="full" <?php echo ($layout == "full") ? "selected" : ""; ?>>
            Full
            </option>
            </select>
        </p>
        
        <?php
 
    }
 
    public function update( $new_instance, $old_instance ) {
 
        $instance = array();
 
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text'] = ( !empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';
        $instance['channel'] = ( !empty( $new_instance['channel'] ) ) ? strip_tags( $new_instance['channel'] ) : '';
        $instance['layout'] = ( !empty( $new_instance['layout'] ) ) ? strip_tags( $new_instance['layout'] ) : '';
 
        return $instance;
    }
 
}
$my_widget = new Youtube_Subs_Widget();
?>