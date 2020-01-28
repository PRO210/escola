//Valida o Botão de Submit Através dos Checkbox
function validaCheckbox() {
    var frm = document.form;
    //Percorre os elementos do formulário
    for (i = 0; i < frm.length; i++) {
//Verifica se o elemento do formulário corresponde a um checkbox 
        if (frm.elements[i].type == "checkbox") {
//Verifica se o checkbox foi selecionado
            if (frm.elements[i].checked) {
//alert("Exite ao menos um checkbox selecionado!");
                return true;
            }
        }
    }
    alert("Nenhuma Caixinha Foi Selecionada!");
    return false;
}
//
//Valida o Botão de Submit Através dos Checkbox
window.onload = function () {
    $('input[type=checkbox]').on('change', function () {
        var total = $('input[type=checkbox]:checked').length;
        if (total > 0) {
            //alert(total);
            $('#button').removeAttr('disabled');
        } else {
            $('#button').attr('disabled', 'disabled');
        }
    });

}
//
//Confirmar se realmente o usuario quer atualizar
function confirmarAtualizacao() {

    var r = confirm("Realmente deseja atualizar?");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}
//
// INICIO FUNÇÃO DE MASCARA MAIUSCULA
function maiuscula(z) {
    v = z.value.toUpperCase();
    z.value = v;
}
//
////Guadei caso precise desse exemplo para o futuro
//$(document).ready(function () {
//    $('#DivB0').hide();
//    $('.b0').click(function () {
//        if (this.checked) {
//            //
//            if ($('.b1').is(':checked')) {
//                $('#DivB0').hide();
//            } else {
//                $('#DivB0').show(3000);
//
//            }
//            //
//        } else {
//            if ($('.b1').is(':checked')) {
//                $('#DivB0').hide();
//            }
//            $('#DivB0').hide(2500);
//        }
//    });
//
//});
