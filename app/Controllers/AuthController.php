<?php

declare(strict_types=1);

namespace App\Controllers;

require_once __DIR__ . '/../Models/Cliente.php';
require_once __DIR__ . '/../Models/Especialidade.php';
require_once __DIR__ . '/../Models/Profissional.php';
require_once __DIR__ . '/../Models/Usuario.php';

use App\Models\Cliente;
use App\Models\Especialidade;
use App\Models\Profissional;
use App\Models\Usuario;

final class AuthController
{
    private Usuario $usuarios;
    private Cliente $clientes;
    private Profissional $profissionais;
    private Especialidade $especialidades;

    public function __construct()
    {
        $this->usuarios = new Usuario();
        $this->clientes = new Cliente();
        $this->profissionais = new Profissional();
        $this->especialidades = new Especialidade();
    }

    public function login(array $dados): void
    {
        $email = trim((string) ($dados['email'] ?? ''));
        $senha = (string) ($dados['senha'] ?? '');

        if ($email === '' || $senha === '') {
            \flash_set('erro', 'Informe email e senha.');
            header('Location: /InovaVida/index.php');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            \flash_set('erro', 'Informe um email válido.');
            header('Location: /InovaVida/index.php');
            exit;
        }

        $usuario = $this->usuarios->authenticate($email, $senha);

        if ($usuario === null) {
            \flash_set('erro', 'Credenciais inválidas.');
            header('Location: /InovaVida/index.php');
            exit;
        }

        if ($usuario['tipo'] === 'cliente') {
            $cliente = $this->clientes->findByUsuarioId((int) $usuario['id']);
            if ($cliente !== null) {
                $usuario['cliente_id'] = (int) $cliente['id'];
            }
        }

        if ($usuario['tipo'] === 'profissional') {
            $profissional = $this->profissionais->findByUsuarioId((int) $usuario['id']);
            if ($profissional !== null) {
                $usuario['profissional_id'] = (int) $profissional['id'];
            }
        }

        \auth_login($usuario);

        $redirect = match ($usuario['tipo']) {
            'cliente' => '/InovaVida/pages/Cliente/aplicacao/dashboard.php',
            'profissional' => '/InovaVida/pages/profissional/aplicacao/dashboard.php',
            default => '/InovaVida/index.php?tipo=indisponivel',
        };

        header('Location: ' . $redirect);
        exit;
    }

    public function registrarCliente(array $dados): void
    {
        $nome = trim((string) ($dados['nome'] ?? ''));
        $email = trim((string) ($dados['email'] ?? ''));
        $senha = (string) ($dados['senha'] ?? '');
        $confirmacao = (string) ($dados['confirmar_senha'] ?? '');

        if ($nome === '' || $email === '' || $senha === '') {
            \flash_set('erro', 'Preencha nome, email e senha.');
            header('Location: /InovaVida/auth/cliente/cadastro.php');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            \flash_set('erro', 'Informe um email válido.');
            header('Location: /InovaVida/auth/cliente/cadastro.php');
            exit;
        }

        if ($senha !== $confirmacao) {
            \flash_set('erro', 'As senhas não conferem.');
            header('Location: /InovaVida/auth/cliente/cadastro.php');
            exit;
        }

        $erroSenha = $this->validarSenha($senha);
        if ($erroSenha !== null) {
            \flash_set('erro', $erroSenha);
            header('Location: /InovaVida/auth/cliente/cadastro.php');
            exit;
        }

        if ($this->usuarios->emailExists($email)) {
            \flash_set('erro', 'Esse email já está cadastrado.');
            header('Location: /InovaVida/auth/cliente/cadastro.php');
            exit;
        }

        $usuarioId = $this->usuarios->create([
            'nome' => $nome,
            'email' => $email,
            'senha' => password_hash($senha, PASSWORD_DEFAULT),
            'tipo' => 'cliente',
            'ativo' => 1,
        ]);

        $this->clientes->create($usuarioId, [
            'cpf' => $dados['cpf'] ?? null,
            'telefone' => $dados['telefone'] ?? null,
            'data_nascimento' => $dados['data_nascimento'] ?? null,
            'sexo' => $dados['sexo'] ?? null,
            'peso' => $dados['peso'] ?? null,
            'altura' => $dados['altura'] ?? null,
            'tipo_sanguineo' => $dados['tipo_sanguineo'] ?? null,
            'cidade' => $dados['cidade'] ?? null,
            'estado' => $dados['estado'] ?? null,
            'endereco' => $dados['endereco'] ?? null,
            'cep' => $dados['cep'] ?? null,
        ]);

        \flash_set('sucesso', 'Cadastro realizado com sucesso.');
        header('Location: /InovaVida/auth/cliente/verificacao.php');
        exit;
    }

