<?php
spl_autoload_register(function ($class) {
    $str = str_replace('kuaikuaicloud\\oss', 'kuaikuaicloud\\oss\\src', $class) . '.php';
    $str = str_replace('\\', '/', $str);
    return include_once realpath('./../') . '/' . $str;
//    return include_once  '../' . $str;
});

$client = new \kuaikuaicloud\oss\Client(['version' => 'v1', 'api_url' => 'http://www.kkcloud.com/api.php/oss', 'access_key' => '访问密钥', 'secret_key' => '安全密钥']);

var_dump($result = $client->GetBucketListsRequest());

var_dump($result->isOk());

var_dump($result->getData());

