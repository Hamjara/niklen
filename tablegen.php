<?php
include_once 'settings.php';
$table_name = $_POST['table_name'];
$link = mysqli_connect(HOST, USER, PASS, DB);
mysqli_query($link, "SET NAMES utf8");
mysqli_query($link, "SET CHARACTER SET utf8");

  $data = array(); // в этот массив запишем то, что выберем из базы
  $ta = mysqli_query($link, "select * from {$table_name}"); // сделаем запрос в БД
  while($row = mysqli_fetch_assoc($ta)){ // оформим каждую строку результата
                                               // как ассоциативный массив
      $data[] = $row; // допишем строку из выборки как новый элемент результирующего массива
      }
  echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>