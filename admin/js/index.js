$(document).ready(function () {
    $('#orders-table').DataTable({
        // "searching": false,
        "lengthChange": false
    });
    $("#toggle-sidebar").click(function () {
        $("body").toggleClass("sidebar-icon-only");
    });
});