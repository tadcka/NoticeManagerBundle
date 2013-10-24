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

### Step 3: Include javascript and css

```twig
@TadckaNoticeManagerBundle/Resources/public/css/notice-manager.css

@TadckaNoticeManagerBundle/Resources/public/js/notice-manager.js
```

### Step 4: Include twig template

```twig
{% include 'TadckaNoticeManagerBundle::flash_notices.html.twig' %}
```

### Step 5: Example

``` php
$noticeContainer = new \Tadcka\NoticeManagerBundle\Container\NoticeContainer();
$noticeContainer->add('Hello world!', \Tadcka\NoticeManagerBundle\NoticeType::SUCCESS);
$this->get('tadcka_notice_manager')->save($noticeContainer);

or

$noticeContainer = new \Tadcka\NoticeManagerBundle\Container\NoticeContainer();
$noticeContainer->add('Hello world!', \Tadcka\NoticeManagerBundle\NoticeType::SUCCESS);
$html = $this->renderView(
    'TadckaNoticeManagerBundle::notices.html.twig',
    array(
        'notice_container' => $noticeContainer->getNotices(),
    )
);
```
