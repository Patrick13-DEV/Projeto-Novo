const cpf = document.getElementById("cpf");

if (cpf) {
    cpf.addEventListener("input", function () {
        let valor = this.value.replace(/\D/g, "");

        valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
        valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
        valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

        this.value = valor;
    });
}

const telefone = document.getElementById("telefone");

if (telefone) {
    telefone.addEventListener("input", function () {
        let valor = this.value.replace(/\D/g, "");

        valor = valor.replace(/^(\d{2})(\d)/g, "($1) $2");
        valor = valor.replace(/(\d{5})(\d)/, "$1-$2");

        this.value = valor;
    });
}

const peso = document.getElementById("peso");

if (peso) {
    peso.addEventListener("input", function () {
        let valor = this.value.replace(/kg/g, "").replace(/\D/g, "");

        if (valor !== "") {
            this.value = valor + "kg";
        } else {
            this.value = "";
        }
    });

    peso.addEventListener("keydown", function (event) {
        if (event.key === "Backspace" || event.key === "Delete") {
            event.preventDefault();

            this.value = "";
        }
    });
}

const altura = document.getElementById("altura");

if (altura) {
    altura.addEventListener("input", function () {
        let valor = this.value.replace(/m/g, "").replace(/\D/g, "");

        if (valor.length > 3) {
            valor = valor.substring(0, 3);
        }

        if (valor.length === 3) {
            valor = valor.substring(0, 1) + "," + valor.substring(1);
        }

        if (valor !== "") {
            this.value = valor + "m";
        } else {
            this.value = "";
        }
    });

    altura.addEventListener("keydown", function (event) {
        if (event.key === "Backspace" || event.key === "Delete") {
            event.preventDefault();

            this.value = "";
        }
    });
}

const especialidadeContainer = document.getElementById(
    "especialidadeContainer",
);

