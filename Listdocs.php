<html>
<head></head>
<h1>header</h1>
<?php
require_once('finddoc.php');

if(!empty($_GET["quer"])) $tes=$_GET["quer"];

docsym($tes);
?>
<?php //echo "Doctor : ".$tes;?>
</html>
