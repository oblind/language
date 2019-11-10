<?php
namespace Oblind;

class Language implements \ArrayAccess {
  /**@var array $langs */
  static $langs = [];
  /**@var static $lang */
  static $lang;
  /**@var string $langName */
  static $langName;
  protected static $alias = [
    'en' => ['en-us'],
    'zh-cn' => ['zh-hans-cn', 'zh-sg'],
    'zh-tw' => ['zh-hk']
  ];
  protected $values = [];

  function offsetExists($offset): bool {
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
    if($p = strpos($lang, ','))
      $lang = substr($lang, 0, $p);
    $lang = strtolower($lang);
    if(static::$langName != $lang) {
      if(!$l = static::$langs[$lang] ?? null) {
        foreach(static::$alias as $k => $ls)
          if(in_array($lang, $ls)) {
            $lang = $k;
            $l = static::$langs[$k] ?? null;
            break;
          }
        if(!$l) {
          $l = new static;
          static::$langs[$lang] = $l;
        }
      }
      static::$lang = $l;
      static::$langName = $lang;
      return $l;
    } else
      return static::$lang;
  }

  static function addTranslation(array $trans, string $lang = null) {
    if($lang) {
      $lang = strtolower($lang);
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
