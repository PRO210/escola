function validaCheckbox() {
    var frm = document.form1;
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
    alert("Nenhuma Turma foi selecionada!");
    return false;
}
//Marcar ou Desmarcar todos os checkbox do Status
$(document).ready(function () {

    $('.selecionar_status').click(function () {
        if (this.checked) {
            $('.checkbox_status').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkbox_status').each(function () {
                this.checked = false;
            });
        }
    });

});
//Marcar ou Desmarcar todos os checkbox da manha
$(document).ready(function () {

    $('.selecionarM').click(function () {
        if (this.checked) {
            $('.checkboxM').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkboxM').each(function () {
                this.checked = false;
            });
        }
    });

});
//Marcar ou Desmarcar todos os checkbox Tarde
$(document).ready(function () {

    $('.selecionarT').click(function () {
        if (this.checked) {
            $('.checkboxT').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkboxT').each(function () {
                this.checked = false;
            });
        }
    });

});
//Marcar ou Desmarcar todos os checkbox das Turmas da Noite
$(document).ready(function () {

    $('.selecionarN').click(function () {
        if (this.checked) {
            $('.checkboxN').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkboxN').each(function () {
                this.checked = false;
            });
        }
    });

});

//Marcar ou Desmarcar todos os checkbox das Turmas da Manha
$(document).ready(function () {

    $('.selecionarTodas').click(function () {
        if (this.checked) {
            $('.checkboxM').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkboxM').each(function () {
                this.checked = false;
            });
        }
    });

});
//Marcar ou Desmarcar todos os checkbox das Turmas da Tarde
$(document).ready(function () {

    $('.selecionarTodas').click(function () {
        if (this.checked) {
            $('.checkboxT').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkboxT').each(function () {
                this.checked = false;
            });
        }
    });

});
//Marcar ou Desmarcar todos os checkbox das Turmas da Noite
$(document).ready(function () {

    $('.selecionarTodas').click(function () {
        if (this.checked) {
            $('.checkboxN').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkboxN').each(function () {
                this.checked = false;
            });
        }
    });

});