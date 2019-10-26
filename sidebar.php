<!-- Wenn die Sidebar kein Widget hat wird die Sidebar ausgeblendet -->
<?php if ( is_active_sidebar( 'sidebar_widget' )): ?>
    <aside id="sidebar" class="container_sidebar">
            <!-- Bindet die Widgets in die Seitenleiste ein -->
            <?php dynamic_sidebar( 'sidebar_widget' ); ?>
    </aside>
<?php endif; ?>