<?php
require '../src/Language.php';

use Oblind\Language;

class ZhCN extends Language {
  protected static $values = [
    'hello' => '你好',
  ];
}
Language::set('zh-cn');

echo _('hello'), "\n";
