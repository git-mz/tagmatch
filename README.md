# tagmatch
>文本关键词匹配程序,一般的匹配方式。

### 使用场景
```
v1.0.0
文本中匹配指定词组，替换为带链接的标签

```

### 使用方法

1、引入包

```php
composer require git-mz/tagmatch
```
2、调用
```php
use tagmatch\main;

$main    = new Main();
$content = '我会脚踏云朵，哦不，是七彩云朵去娶你！';
$tags = [
    ['word' => '云朵',      'url' => 'www.yunduo.com'],
    ['word' => '七彩云朵',  'url' => 'www.qicaiyunduo.com'],
];

// 获取匹配到的tags
$res = $main::init()
     ->setTree($tags)
     ->getTagWord($content);

// 替换匹配到的tags
$res = $main::init()
     ->setTree($tags)
     ->replace($content, $newclass = '');

```
3、方法说明
```php
v1.0.0
    getTagWord(String content, Int wordNum)
    //获取文本中匹配到的标签
    replace(String content, String newclass, Int replaceOne)
    //匹配替换文本中的标签
```

### 小结一下
> 好好学习，天天向上！
> 代码不定期迭代...

