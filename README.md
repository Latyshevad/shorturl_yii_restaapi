<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic RESTful API service</h1>
    <h2 align="center">This Back-end application.</h1>
    <br>
</p>

This is a simple resty service for shortening URL addresses. It is built on the base template of the Yii2 framework.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0 and MySql 5.6 database.


INSTALLATION
------------

### Install from an Archive File

1. Download the project from this repository.
2. Unzip to the server directory.
3. Assign a domain name for this directory (for example: rest.sorturl.ru, or any other)
4. Import the file shortener_db.sql into the database (if you use a different database name, then correct it in the settings file: `/config/db.pxp`).
5. Configure the access to the database in the file `/config/db.pxp`
6. Install and configure the client application from the repository: https://github.com/Latyshevad/


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=shortener_db',
    'username' => 'userName',
    'password' => 'password',
    'charset' => 'utf8',
];
```

**NOTES:**
- Before setting up the database, import the tables from the `shortener_db.sql` file.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.

SUPPORT
-------

I will accept any criticism or help in improving this project. Please send your wishes to the e-mail address: Latyshevad89@gmail.com
