<?php

namespace App\Libraries;

use Exception;
use Firebase\JWT\JWT;

class Entity
{


  protected static $public = "-----BEGIN PUBLIC KEY-----
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
  protected static $private = "-----BEGIN RSA PRIVATE KEY-----
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
-----END RSA PRIVATE KEY-----
";

  private static function sender($data, string $key)
  {

    //run check multi array or single array 
    $check = self::validation($key);
    $remove = array_key_exists('hide', $check) ? $check['hide'] : [];
    $show
      = array_key_exists('show', $check) ? $check['show'] : [];
    $enc =   array_key_exists('enc', $check) ? $check['enc'] : [];
    $int = array_key_exists('int', $check) ? $check['int'] : [];
    $float
      = array_key_exists('float', $check) ? $check['float'] : [];
    $string =  array_key_exists('string', $check) ? $check['string'] : [];
    $bool =  array_key_exists('bool', $check) ? $check['bool'] : [];
    $datas = [];
    if (isset($data[0])) {
      $temp = [];
      //check by entity and remove with no existing variable 

      foreach ($data as $obj) {
        if (is_object($obj)) {
          $obj = json_decode(json_encode($obj), true);
        }

        if (count($remove) > 0) {
          for ($i = 0; $i < count($remove); $i++) {
            unset($obj[$remove[$i]]);
          }
        }



        if (count($enc) > 0) {
          for ($i = 0; $i < count($enc); $i++) {
            $obj[$enc[$i]] = urlencode(self::encrypt($obj[$enc[$i]]));
          }
        }

        if (count($int) > 0) {
          for ($i = 0; $i < count($int); $i++) {
            $obj[$int[$i]] = (int)  $obj[$int[$i]];
          }
        }
        if (count($float) > 0) {
          for ($i = 0; $i < count($float); $i++) {
            $obj[$float[$i]] = (float)  $obj[$float[$i]];
          }
        }

        if (count($string) > 0) {
          for ($i = 0; $i < count($string); $i++) {
            $obj[$string[$i]] = (string)  $obj[$string[$i]];
          }
        }

        if (count($bool) > 0) {
          for ($i = 0; $i < count($bool); $i++) {
            $obj[$bool[$i]] = (bool)  $obj[$bool[$i]];
          }
        }

        if (count($show) > 0) {
          for ($i = 0; $i < count($show); $i++) {
            $temp[$show[$i]] = $obj[$show[$i]];
          }
        }

        if (count($show) > 0) {
          array_push($datas, $temp);
        } else {
          array_push($datas, $obj);
        }
      }
    } else {
      if (is_object($data)) {
        $data = json_decode(json_encode($data), true);
      }
      $temp = [];

      if (count($remove) > 0) {
        for ($i = 0; $i < count($remove); $i++) {
          unset($data[$remove[$i]]);
        }
      }

      if (count($enc) > 0) {
        for ($i = 0; $i < count($enc); $i++) {
          $data[$enc[$i]] = urlencode(self::encrypt($data[$enc[$i]]));
        }
      }

      if (count($int) > 0) {
        for ($i = 0; $i < count($int); $i++) {
          $data[$int[$i]] = (int)  $data[$int[$i]];
        }
      }

      if (count($float) > 0) {
        for ($i = 0; $i < count($float); $i++) {
          $data[$float[$i]] = (float)  $data[$float[$i]];
        }
      }

      if (count($string) > 0) {
        for ($i = 0; $i < count($string); $i++) {
          $data[$string[$i]] = (string)  $data[$string[$i]];
        }
      }

      if (count($bool) > 0) {
        for ($i = 0; $i < count($bool); $i++) {
          $data[$bool[$i]] = (bool)  $data[$bool[$i]];
        }
      }

      if (count($show) > 0) {
        for ($i = 0; $i < count($show); $i++) {
          $temp[$show[$i]] = $data[$show[$i]];
        }
      }

      if (count($show) > 0) {
        $datas = $temp;
      } else {
        $datas = $data;
      }
    }

    //encode as jwt token
    return $datas;
  }

  private static function encrypt(string $string)
  {
    $encrypted_string = openssl_encrypt($string, "AES-128-ECB", static::$private);
    return $encrypted_string;
  }

  public static function decrypt(string $string)
  {
    $encrypted_string = openssl_decrypt(urldecode($string), "AES-128-ECB", static::$private);
    return $encrypted_string;
  }

  private static  function encode($data)
  {
    $token = $data;
    $token = JWT::encode($token, static::$private, 'RS256');
    return $token;
  }

  public static function decode($data)
  {
    $decoded = JWT::decode(
      $data,
      static::$public,
      array('RS256')
    );
    return $decoded;
  }

  public static function run(array $data, string $entity, $res = false, $code = 500, $message = "")
  {
    $data = self::sender($data, $entity);

    $env = $_SERVER['CI_ENVIRONMENT'];
    if ($env == 'development') {
      $result = [
        'status' => $res,
        'status_code' => $code,
        'message' => $message,
        'data' => self::encode($data),

      ];
      $result['preview'] =  self::decode($result['data']);
    } else {
      $result = [
        'status' => $res,
        'status_code' => $code,
        'message' => $message,
        'data' => self::encode($data)
      ];
    }
    return $result;
  }

  private static function validation(string $select)
  {

    $validation = Entities::data_validation();

    if (count($validation[$select]) == 0) {
      throw new Exception("Validation is not exist", 1);
    }

    return $validation[$select];
  }
}
