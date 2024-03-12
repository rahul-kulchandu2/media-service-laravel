# Media Service for Laravel

[![Latest Version](https://img.shields.io/github/v/tag/rahul-kulchandu2/media-service
)](https://github.com/rahul-kulchandu2/media-service-laravel/tags)
[![Latest Version](https://img.shields.io/packagist/dt/kulchandu/media-service
)](https://packagist.org/packages/kulchandu/media-service)


## Introduction

This is a media service using upload image for storage folder and s3bucket for laravel

## Installation Documentation

run composer require kulchandu/media-service

## Publish the vendors

php artisan vendor:publish

## Usage
  $file_path = MediaServiceFacade::uploadAndAssociate($request->file);
  -It returns the path of file-

## License

Laravel Media Service is open-sourced software licensed under the [MIT license](LICENSE.md).

Thank you for considering contributing to Media Service for Laravel!
