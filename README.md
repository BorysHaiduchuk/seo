Seo module
===
Seo module for managing redirects. Generate by template and edit title, description, keyword, og: title, og: description, og: image.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Add composer.json
```
  "repositories": [
        {
            "type": "git",
            "url": "https://github.com/BorysHaiduchuk/seo.git"
        }

    ]
```
Either run

```
php composer.phar require --prefer-dist boryshaiduchuk/yii2-seo "*"
```

or add

```
"boryshaiduchuk/yii2-seo": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
  'modules' => [
            'seo' => [
                'class' => 'boryshaiduchuk\seo\Module',
                'lang_id' => 1
            ]
        ],```