/*! custom_navbar.js v1.0 | by Raychan | https://github.com/Raychan87/FotoTechnik-Blog */

//Funktion für das Anhaengen des Navmenue am Bildschirmrand
function sticky_navmenu(x) {
  if (x.matches){
    // Wenn der Benutzer die Seite Scrollt, wird die Funktion ausgeführt
    window.onscroll = function() {fototechnik_blog_navbar_scroll()};

    // Läd die ID vom Navbar Container
    var navbar = document.getElementById("fototechnik-blog-navbar");

    // Holt sich die Offset Position der Navbar
    var sticky = navbar.offsetTop;

    // Fügt ein Sticky Container hinzu, wenn die ID vom Navbar Container erreicht ist. Bzw. entfernt diesen auch wieder
    function fototechnik_blog_navbar_scroll() {
      if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
      } else {
        navbar.classList.remove("sticky");
      }
    }
  } 
}

// Überprüft ob der Nutzer an einen großen Bildschirm sitzt
// Create a MediaQueryList object
const BigDevice = window.matchMedia("(min-width: 880px)");

// Call the match function at run time
sticky_navmenu(BigDevice);

// Add the match function as a listener for state changes
BigDevice.addEventListener("change", function(){
  sticky_navmenu(BigDevice);
});
