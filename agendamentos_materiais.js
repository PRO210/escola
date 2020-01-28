//Serve para trazer os dados ao tentar visualizar um evento
function json() {
    //
    var id = $("#id_json").val();
    var start = $("#start").val();
    var end = $("#end").val();

    // alert(id  + ' ok ');
    ////    camposMarcados = new Array();
//    $("input[type=checkbox][name='aluno_selecionado[]']:checked").each(function () {
//        camposMarcados.push($(this).val());
//        // alert(camposMarcados);
//    });
    //e.preventDefault();  CAso queira impedir o submit
    $.ajax({
        url: 'agendamentos_function.php',
        type: 'POST',
        data: {'id': id, 'end': end, 'start': start
        },
        //       
        success: function (data)
        {
            $txt = JSON.parse(data);
            //          
            $('#servidor_json2').val($txt.id_servidor);
            $('#servidor_json').text($txt.nome_servidor);
            $('#quantidade_json').text($txt.quantidades);
            $('#material_json').text($txt.nome_material);
            //
            $('#color_json').val($txt.color);
            $('#material_json2').val($txt.id_material);
            $('#quantidade_json2').val($txt.quantidade);
            //
            $('#material_json22').val($txt.id_material22);
            $('#quantidade_json22').val($txt.quantidade22);
            //
            $('#material_json33').val($txt.id_material33);
            $('#quantidade_json33').val($txt.quantidade33);
            
            $('#obs_json').text($txt.obs_json);           
            $('#inputTextArea2').val($txt.obs_json);           
            
            $('#disp11').val($txt.resto1);
            $('#disp22').val($txt.resto2);
            $('#disp33').val($txt.resto3);
          
            
          //alert($txt.resto1);          
        }
    });
}
;