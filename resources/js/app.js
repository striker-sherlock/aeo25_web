import './bootstrap';
import "../sass/app.scss";
import * as bootstrap from "bootstrap";


require("datatables.net-bs4/js/dataTables.bootstrap4");

//Data tables
$(document).ready(function(){
    $("#dataTables").DataTable();
})

$(document).ready(function(){
    $("#trashed").DataTable();
})

$(document).ready(function(){
    $(".dataTables").DataTable();
})