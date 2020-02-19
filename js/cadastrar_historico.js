//Cuida do botão de excluir históricos
$(document).ready(function () {

    $('#inputAno1').change(function () {
        if ($('#inputAno1').val() !== '') {
            $('#exclui_historico').removeAttr('disabled');
        } else {

            $('#exclui_historico').attr('disabled', 'disabled');
        }
    });
});
//

//Fim do excluir historicos
//Cuida do botão criar hisóricos
$(document).ready(function () {
    $('#inputAno').change(function () {

        if ($('#inputAno').val() !== '' && $('#ano_turma').val() !== '') {
            $('#criar_historico').removeAttr('disabled');
        } else {

            $('#criar_historico').attr('disabled', 'disabled');
        }
    });
});
$(document).ready(function () {
    $('#ano_turma').change(function () {

        if ($('#inputAno').val() !== '' && $('#ano_turma').val() !== '') {
            $('#criar_historico').removeAttr('disabled');
        } else {

            $('#criar_historico').attr('disabled', 'disabled');
        }
    });
});


//fim do criar históticos
