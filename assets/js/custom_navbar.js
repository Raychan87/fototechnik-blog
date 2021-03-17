/*! custom_navbar.js v1.0 | by Raychan | https://github.com/Raychan87/FotoTechnik-Blog */

/*
jQuery(document).ready(function() {
  jQuery('.toggle').on('click', function(e) {
    e.preventDefault();
    var submenu = jQuery(this).children('.sub-menu');
    if (jQuery(submenu).is(':hidden')) {
      jQuery(submenu).slideDown(200);
    } else {
      jQuery(submenu).slideUp(200);
    }
  });
});*/

// Überprüft ob der Benutzer im Mobile oder Desktop Modus ist
const smallDevice = window.matchMedia("(min-width: 768px)");
smallDevice.addListener(handleDeviceChange);

function handleDeviceChange(e) {
  if (e.matches){
    
    // Wenn der Benutzer die Seite Scrollt, wird die Funktion ausgeführt
    window.onscroll = function() {fototechnik_blog_navbar_scroll()};

    // Läd die ID vom Navbar Container
    var header = document.getElementById("fototechnik-blog-navbar");

    // Holt sich die Offset Position der Navbar
    var sticky = header.offsetTop;

    // Fügt ein Sticky Container hinzu, wenn die ID vom Navbar Container erreicht ist. Bzw. entfernt diesen auch wieder
    function fototechnik_blog_navbar_scroll() {
      if (window.pageYOffset >= sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    }
  } 
}
