$(function() {
    $("#form_permissionamento").validate({
        rules: {
            name: "required",
            readable_name: "required"
        },
        messages: {
            name: "Campo Obrigatório",
            readable_name: "Campo Obrigatório"
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

    var funcaoAjaxValidaDuplicidade = function(valor, campo) {
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
                model: "App\\Permissionamento"
            },
            beforeSend: function () {
                waitingDialog.show('Aguarde...', {dialogSize: 'sm'});
            },
            success: function(data) {
                if ($.trim(data) == "true") {
                    swal("Aviso", (campo == "readable_name") ? "Descrição já cadastrada" : "Nome já cadastrado");
                    $("#" + campo).val("");
                }
            },
            complete: function () {
                waitingDialog.hide();
            }
        });
    };

    $("#readable_name").change(function () {
        var campo = "readable_name";
        var valor = $(this).val();

        funcaoAjaxValidaDuplicidade(valor, campo);
    });

    $("#name").change(function () {
        var campo = "name";
        var valor = $(this).val();

        funcaoAjaxValidaDuplicidade(valor, campo);
    });
});