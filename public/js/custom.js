$(function () {
    $('#data').DataTable({
        "paging": true,
        "lengthChange": true,
        "iDisplayLength": 10,
        "searching": true,
        "ordering": true,
        "info": true,
        // "autoWidth": true,
        "responsive": true,
    });

    $('#datadetail').DataTable({
        "paging": true,
        "lengthChange": true,
        "iDisplayLength": 10,
        "searching": true,
        // "ordering": true,
        // "info": true,
        // "autoWidth": true,
        "responsive": true,
    });

    flatpickr("#tgl_input", {
        enableTime: false,
        // time_24hr: true,
        dateFormat: "Y-m-d",
        locale: "id",
    });
    
});


function showMessage(type, mess, target = "body") {

    // Options
    toastr.options = {
        "closeButton": true,
        "showDuration": "3000",
        "hideDuration": "3000",
        "timeOut": "5000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    // Target Agar bisa tampil pada saat full screen
    toastr.options.target = target;

    switch (type) {
        case "success":
            toastr.success(mess);
            break;
        case "info":
            toastr.info(mess);
            break;
        case "error":
            toastr.error(mess);
            break;
        case "warning":
            toastr.warning(mess);
            break;
    }
}

// Ambil elemen alert
var alert = $(".alert");

// Tentukan durasi timeout dalam milidetik
var timeoutDuration = 5000;

// Tunggu selama durasi timeout, lalu tutup alert
setTimeout(function() {
    alert.alert('close');
}, timeoutDuration);
