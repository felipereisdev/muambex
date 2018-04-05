$(function() {
    $(".rastrear-muamba").click(function() {
        var id = $(this).data('id');
        var codigoRastreio = $(this).data('codigo-rastreio');
        var token = $(this).data('token');

        $.ajax({
            url: CONTROLLER + 'rastrear_muambas',
            type: 'POST',
            data: {
                id: id,
                codigoRastreio: codigoRastreio,
                _token: token
            },
            dataType: 'html',
            beforeSend: function () {
                waitingDialog.show('Aguarde...', {dialogSize: 'sm'});
            },
            success: function(data) {
                swal(data);
            },
            complete: function () {
                waitingDialog.hide();
            }
        });
    });
});