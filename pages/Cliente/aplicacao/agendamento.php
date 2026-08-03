<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../../src/output.css" rel="stylesheet" />
    <title>Inova Vida Tech</title>
</head>

<body>
    <div class="min-h-screen bg-sky-300 px-3 py-4 sm:px-4 md:px-6 lg:px-8 flex items-center justify-center">
        <div class="w-full max-w-5xl bg-white rounded-t-[2rem] sm:rounded-[2.5rem] shadow-lg overflow-hidden">
            <div class="p-4 sm:p-6 lg:p-8">
                <div class="flex flex-col lg:flex-row gap-6 lg:gap-8">
                    <div class="w-full lg:w-[55%] flex flex-col gap-4">
                        <div class="flex items-center justify-between gap-3">
                            <h1 class="text-2xl sm:text-3xl font-poppins font-semibold">Agendamento</h1>
                            <a href="./dashboard.php" class="text-sm text-sky-600 hover:text-sky-700 font-poppins">Voltar</a>
                        </div>

                        <div class="border border-gray-200 rounded-xl p-4 shadow-sm">
                            <div class="flex items-center gap-4">
                                <div class="bg-sky-400 w-14 h-14 rounded-full shrink-0"></div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-poppins font-semibold text-lg">Kaoru Hanayama</p>
                                    <p class="font-poppins text-sm text-gray-500">Cardiologista</p>
                                </div>
                                <div class="flex items-center gap-1 text-sm font-medium text-gray-700 shrink-0">
                                    <span>4,5</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-5 stroke-green-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="flex justify-end mt-4">
                                <button class="font-poppins text-sm sm:text-base text-green-600 border border-green-500 rounded-md px-4 py-2 hover:bg-green-500 hover:text-white transition-colors">
                                    Ver Perfil
                                </button>
                            </div>
                        </div>

                        <div>
                            <h2 class="font-poppins text-xl font-semibold mb-4">Selecione Dia e Tempo</h2>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
                                <div class="bg-sky-400 text-white rounded-lg p-3 text-center shadow-sm">
                                    <p class="text-xs">Segunda</p>
                                    <p class="text-2xl mt-1">17</p>
                                </div>
                                <div class="bg-white border border-gray-200 rounded-lg p-3 text-center shadow-sm">
                                    <p class="text-xs text-gray-600">Terça</p>
                                    <p class="text-2xl mt-1 text-gray-700">18</p>
                                </div>
                                <div class="bg-white border border-gray-200 rounded-lg p-3 text-center shadow-sm">
                                    <p class="text-xs text-gray-600">Quarta</p>
                                    <p class="text-2xl mt-1 text-gray-700">19</p>
                                </div>
                                <div class="bg-white border border-gray-200 rounded-lg p-3 text-center shadow-sm">
                                    <p class="text-xs text-gray-600">Quinta</p>
                                    <p class="text-2xl mt-1 text-gray-700">20</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-3 mb-4">
                                <div class="bg-sky-400 text-white rounded-lg py-3 text-center shadow-sm">Manhã</div>
                                <div class="bg-white border border-gray-200 rounded-lg py-3 text-center shadow-sm text-gray-700">Tarde</div>
                                <div class="bg-white border border-gray-200 rounded-lg py-3 text-center shadow-sm text-gray-700">Noite</div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4">
                                <div class="bg-sky-400 text-white rounded-lg py-3 text-center shadow-sm">11:00 - 12:00</div>
                                <div class="bg-gray-200 text-gray-500 rounded-lg py-3 text-center shadow-sm">12:00 - 13:00</div>
                                <div class="bg-white border border-gray-200 rounded-lg py-3 text-center shadow-sm text-gray-700">13:00 - 14:00</div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <div class="bg-white border border-gray-200 rounded-lg py-3 text-center shadow-sm text-gray-700">14:00 - 15:00</div>
                                <div class="bg-gray-200 text-gray-500 rounded-lg py-3 text-center shadow-sm">15:00 - 16:00</div>
                                <div class="bg-white border border-gray-200 rounded-lg py-3 text-center shadow-sm text-gray-700">16:00 - 17:00</div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:w-[45%] flex flex-col gap-4">
                        <div class="rounded-xl border border-gray-200 p-4 shadow-sm">
                            <label for="sintomas" class="block text-sm font-semibold font-poppins text-gray-700 mb-2">Descrição dos sintomas</label>
                            <textarea id="sintomas" rows="6" class="w-full rounded-lg border border-gray-300 p-3 outline-none font-poppins text-sm italic resize-none" placeholder="Faça uma descrição sobre seus sintomas"></textarea>
                        </div>

                        <a href="./dashboard.php" class="flex justify-center items-center font-poppins bg-black text-base sm:text-lg text-white w-full h-12 rounded-lg hover:bg-gray-800 transition-colors">
                            Processar Agendamento
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>