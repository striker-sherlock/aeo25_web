import './bootstrap';
import "../sass/app.scss";
import './script'
import * as bootstrap from "bootstrap";
import jquery from 'jquery';


window.jQuery = jquery;
window.$ = jquery;
window.bootstrap = bootstrap;


let $  = require( 'jquery' );
let dt = require( 'datatables.net' )();

$(document).ready( function () {
    console.log('ready');
    $('#data-table').DataTable();
} );
 
 
window.$('#data-table').DataTable();
 //  Sidebar
 if ($(window).width() < 1200) {
    var trigger = $(".page-content");

    trigger.click(function () {
        $("#page-toggled").removeClass("toggled");
        $("#footer-toggled").removeClass("toggled");
        $("#show-sidebar").show();
    });
} else {
    $("#page-toggled").addClass("toggled");
    $("#footer-toggled").addClass("toggled");
}

$("#close-sidebar").click(function () {
    $(".page-wrapper").removeClass("toggled");
    $(".footer-wrapper").removeClass("toggled");
    $("#show-sidebar").show();
});
$("#show-sidebar").click(function () {
    $(".page-wrapper").addClass("toggled");
    $(".footer-wrapper").addClass("toggled");
    $("#show-sidebar").hide();
});

$(".sidebar-dropdown > a").click(function () {
    $(".sidebar-submenu").slideUp(200);
    if ($(this).parent().hasClass("active")) {
        $(".sidebar-dropdown").removeClass("active");
        $(this).parent().removeClass("active");
    } else {
        $(".sidebar-dropdown").removeClass("active");
        $(this).next(".sidebar-submenu").slideDown(200);
        $(this).parent().addClass("active");
    }
});

// $("#alert").modal();
// $("#alert").modal("show");

// $("#event_group").modal({
//     backdrop: "static",
//     keyboard: false,
// });
// $("#event_group").modal("show");