if (especialidadeContainer) {
    const button = document.getElementById("especialidadeButton");
    const dropdown = document.getElementById("especialidadeDropdown");
    const arrow = document.getElementById("especialidadeArrow");
    const texto = document.getElementById("especialidadeTexto");
    const inputPesquisa = document.getElementById("pesquisaEspecialidade");
    const lista = document.getElementById("listaEspecialidades");
    const inputId = document.getElementById("especialidade_id");

    const especialidades = [
        {
            id: 1,
            nome: "Cardiologia",
            descricao: "Saúde do coração",
            icone: "❤️",
        },
        {
            id: 2,
            nome: "Dermatologia",
            descricao: "Pele, cabelos e unhas",
            icone: "✨",
        },
        {
            id: 3,
            nome: "Endocrinologia",
            descricao: "Hormônios e metabolismo",
            icone: "⚕️",
        },
        {
            id: 4,
            nome: "Ginecologia",
            descricao: "Saúde da mulher",
            icone: "🌸",
        },
        {
            id: 5,
            nome: "Neurologia",
            descricao: "Sistema nervoso",
            icone: "🧠",
        },
        {
            id: 6,
            nome: "Nutrição",
            descricao: "Alimentação e saúde",
            icone: "🥗",
        },
        {
            id: 7,
            nome: "Oftalmologia",
            descricao: "Saúde dos olhos",
            icone: "👁️",
        },
        {
            id: 8,
            nome: "Ortopedia",
            descricao: "Ossos e articulações",
            icone: "🦴",
        },
        {
            id: 9,
            nome: "Psicologia",
            descricao: "Saúde mental",
            icone: "🧠",
        },
        {
            id: 10,
            nome: "Psiquiatria",
            descricao: "Saúde mental e comportamento",
            icone: "💭",
        },
        {
            id: 11,
            nome: "Fisioterapia",
            descricao: "Movimento e reabilitação",
            icone: "🏃",
        },
        {
            id: 12,
            nome: "Fonoaudiologia",
            descricao: "Comunicação e audição",
            icone: "🗣️",
        },
        {
            id: 13,
            nome: "Odontologia",
            descricao: "Saúde bucal",
            icone: "🦷",
        },
    ];

    function renderizarEspecialidades(filtro = "") {
        lista.innerHTML = "";

        const resultado = especialidades.filter((especialidade) =>
            especialidade.nome.toLowerCase().includes(filtro.toLowerCase()),
        );

        if (resultado.length === 0) {
            lista.innerHTML = `
                <div class="py-8 text-center">
                    <div class="text-3xl mb-2"> 🔎 </div>
                    <p class="font-poppins text-sm text-gray-500">
                        Nenhuma especialidade encontrada.
                    </p>
                </div> `;
            return;
        }

        resultado.forEach((especialidade) => {
            const item = document.createElement("button");

            item.type = "button";

            item.className = `
                w-full
                flex
                items-center
                gap-3
                p-3
                rounded-xl
                text-left
                transition-all
                duration-200
                hover:bg-sky-50
                group
            `;

            item.innerHTML = `

                <div class="
                    size-11
                    shrink-0
                    rounded-xl
                    bg-gray-50
                    group-hover:bg-white
                    flex
                    items-center
                    justify-center
                    text-xl
                    transition
                ">
                    ${especialidade.icone}
                </div>

                <div class="flex-1 min-w-0">

                    <p class="
                        font-poppins
                        font-semibold
                        text-sm
                        text-gray-700
                        group-hover:text-sky-700
                        transition
                    ">
                        ${especialidade.nome}
                    </p>

                    <p class="
                        font-poppins
                        text-xs
                        text-gray-400
                        mt-0.5
                    ">
                        ${especialidade.descricao}
                    </p>

                </div>

                <div class="
                    opacity-0
                    group-hover:opacity-100
                    text-sky-500
                    transition
                ">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="18"
                        height="18"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="m9 18 6-6-6-6"/>
                    </svg>

                </div>
            `;

            item.addEventListener("click", () => {
                document.getElementById("especialidade").value = especialidade.nome;

                texto.textContent = especialidade.nome;

                texto.classList.remove("text-gray-700");
                texto.classList.add("text-sky-700", "font-semibold");

                fecharDropdown();
            });

            lista.appendChild(item);
        });
    }

    function abrirDropdown() {
        dropdown.classList.remove("opacity-0", "invisible", "-translate-y-3");

        dropdown.classList.add("opacity-100", "visible", "translate-y-0");

        arrow.classList.add("rotate-180");

        setTimeout(() => {
            inputPesquisa.focus();
        }, 100);
    }

    function fecharDropdown() {
        dropdown.classList.add("opacity-0", "invisible", "-translate-y-3");

        dropdown.classList.remove("opacity-100", "visible", "translate-y-0");

        arrow.classList.remove("rotate-180");

        inputPesquisa.value = "";

        renderizarEspecialidades();
    }

    button.addEventListener("click", () => {
        const fechado = dropdown.classList.contains("invisible");

        if (fechado) {
            abrirDropdown();
        } else {
            fecharDropdown();
        }
    });


    inputPesquisa.addEventListener("input", () => {
        renderizarEspecialidades(inputPesquisa.value);
    });

    document.addEventListener("click", (event) => {
        if (!especialidadeContainer.contains(event.target)) {
            fecharDropdown();
        }
    });


    renderizarEspecialidades();
}
const categorias = [
    "Cardiologia",
    "Clínica Geral",
    "Dermatologia",
    "Endocrinologia",
    "Fisioterapia",
    "Neurologia",
    "Nutrição",
    "Odontologia",
    "Ortopedia",
    "Pediatria",
    "Psicologia",
    "Psiquiatria"
];


const listaCategorias = document.getElementById("listaCategorias");
const pesquisaCategoria = document.getElementById("pesquisaCategoria");
const nenhumaCategoria = document.getElementById("nenhumaCategoria");


