<?php
include_once("./constante.php");
include_once("./includes/header.php");
include_once("./service/conexao.php");
?>

    <div class="min-h-screen bg-sky-300 flex items-end  md:items-start md:pt-10 justify-center">
        <div
            class=" bg-white w-full md:h-full max-w-[414px] md:max-w-2xl p-6 md:p-10 rounded-t-[2.5rem] md:rounded-[2.5rem] flex flex-col items-center  gap-6 shadow-lg ">
            <div class="w-full max-w-xs md:max-w-sm lg:max-w-md flex justify-center">
                <img src="./assets/img/Inovavida.png" class="w-full object-contain" alt="Logo Inova Vida" />
            </div>

            <a href="<?= ROOT_PATH ?>pages/escolha/cliente.php"
                class="w-full max-w-sm md:max-w-md lg:max-w-lg text-center text-xl md:text-2xl lg:text-3xl rounded-full bg-sky-400 px-6 py-4 font-semibold text-white transition-all duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 hover:bg-indigo-500">
                Cliente
            </a>

            <a class="w-full max-w-sm md:max-w-md lg:max-w-lg text-center text-xl md:text-2xl lg:text-3xl rounded-full bg-sky-400 px-6 py-4 font-semibold text-white transition-all duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 hover:bg-indigo-500"
            href="<?= ROOT_PATH ?>pages/escolha/profissional.php">
                Profissional da Saude
            </a>

        </div>
    </div>

<?php
include_once("./includes/footer.php");
?>