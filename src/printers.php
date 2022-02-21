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
	$query = sprintf("SELECT host.ip, ModelPrinters.snmp, ModelPrinters.trim FROM host, ModelPrinters WHERE host.hostname = '%s' and host.hostname LIKE ModelPrinters.search", $hostname);
	#echo $query;
	$result = $connection->query($query);
	$row = mysqli_fetch_array($result);
	$snmpwalk = "snmpwalk -c public -v2c ".$row['ip']." ".$row['snmp'];
	set_time_limit(500);
	$resultSNMP=exec($snmpwalk);
	$resultSNMP = trim(substr($resultSNMP, $row['trim']));
	if (strlen($resultSNMP)!=0){
		$query = sprintf("INSERT INTO `StatsPrinters` (`id`, `counts`, `hostname`, `update_date`) VALUES (NULL, '%s', '%s', '%s');",$resultSNMP,$hostname,date('Y-m-d H:i:s'));
		$result = $connection->query($query);
	}
}


$printers = $connection->query("SELECT host.mac, host.ip, host.hostname, host.dynamic AS DYN, ModelPrinters.model, ModelPrinters.snmp, ModelPrinters.trim FROM host, ModelPrinters WHERE host.hostname LIKE ModelPrinters.search ORDER BY INET_ATON(ip)");
echo('<table border="1">');
echo '<tr><td colspan="9"><p>Записей за выборку: '.$printers->num_rows.'</p></td></tr>';
echo '<tr><td>Модель</td><td>IP</td><td>Динамический</td><td>mac</td><td>hostname</td><td>Пробег</td><td>Обновить</tr></tr>';
while(($row = $printers->fetch_assoc()) != FALSE){

	$query = sprintf("SELECT counts, update_date FROM StatsPrinters WHERE hostname='%s' ORDER BY update_date DESC LIMIT 1;",$row['hostname']);
        $result = $connection->query($query);
        $row2 = mysqli_fetch_array($result);
        if (isset($row2['counts'])){$count = $row2['counts'];}else{ $count = "0";}

	printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a href="statsprinters.php?hostname=%s">%s</a></td><td><a href="printers.php?hostname=%s">Обновить запись</a></td></tr>',$row['model'],$row['ip'],$row['DYN'],$row['mac'],$row['hostname'],$row['hostname'],$count,$row['hostname']);
}
echo ('</table>');

?>
