<h1 align="center"> identicon-avatar </h1>

[![Build Status](https://travis-ci.org/valiner/identicon-avatar.svg?branch=master)](https://travis-ci.org/valiner/identicon-avatar)
[![996.icu](https://img.shields.io/badge/link-996.icu-red.svg)](https://996.icu)
[![LICENSE](https://img.shields.io/badge/license-Anti%20996-blue.svg)](https://github.com/996icu/996.ICU/blob/master/LICENSE)


<p align="center"> 
identicon 根据一个字符串(可以是用户的ID或者IP)的哈希值生成大量不重复的头像
很多大型IT网站上可以见到，比如 Github、Sourceforge、Stackoveflow。
</p>

## 安装

```shell
$ composer require valiner/identicon-avatar -vvv
```

## 使用
### 非laravel
```php
<?php
require __DIR__.'/vendor/autoload.php';

use Valiner\IdenticonAvatar\Identicon;

$identicon = new Identicon();
//浏览器输出'sdp'的125px的图像

$identicon->getAvatar('sdp',125);
```

### laravel
```php
app('identicon')->getAvatar('sdp',125);
```

### 方法
> 浏览器输出'sdp'的125px的图像
```php
$identicon->getAvatar('sdp',125)
```
> 保存'sdp'的125px的图像的图像到本地
```php
$identicon->saveAvatar('sdp',125,__DIR_.'/test.png')
```

> 获取'sdp'的125px的图像的的BASE64
```php
$identicon->getAvatarDataUri('sdp',125)
```




## License

MIT
