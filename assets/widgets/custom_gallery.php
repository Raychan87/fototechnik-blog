<?php
/* custom_gallery.php v1.0 | by Raychan | https://github.com/Raychan87/FotoTechnik-Blog */

class fototechnik_blog_gallery extends WP_Widget { 
            
    /* Frontend-Design Funktionen */
    public function __construct(){
        $opts = array(
            'classname'		 => 'custom_gallery', 
            'description'	 => 'Zeigt Ihre Bilder in einer Gallerie an.',
        );
        parent::__construct( 'fototechnik_blog_custom_gallery','FotoTechnik-Blog: Gallerie', $opts );
    }

    /* Funktionen fuer die Ausgabe des Codes auf der Website */
    public function widget( $args, $instance ) {

        /* Name des Widgets das Angezeigt wird. */
        $title = apply_filters( 'widget_title', empty( $instance[ 'title' ] ) ? '' : $instance[ 'title' ], $instance, $this->id_base );

        echo $args[ 'before_widget' ]; 

        /* Container des Widgets */
        ?><div class="fototechnik-blog-container-recent-posts"><?php

            /* Ausgabe des Titels */
            if ( !empty( $title ) ) {
                echo $args[ 'before_title' ] . esc_html( $title ) . $args[ 'after_title' ];
            }
       
        ?></div><?php
        echo $args[ 'after_widget' ];
    } 
    /* Erstellt das Kontroll-Formular im WP-Dashboard */
    public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array(
            'title'			 => 'Gallerie',
        ) ); ?>

        /* "Titel" - Eingabefeld */ ?>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php 'Titel: '; ?></label></p>
        <p><input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" /></p>
            
    <?php } 
        
    /* Updating der Widget-Funktionen */
    public function update( $new_instance, $old_instance ) {
        $instance					 = $old_instance;
        $instance[ 'title' ]		 = sanitize_text_field( $new_instance[ 'title' ] );
        $instance[ 'post_number' ]	 = absint( $new_instance[ 'post_number' ] );
        return $instance;
    } 
}?>
