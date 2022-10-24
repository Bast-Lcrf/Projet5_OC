# - Blog_PHP / P5 - [![SymfonyInsight](https://insight.symfony.com/projects/e14c5bcb-8095-49f8-8449-8f9f6b5c6df3/mini.svg)](https://insight.symfony.com/projects/e14c5bcb-8095-49f8-8449-8f9f6b5c6df3)
Blog project as part of my symfony/php formation with OpenClassrooms.

## Table of contents
1. [General Info](#general-info)
2. [Technologies](#technologies)
3. [Installation](#installation)

## General Info
# projet5-Blog
Blog project as part of my symfony/php training with OpenClassrooms.

## Table of contents
1. [General Info](#general-info)
2. [Technologies](#technologies)
3. [Installation](#installation)

## General Info

**Not working on Nest hub / Nest hub max.**

This project is a simple blog as part of my training, but with some issues to solve.
I created a home page, a page that lists the blog posts, the page that details the post with their comments.
For Admins, they have a dedicated restricted page where they can moderate all new comments and add new articles.
As an Admin, you can delete all the comments into the blog.
Still as an Admin, you can modify all articles posted or delete them (this will delete all the comments linked).

For users, they can read all articles and comments accepted by moderation but they cannot post comments.
They have to create an account to comments.

To make the difference, in the database, the statut is defined as follows :
    - ROLE_ADMIN = Admins
    - ROLE_USER = Users

When they create an account, they are logged in and their statut is ROLE_USER.

if you want to change this value, you have to go into phpmyadmin and change it directly on the database.

## Technologies
A list of technologies used within the project :
* [PHP 7.4.12](https://www.php.net/)
* [Apache 2.0](https://www.apachelounge.com/download/VC15/)
* [MySQL 5.7.32](https://downloads.mysql.com/archives/installer/)
* [Bootstrap 5.2.1](https://getbootstrap.com/docs/5.2/getting-started/introduction/)
* [Composer](https://getcomposer.org/download/)
* Server : For the server, you can use [MAMP](https://www.mamp.info/en/mac/)like me, or whichever you want.

## Installation
* **Clone or download the repository**, and put files into your environment,
```
git clone https://github.com/Bast-Lcrf/Projet5_OC
```
* Install libraries with composer,
'''
php composer.phar install
'''
* Import database with datas : file _'database.sql'_,
* Connect you as an Admin : 
```
Pseudo : admin
Password : pass
```
* Connect you as a User : 
```
Pseudo : test
Password : test
```