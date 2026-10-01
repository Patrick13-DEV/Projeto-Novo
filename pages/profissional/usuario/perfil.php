<?php

include_once("../../../constante.php");
include_once("../../../service/conexao.php");
include_once("../../../service/auth.php");
include_once("../../../includes/header.php");

$idUser = (int) $_SESSION['idUser'];

$mensagem = '';
$tipoMensagem = '';

/*
|--------------------------------------------------------------------------
| ATUALIZAR DADOS
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_perfil'])) {

    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $cpf = trim($_POST['cpf'] ?? '');
    $especialidade = trim($_POST['especialidade'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $estado = trim($_POST['estado'] ?? '');
    $cidade = trim($_POST['cidade'] ?? '');
    $rua = trim($_POST['rua'] ?? '');

    if (
        empty($nome) ||
        empty($email) ||
        empty($especialidade) ||
        empty($estado) ||
        empty($cidade) ||
        empty($rua)
    ) {
        $_SESSION['mensagem_perfil'] = 'Preencha todos os campos obrigatórios.';
        $_SESSION['tipo_mensagem_perfil'] = 'erro';

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $_SESSION['mensagem_perfil'] = 'Informe um e-mail válido.';
        $_SESSION['tipo_mensagem_perfil'] = 'erro';

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    try {

        /*
        |--------------------------------------------------------------------------
        | Verifica se o e-mail já pertence a outro profissional
        |--------------------------------------------------------------------------
        */

        $sql = "
            SELECT id
            FROM profissionais
            WHERE email = :email
            AND id != :id
            LIMIT 1
        ";

        $stmt = $conexao->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':id', $idUser, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->fetch()) {

            $_SESSION['mensagem_perfil'] = 'Este e-mail já está sendo utilizado por outro profissional.';
            $_SESSION['tipo_mensagem_perfil'] = 'erro';

            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

        /*
        |--------------------------------------------------------------------------
        | Atualiza os dados
        |--------------------------------------------------------------------------
        */

        $sql = "
            UPDATE profissionais
            SET
                nome = :nome,
                email = :email,
                cpf = :cpf,
                especialidade = :especialidade,
                telefone = :telefone,
                estado = :estado,
                cidade = :cidade,
                rua = :rua
            WHERE id = :id
        ";

        $stmt = $conexao->prepare($sql);

        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->bindValue(':especialidade', $especialidade, PDO::PARAM_STR);
        $stmt->bindValue(':telefone', $telefone, PDO::PARAM_STR);
        $stmt->bindValue(':estado', $estado, PDO::PARAM_STR);
        $stmt->bindValue(':cidade', $cidade, PDO::PARAM_STR);
        $stmt->bindValue(':rua', $rua, PDO::PARAM_STR);
        $stmt->bindValue(':id', $idUser, PDO::PARAM_INT);

        $stmt->execute();

        /*
        |--------------------------------------------------------------------------
        | Atualiza o nome da sessão
        |--------------------------------------------------------------------------
        */

        $_SESSION['nomeUser'] = $nome;

        $_SESSION['mensagem_perfil'] = 'Informações atualizadas com sucesso.';
        $_SESSION['tipo_mensagem_perfil'] = 'sucesso';

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;

    } catch (PDOException $e) {

        $_SESSION['mensagem_perfil'] = 'Ocorreu um erro ao atualizar suas informações.';
        $_SESSION['tipo_mensagem_perfil'] = 'erro';

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| MENSAGEM DA SESSÃO
|--------------------------------------------------------------------------
*/

if (isset($_SESSION['mensagem_perfil'])) {

    $mensagem = $_SESSION['mensagem_perfil'];
    $tipoMensagem = $_SESSION['tipo_mensagem_perfil'] ?? 'erro';

    unset($_SESSION['mensagem_perfil']);
    unset($_SESSION['tipo_mensagem_perfil']);
}

/*
|--------------------------------------------------------------------------
| BUSCAR PROFISSIONAL
|--------------------------------------------------------------------------
*/

$sql = "
    SELECT
        id,
        nome,
        email,
        cpf,
        especialidade,
        telefone,
        estado,
        cidade,
        rua
    FROM profissionais
    WHERE id = :id
    LIMIT 1
";

$stmt = $conexao->prepare($sql);
$stmt->bindValue(':id', $idUser, PDO::PARAM_INT);
$stmt->execute();

$profissional = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$profissional) {
    echo '
        <main class="flex min-h-screen items-center justify-center bg-sky-300 px-4">
            <div class="rounded-2xl bg-white p-8 text-center shadow-xl">
                <h1 class="text-xl font-bold text-red-600">
                    Profissional não encontrado.
                </h1>
            </div>
        </main>
    ';
    exit;
}

