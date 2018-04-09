$(function() {
    $("#form_muambas").validate({
        rules: {
            nome: "required",
            codigo_rastreio: "required"
        },
        messages: {
            nome: "Campo Obrigatório",
            codigo_rastreio: "Campo Obrigatório"
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

    $("#btn-salvar").click(function () {
        var campo = "codigo_rastreio";
        var valor = $("#codigo_rastreio").val();
        var token = $("[name='_token']").val();
        var id = $("[name='id']").val();
        
        swal({
            title: "Deseja realmente salvar este produto?",
            // text: "Uma vez confirmado, você não poderá rastrea - lo novamente, somente visualizar o histórico!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: CONTROLLER + 'ajax_verifica_duplicidade',
                    type: 'POST',
                    data: {
                        id: id,
                        campo: campo,
                        _token: token,
                        valor: valor,
                        model: "App\\Muamba"
                    },
                    beforeSend: function () {
                        waitingDialog.show('Aguarde...', {dialogSize: 'sm'});
                    },
                    success: function(data) {
                        if ($.trim(data) == "true") {
                            swal("Aviso", "Código de rastreio já cadastrado");
                            $("#" + campo).val("");
                        } else {
                            $("#form_muambas").submit();
                        }
                    },
                    complete: function () {
                        waitingDialog.hide();
                    }
                });
            }
        });
    });
});