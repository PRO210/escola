
function json() {
    //
    camposMarcados = new Array();
    $("input[type=checkbox][name='aluno_selecionado[]']:checked").each(function () {
        camposMarcados.push($(this).val());
        // alert(camposMarcados);
    });
    //e.preventDefault();  CAso queira impedir o submit
    $.ajax({
        url: 'solicitacao_pega.php',
        type: 'POST',
        data: {
            'id': camposMarcados
        },
        //       
        success: function (data)
        {
            //
            $txt = JSON.parse(data);
            var status = $txt.ent;
            //                      
            $('#inputSolicitante').val($txt.sol);
            $('#IdDataEntregue').val($txt.dte);
            $("#status option[name='" + status + "']").attr('selected', true);
            $('select#status option[value="' + status + '"]').attr('selected', 'selected');
            //
            $('#inputRD').val($txt.sol);
            $('#inputSolicitante').val($txt.sol);
            //
            $('#inputDSN').val($txt.declaracao);
            $('#inputRD').val($txt.dec_rp);
            $('#inputDatD').val($txt.dat_d);
            //
            $('#inputTSN').val($txt.transferencia);

            $('#inputRT').val($txt.tf_rt);
            $('#inputDatT').val($txt.dat_tf);
            //
            $('#inputST').val($txt.st);
           

        }
    });
}
;

