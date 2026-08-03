<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/bootstrap.php';

$flash = flash_get();
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../src/output.css" rel="stylesheet" />
    <title>Inova Vida Tech - Login</title>
</head>

<body>
    <!-- Container principal que ocupa a tela toda com fundo azul -->
    <div class="min-h-screen bg-sky-300 flex items-end md:items-center justify-center">

        <!-- Card branco principal -->
        <div class="bg-white w-full lg:max-w-7xl rounded-t-[2.5rem] md:rounded-[2.5rem] shadow-lg overflow-hidden  ">
            <div class="flex flex-col md:flex-row">

                <!-- Esquerda -->
                <form action="/InovaVida/actions/login.php" method="post" class="w-full lg:w-2/5 p-6 md:p-8 lg:p-10 flex flex-col gap-5 items-center lg:min-h-[778px]">
                    <h1 class="text-4xl lg:text-5xl font-poppins font-semibold">
                        Faça seu Login
                    </h1>
                    <p class="text-gray-500 text-xs px-18 md:px-0 font-poppins text-center">
                        Entre com as informações cadastradas para acessar sua conta.
                    </p>

                    <?php if ($flash !== null): ?>
                        <div class="w-full rounded-xl px-4 py-3 text-sm font-semibold <?= $flash['tipo'] === 'sucesso' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' ?>">
                            <?= htmlspecialchars($flash['mensagem'], ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Email -->
                    <div
                        class="border-gray-300 rounded-sm border-3 md:border-2 w-full h-[76px] pl-3 gap-4 flex items-center text-2xl">

                        <div class="bg-sky-800 size-[55px] rounded-lg flex items-center justify-center">

                            <svg class="stroke-1 stroke-white size-12" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />

                            </svg>

                        </div>

                        <input class="flex-1 font-poppins outline-none bg-transparent" type="email" name="email" placeholder="Email" required>

                    </div>

                    <!-- Senha -->
                    <div
                        class="border-gray-300 rounded-sm border-3 md:border-2 w-full h-[76px] pl-3 gap-4 flex items-center text-2xl">

                        <div class="bg-sky-800 size-[55px] rounded-lg flex items-center justify-center">

                            <svg class="stroke-white size-12" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />

                            </svg>

                        </div>

                        <input class="flex-1 font-poppins outline-none bg-transparent" type="password" name="senha" id="senha_login_profissional" placeholder="Senha" required>
                        <button type="button" class="rounded-full border border-sky-800 px-3 py-2 text-sm font-semibold text-sky-800" data-password-toggle="senha_login_profissional">
                            <span data-password-toggle-label>Mostrar</span>
                        </button>

                    </div>


                    <!-- Botão -->
                    <button
                        type="submit"
                        class="text-2xl max-w-sm w-full rounded-full bg-sky-800 px-4 py-4 font-semibold text-white transition duration-300 hover:-translate-y-1 hover:scale-105 hover:bg-indigo-500">

                        <span class="font-poppins">Login</span>

                    </button>

                    <a href="./cadastro.php" class="text-blue-500 text-lg md:text-xl">

                        Não possui uma conta? Cadastre-se

                    </a>

                </form>

                <!-- Direita -->
                <div
                    class="hidden lg:flex lg:w-3/5 bg-gradient-to-br from-sky-100 to-cyan-400 items-center justify-center">

                    <img src="../../assets/img/cadastro.png" alt="Login" class="w-full h-full object-cover">

                </div>

            </div>

        </div>

    </div>

    <script src="/InovaVida/assets/script.js" defer></script>
</body>

</html>