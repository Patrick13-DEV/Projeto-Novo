<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../../src/output.css" rel="stylesheet" />
    <title>Inova Vida Tech</title>
</head>

<body>

    <div class="min-h-screen bg-sky-300  md:px-6 flex items-end md:items-center justify-center">

        <div class="w-full max-w-7xl bg-white md:rounded-[2.5rem] shadow-lg overflow-hidden">
            <div class="p-4 sm:p-6 lg:p-4">
                <div class="flex flex-col md:flex-row gap-6 lg:gap-8">

                    <!-- Lado Esquerdo -->
                    <div class="w-full md:w-3/5  flex flex-col gap-4">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                            <div>
                                <h1 class="text-2xl md:text-xl lg:text-3xl font-poppins font-semibold">
                                    Seja Bem-vindo, Marcelinho!
                                </h1>

                                <h2 class="text-xl text-sky-500 mt-3 font-poppins">
                                    Como posso ajudar você hoje?
                                </h2>
                            </div>

                        </div>

                        <!-- Agendamentos -->

                        <a href="./categorias.php"
                            class="bg-sky-400 rounded-xl border-1 h-40 flex flex-col justify-center items-center shadow-lg hover:bg-sky-500 duration-300">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-20 stroke-white">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />

                            </svg>

                            <p class="text-white text-2xl font-bold font-poppins">
                                Agendamentos
                            </p>

                        </a>

                        <!-- Nenhum Agendamento -->

                        <div class="bg-gray-100 rounded-xl border-1 h-56 flex flex-col justify-center items-center shadow-lg">

                            <div class="bg-sky-400 w-24 h-24 rounded-full flex items-center justify-center">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-16 stroke-white">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />

                                </svg>

                            </div>

                            <p class="mt-5 font-poppins font-medium text-gray-700">
                                Nenhum Agendamento Pendente
                            </p>

                        </div>

                    </div>

                    <!-- Lado Direito -->

                    <div class="lg:w-3/5 p-8 flex items-center justify-between flex-col">

                        <div class="w-full rounded-xl border-1 overflow-hidden shadow-lg pb-5">

                            <div class="bg-sky-400 p-4">

                                <h3 class="text-white font-semibold font-poppins text-md">
                                    Pressão Arterial
                                </h3>

                            </div>

                            <div class="bg-white p-4 border-b">

                                <ul class="list-disc ps-5 font-poppins text-gray-600">
                                    <li>Possui 15 de Pressão Arterial</li>
                                </ul>

                            </div>

                            <div class="bg-sky-400 p-2">

                                <h3 class="text-white font-semibold font-poppins text-md">
                                    Quais são os Indicadores de Saúde?
                                </h3>

                            </div>

                            <div class="bg-white divide-y">

                                <div class="p-4">
                                    <ul class="list-disc ps-5 font-poppins text-gray-600">
                                        <li>TDAH</li>
                                    </ul>
                                </div>

                                <div class="p-4">
                                    <ul class="list-disc ps-5 font-poppins text-gray-600">
                                        <li>Diabetes</li>
                                    </ul>
                                </div>

                                <div class="p-4">
                                    <ul class="list-disc ps-5 font-poppins text-gray-600">
                                        <li>Hipertensão</li>
                                    </ul>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</body>

</html>