$nome = $profissional['nome'];
$email = $profissional['email'];
$cpf = $profissional['cpf'];
$especialidade = $profissional['especialidade'];
$telefone = $profissional['telefone'];
$estado = $profissional['estado'];
$cidade = $profissional['cidade'];
$rua = $profissional['rua'];

?>

<main class="min-h-[calc(100vh-62px)] bg-sky-300 px-3 py-20 sm:px-4 lg:px-8">
    <div class="mx-auto  flex w-full max-w-6xl flex-col overflow-hidden rounded-[2rem] bg-white shadow-[0_20px_60px_rgba(2,132,199,0.2)] lg:flex-row">
        <div class="relative overflow-hidden bg-sky-800 px-6 py-8 text-white sm:px-8 lg:w-[42%] lg:py-10">
            <img src="../../../assets/img/transcent.png" class="absolute right-0 top-0 h-72 w-72 object-cover opacity-80" alt="">
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-sky-200 font-poppins">
                            Perfil
                        </p>
                        <h1 class="text-2xl font-poppins font-semibold sm:text-3xl">
                            Profissional
                        </h1>
                    </div>
                </div>

                <div class="mt-10 flex flex-col items-center sm:flex-row sm:items-center sm:text-left">
                    <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-full bg-white shadow-lg">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-10 w-10 text-sky-800"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0"
                            />
                        </svg>
                    </div>
                    <div class="px-4 mt-4 sm:ml-4 sm:mt-0">
                        <p class="font-poppins text-xl font-semibold">
                            <?=htmlspecialchars($nome) ?>
                        </p>
                        <p class="mt-1 break-all font-poppins text-sm text-sky-100">
                            <?= htmlspecialchars($email) ?>
                        </p>
                        <p class="mt-2 font-poppins text-xs text-sky-200">
                            ID profissional: #<?= (int) $profissional['id'] ?>
                        </p>
                    </div>
                </div>

                <div class="mt-10 space-y-3">
                    <div class="rounded-2xl bg-white/10 p-4 backdrop-blur-sm">
                        <p class="text-xs font-semibold uppercase tracking-wider text-sky-200">
                            Especialidade
                        </p>
                        <p class="mt-1 font-poppins font-semibold">
                            <?= htmlspecialchars($especialidade) ?>
                        </p>
                    </div>
                    <div class="rounded-2xl bg-white/10 p-4 backdrop-blur-sm">
                        <p class="text-xs font-semibold uppercase tracking-wider text-sky-200">
                            Telefone
                        </p>
                        <p class="mt-1 font-poppins font-semibold">
                            <?= htmlspecialchars($telefone ?: 'Não informado') ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 px-5 py-6 sm:px-8 lg:px-10 lg:py-8">
            <?php if (!empty($mensagem)): ?>
                <div class="mb-6 rounded-xl border px-4 py-3 text-sm font-semibold font-poppins <?= $tipoMensagem === 'sucesso' ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-red-200 bg-red-50 text-red-700'?>">
                    <?= htmlspecialchars($mensagem) ?>
                </div>
            <?php endif; ?>

            <div>
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-sky-500 font-poppins">
                            Dados cadastrados
                        </p>
                        <h2 class="mt-1 text-xl font-poppins font-semibold text-slate-800">
                            Informações Essenciais
                        </h2>
                    </div>
                </div>

                <div class="mt-5 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 font-poppins">
                            Nome completo
                        </p>
                        <p class="mt-1 break-words font-poppins font-semibold text-gray-700">
                            <?= htmlspecialchars($nome) ?>
                        </p>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 font-poppins">
                            E-mail
                        </p>
                        <p class="mt-1 break-all font-poppins font-semibold text-gray-700">
                            <?= htmlspecialchars($email) ?>
                        </p>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 font-poppins">
                            CPF
                        </p>
                        <p class="mt-1 font-poppins font-semibold text-gray-700">
                            <?= htmlspecialchars($cpf ?: 'Não informado') ?>
                        </p>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 font-poppins">
                            Telefone
                        </p>
                        <p class="mt-1 font-poppins font-semibold text-gray-700">
                            <?= htmlspecialchars($telefone ?: 'Não informado') ?>
                        </p>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 font-poppins">
                            Especialidade
                        </p>
                        <p class="mt-1 font-poppins font-semibold text-gray-700">
                            <?= htmlspecialchars($especialidade) ?>
                        </p>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 font-poppins">
                            Cidade / Estado
                        </p>
                        <p class="mt-1 font-poppins font-semibold text-gray-700">
                            <?= htmlspecialchars($cidade) ?> / <?= htmlspecialchars($estado) ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-7">
                <h2 class="text-base font-poppins font-semibold text-slate-800">
                    Endereço profissional
                </h2>
                <div class="mt-4 rounded-2xl border border-gray-200 bg-gray-50 p-5">
                    <div class="flex items-start gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-sky-100 text-sky-700">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.7"
                                stroke="currentColor"
                                class="h-5 w-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 10.5-7.5 10.5S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"
                                />
                            </svg>
                        </div>
                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 font-poppins">
                                Rua
                            </p>
                            <p class="mt-1 font-poppins font-semibold text-gray-700">
                                <?= htmlspecialchars($rua) ?>
                            </p>
                            <p class="mt-1 text-sm text-gray-500 font-poppins">
                                <?= htmlspecialchars($cidade) ?> - <?= htmlspecialchars($estado) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end md:justify-center">
                <button type="button" id="abrirModalEditarPerfil" class="inline-flex items-center gap-2 rounded-full bg-sky-800 px-6 py-3 text-sm font-semibold text-white shadow-lg transition duration-300 hover:-translate-y-1 hover:bg-sky-700"><svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-5 w-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13l-3.25.929.929-3.25a4.5 4.5 0 0 1 1.13-1.897L16.862 4.487Z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.5 7.125 16.875 4.5"
                        />
                    </svg>
                    Editar Informações
                </button>
            </div>
        </div>
    </div>
