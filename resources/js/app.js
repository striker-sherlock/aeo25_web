import "./bootstrap";
import "../sass/app.scss";
import "./script";
import "./sidebar";
import "./toggle-password";
import "owl.carousel";

$(document).ready(function(){
   console.log('dsfasdfsaf');   
})
 
window.jQuery = jquery;
window.$ = jquery;
window.bootstrap = bootstrap;
$(document).ready(function () {
    $(".owl-carousel").owlCarousel();
});

 