    <!-- Wird geprüft ob Kommentare vorhanden sind -->
    <?php if ( have_comments() ) : ?>
        <!-- Ausgabe der Kommentare -->
        <div class="comment-list">
            <!-- Überschrift der Kommentare -->
            <h2 class="comment-title">
                <?php $comments_number = get_comments_number(); ?>
                <!-- Wenn es nur ein Kommentar ist -->
                <?php if ('1' === $comments_number ) {
                    printf('1 Kommentar'); 
                /* Oder wenn es mehr als ein Kommentar ist */
                } else {
                    printf('%1$s Kommentare',$comments_number);
                }?>
            </h2>
            <!-- Wenn Kommentare auf mehrere Seiten umgebrochen wird -->
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
                <div class="navigation">
                    <div class="nav-previous"> <?php previous_comments_link( 'Ältere Kommentare' ); ?> </div>
                    <div class="nav-next"> <?php next_comments_link( 'Neuere Kommentare' ); ?> </div>
                </div>
            <?php endif; ?>

            <!-- eine Liste der Kommentare -->
            <?php wp_list_comments(['type'=>'all', 'callback'=>'fototechnik_blog_comments']); ?>

            <!-- Wenn die Kommentare geschlossen sind -->
            <?php if ( ! comments_open() ) : ?>
                <p>Die Kommentare für diesen Beitrag sind geschlossen.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?> 

    <div class="container-comment">
        <!-- Kommentar Formular -->
        <?php $fields = array(
            'author' => '<p><label for="author">' . __( 'Dein Name <em>(erforderlich)</em>' ) . '</label><br /><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
            'email' => '<p><label for="email">' . __( 'Deine E-Mail-Adresse <em>(optional)</em>' ) . '</label><br /><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"/></p>',
            'url' => '<p><label for="url">' . __( 'Deine Website <em>(optional)</em>') . '</label><br /><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
        ); /* https://codex.wordpress.org/Function_Reference/comment_form */
        comment_form( array (
            'fields' => apply_filters( 'comment_form_default_fields', $fields ), 
            'comment_notes_before' => '<p>Bitte verfasse einen Kommentar.</p>', 
            'comment_notes_after' => '<p>Dein Kommentar wird vor der Freischaltung von einem Admin geprüft.</p>', 
            'title_reply' => __( '<h2>Schreibe einen Kommentar</h2>' ),
            'logged_in_as' => '<p class="logged-in-as">'
                                . sprintf( __( 'Angemeldet als %1$s. <a href="%2s" title="Abmelden deines Accounts">abmelden?</a>'), 
                                $user_identity),
                                wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) . '</p>',
            'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>'
        )); ?>
</div>


