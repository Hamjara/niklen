<?php
include_once 'settings.php';
session_start();
//Подключаю базу данных
$link = mysqli_connect(HOST, USER, PASS, DB);
mysqli_query($link, "SET NAMES utf8");
mysqli_query($link, "SET CHARACTER SET utf8");

//Обрабатываю URL
if ($_SERVER['REQUEST_URI'] == '/'){
$Page = 'index';
$Module = 'index';
} else {
$URL_Path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$URL_Parts = explode('/', trim($URL_Path, ' /'));
$Page = array_shift($URL_Parts);
$Module = array_shift($URL_Parts);

if (!empty($Module)) {
$Param = array();
for ($i = 0; $i < count($URL_Parts); $i++) {
$Param[$URL_Parts[$i]] = $URL_Parts[++$i];
}
}
}
echo $Module;
//Загружаю нужную страницу
if ($Module == 'index') {
    include_once('index.html');
}
else if ($Module == 'catalog') {
   include_once('catalog.html');
}    

?>﻿