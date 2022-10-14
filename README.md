# projet5-Blog
Blog project as part of my symfony/php training with OpenClassrooms.

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
[![SymfonyInsight](https://insight.symfony.com/projects/e14c5bcb-8095-49f8-8449-8f9f6b5c6df3/big.svg)](https://insight.symfony.com/projects/e14c5bcb-8095-49f8-8449-8f9f6b5c6df3)

**Not working on Nest hub / Nest hub max.**

This project is a simple blog as part of my training, but with some issues to solve.
I created a home page, a page that lists the blog posts, the page that details the post with their comments.
For Admins, they have a dedicated restricted page where they can moderate all new comments and add new articles.
As an Admin, you can modify all the comments into the blog, the comments went back to the moderation and then you can accept or delete it as you wish.
Still as an Admin, you can modify all articles posted or delete them (this will delete all the comments linked).

For users, they can read all articles and comments accepted by moderation but they cannot post comments.
They have to create an account to comments.

To make the difference, in the database, the statut is defined as follows :
    - 1 = Admins
    - 2 = Users

When they create an account, they are logged in and their statut is 2.

if you want to change this value, you have to go into phpmyadmin and change it directly on the database.
At the moment, you can't do it directly on the blog. But I can add it to the profile page if you want. Then you can upgrade all the ones you want as admin.

## Technologies
A list of technologies used within the project :
* [PHP 7.4.12](https://www.php.net/)
* [Apache 2.0](https://www.apachelounge.com/download/VC15/)
* [MySQL 5.7.32](https://downloads.mysql.com/archives/installer/)
* [Bootstrap 5.2.1](https://getbootstrap.com/docs/5.2/getting-started/introduction/)

## Installation
* **Clone or download the repository**, and put files into your environment,
```
git clone https://github.com/Bast-Lcrf/Projet5_OC
```
* Import database with datas : file _'database.sql'_,
* Connect you : 
```
Pseudo : Admin
Password : pass
```
 



**Not working on Nest hub / Nest hub max.**

This project is a simple blog as part of my training, but with some issues to solve.
I created a home page, a page that lists the blog posts, the page that details the post with their comments.
For Admins, they have a dedicated restricted page where they can moderate all new comments and add new articles.
As an Admin, you can modify all the comments into the blog, the comments went back to the moderation and then you can accept or delete it as you wish.
Still as an Admin, you can modify all articles posted or delete them (this will delete all the comments linked).

For users, they can read all articles and comments accepted by moderation but they cannot post comments.
They have to create an account to comments.

To make the difference, in the database, the statut is defined as follows :
    - 1 = Admins
    - 2 = Users

When they create an account, they are logged in and their statut is 2.

if you want to change this value, you have to go into phpmyadmin and change it directly on the database.
At the moment, you can't do it directly on the blog. But I can add it to the profile page if you want. Then you can upgrade all the ones you want as admin.

## Technologies
A list of technologies used within the project :
* [PHP 7.4.12](https://www.php.net/)
* [Apache 2.0](https://www.apachelounge.com/download/VC15/)
* [MySQL 5.7.32](https://downloads.mysql.com/archives/installer/)
* [Bootstrap 5.2.1](https://getbootstrap.com/docs/5.2/getting-started/introduction/)

## Installation
* **Clone or download the repository**, and put files into your environment,
```
git clone https://github.com/Bast-Lcrf/Projet5_OC
```
* Import database with datas : file _'database.sql'_,
* Connect you : 
```
Pseudo : Admin
Password : pass
```
 
