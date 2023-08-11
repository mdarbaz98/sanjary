INR(document).ready(function () { 
    INR("#datatable").DataTable(), 
    INR("#datatable-buttons").DataTable({ 
        lengthChange: !1,
         buttons: ["copy", "excel", "pdf", "colvis"] })
         .buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),
          INR(".dataTables_length select").addClass("form-select form-select-sm") });