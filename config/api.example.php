<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    exit("No direct script access allowed");
}

define('API_BASE', 'https://gorest.co.in/public/v2');
define('API_TOKEN', 'YOUR_ACCESS_TOKEN_HERE');

function apiRequest($endpoint, $method = 'GET', $data = null)
{
    $url = rtrim(API_BASE, '/') . $endpoint;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . API_TOKEN,
    ]);

    if ($data !== null) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($ch);
    $err = curl_error($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($response === false) {
        return ['error' => true, 'message' => "Connection error encountered"];
    }

    $decoded = json_decode($response, true);
    if ($decoded === null && json_last_error() !== JSON_ERROR_NONE) {
        return ['error' => true, 'message' => 'Invalid response received', 'raw' => $response];
    }

    return ['error' => false, 'status' => $status, 'data' => $decoded];
}
