<?php
// Challenge: make this terrible code safe
echo "<!doctype html>\n";

try {
        $_GET['username'] = 'root';      // temporarily used to set $_GET var
        $_GET['password'] = 'secret';   // temporarily used to set $_GET var
        $username = @$_GET['username'] ? $_GET['username'] : '';
        $password = @$_GET['password'] ? $_GET['password'] : '';
} catch(Exception $error) {
        echo "Please be sure to provide username and/or password";
           // go back to login page
        exit;
}

$pdo = new PDO('sqlite::memory:');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->exec("DROP TABLE IF EXISTS users");
$pdo->exec("CREATE TABLE users (username VARCHAR(255), password VARCHAR(255))");
$passHash = password_hash("secret", PASSWORD_DEFAULT);
$pdo->exec("INSERT INTO users (username, password) VALUES ('root', '$passHash');");

$st = $pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
$st->bindParam(":username", $username, PDO::PARAM_STR);
$st->execute();
$user = $st->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    echo "Access granted to $username!<br>\n";
} else {
    echo "Access denied for $username!<br>\n";
}
?>
