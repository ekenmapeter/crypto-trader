<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function () {

    $('#crypto').on('change', function () {
        var cryptoId = this.value;

        $.ajax({
            url: '{{ route('crypto-rate') }}?id='+cryptoId,
            type: 'get',
            success: function (res) {
                $('#rate').empty(); // clear previous options
                $('#value2').empty(); // clear previous options
                $('#rate').append('<option value="' + res + '">' + res + '</option>');
                $('#value2').append('<option value="' + res + '">' + res + '</option>');
            }
        });
    }); 
});
</script>