    public function prepararCadastroProfissional(array $dados): void
    {
        $nome = trim((string) ($dados['nome'] ?? ''));
        $email = trim((string) ($dados['email'] ?? ''));
        $senha = (string) ($dados['senha'] ?? '');
        $confirmacao = (string) ($dados['confirmar_senha'] ?? '');

        if ($nome === '' || $email === '' || $senha === '') {
            \flash_set('erro', 'Preencha nome, email e senha.');
            header('Location: /InovaVida/auth/profissional/cadastro.php');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            \flash_set('erro', 'Informe um email válido.');
            header('Location: /InovaVida/auth/profissional/cadastro.php');
            exit;
        }

        if ($senha !== $confirmacao) {
            \flash_set('erro', 'As senhas não conferem.');
            header('Location: /InovaVida/auth/profissional/cadastro.php');
            exit;
        }

        $erroSenha = $this->validarSenha($senha);
        if ($erroSenha !== null) {
            \flash_set('erro', $erroSenha);
            header('Location: /InovaVida/auth/profissional/cadastro.php');
            exit;
        }

        if ($this->usuarios->emailExists($email)) {
            \flash_set('erro', 'Esse email já está cadastrado.');
            header('Location: /InovaVida/auth/profissional/cadastro.php');
            exit;
        }

        $_SESSION['cadastro_profissional'] = [
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha,
            'telefone' => trim((string) ($dados['telefone'] ?? '')),
        ];

        header('Location: /InovaVida/auth/profissional/cadastro2.php');
        exit;
    }

    public function registrarProfissional(array $dados): void
    {
        $cadastroTemp = $_SESSION['cadastro_profissional'] ?? null;
        $especialidadeId = (int) ($dados['especialidade_id'] ?? 0);

        if (!is_array($cadastroTemp) || $cadastroTemp === []) {
            \flash_set('erro', 'Complete a primeira etapa do cadastro.');
            header('Location: /InovaVida/auth/profissional/cadastro.php');
            exit;
        }

        if ($especialidadeId <= 0) {
            \flash_set('erro', 'Selecione uma especialidade.');
            header('Location: /InovaVida/auth/profissional/cadastro2.php');
            exit;
        }

        if (!$this->especialidades->exists($especialidadeId)) {
            \flash_set('erro', 'Especialidade inválida.');
            header('Location: /InovaVida/auth/profissional/cadastro.php');
            exit;
        }

        $usuarioId = $this->usuarios->create([
            'nome' => $cadastroTemp['nome'],
            'email' => $cadastroTemp['email'],
            'senha' => password_hash((string) $cadastroTemp['senha'], PASSWORD_DEFAULT),
            'tipo' => 'profissional',
            'ativo' => 1,
        ]);

        $this->profissionais->create($usuarioId, [
            'especialidade_id' => $especialidadeId,
            'crm' => $dados['crm'] ?? null,
            'telefone' => $dados['telefone'] ?? ($cadastroTemp['telefone'] ?? null),
            'descricao' => $dados['descricao'] ?? null,
            'foto' => $dados['foto'] ?? null,
            'valor_consulta' => $dados['valor_consulta'] ?? null,
        ]);

        unset($_SESSION['cadastro_profissional']);

        \flash_set('sucesso', 'Cadastro realizado com sucesso.');
        header('Location: /InovaVida/auth/profissional/verificacao.php');
        exit;
    }

    private function validarSenha(string $senha): ?string
    {
        $erros = [];

        if (mb_strlen($senha) < 6) {
            $erros[] = 'ter pelo menos 6 caracteres';
        }

        if (!preg_match('/[0-9]/', $senha)) {
            $erros[] = 'conter pelo menos 1 número';
        }

        if (!preg_match('/[^A-Za-z0-9]/', $senha)) {
            $erros[] = 'conter pelo menos 1 símbolo';
        }

        if ($erros === []) {
            return null;
        }

        return 'A senha precisa ' . implode(', ', $erros) . '.';
    }

    public function logout(): void
    {
        \auth_logout();
        header('Location: /InovaVida/index.php');
        exit;
    }
}