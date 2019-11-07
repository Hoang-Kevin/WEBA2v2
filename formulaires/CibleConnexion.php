<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Communication avec API</title>
</head>
<body>
<p>
	Vous êtes connecté avec l'id <?php echo $_POST['identifiant'];?> et avec le mot de passe <?php echo $_POST['mot_de_passe'];?>
</p>
<?php

$login["data"]=json_encode($_POST,FORCE_JSON_OBJECT);
$url = 'htpp://localhost:3000/users';

$open_co=curl_init();

curl_setopt($open_co,CURLOPT_URL,$url); 
curl_setopt($open_co,CURLOPT_POST,true);
curl_setopt($open_co,CURLOPT_POSTFIELDS,$login);

$return = curl_exec($open_co);

curl_close($open_co);

$result = json_decode($return);
?>
<body>
</html>