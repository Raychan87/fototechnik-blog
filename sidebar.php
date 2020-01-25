<?php
/* Wenn die Sidebar kein Widget hat wird die Sidebar ausgeblendet */
if ( is_active_sidebar('sidebar_widget') ):?>
    <aside id="sidebar" class="container_sidebar">
            <?php /* Bindet die Widgets in die Seitenleiste ein */
            dynamic_sidebar('sidebar_widget'); 
    ?></aside><?php
endif;