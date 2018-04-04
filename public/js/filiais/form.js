$(function() {
    $("#form_filial").validate({
        rules: {
            nome: "required"
        },
        messages: {
            nome: "Campo Obrigatório"
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
            $('label').attr('style', 'color: black');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#nome").change(function () {
        var campo = "nome";
        var valor = $(this).val();
        var token = $("[name='_token']").val();
        var id = $("[name='id']").val();

        $.ajax({
            url: CONTROLLER + 'ajax_verifica_duplicidade',
            type: 'POST',
            data: {
                id: id,
                campo: campo,
                _token: token,
                valor: valor,
                model: "App\\Filial"
            },
            beforeSend: function () {
                waitingDialog.show('Aguarde...', {dialogSize: 'sm'});
            },
            success: function(data) {
                if ($.trim(data) == "true") {
                    swal("Aviso", "Nome já cadastrado");
                    $("#" + campo).val("");
                }
            },
            complete: function () {
                waitingDialog.hide();
            }
        });
    });
});