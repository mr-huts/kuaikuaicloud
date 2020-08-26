<?php

require_once './vendor/autoload.php';

$client = new \kuaikuaicloud\oss\Client(['version' => 'v1', 'api_url' => 'http://www.kkcloud.com/api.php/oss', 'access_key' => '访问密钥', 'secret_key' => '安全密钥']);

var_dump($result = $client->GetObjectListsRequest(['id' => 4]));

var_dump($result->isOk());

var_dump($result->getData());

var_dump($result->getMessage());