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
                if (objeto.length > 0) {
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
                } else {
                    html += "<tfoot>";
                        html += "<tr>";
                            html += "<td colspan='4'>";
                                html += "<div class='alert alert-warning' role='alert'>";
                                    html += "<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>";
                                    html += "Nenhum registro encontrado";
                                html += "</div>";
                            html += "</td>";
                        html += "</tr>";
                    html += "</tfoot>";
                }
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
                if (data.success) {
                    swal("Erro ao rastrear muamba. Tente novamente!", {
                        icon: "error",
                    }); 
                } else {
                    $("#div-modal-body").children().remove();
                    $("#div-modal-body").html(functionMontaHTML(data));
                    $("#titulo-modal").text("Infos da Muamba: " + nome);
                    $("#modal-rastreio").modal('show');   
                }
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
            title: "Confirma recebimento da muamba?",
            text: "Uma vez confirmado, você não poderá rastrea - la novamente, somente visualizar o histórico!",
            icon: "warning",
            buttons: ["Cancelar", "OK"],
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
                            swal({
                                title: "Uhuuuul",
                                text: "Confirmação realizada com sucesso",
                                type: "success"
                            }).then(okay => {
                                if (okay) {
                                    window.location.reload(1);
                                }
                            });
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
    
    $(".deletar-muamba").click(function() {
        var id = $(this).data('id');
        var token = $(this).data('token');

        swal({
            title: "Deseja realmente excluir esta muamba?",
            text: "Uma vez confirmado, a muamba será excluída de forma definitiva!",
            icon: "warning",
            buttons: ["Cancelar", "OK"],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: CONTROLLER + 'delete',
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
                            swal({
                                title: "Uhuuuul",
                                text: "Muamba excluída com sucesso",
                                type: "success"
                            }).then(okay => {
                                if (okay) {
                                    window.location.reload(1);
                                }
                            });
                        } else {
                            swal("Erro ao excluir muamba. Tente novamente!", {
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