<?php 
function addLog($log){
	$file = './logFile.txt';
	$log .= ' - '. date("F j, Y, G:i a") . ' || '; //Добавим актуальную дату после текста или дампа массива
	$fOpen = fopen($file,'a');
	fwrite($fOpen, $log);
	fwrite($fOpen, "\n");
	fclose($fOpen);
}
?>