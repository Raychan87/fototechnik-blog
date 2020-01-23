<div class="container_navbar">
  <?php /* Fügt eine Checkbox und ein Navigations Button für den Smartphone Modus */ ?>
  <input type="checkbox" id="responsive-nav"> 
  <label for="responsive-nav" class="responsive-nav-label"><span>&#9776;</span></label>
  <?php /* Das Menü fängt hier an */ ?>
  <nav  class="container-main_menu">
    <?php wp_nav_menu( array( 
      'theme_location' => 'navbar',
      'container-id' => ''
    ) ); ?>
  </nav>
</div>
