<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../../../src/output.css" rel="stylesheet" />
    <title>Inova Vida Tech</title>
</head>

<body>
    <div class="min-h-screen bg-sky-300 px-3 py-4 sm:px-4 lg:px-8">
        <div class="mx-auto flex max-w-6xl flex-col overflow-hidden rounded-[2rem] bg-white shadow-[0_20px_60px_rgba(2,132,199,0.2)]">
            <div class="bg-sky-800 px-6 py-8 text-white sm:px-8 lg:px-10">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div class="max-w-3xl">
                        <h1 class="text-2xl font-poppins font-semibold sm:text-3xl">Seja Bem-vindo, Marcelinho!</h1>
                        <h2 class="mt-2 text-lg font-poppins text-sky-300 sm:text-xl">O que você está procurando?</h2>
                    </div>

                    <a href="../usuario/perfil.php"
                        class="inline-flex items-center justify-center self-start rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-sky-800 transition duration-300 hover:bg-sky-100">
                        Perfil
                    </a>
                </div>

                <div class="mt-6 flex items-center rounded-2xl bg-white px-4 py-3 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="mr-3 h-5 w-5 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <p class="font-poppins text-gray-500">Pesquisar</p>
                </div>
            </div>

            <div class="bg-white px-6 py-8 sm:px-8 lg:px-10">
                <div class="mx-auto flex max-w-4xl flex-col overflow-hidden rounded-[1.5rem] border border-gray-200 shadow-sm sm:flex-row">
                    <img class="h-48 w-full object-cover sm:h-auto sm:w-[45%]" src="../../../assets/img/Doutor.png" alt="Profissional" />

                    <div class="flex flex-1 flex-col justify-center px-5 py-6 text-center sm:text-left">
                        <p class="text-sm font-semibold font-poppins text-sky-600">Sem Agendamentos</p>
                        <p class="mt-2 text-sm text-gray-600 font-poppins">Você ainda não possui pedidos de agendamento no momento.</p>
                        <a href="./agendamento.php"
                            class="mt-5 inline-flex items-center justify-center rounded-full bg-sky-800 px-5 py-2.5 text-sm font-semibold text-white transition duration-300 hover:bg-sky-700">
                            Ver Pedidos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>