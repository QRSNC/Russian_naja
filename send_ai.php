<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', '0');
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
session_start();

/**
 * .env dosyasını manuel okur (parse_ini_file olmadan)
 */
function envVal(string $key, $default = null) {
    $path = __DIR__ . '/.env';
    if (!is_readable($path)) return $default;

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#') continue;
        [$k, $v] = explode('=', $line, 2) + [null, null];
        if (trim($k) === $key) return trim($v);
    }
    return $default;
}

// .env'den ayarları al
$apiKey = envVal('COHERE_KEY', '');
$rateLimit = (int) envVal('RATE_LIMIT', 6);
$userText = trim($_POST['message'] ?? '');

// API anahtarı yoksa
if ($apiKey === '') {
    echo json_encode(['text' => 'API key not configured.']);
    exit;
}

// Girdi kontrolü
if ($userText === '' || mb_strlen($userText) > 500) {
    echo json_encode(['text' => 'Invalid or empty message.']);
    exit;
}

// Rate limit kontrolü (dakikada belirli sayıda istek)
$now = time();
if (!isset($_SESSION['hits'])) $_SESSION['hits'] = [];
$_SESSION['hits'] = array_filter($_SESSION['hits'], function ($ts) use ($now) {
    return $ts > $now - 60;
});
if (count($_SESSION['hits']) >= $rateLimit) {
    echo json_encode(['text' => 'Rate limited. Try again later.']);
    exit;
}
$_SESSION['hits'][] = $now;

// Prompt
$prompt = <<<PROMPT
You are an AI assistant for a website that teaches Russian. Only respond in English. Speak briefly and helpfully. Never reply to questions about politics, religion, social issues, or your own identity.

User: {$userText}
PROMPT;

// API'ye gönderilecek JSON
$payload = json_encode([
    'model' => 'command-r-plus',
    'temperature' => 0.5,
    'chat_history' => [],
    'message' => $prompt
], JSON_UNESCAPED_UNICODE);

// Curl ile API'ye bağlan
$ch = curl_init('https://api.cohere.ai/v1/chat');
curl_setopt_array($ch, [
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer {$apiKey}",
        "Content-Type: application/json"
    ],
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $payload,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 15,
]);

$response = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

// Hatalı istek
if ($error || $code !== 200) {
    echo json_encode([
        'text' => "Server error ({$code}): {$error}"
    ]);
    exit;
}

// Yanıt
$data = json_decode($response, true);
echo json_encode([
    'text' => $data['text'] ?? 'Empty reply.'
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);