<?php
require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$token = '1056332862:AAHXUgnVY9CBi06PnKFRHABvD6jDC6PBX3I';
$data = file_get_contents('php://input');
$data = json_decode($data, true);
ob_start();
print_r($data);
$out = ob_get_clean(); 
file_put_contents(__DIR__ . '/message.txt', $out);
if (!empty($data['message']['text'])) {
	$text = $data['message']['text'];
	echo $text;
}
// Ответ на текстовые сообщения.
if (!empty($data['message']['text'])) {
	$text = $data['message']['text'];
 
	if (mb_stripos($text, 'привет') !== false) {
		sendTelegram(
			'sendMessage', 
			array(
				'chat_id' => $data['message']['chat']['id'],
				'text' => 'Хай!'
			)
		);
 
		exit();	
	} 
}
// Для слака отправляем уведомление с данными
// подтяните из вашего конфига
$hookUrl = 'https://hooks.slack.com/services/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';
$client = new Maknz\Slack\Client($hookUrl);
$client->send("Страничка: https://vk.com/id".$chat_id."\n\nИмя: ".$user_id."\n\nСообщение: ".$message."\n\n");  


?>
