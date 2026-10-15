<?php require_once __DIR__ . "/../service/navigation.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="<?= ROOT_PATH ?>assets/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= ROOT_PATH ?>src/output.css" rel="stylesheet">
    <title>InovaVida - SENAC</title>
</head>

<body class="min-h-screen flex flex-col bg-slate-50">

    <header class="w-full shrink-0 bg-white">
        <nav class="flex h-[62px] w-full items-center justify-center px-4 sm:h-[70px]">
            <a href="<?= $logoDestino ?>" class="group flex items-center gap-2 no-underline transition-all duration-300 sm:gap-2.5">
                <div class="relative flex h-9 w-9 shrink-0 items-center justify-center overflow-hidden rounded-[10px] bg-gradient-to-br from-sky-500 to-cyan-500 shadow-md shadow-sky-500/20 transition-all duration-300 group-hover:scale-105 sm:h-10 sm:w-10 sm:rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-5 w-5 text-white sm:h-6 sm:w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h4l2-4 3 8 2-4h7" />
                    </svg>
                </div>

                <div class="flex flex-col leading-none">
                    <span class="text-[18px] font-extrabold tracking-tight text-slate-800 sm:text-[21px]">
                        Inova<span class="text-sky-500">Vida</span>
                    </span>

                    <span class="mt-1 text-[7px] font-bold uppercase tracking-[0.25em] text-slate-400 sm:text-[8px]">
                        SENAC
                    </span>
                </div>
            </a>
        </nav>
    </header>