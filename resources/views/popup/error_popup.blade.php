 <!-- SweetAlert 2 Error Validation -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/sweetalaert2/6.4.2/sweetalert2.min.js"></script>


<script>
    var has_errors = {{ $errors->count() > 0 ? 'true' : 'false'}} ;

    if ( has_errors ) {
        Swal.fire({
          title: 'error',
          icon: 'error',
          html: jQuery("#ERROR_COPY").html(),
          showCloseButton: true,
        })

    }
</script>

   <!-- SweetAlert 2 Error Validation -->