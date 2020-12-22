<?php

require_once('epinoyClass.php');
require_once('shim/ereg.php');

$epinoy = new epinoyLoad('USERNAME', 'PASSWORD');

$session = $epinoy->getSession();

$balance = $epinoy->getBalance($session);

var_dump($session, $balance);
