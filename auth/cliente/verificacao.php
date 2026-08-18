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

        <div
            class="bg-white w-full lg:max-w-7xl rounded-t-[2.5rem] md:rounded-[2.5rem] shadow-lg overflow-hidden lg:h-[753px]">

            <div class="flex flex-col lg:flex-row h-full">

                <!-- ESQUERDA -->
                <div class="w-full lg:w-2/5 p-6 md:p-8 lg:p-10 flex flex-col justify-center items-center gap-6">
                    <h1 class="text-4xl lg:text-5xl font-semibold font-poppins">
                        Verificação
                    </h1>

                    <p class="text-gray-500 text-center text-sm lg:text-base">
                        Digite o código de 4 dígitos enviado para o seu e-mail.
                    </p>

                    <!-- Inputs -->

                    <div class="flex gap-4">
                        <input maxlength="1"
                            class="w-18 h-18 border-2 border-gray-300 rounded-md text-center text-3xl outline-none focus:border-sky-400 transition">
                        <input maxlength="1"
                            class="w-18 h-18 border-2 border-gray-300 rounded-md text-center text-3xl outline-none focus:border-sky-400 transition">
                        <input maxlength="1"
                            class="w-18 h-18 border-2 border-gray-300 rounded-md text-center text-3xl outline-none focus:border-sky-400 transition">
                        <input maxlength="1"
                            class="w-18 h-18 border-2 border-gray-300 rounded-md text-center text-3xl outline-none focus:border-sky-400 transition">
                    </div>

                    <button
                        class="text-2xl max-w-sm w-full rounded-full bg-sky-400 py-4 font-semibold text-white duration-300 hover:-translate-y-1 hover:bg-indigo-500">
                        <a href="./indicadores/primeira.php" class="flex justify-center items-center gap-2">
                            Verificar
                        </a>
                    </button>

                    <a href="./cadastro.php" class="text-blue-500 text-lg">
                        Reenviar código
                    </a>
                </div>

                <!-- DIREITA -->

                <div class="hidden lg:flex lg:w-3/5 bg-gradient-to-br from-sky-100 to-cyan-400">
                    <img src="../../assets/img/cadastro.png" class="w-full h-full object-cover" alt="Verificação">
                </div>
            </div>
        </div>
    </div>

</body>

</html>