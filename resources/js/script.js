$(document).ready(function () {

    //  Show Modal
    var myModal = new bootstrap.Modal(document.getElementById('alert'));
    myModal.show();

    $(".modal").modal("show");

    // Insert Datatables
    $('InstitutionContactTable').dataTable({
        processing: true,
        order: [],
        columnDefs: [{
            targets: [6],
            orderable: false,
        }],
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 pl-0 pr-1'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5 pr-0 my-1'i><'col-sm-12 col-md-7 pl-0 my-1'p>>",
        pageLength: 5,
        lengthMenu: [[5, 10, 25, -1], [5, 10, 25, "All"]]
    });

    $('#MediaPartnerTable').DataTable({
        processing: true,
        order: [],
        columnDefs: [{
            targets: [6],
            orderable: false,
        }],
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 pl-0 pr-1'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5 pr-0 my-1'i><'col-sm-12 col-md-7 pl-0 my-1'p>>",
        pageLength: 5,
        lengthMenu: [[5, 10, 25, -1], [5, 10, 25, "All"]]
    });

    $('#InventoryTable').dataTable({
        processing: true,
        order: [],
        columnDefs: [{
            targets: [6],
            orderable: false,
        }],
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 pl-0 pr-1'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5 pr-0 my-1'i><'col-sm-12 col-md-7 pl-0 my-1'p>>",
        pageLength: 5,
        lengthMenu: [[5, 10, 25, -1], [5, 10, 25, "All"]]
    });

    $("#FlightTicketsTable").dataTable({
        processing: true,
        order: [],
        columnDefs: [
            {
                targets: [6],
                orderable: false,
            },
        ],
        dom:
            "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 pl-0 pr-1'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5 pr-0 my-1'i><'col-sm-12 col-md-7 pl-0 my-1'p>>",
        pageLength: 5,
        lengthMenu: [
            [5, 10, 25, -1],
            [5, 10, 25, "All"],
        ],
    });
});
