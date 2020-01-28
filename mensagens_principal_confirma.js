function json2() {
    //
    var id = $("#id_usuario").val();
    //alert(id  + ' ok ');
    ////    camposMarcados = new Array();
//    $("input[type=checkbox][name='aluno_selecionado[]']:checked").each(function () {
//        camposMarcados.push($(this).val());
//        // alert(camposMarcados);
//    });
    //e.preventDefault();  CAso queira impedir o submit
    $.ajax({
        url: 'mensagens_principal.php',
        type: 'POST',
        data: {'id': id
        },
        //       
        success: function (data)
        {
            $txt = JSON.parse(data);
            //$('#servidor_json').val($txt.msg_agendamentos);
//          $('#servidor_json').text($txt.nome_servidor);//
            alert($txt.id_devolve);
          

        },
        error: function (data)
        {
            alert('erro');


        }
    });
}
;
