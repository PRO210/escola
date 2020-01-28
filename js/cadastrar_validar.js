function validar() {
    if (document.cadastrar.inputNome.value == "" || document.cadastrar.inputNome.value.length < 3)
    {
        alert("O campo Nome não pode está vazio ou ter meno de 3 letras");
        document.cadastrar.inputNome.focus();
        return false;
    }   
    
}


// INICIO FUNÇÃO DE MASCARA MAIUSCULA
function maiuscula(z) {
    v = z.value.toUpperCase();
    z.value = v;
}


function confirmarExclusao() {
    var r = confirm("Realmente deseja excluir?");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}


function confirmarAtualizacao() {
    var r = confirm("Realmente deseja atualizar todos?");
    if (r == true) {
        return true;
    } else {
        return false;
    }
}


//Marcar ou Desmarcar todos os checkbox
$(document).ready(function () {

    $('.selecionar').click(function () {
        if (this.checked) {
            $('.checkbox').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkbox').each(function () {
                this.checked = false;
            });
        }
    });

});


//Esconder ou mostrar Seleção de turmas 
$(document).ready(function () {
    $("#ocultar").click(function (event) {
        event.preventDefault();
        $("#mostrar_esconder").hide(2500);
    });

    $("#mostrar").click(function (event) {
        event.preventDefault();
        $("#mostrar_esconder").show(2500);
    });
});


//Esconder ou mostrar Seleção de turmas 
$(document).ready(function () {
    $("#ocultar").click(function (event) {
        event.preventDefault();
        $("#mostrar_esconder_excluir").show(2500);
    });

    $("#mostrar").click(function (event) {
        event.preventDefault();
        $("#mostrar_esconder_excluir").hide(2500);
    });
});




