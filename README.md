<p align="center"><a href="https://dohcsmc.com" target="_blank"><img src="https://dohcsmc.com/csmc_laravel.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About CSMC PORTAL

CSMC Portal is the portal of all MIS and HIS.

## How to Install

### open CMD and type:
```bash
git clone [repository link]
cd directory
composer update
copy .env.example .env
```

### Update database in .env file
```env
tdh_user
hris
```


```bash
php artisan key:generate
php artisan migrate
```

### open CMD as Administrator and create symbolink:
```bash
mklink /d C:\wamp64\www\portal C:\wamp64\server\portal2\public
```

### License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
