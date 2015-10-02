Gravatar
=================

[![Build Status](https://travis-ci.org/dryhopped/Gravatar.png?branch=master)](https://travis-ci.org/dryhopped/Gravatar)

Gravatar is a simple library for interacting with the Gravatar apis for fetching Avatar Images and Profile Data.

_Gravatar is released under the Apache 2.0 License and is Copyrighted 2013 Luke Scalf._

Change Log
==========

0.2.0
-----

* Added dependency on `kriswallsmith/buzz` http client for fetching profile data
* Added support for fetching gravatar profile data in hcard, qr, vcf, json, php array, and xml formats
* Moved hashing of email addresses into separate function since the email is hashed in several places
* All Code is now PSR-2

Basic Usage
===========

Gravatar is a Composer package named `getninja/gravatar`. To use it, simply add it to the `require` section of your `composer.json` file.

    {
        "require": {
            "getninja/gravatar": "0.2.*"
        }
    }

After adding Gravatar to your `composer.json` file, simply use the class as normal.

    $gravatar = new GetNinja\Gravatar\Gravatar();
