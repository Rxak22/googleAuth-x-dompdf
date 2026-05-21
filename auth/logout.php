<?php
session_start();
session_destroy();
header('Location: singin.php');
exit();