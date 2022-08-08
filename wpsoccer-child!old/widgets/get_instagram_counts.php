<?
  /* $resultInstagram = file_get_contents("https://api.instagram.com/v1/users/1387590779/?access_token=1387590779.15bf1a9.a553782b2a74459884a3f100b76f1f82");
   $fileInstagram = 'instagram_counts.txt';
   file_put_contents($fileInstagram, $resultInstagram);
   
	$fpInstagram = fopen("instagram_counts.txt", "a"); // Открываем файл в режиме записи 
	ftruncate($fpInstagram, 0);
	print_r($resultInstagram);
	$testInstagram = fwrite($fpInstagram, $resultInstagram); // Запись в файл
	if ($testInstagram) echo 'Данные в файл успешно занесены.';
	else echo 'Ошибка при записи в файл.';
	fclose($fpInstagram); //Закрытие файла*/

?>

<?php
  if( $curl = curl_init() ) {
    curl_setopt($curl, CURLOPT_URL, 'https://api.instagram.com/v1/users/1387590779/?access_token=1387590779.15bf1a9.a553782b2a74459884a3f100b76f1f82');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    $out = curl_exec($curl);
	
	$fpInstagram = fopen("instagram_counts.txt", "a"); 
	ftruncate($fpInstagram, 0);
	$testInstagram = fwrite($fpInstagram, $out); 
	if ($testInstagram) echo 'Данные в файл успешно занесены.';
	else echo 'Ошибка при записи в файл.';
	fclose($fpInstagram); 
	
	
    curl_close($curl); 

  }
?>