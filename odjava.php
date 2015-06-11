<?php
session_start();
session_destroy();
include('header.html');
print '<div id="tijelo">';
include 'admin1.php';
print '</div>';
include('footer.html');	
?>