if (listaCategorias) {

    function mostrarCategorias(lista) {

        listaCategorias.innerHTML = "";

        if (lista.length === 0) {

            nenhumaCategoria.classList.remove("hidden");

            return;
        }

        nenhumaCategoria.classList.add("hidden");


        lista.forEach(function(categoria) {

            const card = document.createElement("a");

            card.href =
                "./profissional.php?categoria=" +
                encodeURIComponent(categoria);

            card.className =
                "border rounded-xl h-40 flex flex-col items-center justify-center " +
                "hover:shadow-md hover:border-sky-400 hover:-translate-y-1 " +
                "transition duration-200";


            const quantidade =
                profissionaisPorCategoria[categoria] ?? 0;


            card.innerHTML = `

                <div class="bg-sky-400 w-14 h-14 rounded-full flex items-center justify-center">

                    <span class="text-white text-xl font-semibold">
                        +
                    </span>

                </div>

                <p class="mt-3 font-semibold font-poppins text-center">
                    ${categoria}
                </p>

                <p class="text-sky-500 text-xs font-poppins">
                    ${quantidade} Disponíveis
                </p>

            `;


            listaCategorias.appendChild(card);

        });

    }


    mostrarCategorias(categorias);


    if (pesquisaCategoria) {

        pesquisaCategoria.addEventListener("input", function() {

            const pesquisa = this.value.toLowerCase().trim();


            const resultado = categorias.filter(function(categoria) {

                return categoria
                    .toLowerCase()
                    .includes(pesquisa);});
            mostrarCategorias(resultado);});
    }
}

const dataAgendamento =
    document.getElementById("dataAgendamento");

const horariosAgendamento =
    document.querySelectorAll(".horario-agendamento");

const horaAgendamento =
    document.getElementById("horaAgendamento");


if (dataAgendamento) {

    dataAgendamento.addEventListener("change", function () {

    });

}


function ativarHorario(botao) {


    horariosAgendamento.forEach(function (horario) {

        // Não altera horários indisponíveis
        if (horario.disabled) {
            return;
        }

        horario.classList.remove(
            "bg-sky-400",
            "text-white"
        );

        horario.classList.add(
            "bg-white",
            "border",
            "border-gray-200",
            "text-gray-700"
        );

    });


    botao.classList.remove(
        "bg-white",
        "border",
        "border-gray-200",
        "text-gray-700"
    );

    botao.classList.add(
        "bg-sky-400",
        "text-white"
    );


    if (horaAgendamento) {

        horaAgendamento.value =
            botao.dataset.horario;

    }

}


horariosAgendamento.forEach(function (botao) {

    if (botao.disabled) {
        return;
    }


    botao.addEventListener("click", function () {

        ativarHorario(this);

    });

});


const processarAgendamento =
    document.getElementById("processarAgendamento");


if (processarAgendamento) {

    processarAgendamento.addEventListener("click", function () {

        const dataSelecionada =
            dataAgendamento
                ? dataAgendamento.value
                : "";


        const horarioSelecionado =
            document.querySelector(
                ".horario-agendamento.bg-sky-400"
            );


        if (!dataSelecionada) {

            alert(
                "Selecione uma data para o agendamento."
            );

            return;

        }


        if (!horarioSelecionado) {

            alert(
                "Selecione um horário para o agendamento."
            );

            return;

        }


        const horario =
            horarioSelecionado.dataset.horario;


        console.log("Agendamento:");

        console.log("Data:", dataSelecionada);

        console.log("Horário:", horario);

        console.log(
            "Horário no input:",
            horaAgendamento
                ? horaAgendamento.value
                : ""
        );

    });

}


        let formularioSelecionado = null;
        function confirmarAgendamento(botao, status, mensagem) {
            formularioSelecionado = botao.closest('form'); const toast = document.getElementById('toastConfirmacao');
            const mensagemToast = document.getElementById('toastMensagem');
            const btnConfirmar = document.getElementById('btnConfirmarToast');
            mensagemToast.textContent = mensagem;
            toast.classList.remove('hidden');
            if (status === 'confirmado') {btnConfirmar.className ='rounded-lg bg-green-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-green-600';
            } else {
                btnConfirmar.className = 'rounded-lg bg-red-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-600';
            }

            btnConfirmar.onclick = function () {
                if (formularioSelecionado) {
                    formularioSelecionado.submit();
                }
            };
        }

        function fecharToast() {
            const toast = document.getElementById(
                'toastConfirmacao'
            );
            toast.classList.add('hidden');
            formularioSelecionado = null;
        }
