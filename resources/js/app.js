import './bootstrap';
import "../sass/app.scss";
import './script'
import * as bootstrap from "bootstrap";
import jquery, { ready } from 'jquery';
import "./sidebar";


window.jQuery = jquery;
window.$ = jquery;
window.bootstrap = bootstrap;

 



// let $  = require('jquery');
// let dt = require('datatables.net')();

 
$(document).ready( function () {
    $('#data-table').DataTable();
    $('#countries').select2();
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

 