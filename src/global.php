<?php

if(!function_exists('_')) {
  function _(string $k) {
    return Oblind\Language::$lang[$k];
  }
}
