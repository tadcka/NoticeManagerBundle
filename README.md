NoticeManagerBundle
=============

Notice manager Symfony2 bundle

## Installation

### Step 1: Download NoticeManagerBundle using composer

Add TadckaNoticeBundle in your composer.json:

```js
{
    "require": {
        "tadcka/notice-manager-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update tadcka/notice-manager-bundle
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Tadcka\AddressBundle\TadckaNoticeManagerBundle(),
    );
}
```

### Step 3: Include twig template

```twig
{% include 'TadckaNoticeManagerBundle::notices.html.twig' %}
```

### Step 4: Example

``` php
$noticeContainer = new \Tadcka\NoticeManagerBundle\Container\NoticeContainer();
$noticeContainer->add('Hello world!', \Tadcka\NoticeManagerBundle\NoticeType::SUCCESS);
$this->get('tadcka_notice_manager')->save($noticeContainer);
```
