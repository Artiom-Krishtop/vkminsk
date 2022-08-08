<?
/*
   $resultFacebook = file_get_contents("https://graph.facebook.com/v2.10/belarusbasket?fields=fan_count&access_token=546789935531351|c822aeecda14e41cccaa2c2fa2261309");
   $file = 'facebook_counts.txt';
   file_put_contents($file, $resultFacebook);
   
	$fp = fopen("facebook_counts.txt", "a"); // Открываем файл в режиме записи 
	ftruncate($fp, 0);
	$test = fwrite($fp, $resultFacebook); // Запись в файл
	if ($test) echo 'Данные в файл успешно занесены.';
	else echo 'Ошибка при записи в файл.';
	fclose($fp); //Закрытие файла*/
	
?>

<?php
  if( $curl = curl_init() ) {
    curl_setopt($curl, CURLOPT_URL, 'https://graph.facebook.com/v3.1/vcminsk?fields=fan_count&access_token=705876929793321|92160595dbf1242a6a8c32804034c2b4');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    $out = curl_exec($curl);
	
	$fpFacebook = fopen("facebook_counts.txt", "a"); 
	ftruncate($fpFacebook, 0);
	$testFacebook = fwrite($fpFacebook, $out); 
	if ($testFacebook) echo 'Данные в файл успешно занесены.';
	else echo 'Ошибка при записи в файл.';
	fclose($fpFacebook); 
	
	
    curl_close($curl); 

  }
?>