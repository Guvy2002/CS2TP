<?php
#start session to remove it
session_start();
session_destroy();
header("Location: index.php"); # head back to main page
