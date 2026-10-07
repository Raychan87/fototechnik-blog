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

// Fügt bei Menüpunkten mit Untermenü einen Schalter hinzu (nur im Smartphone Modus per CSS sichtbar)
document.querySelectorAll("#fototechnik-blog-navbar li.menu-item-has-children").forEach(function(item) {
  var link = item.querySelector(":scope > a");
  var button = document.createElement("button");
  button.type = "button";
  button.className = "submenu-toggle";
  button.setAttribute("aria-expanded", "false");
  button.setAttribute("aria-label", "Untermenü von " + link.textContent.trim());
  button.addEventListener("click", function() {
    var open = item.classList.toggle("submenu-open");
    button.setAttribute("aria-expanded", open ? "true" : "false");
  });
  link.after(button);
});

// Deaktiviert das Mitscrollen im Smartphone Modus, wenn das Menü höher als der Bildschirm ist
function navmenu_stick_check() {
  var navbar = document.getElementById("fototechnik-blog-navbar");
  navbar.classList.toggle("no-stick", navbar.offsetHeight > window.innerHeight);
}
document.getElementById("responsive-nav").addEventListener("change", function(event) {
  // Beim Schließen des Menüs alle Untermenüs wieder einklappen
  if (!event.target.checked) {
    document.querySelectorAll("#fototechnik-blog-navbar li.submenu-open").forEach(function(item) {
      item.classList.remove("submenu-open");
      item.querySelector(":scope > .submenu-toggle").setAttribute("aria-expanded", "false");
    });
  }
  navmenu_stick_check();
});
document.querySelectorAll("#fototechnik-blog-navbar .submenu-toggle").forEach(function(button) {
  button.addEventListener("click", navmenu_stick_check);
});
window.addEventListener("resize", navmenu_stick_check);
navmenu_stick_check();

// Überprüft ob der Nutzer an einen großen Bildschirm sitzt
// Create a MediaQueryList object
const BigDevice = window.matchMedia("(min-width: 880px)");

// Call the match function at run time
sticky_navmenu(BigDevice);

// Add the match function as a listener for state changes
BigDevice.addEventListener("change", function(){
  sticky_navmenu(BigDevice);
});
