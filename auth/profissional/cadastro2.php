<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';

$flash = flash_get();
$especialidades = (new App\Models\Especialidade())->all();
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../src/output.css" rel="stylesheet" />
    <title>Inova Vida Tech</title>
</head>

<body>
    <div class="min-h-screen bg-sky-300 flex items-end md:items-center justify-center">

                <!-- Card branco principal -->
        <div class="bg-white w-full md:max-w-7xl rounded-t-[2.5rem] md:rounded-[2.5rem] shadow-lg overflow-hidden">
            <div class="flex flex-col lg:flex-row">

                <form action="/InovaVida/actions/cadastro_profissional.php" method="post" class="w-full lg:w-2/5 p-6 md:p-8 lg:p-10 flex flex-col justify-center items-center gap-5 lg:min-h-[778px]" data-password-validator>
                    <input type="hidden" name="etapa" value="2">

                    <h1 class="text-4xl lg:text-5xl font-poppins font-semibold text-center">Cadastre-se</h1>

                    <p class="text-gray-500 text-center text-sm">
                        Complete os dados abaixo para finalizar seu cadastro.
                    </p>

                    <?php if ($flash !== null): ?>
                        <div class="w-full max-w-md rounded-xl px-4 py-3 text-sm font-semibold <?= $flash['tipo'] === 'sucesso' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' ?>">
                            <?= htmlspecialchars($flash['mensagem'], ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    <?php endif; ?>

                    <div
                        class="border-2 border-gray-300 rounded-sm w-full max-w-md h-[76px] px-3 flex items-center gap-4">
                        <div class="bg-sky-800 size-[55px] rounded-lg flex items-center justify-center"></div>
                        <select name="especialidade_id" class="flex-1 outline-none font-poppins bg-transparent" required>
                            <option value="">Selecione a especialidade</option>
                            <?php foreach ($especialidades as $especialidade): ?>
                                <option value="<?= (int) $especialidade['id'] ?>"><?= htmlspecialchars($especialidade['nome'], ENT_QUOTES, 'UTF-8') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div
                        class="border-2 border-gray-300 rounded-sm w-full max-w-md h-[76px] px-3 flex items-center gap-4">
                        <div class="bg-sky-800 size-[55px] rounded-lg flex items-center justify-center"></div>
                        <input class="flex-1 outline-none font-poppins bg-transparent" name="crm" placeholder="CRM / Registro" type="text">
                    </div>

                    <div
                        class="border-2 border-gray-300 rounded-sm w-full max-w-md h-[76px] px-3 flex items-center gap-4">
                        <div class="bg-sky-800 size-[55px] rounded-lg flex items-center justify-center"></div>
                        <input class="flex-1 outline-none font-poppins bg-transparent" name="telefone" placeholder="Telefone" type="tel">
                    </div>

                    <div
                        class="border-2 border-gray-300 rounded-sm w-full max-w-md h-[76px] px-3 flex items-center gap-4">
                        <div class="bg-sky-800 size-[55px] rounded-lg flex items-center justify-center"></div>
                        <input class="flex-1 outline-none font-poppins bg-transparent" name="valor_consulta" placeholder="Valor da consulta" type="number" min="0" step="0.01">
                    </div>

                    <div
                        class="border-2 border-gray-300 rounded-sm w-full max-w-md h-[120px] px-3 py-3 flex items-start gap-4">
                        <div class="bg-sky-800 size-[55px] rounded-lg flex items-center justify-center"></div>
                        <textarea class="flex-1 h-full outline-none font-poppins bg-transparent resize-none" name="descricao" placeholder="Descrição profissional"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full max-w-md rounded-full bg-sky-800 py-4 text-center text-white font-semibold">Cadastrar</button>

                    <a href="./login.php" class="text-blue-500">Já tem uma conta? Faça login</a>

                </form>

                <div
                    class="hidden lg:flex lg:w-3/5 bg-gradient-to-br from-sky-100 to-cyan-400 items-center justify-center">
                    <img src="../../assets/img/cadastro.png" class="w-full h-full object-cover" alt="Cadastro">
                </div>

            </div>
        </div>
    </div>
    <script src="/InovaVida/assets/script.js" defer></script>
</body>

</html>