# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog][keepachangelog] and this project adheres to [Semantic Versioning][semver].

## v1.8.0

### Added

- Laravel `11.x` support

### Changed

- Minimal Laravel version now is `10.0`
- Version of `composer` in docker container updated up to `2.7.6`
- Updated dev dependencies

## v1.7.0

### Added

- Support Laravel `10.x`

### Changed

- Composer version up to `2.5.5`
- Minimal require PHP version now is `8.0`
- Minimal Laravel version is `9.1`

## v1.6.0

### Added

- Support Laravel `9.x`

### Changed

- Composer version up to `2.2.4`

## v1.5.0

### Added

- Support of RoadRunner env `RR_MODE`

## v1.4.0

### Added

- Support PHP `8.x`

### Changed

- Composer `2.x` is supported now

## v1.3.0

### Changed

- Laravel `8.x` is supported now
- Minimal Laravel version now is `6.0` (Laravel `5.5` LTS got last security update August 30th, 2020)
- CI completely moved from "Travis CI" to "Github Actions" _(travis builds disabled)_
- Minimal required PHP version now is `7.2`

### Added

- PHP 7.4 is supported now

## v1.2.0

### Added

- GitHub actions for a tests running

### Changed

- Maximal `illuminate/*` packages version now is `7.*`

## v1.1.0

### Changed

- Maximal `illuminate/*` packages version now is `6.*`

## v1.0.0

### Added

- Package service provider
- Middleware `VarDumperMiddleware`
- Exception `VarDumperException`
- Helper `\dev\ran_using_cli()`
- Helper `\dev\dd()`
- Helper `\dev\dump()`

[keepachangelog]:https://keepachangelog.com/en/1.0.0/
[semver]:https://semver.org/spec/v2.0.0.html
