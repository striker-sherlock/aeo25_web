import './bootstrap';
import * as bootstrap from "bootstrap";
import jquery, { ready } from 'jquery';
import "../sass/app.scss";
import './script'
import "./sidebar";
import "./toggle-password";
import 'owl.carousel';

window.jQuery = jquery;
window.$ = jquery;
window.bootstrap = bootstrap;


 
// $(document).ready( function () {
//     $('#data-table').DataTable();
    // $('#countries').select2();
//     window.$('.data-table').DataTable();
// } );


 



$(document).ready(function(){
    $('.owl-carousel').owlCarousel();
});



 
// owl.on('mousewheel', '.owl-stage', function (e) {
//     if (e.deltaY>0) {
//         owl.trigger('next.owl');
//     } else {
//         owl.trigger('prev.owl');
//     }
//     e.preventDefault();
// });