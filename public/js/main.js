$(function() {
    var title = "";
    var text = "";
    var type = "";
    
    if ($("#sweet_alert_title").val() != "" &&  typeof($("#sweet_alert_title").val()) != "undefined") {
        title = $("#sweet_alert_title").val();
    }
    
    if ($("#sweet_alert_text").val() != "" &&  typeof($("#sweet_alert_text").val()) != "undefined") {
        text = $("#sweet_alert_text").val();
    }
    
    if ($("#sweet_alert_type").val() != "" &&  typeof($("#sweet_alert_type").val()) != "undefined") {
        type = $("#sweet_alert_type").val();
    }
    
    if (title != "" && text != "") {
        swal(title, text, type);   
    }
    
    CONTROLLER = $("#controller").val();

    $('[data-toggle="tooltip"]').tooltip();

    $(".select2").select2();

    funcaoVerificaTfootTabela = function(tabela) {
        if (tabela.find('tbody').children().length > 0) {
            tabela.find('tfoot').hide();
        } else {
            tabela.find('tfoot').show();
        }
    };
});