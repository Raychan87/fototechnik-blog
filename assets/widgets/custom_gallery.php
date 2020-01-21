<!-- custom_gallery.php v1.0 | by Raychan | https://github.com/Raychan87/FotoTechnik-Blog -->
<?php
class fototechnik_blog_gallery extends WP_Widget { 
            
    // Frontend-Design Funktionen 
    public function __construct(){
        $opts = array(
            'classname'		 => 'custom_gallery', 
            'description'	 => 'Zeigt Ihre Bilder in einer Gallerie an.',
        );
        parent::__construct( 'fototechnik_blog_custom_gallery','FotoTechnik-Blog: Gallerie', $opts );
    }

    // Funktionen für die Ausgabe des Codes auf der Website -->
    public function widget( $args, $instance ) {

        // Name des Widgets das Angezeigt wird.
        $title = apply_filters( 'widget_title', empty( $instance[ 'title' ] ) ? '' : $instance[ 'title' ], $instance, $this->id_base );

        // Anzahl Beiträge die Angezeigt wird.
        $post_number = !empty( $instance[ 'post_number' ] ) ? $instance[ 'post_number' ] : 4;

        echo $args[ 'before_widget' ]; 

        // Container des Widgets
        ?><div class="fototechnik_blog_container_gallery"><?php

            // Ausgabe des Titels
            if ( !empty( $title ) ) {
                echo $args[ 'before_title' ] . esc_html( $title ) . $args[ 'after_title' ];
            }
            // Parameter
            $recent_args = array(
                'no_found_rows'			 => true, // Gibt an, ob die Anzahl der insgesamt gefundenen Zeilen übersprungen werden soll. Das Aktivieren kann die Leistung verbessern. Voreinstellung ist false.
                'post__not_in'			 => get_option( 'sticky_posts' ), // Ein Array von Post-IDs, die nicht abgerufen werden sollen. Hinweis: Eine Reihe von durch Kommas getrennten IDs funktioniert NICHT.
                'ignore_sticky_posts'	 => true, // Wenn "true" dann wird Sticky Posts übersprungen
                'post_status'			 => 'publish', // Beitragsstatus als (String) oder Array
            );
            $recent_posts = new WP_Query( $recent_args );
            // Wird geprüft ob ein Betrag gibt
            if ( $recent_posts->have_posts() ) :
                while ( $recent_posts->have_posts() ) :
                    $recent_posts->the_post(); ?>
                    <!-- Widgeht Inhalt -->
                    <div class="fototechnik_blog_gallery_post">
                    
                        // Code der Gallery
                        
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            endif; 
        ?></div><?php
        echo $args[ 'after_widget' ];
    } 
    // Erstellt das Kontroll-Formular im WP-Dashboard -->
    public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array(
            'title'			 => 'Gallerie',
        ) ); ?>

        <!-- "Titel" - Eingabefeld -->
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php 'Titel: '; ?></label></p>
        <p><input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" /></p>
   <?php } 
        
    // Updating der Widget-Funktionen
    public function update( $new_instance, $old_instance ) {
        $instance					          = $old_instance;
        $instance[ 'title' ]		    = sanitize_text_field( $new_instance[ 'title' ] );
        $instance[ 'post_number' ]	= absint( $new_instance[ 'post_number' ] );
        return $instance;
    } 
} ?>
