$('#material_disp1').change(function () {
    var id_material = $("#material_disp1").val();
    var start = $("#start2").val();
    var end = $("#end2").val();

    // alert(id  + ' ok ');
    ////    camposMarcados = new Array();
//    $("input[type=checkbox][name='aluno_selecionado[]']:checked").each(function () {
//        camposMarcados.push($(this).val());
//        // alert(camposMarcados);
//    });material_json2
    //e.preventDefault();  CAso queira impedir o submit
    $.ajax({
        url: 'agendamentos_function_disponivel.php',
        type: 'POST',
        data: {'id': id_material, 'end': end, 'start': start
        },
        //       
        success: function (data)
        {
            $txt = JSON.parse(data);
//          $('#servidor_json').text($txt.nome_servidor);
            $('#disp1').val($txt.resto1);
//            alert($txt.resto4);

        }
    });
});
$('#material_disp2').change(function () {
    var id_material = $("#material_disp2").val();
    var start = $("#start2").val();
    var end = $("#end2").val();

    $.ajax({
        url: 'agendamentos_function_disponivel.php',
        type: 'POST',
        data: {'id': id_material, 'end': end, 'start': start
        },
        //       
        success: function (data)
        {
            $txt = JSON.parse(data);
            $('#disp2').val($txt.resto1);

        }
    });

});
$('#material_disp3').change(function () {
    var id_material = $("#material_disp3").val();
    var start = $("#start2").val();
    var end = $("#end2").val();

    $.ajax({
        url: 'agendamentos_function_disponivel.php',
        type: 'POST',
        data: {'id': id_material, 'end': end, 'start': start
        },
        //       
        success: function (data)
        {
            $txt = JSON.parse(data);
            $('#disp3').val($txt.resto1);

        }
    });
});
