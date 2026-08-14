<?php
/**
 * Demonstração interativa dos tipos de criptografia disponíveis no PHP
 * Somente PHP e HTML puro (sem CSS) - navegação por botões
 */

session_start();

$textoOriginal = "Mensagem secreta - PHP Crypto Demo";

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

// -----------------------------------------------------------------
// Cabeçalho comum a todas as páginas
// -----------------------------------------------------------------
function imprimirCabecalho(string $titulo)
{
    echo "<h1>" . htmlspecialchars($titulo) . "</h1>";
}

// Botão de "Voltar ao menu" reutilizável
function imprimirBotaoVoltar()
{
    echo '<form method="post" action="">';
    echo '<input type="hidden" name="secao" value="menu">';
    echo '<button type="submit">&#8592; Voltar ao menu</button>';
    echo '</form>';
    echo '<hr>';
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
    <p>Texto original usado nos testes: <b><?= htmlspecialchars($textoOriginal) ?></b></p>
    <p>Escolha uma técnica para ver a demonstração:</p>

    <form method="post" action="">
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
            <button type="submit" name="secao" value="resumo">Resumo - quando usar cada técnica</button>
        </p>
    </form>

<?php elseif ($secao === 'hashing'): ?>

    <?php imprimirCabecalho("1. Hashing (irreversível)"); ?>
    <?php imprimirBotaoVoltar(); ?>

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

    <?php
    $senha = "MinhaSenh@123";
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

    <?php imprimirCabecalho("3. HMAC (hash com chave — integridade + autenticidade)"); ?>
    <?php imprimirBotaoVoltar(); ?>

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

    <?php imprimirCabecalho("4. Criptografia simétrica (reversível) — AES-256-CBC via OpenSSL"); ?>
    <?php imprimirBotaoVoltar(); ?>

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

    <?php imprimirCabecalho("5. Criptografia assimétrica — RSA via OpenSSL"); ?>
    <?php imprimirBotaoVoltar(); ?>

    <?php
    $rsaDisponivel = extension_loaded('openssl');
    $rsaCifrado = null;
    $rsaDecifrado = null;
    $rsaAssinatura = null;
    $rsaAssinaturaValida = null;

    if ($rsaDisponivel) {
        $config = [
            "digest_alg" => "sha256",
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        ];

        $par = openssl_pkey_new($config);
        if ($par !== false) {
            openssl_pkey_export($par, $chavePrivada);
            $detalhes = openssl_pkey_get_details($par);
            $chavePublica = $detalhes['key'];

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
    <?php else: ?>
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

    <?php imprimirCabecalho("6. Base64 — NÃO é criptografia!"); ?>
    <?php imprimirBotaoVoltar(); ?>

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

    <?php imprimirCabecalho("Resumo — quando usar cada técnica"); ?>
    <?php imprimirBotaoVoltar(); ?>

    <ul>
        <li><b>Hash (SHA-256/512):</b> verificar integridade de arquivos/dados que não precisam ser recuperados.</li>
        <li><b>password_hash/verify:</b> sempre para armazenar senhas de usuários.</li>
        <li><b>HMAC:</b> verificar integridade + autenticidade quando ambas as partes compartilham uma chave secreta (ex: assinar tokens, webhooks).</li>
        <li><b>AES (openssl_encrypt/decrypt):</b> criptografar dados que precisam ser recuperados depois (ex: dados sensíveis salvos em banco).</li>
        <li><b>RSA:</b> troca de chaves, assinaturas digitais, cenários onde remetente e destinatário não compartilham uma chave secreta previamente.</li>
        <li><b>Base64:</b> apenas para representar dados binários como texto (ex: enviar imagens em JSON) — nunca para esconder informação.</li>
    </ul>

<?php else: ?>

    <p>Seção desconhecida.</p>
    <?php imprimirBotaoVoltar(); ?>

<?php endif; ?>

</body>
</html>