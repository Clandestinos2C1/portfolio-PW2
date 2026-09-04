<?php

/*
DECLARAÇÃO DE USO DE INTELIGÊNCIA ARTIFICIAL

Ferramenta: Claude
Etapa: Desenvolvimento
Finalidade: Auxílio no coding em php e identificação de seções por comentários
            (necessário pois não tenho experiência com criptografia)
Validação: Código analisado, corrigido e testado pelo aluno.
*/


/*
Demonstração interativa dos tipos de criptografia disponíveis no PHP (sem CSS)
 
Vale lembrar que esse projeto é uma demonstração, 
por isso carece de muitas coisas que seriam necessárias em um projeto sério (incluindo beleza).
 */

session_start();

// Texto padrão usado se o usuário ainda não digitou nada
$textoPadrao = "mensagem ultra mega secreta";

// Se o usuário enviou um novo texto, guarda na sessão para persistir
// entre as trocas de seção, senão usa o que já estava salvo (ou o padrão).
if (isset($_POST['texto']) && trim($_POST['texto']) !== '') {
    $_SESSION['texto'] = $_POST['texto'];
}
$textoOriginal = isset($_SESSION['texto']) ? $_SESSION['texto'] : $textoPadrao;

// Descobre qual seção o usuário pediu para ver (via botão/POST)
$secao = isset($_POST['secao']) ? $_POST['secao'] : 'menu';

// -----------------------------------------------------------------
// Funções auxiliares de criptografia
// -----------------------------------------------------------------

function encriptarAES(string $dado, string $chave): array
{
    $metodo = 'aes-256-cbc';
    $tamanhoIV = openssl_cipher_iv_length($metodo);
    $iv = openssl_random_pseudo_bytes($tamanhoIV);

    $criptografado = openssl_encrypt(
        $dado,
        $metodo,
        $chave,
        OPENSSL_RAW_DATA,
        $iv
    );

    return [
        'cifrado' => base64_encode($criptografado),
        'iv'      => base64_encode($iv),
    ];
}

function decriptarAES(string $cifradoBase64, string $ivBase64, string $chave): string
{
    $metodo = 'aes-256-cbc';
    $cifrado = base64_decode($cifradoBase64);
    $iv = base64_decode($ivBase64);

    return openssl_decrypt(
        $cifrado,
        $metodo,
        $chave,
        OPENSSL_RAW_DATA,
        $iv
    );
}

// Cabeçalho pra todas as páginas

function imprimirCabecalho(string $titulo)
{
    echo "<h1>" . htmlspecialchars($titulo) . "</h1>";
}

// Botão de voltar pro menu

function imprimirBotaoVoltar()
{
    echo '<form method="post" action="">';
    echo '<input type="hidden" name="secao" value="menu">';
    echo '<button type="submit">&#8592; Voltar ao menu</button>';
    echo '</form>';
    echo '<hr>';
}

// Campo para editar o texto usado nas criptografias

