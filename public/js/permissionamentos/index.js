$(function() {
    $(".btn-excluir").click(function() {
        var $this = $(this);
        var id = $this.data('id');
        var token = $this.data('token');
        
        swal({
            title: "Atenção!",
            text: "Tem certeza que deseja deletar este item?",
            icon: "warning",
            buttons: {
              cancel: {
                text: "Não",
                value: null,
                visible: true,
                className: "",
                closeModal: true,
              },
              confirm: {
                text: "Sim",
                value: true,
                visible: true,
                className: "",
                closeModal: true
              }
            },
            dangerMode: true,
        })
        .then((param) => {
            if (param) {
                $.ajax({
                    url: CONTROLLER + 'delete',
                    type: 'POST',
                    data: {
                        id: id,
                        _token: token,
                        model: "App\\Permissionamento"
                    },
                    beforeSend: function () {
                        waitingDialog.show('Aguarde...', {dialogSize: 'sm'});
                    },
                    success: function(data) {
                        if ($.trim(data) == "true") {
                            swal("Uhuuuul!", "Permissão excluída com sucesso", "success");
                            $this.parents('tr:first').remove();
                        } else {
                            swal("Ooooops!", "Erro ao excluir permissão", "error");
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