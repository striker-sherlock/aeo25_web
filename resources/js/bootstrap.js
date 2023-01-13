import _ from "lodash";
window._ = _;

import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;

import $ from "jquery";
window.$ = $;

import DataTable from "datatables.net";
window.DataTable = DataTable;

// Setup Datatable
$(document).ready(function () {
    $("#dataTables").DataTable();
    $(".dataTables").DataTable();
});
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

$(document).ready(function () {
    $(".InstitutionContactTable").DataTable();
    $(".FollowUpTable").DataTable();
    $("#DoneFollowUpTable").DataTable();
    $("#OnProgressFollowUpTable").DataTable();
    $("#MediaPartnerTable").DataTable();
    $("#InventoryTable").DataTable();
    $("#AccessControlTable").DataTable();

    $("#competitionCarousel").carousel({
        interval: 10000,
    });

    $(".carousel .carousel-item").each(function () {
        var minPerSlide = 3;
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(":first");
        }
        next.children(":first-child").clone().appendTo($(this));

        for (var i = 0; i < minPerSlide; i++) {
            next = next.next();
            if (!next.length) {
                next = $(this).siblings(":first");
            }

            next.children(":first-child").clone().appendTo($(this));
        }
    });



});

// Enable Popover
var popoverTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="popover"]')
);
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl);
});

$("#btnConfirmSubmit").on("click", function () {
    let submissionLink = $("#submission_link").val();
    $("#confirmLink").attr("href", submissionLink);
  })
  $(document).ready(function () {
    $("#sendSubmission").prop("disabled", true);
    $("#confirmLink").on("click", function () {
      $("#sendSubmission").prop("disabled", false);
    })
  })
  function submit() {
    $("#form").submit();
  }
  $('.modal').insertAfter($('section'));
