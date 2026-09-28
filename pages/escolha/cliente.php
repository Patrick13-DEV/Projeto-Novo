<?php

include_once("../../constante.php");
include_once("../../includes/header.php");
include_once("../../service/conexao.php");

?>

<main class="bg-sky-300 flex justify-center py-8">
    <div class="bg-white w-full max-w-[414px] md:max-w-2xl p-6 md:p-10 rounded-[2.5rem] flex flex-col items-center gap-6 shadow-lg">
        <div class="w-full max-w-xs md:max-w-sm lg:max-w-md flex justify-center">
            <img src="<?= ROOT_PATH ?>assets/img/Inovavida.png" class="w-full object-contain" alt="Logo Inova Vida"/>
        </div>
        <a href="<?= ROOT_PATH ?>auth/Cliente/login.php" class="w-full max-w-sm md:max-w-md lg:max-w-lg text-center text-xl md:text-2xl lg:text-3xl rounded-full bg-sky-400 px-6 py-4 font-semibold text-white transition-all duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 hover:bg-indigo-500">
            Login
        </a>
        <a href="<?= ROOT_PATH ?>auth/Cliente/cadastro.php" class="w-full max-w-sm md:max-w-md lg:max-w-lg text-center text-xl md:text-2xl lg:text-3xl rounded-full bg-sky-400 px-6 py-4 font-semibold text-white transition-all duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 hover:bg-indigo-500">
            Cadastro
        </a>
    </div>
</main>

<?php

include_once("../../includes/footer.php");

?>