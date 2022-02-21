# DHCP

Для автоопроса принтеров добавить в крон:

cronetab -e

00 08,09,10,11,12,13,14,15,16,17,18,19,20 * * * php /var/www/html/printersupdate.php

Настройка MikroTik в файле MikroTik.src
