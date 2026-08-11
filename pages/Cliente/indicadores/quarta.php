<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../../src/output.css" rel="stylesheet" />
    <title>Inova Vida Tech</title>
</head>

<body>
    <div class="min-h-screen bg-sky-300 flex items-end md:items-center justify-center">
            <div class="flex w-full md:max-w-2xl lg:max-w-4xl flex-col overflow-hidden rounded-t-[2.5rem] md:rounded-[2.5rem] bg-white shadow-[0_20px_60px_rgba(2,132,199,0.2)] md:flex-row">
                <div class="flex flex-1 flex-col justify-center px-6 py-8 sm:px-8 lg:px-10 lg:pr-12">
                    <span class="mb-4 inline-flex w-fit rounded-full bg-sky-100 px-3 py-1 text-sm font-semibold text-sky-700">
                        Etapa 4 · Peso e altura
                    </span>

                    <h1 class="text-3xl font-poppins font-semibold text-slate-800 sm:text-4xl">Peso & Altura</h1>

                    <p class="mt-4 max-w-md text-base leading-relaxed text-gray-600 sm:text-lg">
                        Determine seu peso e altura para completar o cadastro dos indicadores.
                    </p>

                    <div class="mt-6 w-full max-w-md space-y-3">
                        <div class="flex items-center rounded-2xl border border-gray-200 bg-gray-50 px-3 py-3 shadow-sm">
                            <div class="mr-3 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-500">
                                <svg class="h-6 w-6 stroke-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                                </svg>
                            </div>
                            <input class="w-full bg-transparent font-poppins text-base outline-none" type="text" placeholder="Peso">
                        </div>

                        <div class="flex items-center rounded-2xl border border-gray-200 bg-gray-50 px-3 py-3 shadow-sm">
                            <div class="mr-3 flex h-12 w-12 items-center justify-center rounded-xl bg-sky-500">
                                <svg class="h-6 w-6 stroke-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                                </svg>
                            </div>
                            <input class="w-full bg-transparent font-poppins text-base outline-none" type="text" placeholder="Altura">
                        </div>
                    </div>

                    <div class="mt-6 flex gap-2">
                        <div class="h-2.5 w-2.5 rounded-full bg-gray-300"></div>
                        <div class="h-2.5 w-2.5 rounded-full bg-gray-300"></div>
                        <div class="h-2.5 w-2.5 rounded-full bg-gray-300"></div>
                        <div class="h-2.5 w-2.5 rounded-full bg-sky-500"></div>
                        <div class="h-2.5 w-2.5 rounded-full bg-gray-300"></div>
                    </div>

                    <a href="./conclusao.php"
                        class="mt-8 inline-flex w-fit items-center justify-center rounded-full bg-sky-500 px-7 py-3 text-lg font-semibold text-white shadow-lg transition duration-300 ease-in-out hover:-translate-y-1 hover:bg-indigo-500">
                        Próximo
                    </a>
                </div>

                <div class="flex items-center justify-center bg-gradient-to-br from-sky-100 via-cyan-50 to-white p-8 lg:w-[45%] lg:p-10">
                    <div class="rounded-[2rem] border border-sky-200 bg-white/90 p-6 shadow-lg">
                        <img src="../../../assets/img/clean.png" class="h-56 w-full max-w-sm object-contain" alt="Ilustração de saúde" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>