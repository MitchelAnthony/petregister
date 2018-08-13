# Petregister
[![Build Status](https://travis-ci.org/MitchelAnthony/petregister.svg?branch=master)](https://travis-ci.org/MitchelAnthony/petregister) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/MitchelAnthony/petregister/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/MitchelAnthony/petregister/?branch=master)

This project and readme are work in progress.

## Getting started

```
$ composer install
$ yarn
$ cp .env.dist .env
$ touch var/petregister.db
$ bin/console d:d:c
$ bin/console d:s:u --force
$ bin/console d:f:l
$ bin/console server:start
$ yarn run encore dev --watch
```
Open your browser and go to the link provided by server:run (usually http://localhost:8000). To login, go to /login and use admin/admin or user/user.

## Backlog

As a __visitor__, I want to
* ~~register an account~~
* ~~login to my account~~
* ~~search for a matching microchipId~~
* alert the owner that I found their animal
* be notified if the microchipId is found in another database (via http://www.europetnet.com/apiSearch.php?chipID={id} or http://www.europetnet.com/apiSearch.php?chipIDS={id})
* browse a list of missing pets

As a __pet owner__, I want to
* ~~add a pet~~
* ~~edit a pet~~
* ~~remove a pet~~
* transfer a pet to a new owner
* fill out my contact data
* set my contact preferences
* delete my account
* report my pet as missing

As a __veterinarian__ [*][1], I want to
*

As an __administrator__, I want to
*

Since this is a public project that can be used by anyone in a production setting, let's alo add some security best practices / [owasp](https://www.owasp.org/images/7/72/OWASP_Top_10-2017_%28en%29.pdf.pdf) / [nist](https://pages.nist.gov/800-63-3/sp800-63b.html#memsecret) recommendations.
* ~~Passwords of at least 8 characters~~
* Blacklist of 'forbidden' / leaked passwords
* ~~Password strength guidance / meter~~
* A guide to setup SSL for this project to prevent MitM attacks
* ~~Expensive hashing for passwords => argon2i~~
* Possibly 2FA
* Limit login attempts
* Log all login / access control / validation failures
* CSP / security headers / etc

[1]: This also includes pet rescue organisations and the like.