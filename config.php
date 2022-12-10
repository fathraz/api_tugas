<?php
    define('DB_NAME', 'db_tugas');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_HOST', 'localhost');

    $kon = mysqli_connect("localhost", "root", "", "db_tugas") or die(mysqli_error());
?>
