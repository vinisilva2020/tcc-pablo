<?php


$senha = 000;

$hash = password_hash($senha,PASSWORD_DEFAULT);

echo $hash;

?>