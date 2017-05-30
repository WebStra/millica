<script>
    $('.subscribe_me').click(function (event) {
        event.preventDefault();
        var form = $(this).parents('form').serialize();
        var thisForm = $(this);
        thisForm.attr('disabled', 'disabled');
        $.ajax({
            url: '{{route('make_subscribe')}}',
            method: 'POST',
            dataType: 'json',
            data: form,
            success: function (data) {
                if (data.error) {
                    toastr.error('Eroare! Introduceti o adresa de email valida!');
                    setTimeout(function () {
                        thisForm.removeAttr('disabled');
                    }, 2000);
                }
                if (data.subscribed) {
                    toastr.warning('Sunteti deja abonat!!');
                    setTimeout(function () {
                        thisForm.removeAttr('disabled');
                    }, 2000);
                }
                if (data.succes) {
                    toastr.success('Multumim pentru abonare!');
                    setTimeout(function () {
                        thisForm.parents('form')[0].reset();
                        thisForm.removeAttr('disabled');
                    }, 2000);
                }
            }
        });
    });
</script>

<script>
    $('.add_to_favorite').click(function (e) {
        e.preventDefault();
        var this_ = $(this);
        var product = this_.data('id');

        if ($(this).children('i').hasClass('fa-heart-o')) {
            $(this).children('i').removeClass('fa-heart-o');
            $(this).children('i').addClass('fa-heart');
        }
        else {
            $(this).children('i').addClass('fa-heart-o');
            $(this).children('i').removeClass('fa-heart');
        }

        $.ajax({
            url: '{{route('add_to_favorite')}}',
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'product': product},
            success: function (data) {
                $('.my_favorite_products').html('('+data.countFavorites+')');
                toastr.success(data.succes);
            }
        });
    });
</script>

