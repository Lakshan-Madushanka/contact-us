# Full Contact-Us functionality for your website 

![GitHub release (latest by date)](https://img.shields.io/github/v/release/Lakshan-Madushanka/contact-us)
[![GitHub issues](https://img.shields.io/github/issues/Lakshan-Madushanka/contact-us)](https://github.com/Lakshan-Madushanka/contact-us/issues)
[![GitHub forks](https://img.shields.io/github/forks/Lakshan-Madushanka/contact-us)](https://github.com/Lakshan-Madushanka/contact-us/network)
[![GitHub license](https://img.shields.io/github/license/Lakshan-Madushanka/contact-us)](https://github.com/Lakshan-Madushanka/contact-us/blob/main/LICENSE.md)
![Packagist Downloads](https://img.shields.io/packagist/dt/lakm/contact)

This package provide full contact us functionality for your web site with modern front-end scaffolding. you have freedom to modify these front-end templates as you wish.

## Work flow
1). User make a inquery using contact-us page. </br>
2). Successfully uploaded inquery is saved in db and  forwaded to admins using mail settings. </br>
3). Admin make a reply. </br>
4). Successfully uploaded rely is saved in db and forwared to the user and admins.

## Screen shots
![screen1](https://user-images.githubusercontent.com/47297673/135661945-00c7508a-bea4-45c7-a35a-0cd4559ae9f6.PNG)
![screen2](https://user-images.githubusercontent.com/47297673/135661953-e2fe01a1-44a8-4024-8b7c-d828d8f10264.PNG)
![screen3](https://user-images.githubusercontent.com/47297673/135661956-75733ce2-bba2-4415-823c-a3c7c9c994e3.PNG)
![screen4](https://user-images.githubusercontent.com/47297673/135661962-254a07f6-78bb-499b-9527-f04b760e1591.PNG)
![screen5](https://user-images.githubusercontent.com/47297673/135661965-a18e2617-17b8-4be4-a71d-b67b1ea7a19c.PNG)



## Installation

You can install the package via composer:

```bash
composer lakm/contact
```

Then run this artisan command: This will generate all scaffolding 
```bash
php artisan lakm:InitContactUs
```
Routes must be register in one of the service provider class(AppServiceProvider)
```bash
ContactUs::routes();
```

This is the contents of the published config file : This allow you to set configurations according to your expectations. 

```php
return [
    // include role names to send the email
    'roles' => ['admin', 'super_admin'],

    // you can change email contain column below
    'email_column' => 'email',

    // you can change name contain column below
    'name_column' => 'name',

    /*
     include relationship name
    to obtain roles if roles are
    in seperate table other than user
     */

    'relationship' => 'roles',

    // you can change role table column name below

    'role_column_name' => 'name',

    /* define list of emails if
    need to send particular users
     */

    'users' => [
            //'exampl@text.com' => 'name'
        ]
];
```
## Change mail template 

```bash
php artisan vendor:publish --tag laravel-mail
```

## Usage

Simply set the routes : You can get the route list using below command
```bash
php artisan route:list
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please acknowledge if you found any vulnerability using this email : epmadushanka@gmail.com

## Credits
- lakshan(https://github.com/Lakshan-Madushanka/)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
