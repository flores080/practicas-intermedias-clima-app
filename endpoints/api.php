<?php
header('Content-Type: application/json');
// Copyright 2019 Oath Inc. Licensed under the terms of the zLib license see https://opensource.org/licenses/Zlib for terms.

function buildBaseString($baseURI, $method, $params) {
    $r = array();
    ksort($params);
    foreach($params as $key => $value) {
        $r[] = "$key=" . rawurlencode($value);
    }
    return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
}

function buildAuthorizationHeader($oauth) {
    $r = 'Authorization: OAuth ';
    $values = array();
    foreach($oauth as $key=>$value) {
        $values[] = "$key=\"" . rawurlencode($value) . "\"";
    }
    $r .= implode(', ', $values);
    return $r;
}

$url = 'https://weather-ydn-yql.media.yahoo.com/forecastrss';
$app_id = 'rG7y794c';
$consumer_key = 'dj0yJmk9NDF3bnRVQTRwWGVWJmQ9WVdrOWNrYzNlVGM1TkdNbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmc3Y9MCZ4PTg0';
$consumer_secret = '201e1d247187ea261f4c2361927791621a8e4ae8';

$query = array(
    'location' => 'guatemala,gt',
    'format' => 'json',
    'u' => 'c',
    'lang' => 'es-es'
);

$oauth = array(
    'oauth_consumer_key' => $consumer_key,
    'oauth_nonce' => uniqid(mt_rand(1, 1000)),
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_timestamp' => time(),
    'oauth_version' => '1.0'
);

$base_info = buildBaseString($url, 'GET', array_merge($query, $oauth));
$composite_key = rawurlencode($consumer_secret) . '&';
$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
$oauth['oauth_signature'] = $oauth_signature;

$header = array(
    buildAuthorizationHeader($oauth),
    'X-Yahoo-App-Id: ' . $app_id
);
$options = array(
    CURLOPT_HTTPHEADER => $header,
    CURLOPT_HEADER => false,
    CURLOPT_URL => $url . '?' . http_build_query($query),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false
);

$ch = curl_init();
curl_setopt_array($ch, $options);
$response = curl_exec($ch);
curl_close($ch);

$r = json_decode($response, true);
//print_r($r['location']);
$r = $r['current_observation'];
print_r($response);

$dia = 'Miercoles';
$hora = "8:00";
$clima = $r['condition']['text'];

$temperatura =  $r['condition']['temperature'];
$precipitacion = 2;
$humedad = $['atmosphere']['humidity'];
$viento = $['wind']['speed'];