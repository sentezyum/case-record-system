<script>
  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  };

  var toastr_type = "<?php echo !empty($params['class']) ? $params['class'] : 'info'; ?>";
  var toastr_message = "<?php echo $message; ?>";
  toastr[toastr_type](toastr_message);
</script>
