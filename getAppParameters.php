<?php
use Aws\Ssm\SsmClient;

// Include Composer's autoloader to load the AWS SDK for PHP
require 'vendor/autoload.php';

// Get the application environment parameters from the Parameter Store.
$az = 'us-east-1b';
$region = substr($az, 0, -1);

$ssm_client = new SsmClient([
    'version' => 'latest',
    'region'  => $region
]);

$result = $ssm_client->getParametersByPath(['Path' => '/cafe']);

$showServerInfo = "";
$timeZone = "";
$currency = "";
$db_url = "";
$db_name = "";
$db_user = "";
$db_password = "";

foreach ($result['Parameters'] as $p) {
    if ($p['Name'] == '/cafe/showServerInfo') $showServerInfo = $p['Value'];
    if ($p['Name'] == '/cafe/timeZone') $timeZone = $p['Value'];
    if ($p['Name'] == '/cafe/currency') $currency = $p['Value'];
    if ($p['Name'] == '/cafe/dbUrl') $db_url = $p['Value'];
    if ($p['Name'] == '/cafe/dbName') $db_name = $p['Value'];
    if ($p['Name'] == '/cafe/dbUser') $db_user = $p['Value'];
    if ($p['Name'] == '/cafe/dbPassword') $db_password = $p['Value'];
}
?>