</main>


<div id="modalEditarPerfil" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/60 p-4 backdrop-blur-sm">
    <div id="cardEditarPerfil" class="py-6 px-8 max-h-[90vh] w-full max-w-2xl scale-95 overflow-y-auto rounded-3xl bg-white opacity-0 shadow-2xl transition-all duration-300">
        <div class="flex items-start justify-between gap-4 border-b border-gray-100 px-6 py-5">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-sky-500 font-poppins">
                    Meu perfil
                </p>
                <h2 class="mt-1 text-xl font-bold text-slate-800 font-poppins">
                    Editar informações
                </h2>
                <p class="mt-1 text-sm text-gray-500 font-poppins">
                    Atualize seus dados profissionais.
                </p>
            </div>
            <button type="button" id="fecharModalEditarPerfil" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-gray-100 text-gray-500 transition hover:bg-gray-200">
                ✕
            </button>
        </div>

        <form method="POST" class="px-6 py-6">
            <input type="hidden" name="editar_perfil" value="1">
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="nome" class="mb-1.5 block text-sm font-semibold text-gray-700 font-poppins">
                        Nome completo
                    </label>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($nome) ?>" required class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-100">
                </div>
                <div>
                    <label for="email" class="mb-1.5 block text-sm font-semibold text-gray-700 font-poppins">
                        E-mail
                    </label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-100">
                </div>

                <div>
                    <label for="cpf" class="mb-1.5 block text-sm font-semibold text-gray-700 font-poppins">
                        CPF
                    </label>
                    <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($cpf ?? '') ?>" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-100">
                </div>

                <div>
                    <label for="especialidade" class="mb-1.5 block text-sm font-semibold text-gray-700 font-poppins">
                        Especialidade
                    </label>

                    <input type="text" id="especialidade" name="especialidade" value="<?= htmlspecialchars($especialidade) ?>" required class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-100">
                </div>

                <div>
                    <label for="telefone" class="mb-1.5 block text-sm font-semibold text-gray-700 font-poppins">
                        Telefone
                    </label>
                    <input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($telefone ?? '') ?>" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-100">
                </div>

                <div>
                    <label for="estado" class="mb-1.5 block text-sm font-semibold text-gray-700 font-poppins">
                        Estado
                    </label>
                    <input type="text" id="estado" name="estado" value="<?= htmlspecialchars($estado) ?>" required maxlength="100" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-100">
                </div>

                <div>
                    <label for="cidade" class="mb-1.5 block text-sm font-semibold text-gray-700 font-poppins">
                        Cidade
                    </label>
                    <input type="text" id="cidade" name="cidade" value="<?= htmlspecialchars($cidade) ?>" required maxlength="100" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-100">
                </div>

                <div class="sm:col-span-2">
                    <label for="rua" class="mb-1.5 block text-sm font-semibold text-gray-700 font-poppins">
                        Rua
                    </label>
                    <input type="text" id="rua" name="rua" value="<?= htmlspecialchars($rua) ?>" required maxlength="100" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 outline-none transition focus:border-sky-500 focus:bg-white focus:ring-2 focus:ring-sky-100">
                </div>
            </div>

            <div class="mt-0 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <button type="button" id="cancelarEdicaoPerfil" class="rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-50">
                    Cancelar
                </button>
                <button type="submit" class="rounded-xl bg-sky-800 px-5 py-3 text-sm font-semibold text-white transition hover:bg-sky-700">
                    Salvar alterações
                </button>
            </div>
        </form>
    </div>
</div>

<script src="../../../assets/script.js"></script>