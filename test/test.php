<?php
require '../src/Language.php';

use Oblind\Language;

Language::addTranslation([
  'hello' => '你好',
], 'zh-cn');
Language::addTranslation([
  'hello' => 'fuck',
]);

echo _('hello'), "\n";
Language::set('zh-cn');
echo _('hello'), "\n";
