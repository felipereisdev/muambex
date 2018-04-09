$(function() {
    var functionMontaHTML = function(objeto) {
        var html = "";
        
        html += "<div class='table-responsive' style='height: 400px; overflow: auto;'>";
            html += "<table class='table table-striped'>";
                html += "<thead>";
                    html += "<tr>";
                        html += "<th style='width: 20%'>Data</th>";
                        html += "<th style='width: 20%'>Local</th>";
                        html += "<th style='width: 20%'>Status</th>";
                        html += "<th style='width: 40%'>Encaminhado</th>";
                    html += "</tr>";
                html += "</thead>";
                
                html += "<tbody>";
                    $.each(objeto, function(key, value) {
                        html += "<tr>";
                            html += "<td>" + value.data + "</td>";
                            html += "<td>" + value.local + "</td>";
                            html += "<td>" + value.status + "</td>";
                            html += "<td>" + ((value.encaminhado != undefined) ? value.encaminhado : '-') + "</td>";
                        html += "</tr>";   
                    });
                html += "</tbody>";
            html += "</table>";
        html += "</div>";
        
        return html;
    };
    
    $(".rastrear-muamba, .historico-muamba").click(function() {
        var id = $(this).data('id');
        var codigoRastreio = $(this).data('codigo-rastreio');
        var token = $(this).data('token');
        var nome = $(this).data('nome');
        var tipo = $(this).data('tipo');
        var action = "rastrear_muambas";
        
        if ($.trim(tipo) == "historico") {
            action = "historico_muambas";
        }

        $.ajax({
            url: CONTROLLER + action,
            type: 'POST',
            data: {
                id: id,
                codigoRastreio: codigoRastreio,
                _token: token
            },
            dataType: 'json',
            beforeSend: function () {
                waitingDialog.show('Aguarde...', {dialogSize: 'sm'});
            },
            success: function(data) {
                $("#div-modal-body").children().remove();
                $("#div-modal-body").html(functionMontaHTML(data));
                $("#titulo-modal").text("Infos da Muamba: " + nome);
                $("#modal-rastreio").modal('show');
            },
            complete: function () {
                waitingDialog.hide();
            }
        });
    });
    
    $(".confirmar-recebimento").click(function() {
        var id = $(this).data('id');
        var token = $(this).data('token');

        swal({
            title: "Confirma recebimento do produto?",
            text: "Uma vez confirmado, você não poderá rastrea - lo novamente, somente visualizar o histórico!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: CONTROLLER + 'confirmar_recebimento',
                    type: 'POST',
                    data: {
                        id: id,
                        _token: token
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        waitingDialog.show('Aguarde...', {dialogSize: 'sm'});
                    },
                    success: function(data) {
                        if (data) {
                            swal("Confirmação realizada com sucesso!", {
                                icon: "success",
                            });
                            
                            $(this).remove();
                        } else {
                            swal("Erro ao realizar confirmação. Tente novamente!", {
                                icon: "error",
                            });   
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