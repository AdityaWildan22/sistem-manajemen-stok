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

    $('#data-dashboard').DataTable({
        "paging": true,
        "lengthChange": true,
        "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
        "iDisplayLength": 5,
        "searching": true,
        "responsive": true,
    });

    $('#data-dashboard2').DataTable({
        "paging": true,
        "lengthChange": true,
        "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
        "iDisplayLength": 5,
        "searching": true,
        "responsive": true,
    });

    flatpickr("#tgl_input", {
        enableTime: false,
        // time_24hr: true,
        dateFormat: "Y-m-d",
        locale: "id",
    });

    flatpickr("#tgl_akhir", {
        enableTime: false,
        // time_24hr: true,
        dateFormat: "Y-m-d",
        locale: "id",
    });

    flatpickr("#tgl_awal", {
        enableTime: false,
        // time_24hr: true,
        dateFormat: "Y-m-d",
        locale: "id",
    });

    // Foto click
    $("#avatar").click(function () {
        $("#file").click();
    });

    // Ketika file input change
    $("#file").change(function () {
        setImage(this, "#avatar");
    });
    
    
});

// Read Image
function setImage(input, target) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      // Mengganti src dari object img#avatar
      reader.onload = function (e) {
        $(target).attr('src', e.target.result);
        $("#foto").val(e.target.result);
      }
  
      reader.readAsDataURL(input.files[0]);
    }
  }
  


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

// // Ambil elemen alert
// var alert = $(".alert");

// // Tentukan durasi timeout dalam milidetik
// var timeoutDuration = 5000;

// // Tunggu selama durasi timeout, lalu tutup alert
// setTimeout(function() {
//     alert.alert('close');
// }, timeoutDuration);
