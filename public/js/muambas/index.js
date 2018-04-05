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
    
    $(".rastrear-muamba").click(function() {
        var id = $(this).data('id');
        var codigoRastreio = $(this).data('codigo-rastreio');
        var token = $(this).data('token');
        var nome = $(this).data('nome');

        $.ajax({
            url: CONTROLLER + 'rastrear_muambas',
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
});