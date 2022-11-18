import _ from 'lodash';
window._ = _;

import 'bootstrap';

import $ from 'jquery'
window.$ = $;

import 'datatables.net'

import DataTable from 'datatables.net';
window.DataTable = DataTable;




/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

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
