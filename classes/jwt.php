<?php

class JWT {
  
  public static function sign($data) {
    $header = str_replace("=","",base64_encode('{"alg":"HS256","iat":'.time().'}'));
    $token = "{";
    foreach($data as $key=>$value) {
      $token.= '"'.$key.'":"'.$value.'",';
    } 
    $token .= "}";
    $to_sign = $header.".".base64_encode($token);
    return $to_sign.".".JWT::signature($to_sign); 
  } 

  public static function signature($data) {
    return hash("sha256","donth4ckmebr0".$data);
  }

  public static function verify($auth) {
    list($h64,$d64,$sign) = explode(".",$auth);
    if (!empty($sign) and (JWT::signature($h64.".".$d64) != $sign)) {
      die("Invalid Signature");
    }
    $header = base64_decode($h64);
    $data = base64_decode($d64);
    return JWT::parse_json($data);
  }
  public static function parse_json($str) {
    $data = explode(",",rtrim(ltrim($str, '{'), '}'));
    $ret = array();
    foreach($data as $entry) {
      list($key, $value) =  explode(":",$entry);
      $key = rtrim(ltrim($key, '"'), '"');
      $value = rtrim(ltrim($value, '"'), '"');
      $ret[$key] = $value;
    }
    return $ret;
  }
}

?>
