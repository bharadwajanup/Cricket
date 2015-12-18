<?php
$info = $_POST['overTableInfo'];
$fileName = $_POST['id']."_".$_POST['innings'].".txt";
file_put_contents($fileName,$info);
?>