<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    $('#categories').on('change', function () {
        var categoryId = this.value;
        $('#sub_categories').html('');
        $.ajax({
            url: '{{ route('sub_categories') }}?card_id='+categoryId,
            type: 'get',
            success: function (res) {
                $('#sub_categories').html('<option value="">Select Card Category</option>');
                $.each(res, function (key, value) {
                    $('#sub_categories').append('<option value="' + value.id + '">' + value.card_country_name + '</option>');
                });
                $('#rate').html('<option value="">Current Rate</option>');
            }
        });
    }); 

    $('#sub_categories').on('change', function () {
        var sub_categoriesId = this.value;
        $('#rate').html('');
        $('#value2').html('');
        $.ajax({
            url: '{{ route('rate') }}?card_id_id='+sub_categoriesId,
            type: 'get',
            success: function (res) {
                $.each(res, function (key, value) {
                    $('#rate').append('<option value="' + value.rate + '">' + value.rate + '</option>');
                    $('#value2').append('<option value="' + value.rate + '">' + value.rate + '</option>');
                });
            }
        });
    });
});
</script>