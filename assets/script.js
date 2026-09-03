
const cpf = document.getElementById('cpf');

if (cpf) {
    cpf.addEventListener('input', function () {

        let valor = this.value.replace(/\D/g, '');

        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

        this.value = valor;
    });
}

const telefone = document.getElementById('telefone');

if (telefone) {
    telefone.addEventListener('input', function () {

        let valor = this.value.replace(/\D/g, '');

        valor = valor.replace(/^(\d{2})(\d)/g, '($1) $2');
        valor = valor.replace(/(\d{5})(\d)/, '$1-$2');

        this.value = valor;
    });
}
