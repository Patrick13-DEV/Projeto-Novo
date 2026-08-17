
<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../src/output.css" rel="stylesheet" />
    <title>Inova Vida Tech</title>
</head>

<body>
    <!-- Container principal que ocupa a tela toda com fundo azul -->
    <div class="min-h-screen bg-sky-300 flex items-end md:items-center justify-center">

    
        <div class="bg-white w-full lg:max-w-7xl rounded-t-[2.5rem] md:rounded-[2.5rem] shadow-lg overflow-hidden ">

            <div class="flex flex-col md:flex-row">

                <form action="/InovaVida/actions/cadastro_cliente.php" method="post" class="w-full lg:w-2/5 p-6 md:p-5 flex flex-col gap-4 items-center" data-password-validator>
                    <h1 class="text-4xl font-poppins font-semibold">Cadastre-se</h1>
                    <p class="text-gray-500 text-xs px-18 md:px-0 font-poppins form-extralight">Preencha com as informações necessárias</p>

                    <div class="border-gray-300 rounded-sm border-3 md:border-2 w-full h-[70px] pl-3 gap-4 flex items-center text-2xl">
                        <div class="bg-sky-800 size-[52px] rounded-lg flex items-center justify-center">
                            <svg class="stroke-1 stroke-white size-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                            </svg>
                        </div>
                        <input class="flex-1 w-full font-poppins outline-none bg-transparent" type="text" name="nome" placeholder="Nome Completo" required>
                    </div>

                    <div class="border-gray-300 rounded-sm border-3 md:border-2 w-full h-[70px] pl-3 gap-4 flex items-center text-2xl">
                        <div class="bg-sky-800 size-[52px] rounded-lg flex items-center justify-center">
                            <svg class="stroke-1 stroke-white size-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                            </svg>
                        </div>
                        <input class="flex-1 w-full font-poppins outline-none bg-transparent" type="email" name="email" placeholder="Email" required>
                    </div>

                    <div class="border-gray-300 rounded-sm border-3 md:border-2 w-full h-[70px] pl-3 gap-4 flex items-center text-2xl">
                        <div class="bg-sky-800 size-[52px] rounded-lg flex items-center justify-center">
                            <svg class="stroke-1 stroke-white size-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                            </svg>
                        </div>
                        <input class="flex-1 w-full font-poppins outline-none bg-transparent" type="text" name="cpf" placeholder="CPF" required>
                    </div>

                    <div class="border-gray-300 rounded-sm border-3 md:border-2 w-full h-[70px] pl-3 gap-4 flex items-center text-2xl">
                        <div class="bg-sky-800 size-[52px] rounded-lg flex items-center justify-center">
                            <svg class="stroke-white size-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 0 0 2.25-2.25v-1.372a1.125 1.125 0 0 0-.76-1.06l-4.397-1.466a1.125 1.125 0 0 0-1.175.317l-1.31 1.548a16.6 16.6 0 0 1-7.3-7.3l1.548-1.31a1.125 1.125 0 0 0 .317-1.175L7.682 2.31a1.125 1.125 0 0 0-1.06-.76H5.25A2.25 2.25 0 0 0 3 3.8v1.5" />
                            </svg>
                        </div>
                        <input class="flex-1 w-full font-poppins outline-none bg-transparent" type="tel" name="telefone" placeholder="Telefone" required>
                    </div>

                    <div class="border-gray-300 rounded-sm border-3 md:border-2 w-full h-[70px] pl-3 pr-3 gap-4 flex items-center text-2xl">
                        <div class="bg-sky-800 size-[52px] rounded-lg flex items-center justify-center">
                            <svg class="stroke-white size-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </div>
                        <input class="flex-1 w-full font-poppins outline-none bg-transparent" type="password" name="senha" id="senha_cliente" data-password-input placeholder="Senha" minlength="6" required>
                    </div>

                    <div class="border-gray-300 rounded-sm border-3 md:border-2 w-full h-[70px] pl-3 pr-3 gap-4 flex items-center text-2xl">
                        <div class="bg-sky-800 size-[52px] rounded-lg flex items-center justify-center">
                            <svg class="stroke-white size-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </div>
                        <input class="flex-1 w-full font-poppins outline-none bg-transparent" type="password" name="confirmar_senha" id="confirmar_senha_cliente" data-password-confirm placeholder="Confirme a Senha" minlength="6" required>
                    </div>

                    <button type="submit" class="text-2xl max-w-sm w-full rounded-full bg-sky-800  py-4 font-semibold text-white delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500">
                        <span class="font-poppins">Cadastrar</span>
                    </button>

                    <a href="./login.php" class="text-blue-500 text-lg">Já tem uma conta? Faça login</a>
                </form>

                <div class="hidden lg:flex lg:w-3/5 bg-gradient-to-br from-sky-100 to-cyan-400 items-center justify-center">
                    <img src="../../assets/img/cadastro.png" alt="Cadastro" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>

    <script src="/InovaVida/assets/script.js" defer></script>
</body>

</html>