<?php
//phpinfo();
ini_set('display_errors', 1);
$host = 'localhost'; // адрес сервера
$database = 'api'; // имя базы данных
$user = 'api'; // имя пользователя
$password = 'H98r4v68e$&@dNn8gvo'; // пароль

$connection = new mysqli($host, $database, $password, $user);
$connection->query("SET NAMES 'utf8'");

$printers = $connection->query("SELECT host.mac, host.ip, host.hostname, host.dynamic AS DYN, ModelPrinters.model, ModelPrinters.snmp, ModelPrinters.trim FROM host, ModelPrinters WHERE host.hostname LIKE ModelPrinters.search ORDER BY INET_ATON(ip)");
while(($row = $printers->fetch_assoc()) != FALSE){
	$snmpwalk = "snmpwalk -c public -v2c ".$row['ip']." ".$row['snmp'];
	set_time_limit(500);
        $resultSNMP=exec($snmpwalk);
        $resultSNMP = trim(substr($resultSNMP, $row['trim']));
	if (strlen($resultSNMP)!=0){
                $query = sprintf("INSERT INTO `StatsPrinters` (`id`, `counts`, `hostname`, `update_date`) VALUES (NULL, '%s', '%s', '%s');",$resultSNMP,$row['hostname'],date('Y-m-d H:i:s'));
                $result = $connection->query($query);
        }
}
?>
