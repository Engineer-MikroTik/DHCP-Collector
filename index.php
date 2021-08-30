<?php
//phpinfo();
ini_set('display_errors', 1);
$host = 'localhost'; // адрес сервера
$database = 'api'; // имя базы данных
$user = 'api'; // имя пользователя
$password = 'H98r4v68e$&@dNn8gvo'; // пароль

$connection = new mysqli($host, $database, $password, $user);
$connection->query("SET NAMES 'utf8'");

$photo = $connection->query("SELECT id, mac, ip, hostname, update_date, dynamic FROM host ORDER BY INET_ATON(ip)");

echo('<table border="1">');
echo '<tr><td colspan="5"><p>Записи за всё время:</p></td></tr>';
echo '<tr><td>IP</td><td>mac</td><td>hostname</td><td>Дата обновления</td><td>Динамический</td></tr>';
while(($row = $photo->fetch_assoc()) != FALSE){
        printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>',$row['ip'],$row['mac'],$row['hostname'],$row['update_date'],$row['dynamic']);
}
echo ('</table>');
?>