# Pizzageddon

This repo contains an example starting project / learning resource for a toru yii project.

This project uses [vagrant](https://www.vagrantup.com) to run a virtualised [webserver](https://nginx.org) and [database](https://mariadb.com) to host the [yii2](https://www.yiiframework.com) / [php](https://www.php.net) project.

## URLs

 * http://admin.pizzageddon.local
 * http://www.pizzageddon.local

## Requirements
* A virtual machine, either [Virtualbox](https://www.virtualbox.org) or [Parallels](https://www.parallels.com)
* [Vagrant](https://www.vagrantup.com)
* [Parallels Provider](https://parallels.github.io/vagrant-parallels/docs/) if parallels is used
* [Vagrant Hostmanager](https://github.com/devopsgroup-io/vagrant-hostmanager)

## Development

### First run

In a terminal run the following within the project's folder

```sh
vagrant up;
vagrant ssh;
app
yarn;
composer install;
bower install;
php init;
php yii migrate-cms;
php yii migrate;
```

### Subsequent run's

In a terminal run the following within the project's folder

```sh
vagrant up;
vagrant ssh;
app
php init;
php yii migrate;
```

