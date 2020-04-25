<?php
require_once dirname(__DIR__) . '/html/sess.php';
$_REQUEST['obj'] = '{"p":1}';

$args = [];
if($argc > 1) {
    $args = array_slice($argv, 1);
}
$tmB = $args ? array_shift($tm) : '07:37:00';
$tmE = $args ? array_shift($tm) : '07:38:00';

$api = new WialonApi();

$c = 919;
$b = new DateTime('2020-04-25 07:37:00', WialonApi::getTimezone());
$e = new DateTime('2020-04-25 07:38:00', WialonApi::getTimezone());

echo json_encode([
    'c' => $c,
    'b' => $b,
    'e' => $e,
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;
$lst = $api->getMessages($c, $b, $e);
echo "Count = " . count($lst) . "\n";
echo json_encode($lst, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;
echo "Err:\n";
echo json_encode(WialonApi::$m_err, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;
echo "Res:\n";
echo json_encode(WialonApi::$m_res, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL;