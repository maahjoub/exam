<?php
$host = "localhost";
$dbName = "exam";
$user = "root";
$password = '';

try {
    global $coon;
    $coon = new PDO('mysql:host=localhost;dbname=exam', $user, $password);
    $coon->exec(
        'set charset utf8'
    );
    return $coon;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
