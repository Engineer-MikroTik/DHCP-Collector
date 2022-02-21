# DHCP

Для автоопроса принтеров добавить в крон:

cronetab -e

00 08,09,10,11,12,13,14,15,16,17,18,19,20 * * * php /var/www/html/printersupdate.php

# На MikroTik в DHCP Server на нужных сетях добавить:

/*

:if ($leaseBound = 1) do={
 /ip dhcp-server lease;
  :foreach i in=[find dynamic=yes] do={
  :local dhcpip
  :set dhcpip [ get $i address ];
  :local clientid
  :set clientid [get $i host-name];

  :if ($leaseActIP = $dhcpip) do={
   :local string "http://10.1.0.44/api.php\?mac=$leaseActMAC&ip=$dhcpip&hostname=$clientid&dhcpname=$leaseServerName&dynamic=1"
    /tool fetch url=$string keep-result=no
    }
 }
}

:if ($leaseBound = 1) do={
 /ip dhcp-server lease;
  :foreach i in=[find dynamic=no] do={
  :local dhcpip
  :set dhcpip [ get $i address ];
  :local clientid
  :set clientid [get $i host-name];

  :if ($leaseActIP = $dhcpip) do={
   :local string "http://10.1.0.44/api.php\?mac=$leaseActMAC&ip=$dhcpip&hostname=$clientid&dhcpname=$leaseServerName&dynamic=0"
    /tool fetch url=$string keep-result=no
    }
 }
}

*/
