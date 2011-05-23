
drop database if exists ajax_chat;
create database ajax_chat;
use ajax_chat;

grant select, insert, update, delete on ajax_chat.* to 'ajax_chat'@'localhost' identified by 'reiore04';

create table user (
	id bigint unsigned auto_increment,
	username varchar(32) unique not null,
	password char(40) not null,
	create_time timestamp default current_timestamp,
	primary key (id),
	index (username, password)
) engine=MyISAM charset=UTF8;

create table message (
	id bigint unsigned auto_increment,
	user_id bigint unsigned not null,
	message varchar(256) not null,
	create_time timestamp default current_timestamp,
	primary key (id),
	foreign key (user_id) references user (id)
) engine=MyISAM charset=UTF8;
