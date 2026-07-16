<?php
include("includes/connection.php");

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? (string) $_POST['password'] : '';

// Campos obrigatorios
if ($username === '') {
    $_SESSION['msg'] = "1";
    header("Location:index.php");
    exit;
}
if ($password === '') {
    $_SESSION['msg'] = "2";
    header("Location:index.php");
    exit;
}

// Busca o admin pelo usuario usando prepared statement (evita SQL injection)
$row = null;
if ($stmt = mysqli_prepare($mysqli, "SELECT id, username, password FROM tbl_admin WHERE username = ? LIMIT 1")) {
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = $result ? mysqli_fetch_assoc($result) : null;
    mysqli_stmt_close($stmt);
}

$authenticated = false;

if ($row) {
    $stored = (string) $row['password'];
    $info = password_get_info($stored);
    $isHashed = !empty($info['algo']);

    if ($isHashed) {
        // Senha ja armazenada como hash
        $authenticated = password_verify($password, $stored);

        // Reforca o hash caso o algoritmo/custo padrao tenha mudado
        if ($authenticated && password_needs_rehash($stored, PASSWORD_DEFAULT)) {
            upgrade_admin_password($mysqli, (int) $row['id'], $password);
        }
    } else {
        // Senha legada em texto puro: compara e migra para hash
        if (hash_equals($stored, $password)) {
            $authenticated = true;
            upgrade_admin_password($mysqli, (int) $row['id'], $password);
        }
    }
}

if ($authenticated) {
    // Evita fixacao de sessao
    session_regenerate_id(true);
    $_SESSION['id'] = $row['id'];
    $_SESSION['admin_name'] = $row['username'];
    header("Location:home.php");
    exit;
}

$_SESSION['msg'] = "4";
header("Location:index.php");
exit;

// Atualiza a senha do admin para um hash seguro
function upgrade_admin_password($mysqli, $id, $plainPassword)
{
    $newHash = password_hash($plainPassword, PASSWORD_DEFAULT);
    if ($upd = mysqli_prepare($mysqli, "UPDATE tbl_admin SET password = ? WHERE id = ?")) {
        mysqli_stmt_bind_param($upd, "si", $newHash, $id);
        mysqli_stmt_execute($upd);
        mysqli_stmt_close($upd);
    }
}
?>
