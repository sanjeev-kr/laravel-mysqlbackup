# laravel-mysqlbackup
Laravel package to create MySql database backup in .sql or .sql.gz
## Install with Composer
```
composer require sanjeev-kr/laravel-mysqlbackup
```
Add below service provider to the service providers list in config/app.php
```
Sanjeev\MySqlBackup\MySqlBackupServiceProvider::class
```
To take backup run below commnad
```
php artisan make:mysqlbackup filename format
```
## Examples
- To make backup in sql format run below command
```
php artisan make:mysqlbackup mybackup sql
```
Backup would be created in storage/backup directory with file name mybackup_2019_02_10.sql. Date format yyyy_mm_dd is appended to given file name.

- To make backup in sql.gz format run below command

```
php artisan make:mysqlbackup mybackup sql.gz
```
Backup would be created in storage/backup directory with file name mybackup_2019_02_10.sql.gz. Date format yyyy_mm_dd is appended to given file name.
