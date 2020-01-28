function validar() {
    if (document.cadastrar.inputNome.value == "" || document.cadastrar.inputNome.value.length < 3){
        alert("O campo Nome não pode está vazio ou ter meno de 3 letras");
        document.cadastrar.inputNome.focus();
        return false;
    }
    if (document.cadastrar.inputNascimento.value == "") {
        alert("O campo Nascimento não pode está vazio. Por favor verifique");
        document.cadastrar.inputNascimento.focus();
        return false;
    }
}


// INICIO FUNÇÃO DE MASCARA MAIUSCULA
function maiuscula(z) {
    v = z.value.toUpperCase();
    z.value = v;
}





