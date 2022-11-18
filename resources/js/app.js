import './bootstrap';
import "../sass/app.scss";
import './script'
import * as bootstrap from "bootstrap";
import jquery, { ready } from 'jquery';


window.jQuery = jquery;
window.$ = jquery;
window.bootstrap = bootstrap;

 



// let $  = require('jquery');
// let dt = require('datatables.net')();

 
$(document).ready( function () {
    console.log('ready');
    // $('#countries').select2();
    // $('#data-table').DataTable();
} );


window.$('.data-table').DataTable();
 
// toggle password
const togglePassword = $("#toggle-password");
const password = $("input[name='password']");
$(togglePassword).click(function(){
    console.log('adsf');
    const type = password.attr('type') === 'password' ? 'text' : 'password'
    password.attr('type',type);
    this.classList.toggle('fa-eye-slash')
    
})

// toggle confirm password
const toggleConfirmPassword = $("#toggle-confirm-password");
const passwordConfirm = $("input[name='password_confirmation']");
$(toggleConfirmPassword).click(function(){
    const typeConfirm = passwordConfirm.attr('type') === 'password' ? 'text' : 'password'
    passwordConfirm.attr('type',typeConfirm);
    this.classList.toggle('fa-eye-slash')
    
})


//  Sidebar
$(document).ready(function(){
    $("#page-toggled").addClass("toggled");
    $("#footer-toggled").addClass("toggled");
    if ($(window).width() < 1200) {
        var trigger = $("#page-toggled");
        // console.log('asdfsdf');
    
        trigger.click(function () {
            $("#page-toggled").removeClass("toggled");
            $("#footer-toggled").removeClass("toggled");
       
            $("#show-sidebar").show();
        });
    } else {
        console.log('asdfsdf');
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
    
})