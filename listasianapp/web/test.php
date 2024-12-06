<?php
echo 'Current timezone: ' . date_default_timezone_get();
echo 'Current time: ' . date('Y-m-d H:i:s');

print_r(DateTimeZone::listIdentifiers());

?>
