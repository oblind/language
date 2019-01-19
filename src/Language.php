<?php
namespace Oblind;

require __DIR__ . '/global.php';

class Language implements \ArrayAccess {
  static $langs = [];
  static $lang;
  protected static $values = [];

  function offsetExists($offset): boolean {
    return isset(static::$values[$offset]);
  }

  function offsetGet($offset) {
    return static::$values[$offset] ?? $offset;
  }

  function offsetSet($offset, $value) {
    static::$values[$offset] = $value;
  }

  function offsetUnset($offset) {
    unset(static::$values[$offset]);
  }

  /**
   * 设置语言
   *
   * @param string|Language $lang
   * @return Language
   */
  static function set($lang): Language {
    if($lang instanceof Language)
      $lang = get_class($lang);
    else
      $lang = ucfirst(str_replace('-', '', $lang));
    if(!$l = static::$langs[$lang] ?? null) {
      if(class_exists($lang)) {
        $l = new $lang;
        static::$langs[$lang] = $l;
      } else {
        if(!$l = static::$langs['en'] ?? null) {
          $l = new Language;
          static::$langs['en'] = $l;
        }
      }
    }
    static::$lang = $l;
    return $l;
  }

  static function trans(string $k): string {
    return static::$values[$k] ?? $k;
  }
}
