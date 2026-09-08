<?php

include_once("../../constante.php");

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../src/output.css" rel="stylesheet" />
    <title>Inova Vida Tech</title>
</head>

<body>
    <div class="min-h-screen bg-sky-300 flex items-end md:items-center justify-center">

        <div class="bg-white w-full lg:max-w-7xl rounded-t-[2.5rem] md:rounded-[2.5rem] shadow-lg overflow-hidden ">

            <div class="flex flex-col md:flex-row">



                <form action="<?= ROOT_PATH ?>actions/cadastro_profissional.php" method="post" class="w-full lg:w-2/5 p-6 md:p-5 flex flex-col gap-4 items-center lg:min-h-[753px]">
                <input type="hidden" name="etapa" value="dados_profissionais">
                    <h1 class="text-4xl font-poppins font-semibold"> Cadastre-se </h1>

                    <p class="text-gray-500 text-xs px-18 md:px-0 font-poppins form-extralight"> Preencha com as informações necessárias </p>

                    <div class="relative w-full" id="especialidadeContainer">

                        <button type="button" id="especialidadeButton" class="w-full h-[70px] border-2 border-gray-300 rounded-sm px-3 flex items-center gap-4 text-left transition-all duration-300 hover:border-sky-400 focus:outline-none">
                            <div class="bg-sky-800 size-[52px] shrink-0 rounded-lg flex items-center justify-center text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 12h6" />
                                    <path d="M12 9v6" />
                                    <path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2Z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="block text-xs text-gray-400 font-poppins"> Especialidade </span>

                                <span id="especialidadeTexto" class="block text-base font-poppins text-gray-700 truncate"> Selecione sua especialidade </span>
                            </div>
                            <svg id="especialidadeArrow" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 transition-transform duration-300 shrink-0">
                                <path d="m6 9 6 6 6-6" />
                            </svg>
                        </button>

                        <input type="hidden" name="especialidade" id="especialidade" required>


                        <div id="especialidadeDropdown" class="absolute z-50 left-0 right-0 mt-3 bg-white rounded-2xl border border-gray-200 shadow-[0_20px_50px_rgba(0,0,0,0.12)] overflow-hidden opacity-0 invisible -translate-y-3 transition-all duration-300">

                            <div class="p-4 border-b border-gray-100 bg-gradient-to-r from-sky-50 to-white">
                                <div class="relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                        <circle cx="11" cy="11" r="8" />
                                        <path d="m21 21-4.3-4.3" />
                                    </svg>
                                    <input type="text" id="pesquisaEspecialidade" placeholder="Pesquisar especialidade..." class="w-full h-11 pl-10 pr-4 rounded-xl bg-white border border-gray-200 outline-none font-poppins text-sm focus:border-sky-400 focus:ring-2 focus:ring-sky-100 transition">
                                </div>
                            </div>

                            <div id="listaEspecialidades" class="max-h-[300px] overflow-y-auto p-2">
                            </div>
                        </div>
                    </div>

                    <div
                        class="border-gray-300 rounded-sm border-3 md:border-2 w-full h-[70px] pl-3 gap-4 flex items-center text-2xl">
                        <div class="bg-sky-800 size-[52px] rounded-lg flex items-center justify-center">
                            <svg class="stroke-1 stroke-white size-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s8-4.5 8-11a8 8 0 1 0-16 0c0 6.5 8 11 8 11Z" />
                                <circle cx="12" cy="10" r="2.5" />
                            </svg>
                        </div>

                        <input class="flex-1 w-full font-poppins outline-none bg-transparent" type="text" name="estado" placeholder="Estado" maxlength="2" required>
                    </div>

                    <div
                        class="border-gray-300 rounded-sm border-3 md:border-2 w-full h-[70px] pl-3 gap-4 flex items-center text-2xl">
                        <div class="bg-sky-800 size-[52px] rounded-lg flex items-center justify-center">
                            <svg class="stroke-1 stroke-white size-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V9l7-4 7 4v12M9 21v-6h6v6" />
                            </svg>
                        </div>
                        <input class="flex-1 w-full font-poppins outline-none bg-transparent" type="text" name="cidade" placeholder="Cidade" required>
                    </div>

                    <div class="border-gray-300 rounded-sm border-3 md:border-2 w-full h-[70px] pl-3 gap-4 flex items-center text-2xl">
                        <div class="bg-sky-800 size-[52px] rounded-lg flex items-center justify-center">
                            <svg class="stroke-1 stroke-white size-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5M4.5 21V9l7.5-6 7.5 6v12M8.25 21v-6h7.5v6" />
                            </svg>
                        </div>
                        <input class="flex-1 w-full font-poppins outline-none bg-transparent" type="text" name="rua" placeholder="Rua" required>
                    </div>

                    <button
                        type="submit" class="text-2xl max-w-sm w-full rounded-full bg-sky-800 py-4 font-semibold text-white cursor-pointer delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500">
                        <span class="font-poppins"> Cadastrar </span>
                    </button>

                </form>

                <div class="hidden lg:flex lg:w-3/5 bg-gradient-to-br from-sky-100 to-cyan-400 items-center justify-center">
                    <img src="../../assets/img/cadastro.png" alt="Cadastro" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/script.js" defer></script>
</body>

</html>