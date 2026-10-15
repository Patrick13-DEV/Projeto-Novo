document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("modalDetalhesHistorico");
        const card = document.getElementById("cardDetalhesHistorico");
        const botoes = document.querySelectorAll(".abrirDetalhesHistorico");
        const fecharTopo = document.getElementById("fecharModalHistorico");
        const fecharBase = document.getElementById("fecharModalHistoricoBottom");

        const codigo = document.getElementById("historicoCodigo");
        const cliente = document.getElementById("historicoCliente");
        const data = document.getElementById("historicoData");
        const hora = document.getElementById("historicoHora");
        const status = document.getElementById("historicoStatus");
        const descricao = document.getElementById("historicoDescricao");

        function abrirModal(botao) {
            codigo.textContent = "Código: AG-" + String(botao.dataset.id).padStart(5, "0");
            cliente.textContent = botao.dataset.cliente || "Não informado";
            data.textContent = botao.dataset.data || "Não informada";
            hora.textContent = botao.dataset.hora || "Não informado";
            status.textContent = botao.dataset.status || "Não informado";
            descricao.textContent = botao.dataset.descricao || "Nenhuma descrição informada.";

            const classesStatus = {
                "Confirmado": "bg-emerald-100 text-emerald-700",
                "Concluído": "bg-blue-100 text-blue-700",
                "Cancelado": "bg-red-100 text-red-700",
                "Pendente": "bg-amber-100 text-amber-700"
            };

            status.className = "inline-flex rounded-full px-3 py-1.5 text-sm font-bold " +
                (classesStatus[status.textContent] || "bg-slate-100 text-slate-700");

            modal.classList.remove("hidden");
            modal.classList.add("flex");
            document.body.classList.add("overflow-hidden");

            requestAnimationFrame(function() {
                card.classList.remove("scale-95", "opacity-0");
                card.classList.add("scale-100", "opacity-100");
            });
        }

        function fecharModal() {
            card.classList.remove("scale-100", "opacity-100");
            card.classList.add("scale-95", "opacity-0");

            setTimeout(function() {
                modal.classList.remove("flex");
                modal.classList.add("hidden");
                document.body.classList.remove("overflow-hidden");
            }, 300);
        }

        botoes.forEach(function(botao) {
            botao.addEventListener("click", function() {
                abrirModal(botao);
            });
        });

        fecharTopo.addEventListener("click", fecharModal);
        fecharBase.addEventListener("click", fecharModal);

        modal.addEventListener("click", function(event) {
            if (event.target === modal) {
                fecharModal();
            }
        });

        document.addEventListener("keydown", function(event) {
            if (event.key === "Escape" && !modal.classList.contains("hidden")) {
                fecharModal();
            }
        });
    });
