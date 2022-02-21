<?php
//phpinfo();
ini_set('display_errors', 1);
$host = 'localhost'; // адрес сервера
$database = 'api'; // имя базы данных
$user = 'api'; // имя пользователя
$password = 'H98r4v68e$&@dNn8gvo'; // пароль

$connection = new mysqli($host, $database, $password, $user);
$connection->query("SET NAMES 'utf8'");


if (isset($_GET['hostname'])){
	$hostname = htmlspecialchars($_GET['hostname']);
	$query = sprintf("SELECT counts, update_date FROM StatsPrinters WHERE StatsPrinters.hostname = '%s' ORDER BY update_date DESC", $hostname);
	#echo $query;
	$result = $connection->query($query);
	echo('<table border="1">');
	echo '<tr><td colspan="2"><p>Статистика: '.$hostname.'</p></td></tr>';
	while(($row = $result->fetch_assoc()) != FALSE){
		 printf('<tr><td>%s</td><td>%s</td></tr>',$row['counts'],$row['update_date']);
	}
	echo ('</table>');
}
?>
