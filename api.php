<?php
//phpinfo();
ini_set('display_errors', 1);
$host = 'localhost'; // адрес сервера
$database = 'api'; // имя базы данных
$user = 'api'; // имя пользователя
$password = 'H98r4v68e$&@dNn8gvo'; // пароль

$connection = new mysqli($host, $database, $password, $user);
$connection->query("SET NAMES 'utf8'");

        if (isset($_GET["mac"]) && isset($_GET["ip"]) && isset($_GET["dynamic"])){

          $mac = htmlspecialchars($_GET["mac"]);
          $ip = htmlspecialchars($_GET["ip"]);
          $dynamic = htmlspecialchars($_GET["dynamic"]);

          if (isset($_GET["hostname"])){
                $hostname = trim(htmlspecialchars($_GET["hostname"]));
          }else{
                $hostname="null";
        }

          $query = sprintf("SELECT id FROM host WHERE mac='%s'",$mac);
          $result = $connection->query($query);
          $row = mysqli_fetch_array($result);
          if (isset($row['id'])){
           $query = sprintf("UPDATE `host` SET `ip` = '%s', `hostname` = '%s', `update_date` = '%s', `dynamic` = '%s' WHERE `host`.`id` = '%s'",$ip,$hostname,date('Y-m-d H:i:s'),$dynamic,$row['id']);
           $result = $connection->query($query);
           #echo $query;
          }else{
           #echo "нет данных";
           $query = sprintf("INSERT INTO `host` (`id`, `mac`, `hostname`, `ip`, `dynamic`, `update_date`) VALUES (NULL, '%s', '%s', '%s', '%s', '%s');",$mac,$hostname,$ip,$dynamic,date('Y-m-d H:i:s'));
           $result = $connection->query($query);
           #echo $query;
          }
        }

?>