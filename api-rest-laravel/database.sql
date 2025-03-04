CREATE DATABASE IF NOT EXISTS api-rest-laravel
USE api_rest_laravel;

CREATE TABLE users(
id              int(255) auto_increment not null,
name            varchar(50) NOT NULL,
surname         varchar(100),
role            varchar(20),
email           varchar(255) NOT NULL,
password        varchar(255) NOT NULL,
description     text,
image           varchar(255),
created_at      datetime    DEFAULT NULL,
updated_at      datetime    DEFAULT NULL,
remember_token  varchar(255),

CONSTRAINT  pk_users PRIMARY KEY(id)

)ENGINE=InnoDb;


CREATE TABLE categories(

id              int(255) auto_increment not null,
name            varchar(50) NOT NULL,
created_at      datetime    DEFAULT NULL,
updated_at      datetime    DEFAULT NULL,

CONSTRAINT  pk_categories PRIMARY KEY(id)

)ENGINE=InnoDb;


CREATE TABLE posts(

id              int(255) auto_increment not null,
user_id         int(255) not null,
category_id     int(255) not null,
title           varchar(255) NOT NULL,
content         text NOT NULL,
image           varchar(255),
created_at      datetime    DEFAULT NULL,
updated_at      datetime    DEFAULT NULL,

CONSTRAINT  pk_posts            PRIMARY KEY(id),
CONSTRAINT  fk_post_user        FOREIGN KEY (user_id) REFERENCES users(id),
CONSTRAINT  fk_post_categories  FOREIGN KEY(category_id) REFERENCES categories(id)

)ENGINE=InnoDb;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  NitroPC
 * Created: 23-mar-2020
 */

