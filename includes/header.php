
<?php
// header.php
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <link href="./src/output.css" rel="stylesheet">

    <title>InovaVida - SENAC</title>
</head>

<body class="bg-slate-50 text-slate-800">

    <!-- HEADER -->
    <header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/90 backdrop-blur-xl">

        <nav class="relative mx-auto flex h-[78px] w-[92%] max-w-7xl items-center justify-between">

            <a
                href="<?= ROOT_PATH ?>index.php"
                class="group absolute left-1/2 top-1/2 flex -translate-x-1/2 -translate-y-1/2 items-center gap-3 no-underline"
            >

                <!-- ÍCONE DA LOGO -->
                <div
                    class="relative flex h-11 w-11 items-center justify-center overflow-hidden rounded-xl bg-gradient-to-br from-sky-500 to-cyan-500 shadow-lg shadow-sky-500/20 transition-all duration-300 group-hover:scale-105 group-hover:shadow-sky-500/30"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        class="h-6 w-6 text-white"
                    >

                        <!-- Coração -->
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78Z"
                        />

                        <!-- Batimento -->
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 12h4l2-4 3 8 2-4h7"
                        />

                    </svg>

                </div>


                <!-- NOME DA MARCA -->
                <div class="flex flex-col leading-none">

                    <span class="text-[21px] font-extrabold tracking-tight text-slate-800">
                        Inova<span class="text-sky-500">Vida</span>
                    </span>

                    <span class="mt-1 text-[9px] font-bold uppercase tracking-[0.25em] text-slate-400">
                        SENAC
                    </span>

                </div>

            </a>


            <!-- ========================================= -->
            <!-- ÁREA DIREITA -->
            <!-- ========================================= -->

            <div class="flex items-center gap-3">


                <!-- USUÁRIO LOGADO -->
                <?php if (!empty($nomeUser)): ?>

                    <div
                        class="hidden items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 sm:flex"
                    >

                        <!-- Avatar -->
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-sky-100 text-sm font-bold text-sky-600"
                        >
                            <?= strtoupper(substr($nomeUser, 0, 1)) ?>
                        </div>


                        <!-- Nome -->
                        <div class="max-w-[130px] leading-tight">

                            <span class="block text-[9px] font-bold uppercase tracking-wider text-slate-400">
                                Olá,
                            </span>

                            <span class="block truncate text-sm font-bold text-slate-700">
                                <?= htmlspecialchars($nomeUser) ?>
                            </span>

                        </div>

                    </div>

                <?php endif; ?>


                <!-- ========================================= -->
                <!-- BOTÃO MENU MOBILE -->
                <!-- ========================================= -->

                <button
                    id="mobileMenuButton"
                    type="button"
                    aria-label="Abrir menu"
                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-50 md:hidden"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="h-5 w-5"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                    </svg>

                </button>

            </div>

        </nav>


        <!-- ========================================= -->
        <!-- MENU MOBILE -->
        <!-- ========================================= -->

        <div
            id="mobileMenu"
            class="hidden border-t border-slate-100 bg-white px-[4%] py-4 md:hidden"
        >

            <div class="flex flex-col gap-1">


                <!-- Cuidado -->
                <a
                    href="<?= ROOT_PATH ?>index.php"
                    class="rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 no-underline transition hover:bg-sky-50 hover:text-sky-600"
                >
                    Cuidado
                </a>


                <!-- Saúde -->
                <a
                    href="<?= ROOT_PATH ?>pages/escolha/cliente.php"
                    class="rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 no-underline transition hover:bg-sky-50 hover:text-sky-600"
                >
                    Saúde
                </a>


                <!-- Suporte -->
                <a
                    href="<?= ROOT_PATH ?>pages/escolha/profissional.php"
                    class="rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 no-underline transition hover:bg-sky-50 hover:text-sky-600"
                >
                    Suporte
                </a>

            </div>

        </div>

    </header>


    <!-- ========================================= -->
    <!-- SCRIPT DO MENU MOBILE -->
    <!-- ========================================= -->

    <script>

        const mobileMenuButton = document.getElementById("mobileMenuButton");
        const mobileMenu = document.getElementById("mobileMenu");

        mobileMenuButton?.addEventListener("click", () => {

            mobileMenu.classList.toggle("hidden");

        });

    </script>


</body>

</html>
