
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


const peso = document.getElementById('peso');

if (peso) {

    peso.addEventListener('input', function () {

        let valor = this.value
            .replace(/kg/g, '')
            .replace(/\D/g, '');

        if (valor !== '') {
            this.value = valor + 'kg';
        } else {
            this.value = '';
        }
    });


    peso.addEventListener('keydown', function (event) {

        if (
            event.key === 'Backspace' ||
            event.key === 'Delete'
        ) {

            event.preventDefault();

            this.value = '';

        }
    });
}


const altura = document.getElementById('altura');

if (altura) {

    altura.addEventListener('input', function () {

        let valor = this.value
            .replace(/m/g, '')
            .replace(/\D/g, '');

        if (valor.length > 3) {
            valor = valor.substring(0, 3);
        }

        if (valor.length === 3) {

            valor =
                valor.substring(0, 1) +
                ',' +
                valor.substring(1);
        }

        if (valor !== '') {
            this.value = valor + 'm';
        } else {
            this.value = '';
        }
    });


    altura.addEventListener('keydown', function (event) {

        if (
            event.key === 'Backspace' ||
            event.key === 'Delete'
        ) {

            event.preventDefault();

            this.value = '';

        }
    });
}
