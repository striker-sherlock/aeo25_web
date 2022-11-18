import _ from 'lodash';
window._ = _;

import 'bootstrap';

import $ from 'jquery'
window.$ = $;


import DataTable from 'datatables.net';
window.DataTable = DataTable;

DataTable($);


import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

$(document).ready(function () {

    $('.InstitutionContactTable').DataTable();
    $('.FollowUpTable').DataTable();
    $('#DoneFollowUpTable').DataTable();
    $('#OnProgressFollowUpTable').DataTable();
    $('#MediaPartnerTable').DataTable();
    $('#InventoryTable').DataTable();
    $('#AccessControlTable').DataTable();

});
