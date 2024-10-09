<?php
// github-webhook-handler.php

// Настройка для директории вашего сайта
$repoDir = '/var/www/html/mtsite';
$branch = 'main'; // или 'master', если это ваша ветка
$logFile = '/var/www/html/mtsite/deploy.log';

// Получение входящих данных из GitHub
$payload = file_get_contents('php://input');
if (empty($payload)) {
	http_response_code(400);
	exit('Missing payload');
}

// Проверка подписи (если вы настроили секретный ключ в вебхуке)
$secret = '3I3HZzf8A2zwnF';
$signature = 'sha256=' . hash_hmac('sha256', $payload, $secret);
if (!hash_equals($signature, $_SERVER['HTTP_X_HUB_SIGNATURE_256'])) {
	http_response_code(403);
	exit('Invalid signature');
}

// Запись лога о поступившем запросе
file_put_contents($logFile, date('Y-m-d H:i:s') . " Received payload: $payload\n", FILE_APPEND);

// Декодирование JSON payload
$data = json_decode($payload, true);

// Проверка события push на основной ветке
if ($data['ref'] === 'refs/heads/' . $branch) {
	// Выполнение команд для обновления сайта
	$commands = [
		"cd $repoDir",
		'git pull origin ' . $branch,
		'composer install', // если используется Composer
		'npm install', // если используется npm
		'npm run build', // если требуется сборка фронтенда
	];

	foreach ($commands as $command) {
		$output = [];
		$returnVar = 0;
		exec($command . ' 2>&1', $output, $returnVar);
		file_put_contents($logFile, date('Y-m-d H:i:s') . " Executed: $command\nOutput: " . implode("\n", $output) . "\n", FILE_APPEND);
	}
}

http_response_code(200);
echo 'Deployment completed successfully.';
?>
