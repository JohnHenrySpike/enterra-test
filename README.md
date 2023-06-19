enterra-test
=================

RestAPI test application without frontend

- yii2 framework (basic)
- swagger api docs

Requriments: 
 - Linux
 - docker
 - docker-compose

Usage
--------------

```Shell
# clone the code repository
$ git clone git@github.com:JohnHenrySpike/enterra-test.git
# get the root of project
$ cd enterra-test
#buil docker images and starts conatiners
$ make up      
#load dependency             
$ make composer-install
#creating tables     
$ make          
```

swagger docs: http://127.0.0.1:8080/docs/


Additional
-----------

web-server port set in ```.env``` file in root of project

list of all 'make' commands

```Shell
help                           This help
console-php                    Run php bash
docs                           Update openapi docs
composer-command               Composer command c="some command"
composer-install               Composer install command
composer-dumpautoload          Composer dump autoload
db-reset                       Remove db volume
up                             Up Docker-project
down                           Down Docker-project
stop                           Stop Docker-project
build                          Build Docker-project
ps                             Show list containers
log                            Show containers logs
```
