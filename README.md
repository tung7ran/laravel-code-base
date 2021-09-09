<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Guide Gco code base

Installation
------------
### 1 - Dependency

The first step is using composer to install the package and automatically update your `composer.json` file, you can do this by running:

```shell
composer install
```
2 - Provider

You need to update your application configuration in order to register the package so it can be loaded by Laravel, just update your `config/app.php` file adding the following code at the end of your `'providers'` section:

> `config/app.php`

```php
<?php

return [
    // ...
    'providers' => [
        Prettus\Repository\Providers\RepositoryServiceProvider::class,
        Artesaos\SEOTools\Providers\SEOToolsServiceProvider::class,
        // ...
    ],
    // ...
];
```
You can setup a short-version aliases for these facades in your `config/app.php` file. For example:

```php
<?php

return [
    // ...
    'aliases' => [
        'Passport'     => Laravel\Passport\Passport::class,
        'SEO' => Artesaos\SEOTools\Facades\SEOTools::class,
        // ...
    ],
    // ...
];
```
### 3 Configuration

#### Publish config

In your terminal type

```shell
php artisan vendor:publish
```

or

```shell
php artisan vendor:publish --provider="Artesaos\SEOTools\Providers\SEOToolsServiceProvider"
php artisan vendor:publish --provider "Prettus\Repository\Providers\RepositoryServiceProvider"
```
### 4 Generators

Create your repositories easily through the generator.

#### Config

You must first configure the storage location of the repository files. By default is the "app" folder and the namespace "App". Please note that, values in the `paths` array are acutally used as both *namespace* and file paths. Relax though, both foreward and backward slashes are taken care of during generation.

```php
    ...
    'generator'=>[
        'basePath'=>app()->path(),
        'rootNamespace'=>'App\\',
        'paths'=>[
            'models'       => 'Entities',
            'repositories' => 'Repositories',
            'interfaces'   => 'Repositories',
            'transformers' => 'Transformers',
            'presenters'   => 'Presenters',
            'validators'   => 'Validators',
            'controllers'  => 'Http/Controllers',
            'provider'     => 'RepositoryServiceProvider',
            'criteria'     => 'Criteria',
        ]
    ]
```

You may want to save the root of your project folder out of the app and add another namespace, for example

```php
    ...
     'generator'=>[
        'basePath'      => base_path('src/Lorem'),
        'rootNamespace' => 'Lorem\\'
    ]
```

Additionally, you may wish to customize where your generated classes end up being saved.  That can be accomplished by editing the `paths` node to your liking.  For example:

```php
    'generator'=>[
        'basePath'=>app()->path(),
        'rootNamespace'=>'App\\',
        'paths'=>[
            'models'=>'Models',
            'repositories'=>'Repositories\\Eloquent',
            'interfaces'=>'Contracts\\Repositories',
            'transformers'=>'Transformers',
            'presenters'=>'Presenters'
            'validators'   => 'Validators',
            'controllers'  => 'Http/Controllers',
            'provider'     => 'RepositoryServiceProvider',
            'criteria'     => 'Criteria',
        ]
    ]
```

#### Commands

To generate everything you need for your Model, run this command:

```terminal
php artisan make:entity Post
```
