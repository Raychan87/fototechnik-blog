<?php 
/* Wird geprueft ob Kommentare vorhanden sind */
if ( have_comments() ) :
    /* Ausgabe der Kommentare */?>
    <div class="comment-list">
        <?php /* ueberschrift der Kommentare */?>
        <h2 class="comment-title">
            <?php $comments_number = get_comments_number();
            /* Wenn es nur ein Kommentar ist */
            if ('1' === $comments_number ) {
                printf('1 Kommentar'); 
            /* Oder wenn es mehr als ein Kommentar ist */
            }else{
                printf('%1$s Kommentare',$comments_number);
            }?>
        </h2>
        <?php /* Wenn Kommentare auf mehrere Seiten umgebrochen wird */
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <div class="navigation">
                <div class="nav-previous"><?php previous_comments_link('Ältere Kommentare');?></div>
                <div class="nav-next"><?php next_comments_link('Neuere Kommentare');?></div>
            </div>
        <?php endif;

        /* eine Liste der Kommentare */
        wp_list_comments(['type'=>'all','callback'=>'fototechnik_blog_comments']);

        /* Wenn die Kommentare geschlossen sind */
        if ( !comments_open() ) :?>
            <p>Die Kommentare für diesen Beitrag sind geschlossen.</p>
        <?php endif; ?>
    </div>
<?php endif; ?>

<div class="container-comment">
    <?php /* Kommentar Formular */
    $fields = array(
        'author' =>'<p class="comment-form-author">' . '<input id="author" placeholder="Dein Name (erforderlich)" name="author" type="text" value="' .
            esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />'.'</p>',
        'email'  =>'<p class="comment-form-email">' . '<input id="email" placeholder="deine-email@beispiel.de (optional)" name="email" type="text" value="' . 
        esc_attr(  $commenter['comment_author_email'] ) .'" size="30"' . ' />'.'</p>',
        'url'    => '<p class="comment-form-url">' .'<input id="url" name="url" placeholder="http://deine-webseite.de (optional)" type="text" value="' . 
        esc_attr( $commenter['comment_author_url'] ) . '" size="30" /> ' .'</p>',
        'cookies'=> '',
    ); /* https://codex.wordpress.org/Function_Reference/comment_form */
    comment_form( array (
        'fields' => apply_filters( 'comment_form_default_fields', $fields ), 
        'comment_notes_before' => '', 
        'comment_notes_after' => '<p class="comment-notes-after-text">Dein Kommentar wird vor der Veröffentlichung von mir geprüft.</p>', 
        'title_reply' => ( '<h2>Schreibe einen Kommentar</h2>' ),
        'logged_in_as' => '<p class="logged-in-as">'
                            . sprintf( ( 'Angemeldet als %1$s. <a href="%2s" title="Abmelden deines Accounts">abmelden?</a>'), 
                            $user_identity),
                            wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) . '</p>',
        'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>'
    ));?>
</div>


