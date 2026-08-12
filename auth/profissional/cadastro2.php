
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

    
        <div class="bg-white w-full md:max-w-2xl lg:max-w-4xl rounded-t-[2.5rem] md:rounded-[2.5rem] shadow-lg overflow-hidden">

            <div class="flex flex-col md:flex-row">

                <form action="/InovaVida/actions/cadastro_cliente.php" method="post" class="w-full lg:w-2/5 p-6 md:p-5 flex flex-col gap-4 items-center" data-password-validator>
                    <h1 class="text-4xl font-poppins font-semibold">Cadastre-se</h1>
                    <p class="text-gray-500 text-xs px-18 md:px-0 font-poppins form-extralight">Preencha com as informações necessárias</p>

                    <div
                        class="border-2 border-gray-300 rounded-sm w-full max-w-md h-[76px] px-3 flex items-center gap-4">
                        <div class="bg-sky-800 size-[55px] rounded-lg flex items-center justify-center"></div>
                        <select name="especialidade_id" class="flex-1 outline-none font-poppins bg-transparent" required>
                            <option value="">Selecione a especialidade</option>
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

                    <button type="submit" class="text-2xl max-w-sm w-full rounded-full bg-sky-400  py-4 font-semibold text-white delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500">
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