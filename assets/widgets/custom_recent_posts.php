<!-- custom_recent_posts.php v1.0 | by Raychan | https://github.com/Raychan87/FotoTechnik-Blog -->
<?php
class fototechnik_blog_recent_posts extends WP_Widget { 
            
    // Frontend-Design Funktionen 
    public function __construct(){
        $opts = array(
            'classname'		 => 'custom_recent_posts', 
            'description'	 => 'Zeigt Ihre letzten Beiträge mit Miniaturansicht und Datum an.',
        );
        parent::__construct( 'fototechnik_blog_custom_recent_posts','FotoTechnik-Blog: Aktuelle Beiträge', $opts );
    }

    // Funktionen für die Ausgabe des Codes auf der Website -->
    public function widget( $args, $instance ) {

        // Name des Widgets das Angezeigt wird.
        $title = apply_filters( 'widget_title', empty( $instance[ 'title' ] ) ? '' : $instance[ 'title' ], $instance, $this->id_base );

        // Anzahl Beiträge die Angezeigt wird.
        $post_number = !empty( $instance[ 'post_number' ] ) ? $instance[ 'post_number' ] : 4;

        echo $args[ 'before_widget' ]; 

        // Container des Widgets
        ?><div class="fototechnik_blog_container_recent_posts"><?php

            // Ausgabe des Titels
            if ( !empty( $title ) ) {
                echo $args[ 'before_title' ] . esc_html( $title ) . $args[ 'after_title' ];
            }
            // Parameter
            $recent_args = array(
                'posts_per_page'		 => absint( $post_number ), // Anzahl der Beiträge
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
                    <span class="fototechnik_blog_recent_post_post">
                        <a class="fototechnik_blog_recent_post_thumb" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail( 'fototechnik-blog-thumbnail' ); ?>
                        </a>
                        <span class="fototechnik_blog_recent_post_text">
                            <h2>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <span class="fototechnik_blog_recent_post_date">
                                <?php echo get_the_date(); ?>
                            </span>
                            <span class="fototechnik_blog_recent_post_comments">
                                <a href="<?php echo get_comments_link(); ?>" rel="nofollow" title="<?php echo "Kommentar zu ";  the_title_attribute(); ?>">
					                <?php echo absint( get_comments_number()); echo " Kommentare"; ?>
				                </a>
                            </span>
                        </span>
                    </span>
                <?php endwhile;
                wp_reset_postdata();
            endif; 
        ?></div><?php
        echo $args[ 'after_widget' ];
    } 
    // Erstellt das Kontroll-Formular im WP-Dashboard -->
    public function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array(
            'title'			 => 'Aktuelle Beiträge',
            'post_number'	 => 4,
        ) ); ?>

        <!-- "Titel" - Eingabefeld -->
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php 'Titel: '; ?></label></p>
        <p><input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" /></p>
            
        <!-- "Anzahl der Beiträge" - Eingabefeld -->
        <p><label for="<?php echo esc_attr( $this->get_field_name( 'post_number' ) ); ?>">
                <?php 'Anzahl der Beiträge'; ?>
        </label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_number' ) ); ?>" type="number" value="<?php echo absint( $instance[ 'post_number' ] ); ?>" /></p>   
    <?php } 
        
    // Updating der Widget-Funktionen
    public function update( $new_instance, $old_instance ) {
        $instance					 = $old_instance;
        $instance[ 'title' ]		 = sanitize_text_field( $new_instance[ 'title' ] );
        $instance[ 'post_number' ]	 = absint( $new_instance[ 'post_number' ] );
        return $instance;
    } 
} ?>
