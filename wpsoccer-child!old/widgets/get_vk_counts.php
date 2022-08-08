<?php
  if( $curl = curl_init() ) {
    curl_setopt($curl, CURLOPT_URL, 'https://api.vk.com/method/groups.getMembers?group_id=100323596&version=5.84&access_token=63b15da263b15da263b15da21863d7c42c663b163b15da2387611bfc441556aae1811cf');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    $out = curl_exec($curl);
	
	$fpFacebook = fopen("vk_counts.txt", "a"); 
	ftruncate($fpFacebook, 0);
	$testFacebook = fwrite($fpFacebook, $out); 
	if ($testFacebook) echo 'Данные в файл успешно занесены.';
	else echo 'Ошибка при записи в файл.';
	fclose($fpFacebook); 
	
	
    curl_close($curl); 

  }
?>