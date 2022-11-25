import "./bootstrap";
import "../sass/app.scss";
import "./script";
import "./sidebar";
import "./toggle-password";
import "owl.carousel";

$(document).ready(function () {
    $(".owl-carousel").owlCarousel();
});

// owl.on('mousewheel', '.owl-stage', function (e) {
//     if (e.deltaY>0) {
//         owl.trigger('next.owl');
//     } else {
//         owl.trigger('prev.owl');
//     }
//     e.preventDefault();
// });
