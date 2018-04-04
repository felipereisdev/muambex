$(function() {
    $("#btnAdicionar").click(function() {
        var html = "";
        var nomeUsuario = $("#usuario").find('option:selected').text();
        var idUsuario = $("#usuario").find('option:selected').val();

        if (idUsuario != "") {
            if ($("#table-usuarios-filiais").find('tbody').length == 0) {
                $("#table-usuarios-filiais").append("<tbody></tbody>");
            }

            html += "<tr>";
                html += "<td>";
                    html += nomeUsuario;
                html += "</td>";
                html += "<td>";
                    html += "<button type='button' class='btn btn-sm btn-danger glyphicon glyphicon-trash btn-deletar-usuario' data-toggle='tooltip' title='Deletar'></button>";
                    html += "<input type='hidden' name='usuarios[]' value='" + idUsuario + "' />";
                html += "</td>";
            html += "</tr>";

            $("#table-usuarios-filiais").find('tbody').append(html);

            funcaoVerificaTfootTabela($("#table-usuarios-filiais"));

            $('[data-toggle="tooltip"]').tooltip();

            $("#usuario").find('option:selected').remove();
            $("#usuario").val("");
        } else {
            swal("Selecione um usuário");
        }
    });

    $(".btn-deletar-usuario").click(function() {
        $(this).parents('tr:first').remove();

        funcaoVerificaTfootTabela($("#table-usuarios-filiais"));
    });
});