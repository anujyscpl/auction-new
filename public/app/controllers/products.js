$(document).ready(function() {

$('input[type="file"]').change(function (e) {
    const array = [];
    for (let i = 0; i < e.target.files.length; i++) {
        array.push(e.target.files[i].name)
    }
    console.log(e.target.files)
    $('.custom-file-label').html(array.join(', '));
});

$('#category').on('change', function () {
    const category_id = this.value;
    $("#sub_category").html('');
    $.ajax({
        url: '/admin/sub-category',
        type: "POST",
        data: {
            category_id: category_id,
            _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (res) {
            $('#sub_category').html('<option value="">-- Select Sub Category --</option>');
            $.each(res.sub_categories, function (key, value) {
                $("#sub_category").append('<option value="' + value
                    .id + '">' + value.name + '</option>');
            });
        }
    });
});


});
