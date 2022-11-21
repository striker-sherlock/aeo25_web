import './bootstrap';
import "../sass/app.scss";
import './script'
import * as bootstrap from "bootstrap";
import jquery, { ready } from 'jquery';
import "./sidebar";


window.jQuery = jquery;
window.$ = jquery;
window.bootstrap = bootstrap;




let dt = require('datatables.net')();

$(document).ready(function(){

})
$(document).ready( function () {
    console.log('ready');
    $('#data-table').DataTable();
} );



window.$('#data-table').DataTable();
 
