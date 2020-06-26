<p align="center">
  <img src="https://laravel.com/assets/img/components/logo-laravel.svg" alt="Laravel" width="240" />
</p>

# Stacked variables dumper <sub><sup>| for Laravel-based application</sup></sub>

[![Version][badge_packagist_version]][link_packagist]
[![PHP Version][badge_php_version]][link_packagist]
[![Build Status][badge_build_status]][link_build_status]
[![Coverage][badge_coverage]][link_coverage]
[![Downloads count][badge_downloads_count]][link_packagist]
[![License][badge_license]][link_license]

Using this package you can dump any variables using `\dev\dump()` and `\dev\dd()` function **without** main process stopping or sending data to the standard output _(last is required for running applications using [RoadRunner][roadrunner])_.

## Install

Require this package with composer using the following command:

```shell script
$ composer require --dev avto-dev/stacked-dumper-laravel "^1.0"
```

> Installed `composer` is required ([how to install composer][getcomposer]).

> You need to fix the major version of package.

## Usage

In any part of your application call `\dev\dump()` and/or `\dev\dd()`. That's all =)

### RoadRunner use-case

For example, if you trying to `dump('test');` in controller, you will see something like that:

```text
worker error: invalid data found in the buffer (possible echo)
```

But, if you will use helpers provided by this package `\dev\dump('test');`, all will forks fine:

```text
"test"
```

### Testing

For package testing we use `phpunit` framework and `docker-ce` + `docker-compose` as develop environment. So, just write into your terminal after repository cloning:

```shell script
$ make build
$ make latest # or 'make lowest'
$ make test
```

## Changes log

[![Release date][badge_release_date]][link_releases]
[![Commits since latest release][badge_commits_since_release]][link_commits]

Changes log can be [found here][link_changes_log].

## Support

[![Issues][badge_issues]][link_issues]
[![Issues][badge_pulls]][link_pulls]

If you will find any package errors, please, [make an issue][link_create_issue] in current repository.

## License

This is open-sourced software licensed under the [MIT License][link_license].

[badge_packagist_version]:https://img.shields.io/packagist/v/avto-dev/stacked-dumper-laravel.svg?maxAge=180
[badge_php_version]:https://img.shields.io/packagist/php-v/avto-dev/stacked-dumper-laravel.svg?longCache=true
[badge_build_status]:https://img.shields.io/github/workflow/status/avto-dev/stacked-dumper-laravel/tests/master
[badge_coverage]:https://img.shields.io/codecov/c/github/avto-dev/stacked-dumper-laravel/master.svg?maxAge=60
[badge_downloads_count]:https://img.shields.io/packagist/dt/avto-dev/stacked-dumper-laravel.svg?maxAge=180
[badge_license]:https://img.shields.io/packagist/l/avto-dev/stacked-dumper-laravel.svg?longCache=true
[badge_release_date]:https://img.shields.io/github/release-date/avto-dev/stacked-dumper-laravel.svg?style=flat-square&maxAge=180
[badge_commits_since_release]:https://img.shields.io/github/commits-since/avto-dev/stacked-dumper-laravel/latest.svg?style=flat-square&maxAge=180
[badge_issues]:https://img.shields.io/github/issues/avto-dev/stacked-dumper-laravel.svg?style=flat-square&maxAge=180
[badge_pulls]:https://img.shields.io/github/issues-pr/avto-dev/stacked-dumper-laravel.svg?style=flat-square&maxAge=180
[link_releases]:https://github.com/avto-dev/stacked-dumper-laravel/releases
[link_packagist]:https://packagist.org/packages/avto-dev/stacked-dumper-laravel
[link_build_status]:https://travis-ci.org/avto-dev/stacked-dumper-laravel
[link_coverage]:https://codecov.io/gh/avto-dev/stacked-dumper-laravel/
[link_changes_log]:https://github.com/avto-dev/stacked-dumper-laravel/blob/master/CHANGELOG.md
[link_issues]:https://github.com/avto-dev/stacked-dumper-laravel/issues
[link_create_issue]:https://github.com/avto-dev/stacked-dumper-laravel/issues/new/choose
[link_commits]:https://github.com/avto-dev/stacked-dumper-laravel/commits
[link_pulls]:https://github.com/avto-dev/stacked-dumper-laravel/pulls
[link_license]:https://github.com/avto-dev/stacked-dumper-laravel/blob/master/LICENSE
[getcomposer]:https://getcomposer.org/download/
[roadrunner]:https://github.com/spiral/roadrunner
