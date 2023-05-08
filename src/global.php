<?php

if(!function_exists('_')) {
  function _(?string $k, array $args = null) {
    $r = Oblind\Language::$lang[$k] ?? $k;
    if($r && $args)
      foreach($args as $k => $v)
        $r = str_replace("{{$k}}", $v, $r);
    return $r;
  }
}
