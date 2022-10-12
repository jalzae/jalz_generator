<?php

use Firebase\JWT\JWT;

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

function res_future($res = false, $code = 500, $message = "", $data = [])
{
  $env = $_SERVER['CI_ENVIRONMENT'];
  if ($env == 'development') {
    $result = [
      'status' => $res,
      'status_code' => $code,
      'message' => $message,
      'data' => encode_data($data),

    ];
    $result['preview'] =  decode_data($result['data']);
  } else {
    $result = [
      'status' => $res,
      'status_code' => $code,
      'message' => $message,
      'data' => encode_data($data)
    ];
  }
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


function encoder($data = "")
{
  $issuer_claim = $data['password'];
  $audience_claim = $data['username'];
  $issuedat_claim  = time();
  $notbefore_claim = $issuedat_claim + 10;
  $expire_claim = $issuedat_claim + 3600;

  $token = array(
    'access' => true,
    "iss" => $issuer_claim,
    "aud" => $audience_claim,
    "iat" => $issuedat_claim,
    "nbf" => $notbefore_claim,
    "exp" => $expire_claim,
    "id" => $data['id'],
  );

  $token = JWT::encode($token, 'alwaysEBASForFreedom1234567890!!!', 'HS256');
  return $token;
}

function decoder($token = "")
{
  $decoded = JWT::decode(
    $token,
    'alwaysEBASForFreedom1234567890!!!',
    array('HS256')
  );
  return $decoded;
}

function encode_data($data = [])
{
  $public = "-----BEGIN PUBLIC KEY-----
MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAo9HWi1LSHz1etot/r1Su
8xkf830jhwrzMRF2cy4jJATmVp+UrIFXC4RiCXBplO6hYnPNg0m5J1e2fZwIZeKn
u5BuYfHDT4Kg3Da36+A9GPe+9CtxbH2ke7T7VhE0p6SaOGRis5bxQGIoA15SdNSA
cUQuGhXfYakz3mEto5JFZA/FX9gnlqcNOrMMgyCZ39/vDGA6a38AIH0Ee7IAW1WV
7doqyKQndC6L3y7ulk5WHV7MmsUuC7qNP+dLZA7Gqj8Rtr61ZwXi6kTih9L9l6FZ
bpPwdsUZ/AYhBe1DTl80uo1mTLEjzSHHzlMFU3Ntkw2E8Fdy+7bmNXrt4DHlnqa9
UoNIZ66gt3VTcRJ9dajmj4ztJy5l91pplfq0/2NGqhSdnugCjDQbcZ/DR1HPU1Ez
gChZBO99J6Thz3gyFjUL5n4PhxEcJ6NCSqDz5Dh5l2LwToil6GIufeT0NsfS7Bc9
nGk4zjPEyczZynt8MSNh9/2LSmy3l32xIv0LsGzn77q3hNAh+w7vDI13fvDrjdDJ
fZFd54wy2oHIiR5Bnbt5Z6ZDqeahx4LrnUjb6L/zgJm1z0cJ4lcgeEO0TaynbKWL
vpAYu8g8QZSU8zNWUgmk9/TYp4Ep+UwyBh2ErrizxHVEn4It829V8Y3oaTl28qg2
Wke8crI5TnBPVmBAS4j41dMCAwEAAQ==
-----END PUBLIC KEY-----
";
  $private = "-----BEGIN RSA PRIVATE KEY-----
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
-----END RSA PRIVATE KEY-----
";

  $token = $data;
  $token = JWT::encode($token, $private, 'RS256');
  return $token;
}

function decode_data($token = "")
{
  $public = "-----BEGIN PUBLIC KEY-----
MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAo9HWi1LSHz1etot/r1Su
8xkf830jhwrzMRF2cy4jJATmVp+UrIFXC4RiCXBplO6hYnPNg0m5J1e2fZwIZeKn
u5BuYfHDT4Kg3Da36+A9GPe+9CtxbH2ke7T7VhE0p6SaOGRis5bxQGIoA15SdNSA
cUQuGhXfYakz3mEto5JFZA/FX9gnlqcNOrMMgyCZ39/vDGA6a38AIH0Ee7IAW1WV
7doqyKQndC6L3y7ulk5WHV7MmsUuC7qNP+dLZA7Gqj8Rtr61ZwXi6kTih9L9l6FZ
bpPwdsUZ/AYhBe1DTl80uo1mTLEjzSHHzlMFU3Ntkw2E8Fdy+7bmNXrt4DHlnqa9
UoNIZ66gt3VTcRJ9dajmj4ztJy5l91pplfq0/2NGqhSdnugCjDQbcZ/DR1HPU1Ez
gChZBO99J6Thz3gyFjUL5n4PhxEcJ6NCSqDz5Dh5l2LwToil6GIufeT0NsfS7Bc9
nGk4zjPEyczZynt8MSNh9/2LSmy3l32xIv0LsGzn77q3hNAh+w7vDI13fvDrjdDJ
fZFd54wy2oHIiR5Bnbt5Z6ZDqeahx4LrnUjb6L/zgJm1z0cJ4lcgeEO0TaynbKWL
vpAYu8g8QZSU8zNWUgmk9/TYp4Ep+UwyBh2ErrizxHVEn4It829V8Y3oaTl28qg2
Wke8crI5TnBPVmBAS4j41dMCAwEAAQ==
-----END PUBLIC KEY-----
";
  $private = "-----BEGIN RSA PRIVATE KEY-----
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
-----END RSA PRIVATE KEY-----
";
  $decoded = JWT::decode(
    $token,
    $public,
    array('RS256')
  );
  return $decoded;
}

function encrypt($string)
{


  $public = "-----BEGIN PUBLIC KEY-----
MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAo9HWi1LSHz1etot/r1Su
8xkf830jhwrzMRF2cy4jJATmVp+UrIFXC4RiCXBplO6hYnPNg0m5J1e2fZwIZeKn
u5BuYfHDT4Kg3Da36+A9GPe+9CtxbH2ke7T7VhE0p6SaOGRis5bxQGIoA15SdNSA
cUQuGhXfYakz3mEto5JFZA/FX9gnlqcNOrMMgyCZ39/vDGA6a38AIH0Ee7IAW1WV
7doqyKQndC6L3y7ulk5WHV7MmsUuC7qNP+dLZA7Gqj8Rtr61ZwXi6kTih9L9l6FZ
bpPwdsUZ/AYhBe1DTl80uo1mTLEjzSHHzlMFU3Ntkw2E8Fdy+7bmNXrt4DHlnqa9
UoNIZ66gt3VTcRJ9dajmj4ztJy5l91pplfq0/2NGqhSdnugCjDQbcZ/DR1HPU1Ez
gChZBO99J6Thz3gyFjUL5n4PhxEcJ6NCSqDz5Dh5l2LwToil6GIufeT0NsfS7Bc9
nGk4zjPEyczZynt8MSNh9/2LSmy3l32xIv0LsGzn77q3hNAh+w7vDI13fvDrjdDJ
fZFd54wy2oHIiR5Bnbt5Z6ZDqeahx4LrnUjb6L/zgJm1z0cJ4lcgeEO0TaynbKWL
vpAYu8g8QZSU8zNWUgmk9/TYp4Ep+UwyBh2ErrizxHVEn4It829V8Y3oaTl28qg2
Wke8crI5TnBPVmBAS4j41dMCAwEAAQ==
-----END PUBLIC KEY-----
";
  $private = "-----BEGIN RSA PRIVATE KEY-----
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
-----END RSA PRIVATE KEY-----
";

  $encrypted_string = openssl_encrypt($string, "AES-128-ECB", $private);
  return $encrypted_string;
}

function decrypt($string)
{
  $public = "-----BEGIN PUBLIC KEY-----
MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAo9HWi1LSHz1etot/r1Su
8xkf830jhwrzMRF2cy4jJATmVp+UrIFXC4RiCXBplO6hYnPNg0m5J1e2fZwIZeKn
u5BuYfHDT4Kg3Da36+A9GPe+9CtxbH2ke7T7VhE0p6SaOGRis5bxQGIoA15SdNSA
cUQuGhXfYakz3mEto5JFZA/FX9gnlqcNOrMMgyCZ39/vDGA6a38AIH0Ee7IAW1WV
7doqyKQndC6L3y7ulk5WHV7MmsUuC7qNP+dLZA7Gqj8Rtr61ZwXi6kTih9L9l6FZ
bpPwdsUZ/AYhBe1DTl80uo1mTLEjzSHHzlMFU3Ntkw2E8Fdy+7bmNXrt4DHlnqa9
UoNIZ66gt3VTcRJ9dajmj4ztJy5l91pplfq0/2NGqhSdnugCjDQbcZ/DR1HPU1Ez
gChZBO99J6Thz3gyFjUL5n4PhxEcJ6NCSqDz5Dh5l2LwToil6GIufeT0NsfS7Bc9
nGk4zjPEyczZynt8MSNh9/2LSmy3l32xIv0LsGzn77q3hNAh+w7vDI13fvDrjdDJ
fZFd54wy2oHIiR5Bnbt5Z6ZDqeahx4LrnUjb6L/zgJm1z0cJ4lcgeEO0TaynbKWL
vpAYu8g8QZSU8zNWUgmk9/TYp4Ep+UwyBh2ErrizxHVEn4It829V8Y3oaTl28qg2
Wke8crI5TnBPVmBAS4j41dMCAwEAAQ==
-----END PUBLIC KEY-----
";
  $private = "-----BEGIN RSA PRIVATE KEY-----
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
-----END RSA PRIVATE KEY-----
";

  $encrypted_string = openssl_decrypt($string, "AES-128-ECB", $public);
  return $encrypted_string;
}
