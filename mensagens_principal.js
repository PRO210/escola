function json() {
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
            //          
            $('#servidor_json').val($txt.msg_agendamentos);
//          $('#servidor_json').text($txt.nome_servidor);//
            //alert($txt.id_devolve);
            //alert($txt.msg_agendamentos);
            if ($txt.msg_sim == "sim") {
                //
                getCookie();
                checkCookie();
            }

        },
        error: function (data)
        {
            alert('erro');


        }
    });
}
;
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    var user = getCookie("msg");
    if (user != "") {
       // alert("Bem Vindo de Volta " + user);
    } else {
        //alert("chamar");
        $('#exemplomodal2').modal('show');

//                                user = prompt("Please enter your name:", "");
//                                if (user != "" && user != null) {
//                                    setCookie("username", user, 30);
//                                }
    }
}
