<?php
require '../vendor/autoload.php';

use Oblind\Language;

Language::addTranslation([
  'hello' => '你好',
], 'zh-cn');
Language::addTranslation([
  'hello' => 'fuck',
]);

echo _('hello'), "\n";
Language::set('zh-CN');
echo Language::$langName, "\n";
echo _('hello'), "\n";
