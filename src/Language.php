<?php
namespace Oblind;

require __DIR__ . '/global.php';

class Language implements \ArrayAccess {
  /**@var array $langs */
  static $langs = [];
  /**@var static $lang */
  static $lang;
  protected $values = [];

  function offsetExists($offset): boolean {
    return isset($this->values[$offset]);
  }

  function offsetGet($offset) {
    return $this->values[$offset] ?? $offset;
  }

  function offsetSet($offset, $value) {
    $this->values[$offset] = $value;
  }

  function offsetUnset($offset) {
    unset($this->values[$offset]);
  }

  /**
   * 设置语言
   *
   * @param string $lang
   * @return Language
   */
  static function set(string $lang): Language {
    if(!$l = static::$langs[$lang] ?? null) {
      $l = new static;
      static::$langs[$lang] = $l;
    }
    static::$lang = $l;
    return $l;
  }

  static function addTranslation(array $trans, string $lang = null) {
    if($lang) {
      if(!$l = static::$langs[$lang] ?? null) {
        $l = new static;
        static::$langs[$lang] = $l;
      }
    } else
      $l = static::$lang;
    $l->values = array_merge($l->values, $trans);
  }
}

Language::set('en');
