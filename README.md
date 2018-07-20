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
Open your browser and go to the link provider by server:run (usually http://localhost:8000). To login, go to /login and use admin/admin or user/user.

## Backlog

As a __visitor__, I want to
* ~~register an account~~
* ~~login to my account~~
* search for a matching microchipId
* alert the owner that I found their animal

As a __pet owner__, I want to
* ~~add a pet~~
* ~~edit a pet~~
* ~~remove a pet~~
* transfer a pet to a new owner
* fill out my contact data
* set my contact preferences
* delete my account

As a __veterinarian__ [*][1], I want to
*

As an __administrator__, I want to
*

[1]: This also includes pet rescue organisations and the like.