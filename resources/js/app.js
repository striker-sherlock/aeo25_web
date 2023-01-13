import "@popperjs/core"
import "./bootstrap";
import "../sass/app.scss";
import "./script";
import "./sidebar";
import "./toggle-password";
import "./counter";
import "owl.carousel";

 
window.jQuery = jquery;
window.$ = jquery;
window.bootstrap = bootstrap;
$(document).ready(function () {
    $(".owl-carousel").owlCarousel();
});

