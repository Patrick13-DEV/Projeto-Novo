# InovaVida — organização por responsabilidades

## Estrutura
- `controllers/`: preparação dos dados e regras das páginas PHP, sem marcação HTML.
- `pages/`, `auth/`, `index.php`: templates de apresentação com HTML, condicionais de exibição e interpolação PHP.
- `service/functions.php`: funções auxiliares de apresentação de status e datas.
- `service/navigation.php`: seleção de destino do menu conforme a sessão.
- `actions/`: endpoints de cadastro, login e agendamento, preservados como camada de processamento.
- `assets/script.js`: comportamento JavaScript compartilhado.
- `assets/js/`: JavaScript específico de páginas extraído de blocos `<script>`.
- `assets/style.css`: regras CSS próprias; `src/output.css`: Tailwind CSS pré-compilado.

## Executar
Coloque a pasta `InovaVida` na raiz do servidor PHP configurado para `http://localhost/InovaVida/`, configure o banco conforme `service/conexao.php` e importe o SQL adequado de `database/`. Requer PHP com PDO MySQL. Não é necessário distribuir `node_modules`; execute `npm install` se precisar recompilar Tailwind.

## Notas
O código de negócio da preparação de cada página está em `controllers/`, com nomes baseados no caminho da página. As views carregam seu controller antes de qualquer HTML. Os dados dinâmicos de categorias são passados ao JS por um atributo HTML escapado, sem `<script>` de dados embutido. Nenhuma query ou regra existente foi intencionalmente alterada.

## Controle de acesso e redirecionamento

- `service/access.php` centraliza a verificacao de sessao, o perfil do usuario e o destino do dashboard.
- Visitantes podem acessar index, escolha, login, cadastro e etapas de cadastro. Usuarios autenticados sao redirecionados automaticamente para seu dashboard ao tentar acessar essas telas ou seus endpoints de formulario.
- Telas internas exigem autenticacao e o perfil correto (cliente ou profissional). Acesso indevido e redirecionado.
- `actions/logout.php` encerra a sessao e remove o cookie; somente apos sair e possivel voltar ao login e cadastro.
- Para usar outra pasta/servidor, ajuste `ROOT_PATH` em `constante.php`.

## Protecao contra listagem de diretorios (Apache)

O arquivo `.htaccess` na raiz do projeto define `Options -Indexes`,
impedindo que o Apache exiba uma listagem de arquivos quando alguem acessa
uma pasta sem pagina de indice. A diretiva vale tambem para as subpastas,
salvo configuracoes especificas do servidor que a substituam.

**Requisitos:** o Apache precisa permitir essa diretiva via `.htaccess`
(`AllowOverride Options` ou `AllowOverride All` no bloco `<Directory>`
correspondente). Caso o servidor nao permita `.htaccess`, configure
`Options -Indexes` diretamente no VirtualHost/bloco `<Directory>` e recarregue
o Apache. Se a diretiva nao for permitida no `.htaccess`, o Apache pode
responder com erro 500; nesse caso, ajuste a configuracao do servidor.

**Teste sugerido:** abra uma subpasta sem `index.php` ou `index.html`, por
exemplo `/InovaVida/controllers/`. Em vez de mostrar uma lista de arquivos,
o servidor deve responder `403 Forbidden` (na configuracao Apache usual).
Arquivos publicos com URL conhecida continuam acessiveis; esta medida
nao substitui protecao de arquivos sensiveis nem autorizacao de acesso.
