$('#start').change(function () {

    var start = $("#start").val();
    var end = $("#end").val();
    alert(start)


});
//Traz os materias quando se tenta editar um evento  //Traz os materias quando se tenta editar um evento 
$('#material_json2').change(function () {
    var id_material = $("#material_json2").val();
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
        url: 'agendamentos_function_disponivel.php',
        type: 'POST',
        data: {'id': id_material, 'end': end, 'start': start
        },
        //       
        success: function (data)
        {
            $txt = JSON.parse(data);
//          $('#servidor_json').text($txt.nome_servidor);
            $('#disp11').val($txt.resto1);
            // alert($txt.resto1);
        }
    });

});
$('#material_json22').change(function () {
    var id_material = $("#material_json22").val();
    var start = $("#start").val();
    var end = $("#end").val();

    $.ajax({
        url: 'agendamentos_function_disponivel.php',
        type: 'POST',
        data: {'id': id_material, 'end': end, 'start': start
        },
        //       
        success: function (data)
        {
            $txt = JSON.parse(data);
            $('#disp22').val($txt.resto1);

        }
    });

});
$('#material_json33').change(function () {
    var id_material = $("#material_json33").val();
    var start = $("#start").val();
    var end = $("#end").val();

    $.ajax({
        url: 'agendamentos_function_disponivel.php',
        type: 'POST',
        data: {'id': id_material, 'end': end, 'start': start
        },
        //       
        success: function (data)
        {
            $txt = JSON.parse(data);
            $('#disp33').val($txt.resto1);

        }
    });
});