function imprimirCampoTexto(string $textoAtual)
{
    echo '<form method="post" action="">';
    echo '<input type="hidden" name="secao" value="' . htmlspecialchars($_POST['secao'] ?? 'menu') . '">';
    echo 'Texto para criptografar: ';
    echo '<input type="text" name="texto" size="50" value="' . htmlspecialchars($textoAtual) . '">';
    echo ' <button type="submit">Atualizar texto</button>';
    echo '</form>';
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demonstração de Criptografia em PHP</title>
</head>
<body>

<?php if ($secao === 'menu'): ?>

    <h1>Demonstração de Criptografia em PHP</h1>
    <p>Texto atual usado nos testes: <b><?= htmlspecialchars($textoOriginal) ?></b></p>

    <form method="post" action="">
        <input type="hidden" name="secao" value="menu">
        Alterar texto: <input type="text" name="texto" size="50" value="<?= htmlspecialchars($textoOriginal) ?>">
        <button type="submit">Atualizar texto</button>
    </form>

    <p>Escolha uma técnica para ver a demonstração:</p>

    <form method="post" action="">
        <input type="hidden" name="texto" value="<?= htmlspecialchars($textoOriginal) ?>">
        <p>
            <button type="submit" name="secao" value="hashing">1. Hashing (irreversível)</button>
        </p>
        <p>
            <button type="submit" name="secao" value="senha">2. Hash de senhas (password_hash)</button>
        </p>
        <p>
            <button type="submit" name="secao" value="hmac">3. HMAC (hash com chave)</button>
        </p>
        <p>
            <button type="submit" name="secao" value="aes">4. Criptografia simétrica (AES-256-CBC)</button>
        </p>
        <p>
            <button type="submit" name="secao" value="rsa">5. Criptografia assimétrica (RSA)</button>
        </p>
        <p>
            <button type="submit" name="secao" value="base64">6. Base64 (não é criptografia!)</button>
        </p>
        <p>
            <button type="submit" name="secao" value="resumo">Resumo: quando usar cada técnica</button>
        </p>
    </form>

<?php elseif ($secao === 'hashing'): ?>

    <?php imprimirCabecalho("1. Hashing (irreversível)"); ?>
    <?php imprimirBotaoVoltar(); ?>
    <?php imprimirCampoTexto($textoOriginal); ?>

    <?php
    $hashMD5    = md5($textoOriginal);
    $hashSHA1   = sha1($textoOriginal);
    $hashSHA256 = hash('sha256', $textoOriginal);
    $hashSHA512 = hash('sha512', $textoOriginal);
    ?>

    <p>Texto original: <b><?= htmlspecialchars($textoOriginal) ?></b></p>

    <table border="1" cellpadding="6">
        <tr><th>Algoritmo</th><th>Resultado</th></tr>
        <tr><td>MD5 (obsoleto para segurança, ainda usado para checksums)</td><td><?= $hashMD5 ?></td></tr>
        <tr><td>SHA-1 (obsoleto para segurança)</td><td><?= $hashSHA1 ?></td></tr>
        <tr><td>SHA-256</td><td><?= $hashSHA256 ?></td></tr>
        <tr><td>SHA-512</td><td><?= $hashSHA512 ?></td></tr>
    </table>

<?php elseif ($secao === 'senha'): ?>

    <?php imprimirCabecalho("2. Hash de senhas (password_hash / password_verify)"); ?>
    <?php imprimirBotaoVoltar(); ?>
    <?php imprimirCampoTexto($textoOriginal); ?>

    <?php
    $senha = $textoOriginal;
    $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
    $senhaValida = password_verify($senha, $senhaHash);

    $senhaHashArgon2 = null;
    if (defined('PASSWORD_ARGON2ID')) {
        $senhaHashArgon2 = password_hash($senha, PASSWORD_ARGON2ID);
    }
    ?>

    <table border="1" cellpadding="6">
        <tr><th>Item</th><th>Valor</th></tr>
        <tr><td>Senha original</td><td><?= htmlspecialchars($senha) ?></td></tr>
        <tr><td>Hash Bcrypt gerado</td><td><?= $senhaHash ?></td></tr>
        <tr>
            <td>Verificação (password_verify)</td>
            <td><?= $senhaValida ? '&#10004; Senha confere' : '&#10008; Senha não confere' ?></td>
        </tr>
        <?php if ($senhaHashArgon2): ?>
        <tr><td>Hash Argon2id (alternativa mais moderna)</td><td><?= $senhaHashArgon2 ?></td></tr>
        <?php endif; ?>
    </table>

<?php elseif ($secao === 'hmac'): ?>

    <?php imprimirCabecalho("3. HMAC (hash com chave)"); ?>
    <?php imprimirBotaoVoltar(); ?>
    <?php imprimirCampoTexto($textoOriginal); ?>

    <?php
    $chaveHMAC = "chave-secreta-compartilhada";
    $hmacSHA256 = hash_hmac('sha256', $textoOriginal, $chaveHMAC);
    ?>

    <table border="1" cellpadding="6">
        <tr><th>Item</th><th>Valor</th></tr>
        <tr><td>Texto original</td><td><?= htmlspecialchars($textoOriginal) ?></td></tr>
        <tr><td>Chave secreta</td><td><?= htmlspecialchars($chaveHMAC) ?></td></tr>
        <tr><td>HMAC-SHA256</td><td><?= $hmacSHA256 ?></td></tr>
    </table>

<?php elseif ($secao === 'aes'): ?>

    <?php imprimirCabecalho("4. Criptografia simétrica (reversível), AES-256-CBC via OpenSSL"); ?>
    <?php imprimirBotaoVoltar(); ?>
    <?php imprimirCampoTexto($textoOriginal); ?>

    <?php
    $chaveAES = substr(hash('sha256', 'segredo-do-sistema', true), 0, 32);
    $resultadoAES = encriptarAES($textoOriginal, $chaveAES);
    $textoDescriptografado = decriptarAES($resultadoAES['cifrado'], $resultadoAES['iv'], $chaveAES);
    $conferido = ($textoDescriptografado === $textoOriginal);
    ?>

    <table border="1" cellpadding="6">
        <tr><th>Item</th><th>Valor</th></tr>
        <tr><td>Texto cifrado (Base64)</td><td><?= $resultadoAES['cifrado'] ?></td></tr>
        <tr><td>IV (vetor de inicialização, Base64)</td><td><?= $resultadoAES['iv'] ?></td></tr>
        <tr><td>Texto decifrado</td><td><?= htmlspecialchars($textoDescriptografado) ?></td></tr>
        <tr>
            <td>Conferência com o original</td>
            <td><?= $conferido ? '&#10004; Confere' : '&#10008; Divergente' ?></td>
        </tr>
    </table>

<?php elseif ($secao === 'rsa'): ?>

    <?php imprimirCabecalho("5. Criptografia assimétrica: RSA via OpenSSL"); ?>
    <?php imprimirBotaoVoltar(); ?>
    <?php imprimirCampoTexto($textoOriginal); ?>

    <?php
    $rsaDisponivel = extension_loaded('openssl');
    $rsaCifrado = null;
    $rsaDecifrado = null;
    $rsaAssinatura = null;
    $rsaAssinaturaValida = null;
    $rsaErro = null;

    // Par de chaves RSA FIXO, gerado previamente e embutido no código.
    // Isso evita usar openssl_pkey_new(), que no XAMPP costuma falhar
    // por depender de um arquivo openssl.cnf configurado no php.ini

    $chavePrivadaPem = <<<PEM
-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCb2lCCciKW2l2p
5/czdLHdd4sBkyDTui7FjYrA2a36nJseeKm8pmkOyeS+H25QFNycwgKMhm3nxzm2
s+xnUS01CuNB99Hp5LMC+MjbujSTqkhsanzIorrIFyvrSDqtaZ4prBKeTDKZHjWx
omqCXM+aumJf7ox9To8p2xAuNYiG8W5hDzT41DjASV6O9O0ApB5E6IBGcvNkw2M1
CEYl1cIwMxbAHDdYXNmQkCTMEqDSPkk6pIxPacMjJcpwaL1xjCewryiGnkAUNdsU
tKqNBQBPKwkS9TjN/AB+jKzwQtMNxFdAqw9Z+vkQSaxiy4uxKvmVavKcqhAB1EnB
Zkaa4PHtAgMBAAECggEAGWRcyJv62bQTHYr/AgGptujym1uSthw34ZTZfekZSOL5
/OFw2h0Msc2f+H/bc62qcdnEG4wNXP1fAE7ZHc4ifOlctFNBfod1yO6qnu38AfD0
4sEIupGUt+PakndOpBE4pRZ1ZBgLCFpdKidJjhq78jwaqgGOHx5NAedAgB7VsxJi
pMUAZCo96egesFE19dbF7t8rKJjUa190A3/w8nvOqtOpheSsL0BJOYjThI4DcNYW
SvfW1OiqT3UEmd+yXgDucCBffeRwSJre60O1iE9cDj/OeJ2FMbzOTkWbEkF6XU9l
3LsYgQ8bKRTs7BMRJaXw1DLr8LbADH9M0szJ/aCTywKBgQDPZY6YYaD0JGSou4+e
RkIFVgfHK+RmneWSbRzFOQKcCMSjn6lb4u31T+aNBYJ1io8LMQuA81yH3IDmsRNR
lDrmEl4qmyHF7dNPsVQpi5yxqWol8wYa8ORsSibUrUWbJuSLUlTRhe1b7gC4fXJv
ZKaLUOh5l8sJqJcNgyYLgvNIuwKBgQDAYHXa0MAotbC9oZ/r3P+ZUbocC30JCapq
GzlzIQBvd+XXDlGBWRtNFBQae1Oqp32V7k90tvGFvcuSrSQY//eQl8N5B0mlAV/0
XMGxsAZSa8idM55Ge/Rq554w+ZMTRarqB4MnfcYvYYG3CKDmevriCu0Wz7+iZnEA
x/nwcoG5dwKBgQCSLMMfNZhK2yezIVctN9mqhyM+RvpZNSqsVIk1nGPxc+Ccbpjg
cYZEI0ec12hGzhzZx3yTK3NpMooLjnzOP8pvhDyojOR165THE3X9PjB3q69sBeik
rmpgxLavqVxo6TWl2KZ9coaEB7CsV4aDao5TnPftU4ZATXoBhREYhfhQpwKBgCQL
LqmzyP0Xpaix+pufiYg5ZsxQXrntxK8isK3gdgtshHS5qw24G0Riya14g+GKhh4s
S1jL2g6708OEiynf84t009v+QI8Y5diL9IKNP3H73deOT05XdSD+ioYUjLjkqbQ1
eh5RE2vXMg2QIU1tp0no0Ckg/X+4/90smqixW5rbAoGBAK+IfsHg/JA4Rrb1yaf5
p8vqWs8vCKeFqVoYACG5+tMpjEuCiqIz9AqxIpPSijNFBGmwy0eH0pkywhuHD1UC
6qHbdFrnzOX1SEB9W3JdgrgzTioNjZ3BPoyXVeIMdhl8aRmsEApzky0gy53hOEU3
yOuXVwDBATSWX1+Rs6IbrkMq
-----END PRIVATE KEY-----
PEM;

    $chavePublicaPem = <<<PEM
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAm9pQgnIiltpdqef3M3Sx
3XeLAZMg07ouxY2KwNmt+pybHnipvKZpDsnkvh9uUBTcnMICjIZt58c5trPsZ1Et
NQrjQffR6eSzAvjI27o0k6pIbGp8yKK6yBcr60g6rWmeKawSnkwymR41saJqglzP
mrpiX+6MfU6PKdsQLjWIhvFuYQ80+NQ4wElejvTtAKQeROiARnLzZMNjNQhGJdXC
MDMWwBw3WFzZkJAkzBKg0j5JOqSMT2nDIyXKcGi9cYwnsK8ohp5AFDXbFLSqjQUA
TysJEvU4zfwAfoys8ELTDcRXQKsPWfr5EEmsYsuLsSr5lWrynKoQAdRJwWZGmuDx
7QIDAQAB
-----END PUBLIC KEY-----
PEM;

    if ($rsaDisponivel) {
        $chavePrivada = openssl_pkey_get_private($chavePrivadaPem);
        $chavePublica = openssl_pkey_get_public($chavePublicaPem);

        if (!$chavePrivada || !$chavePublica) {
            $rsaErro = "Não foi possível carregar as chaves RSA fixas.";
        } else {
            openssl_public_encrypt($textoOriginal, $rsaCifradoBin, $chavePublica);
            $rsaCifrado = base64_encode($rsaCifradoBin);
            openssl_private_decrypt($rsaCifradoBin, $rsaDecifradoBin, $chavePrivada);
            $rsaDecifrado = $rsaDecifradoBin;

            openssl_sign($textoOriginal, $assinaturaBin, $chavePrivada, OPENSSL_ALGO_SHA256);
            $rsaAssinatura = base64_encode($assinaturaBin);
            $verifica = openssl_verify($textoOriginal, $assinaturaBin, $chavePublica, OPENSSL_ALGO_SHA256);
            $rsaAssinaturaValida = ($verifica === 1);
        }
    }
    ?>

    <?php if (!$rsaDisponivel): ?>
        <p><b>Aviso:</b> Extensão OpenSSL não disponível neste servidor.</p>
    <?php elseif ($rsaErro): ?>
        <p><b>Erro:</b> <?= htmlspecialchars($rsaErro) ?></p>
    <?php else: ?>
        <p><i>Observação: aqui é usado um par de chaves fixo (embutido no código) em vez de gerar
        um novo a cada vez, para que eu não precise configurar.</i></p>
        <table border="1" cellpadding="6">
            <tr><th>Item</th><th>Valor</th></tr>
            <tr><td>Cifrado com a chave pública (Base64)</td><td><?= $rsaCifrado ?></td></tr>
            <tr><td>Decifrado com a chave privada</td><td><?= htmlspecialchars($rsaDecifrado) ?></td></tr>
            <tr><td>Assinatura digital (Base64)</td><td><?= $rsaAssinatura ?></td></tr>
            <tr>
                <td>Verificação da assinatura</td>
                <td><?= $rsaAssinaturaValida ? '&#10004; Assinatura válida' : '&#10008; Assinatura inválida' ?></td>
            </tr>
        </table>
    <?php endif; ?>

<?php elseif ($secao === 'base64'): ?>

    <?php imprimirCabecalho("6. Base64 (NÃO é criptografia!)"); ?>
    <?php imprimirBotaoVoltar(); ?>
    <?php imprimirCampoTexto($textoOriginal); ?>

    <?php
    $base64Codificado = base64_encode($textoOriginal);
    $base64Decodificado = base64_decode($base64Codificado);
    ?>

    <p><b>Atenção:</b> Base64 é apenas codificação, não criptografia.
    Qualquer pessoa pode decodificar sem precisar de nenhuma chave secreta.</p>

    <table border="1" cellpadding="6">
        <tr><th>Item</th><th>Valor</th></tr>
        <tr><td>Codificado</td><td><?= $base64Codificado ?></td></tr>
        <tr><td>Decodificado</td><td><?= htmlspecialchars($base64Decodificado) ?></td></tr>
    </table>

<?php elseif ($secao === 'resumo'): ?>

    <?php imprimirCabecalho("Quando usar cada técnica"); ?>
    <?php imprimirBotaoVoltar(); ?>

    <ul>
        <li><b>Hash (SHA-256/512):</b> verificar integridade de arquivos/dados que não precisam ser recuperados.</li>
        <li><b>password_hash/verify:</b> sempre para armazenar senhas de usuários.</li>
        <li><b>HMAC:</b> verificar integridade + autenticidade quando ambas as partes compartilham uma chave secreta (ex: assinar tokens, webhooks).</li>
        <li><b>AES (openssl_encrypt/decrypt):</b> criptografar dados que precisam ser recuperados depois (ex: dados sensíveis salvos em banco).</li>
        <li><b>RSA:</b> troca de chaves, assinaturas digitais, cenários onde remetente e destinatário não compartilham uma chave secreta previamente.</li>
        <li><b>Base64:</b> apenas para representar dados binários como texto (ex: enviar imagens em JSON), nunca para esconder informação.</li>
    </ul>

<?php else: ?>

    <p>Seção desconhecida.</p>
    <?php imprimirBotaoVoltar(); ?>

<?php endif; ?>

</body>
</html>
