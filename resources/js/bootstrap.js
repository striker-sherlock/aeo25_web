import _ from 'lodash';
window._ = _;

import 'bootstrap';

import $ from 'jquery';
window.$ = $;

import 'datatables.net';

import DataTable from 'datatables.net';
window.DataTable = DataTable;

$(document).ready(function(){
    $('#dataTables').DataTable();
});

$(document).ready(function(){
    $('#trashed').DataTable();
});

$(document).ready(function(){
    $('.dataTables').DataTable();
});
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

    $('#competitionCarousel').carousel({
        interval: 10000
      })
      
      $('.carousel .carousel-item').each(function(){
          var minPerSlide = 3;
          var next = $(this).next();
          if (!next.length) {
          next = $(this).siblings(':first');
          }
          next.children(':first-child').clone().appendTo($(this));
          
          for (var i=0;i<minPerSlide;i++) {
              next=next.next();
              if (!next.length) {
                  next = $(this).siblings(':first');
                }
              
              next.children(':first-child').clone().appendTo($(this));
            }
      });
      

});
