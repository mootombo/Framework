[MOOTOMBO!RDK](http://devxive.com) [![Build Status](https://secure.travis-ci.org/mootombo/rdk.png?branch=master)](https://travis-ci.org/mootombo/rdk)
====

coming soon...


## What is the MOOTOMBO!RDK ?

The `MOOTOMBO!RDK` is a platform for writing web and command line applications in PHP. It is free and open source software, distributed under the GNU General Public License version 2 or later.

It comprises code originally developed for the MOOTOMBO!WebOS, a Content Management System (CMS) and Web Application Platform (WAP). For more information about the MOOTOMBO!WebOS visit [http://mootombo.com/about](http://mootombo.com/about).

For news and information about developing with MOTOOMBO, please visit [http://developer.mootombo.org](http://developer.mootombo.org).

View the MOOTOMBO!RDK API Documentation at [http://mootombo.github.com/rdk](http://mootombo.github.com/rdk). Powered by [phpDocumentor 2](http://www.phpdoc.org).

You can discuss MOOTOMBO!RDK development by joining the RDK Forum at [http://devxive.com/forum/rdk](http://devxive.com/forum/rdk).


## Requirements

- PHP 5.3.10
- Each package has their own requirements as well. Ex: The Image package requires the PHP GD extension. Please see the `composer.json` in each package repository for these requirements.
- Applications implementing the MOOTOMBO!RDK must implement the 'MPATH_ROOT' constant which should be the root path of the application.


## Installation

The simplest way to get up and running with the MOOTOMBO!RDK is to use [composer](http://getcomposer.org). Basic installation for composer can be found below, for additional information on installing composer, [read the documentation](http://getcomposer.org/doc/00-intro.md#installation-nix).

```sh
curl -sS https://getcomposer.org/installer | php
```

### Full Installation Via Composer

Composer has the ability to download the full stack framework (including all our packages) as a project starter using the "create-project" command. In the example below, "myAwesomeApp" is the folder where you want to create the project. It should not be created yet.

```sh
php composer.phar create-project --prefer-dist mootombo/framework myAwesomeApp
```

If you are interested in working with the development code (in the master branch), and not a tagged stable distribution, then pass in the `--stability="dev"` command after `--prefer-dist`.

### Package Installation Via Composer

There are two ways to add our packages to your existing composer powered application.

##### Adding packages manually to the `require` option in your `composer.json`.

```json
{
    "require": {
        "mootombo/PACKAGENAME": "VERSION"
    }
}
```
and then run install (or update).
```sh
php composer.phar install
```

##### Adding packages using `composer require`

```sh
php composer.phar require mootombo/packagename:version
```

### Full Installation Via Git

`git clone git://github.com/mootombo/rdk.git`


## Documentation

General documentation about the MOOTOMBO!RDK can be found under the [/docs](docs/) folder of this repository. In addition, each package has documentation in a `README.md` file.


## Reporting Bugs and Issue

Bugs and issues found in the MOOTOMBO!RDK code can be reported on the [Issues](https://github.com/mootombo/rdk/issues) list. Even for distributed packages where the code is in another repo, please submit issues to this issue tracker.


## Contributing

All kind of contributions are welcome. Please read about how to contribute [here](CONTRIBUTING.md).

You may find tasks you can do on the [Issues](https://github.com/mootombo/rdk/issues) list by filtering on labels and milestones.


