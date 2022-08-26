<?php

/**
 * give Result to response API
 *
 * @param bool  $res    give it with true or false
 * @param int        $code        status code will provide response status code
 * @param object|array        $data        PHP object or array
 * @param string         $message Give message

 */
function res($res = false, $code = 500, $message = "", $data = [])
{
  $result = [
    'status' => $res,
    'status_code' => $code,
    'message' => $message,
    'data' => $data
  ];

  return $result;
}

function skip($res = false, $message = "", $code = 500)
{
  $result = [
    'status' => $res,
    'status_code' => $code,
    'message' => $message,
  ];
  http_response_code($code);
  print_r(json_encode($result));
  exit;
}

function passwordhash($pass = "")
{
  $pass = sha1(md5($pass));

  return $pass;
}

/**
 * Distinct Data
 *
 * @param array  $filtered    filtered must be array
 * @param string  $string    String must be string
 */
function distincData($filtered, $string)
{

  $result = array_filter(
    $filtered,
    function ($value, $key) use ($filtered, $string) {
      $keys =  array_keys($value);
      $i = array_search($string, $keys);
      return $key === array_search($value[$keys[$i]], array_column($filtered, $keys[$i]));
    },
    ARRAY_FILTER_USE_BOTH
  );

  return $result;
}

/**
 * CURL Helper Methods Request
 *
 * @param string  $url    URL Request
 * @param string  $method    'GET'|'POST'|'PUT'|'DELETE'|'PATCH'
 * @param object|array  $header    Header Body request like Auth Dll
 * @param object|array  $body    Body request like Auth Dll
 * @param object|array  $type    Empty is form-urlencoded|other is 'json' or 'form'
 */
function getApi($url, $method = 'GET', $header = [], $body = [], $type = "")
{
  try {
    if ($type == "form") {
      $header['Content-Type'] = 'multipart/form-data';
    } else if ($type == "json") {
      $header['Content-Type'] = 'application/json';
    } else {
      $header['Content-Type'] = 'x-www-form-urlencoded';
    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36',
      CURLOPT_POSTFIELDS => json_encode($body),
      CURLOPT_HTTPHEADER => json_encode($header),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
  } catch (Exception $e) {
    return $e;
  }
}
