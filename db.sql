create table shop_admin
(
	adminid int auto_increment
		primary key,
	adminuser varchar(32) not null,
	adminpasswd char(32) not null,
	adminemail varchar(50) not null,
	logintime int default '0' not null,
	loginip bigint default '0' not null,
	createtime int default '0' not null,
	constraint shop_admin_adminid_uindex
		unique (adminid)
)
;

create index shop_admin__adminuser_adminpasswd
	on shop_admin (adminuser, adminpasswd)
;

create index shop_admin__adminuser_adminemail
	on shop_admin (adminuser, adminemail)
;

create table shop_category
(
	cateid bigint auto_increment
		primary key,
	title varchar(32) not null,
	parentid bigint default '0' not null,
	createtime int default '0' not null,
	constraint shop_category_cateid_uindex
		unique (cateid),
	constraint shop_category_parentid_uindex
		unique (parentid),
	constraint shop_category_createtime_uindex
		unique (createtime)
)
;

create table shop_profile
(
	id bigint auto_increment
		primary key,
	truename varchar(32) not null,
	age tinyint default '0' not null,
	sex enum('0', '1', '2') default '0' not null,
	birthday date default '2017-01-01' not null,
	nickname varchar(32) not null,
	company varchar(100) not null,
	userid int default '0' not null,
	createtime int default '0' not null,
	constraint shop_profile_id_uindex
		unique (id),
	constraint shop_profile_userid_uindex
		unique (userid),
	constraint shop_profile_createtime_uindex
		unique (createtime)
)
;

create table shop_user
(
	userid int auto_increment
		primary key,
	username varchar(32) not null,
	userpasswd varchar(32) not null,
	useremail varchar(100) not null,
	createtime int default '0' not null,
	constraint shop_user_userid_uindex
		unique (userid)
)
;

create index shop_user__username_userpasswd
	on shop_user (username, userpasswd)
;

create index shop_user__useremail_userpasswd
	on shop_user (useremail, userpasswd)
;

alter table shop_profile
	add constraint shop_profile_userid
		foreign key (userid) references yii.shop_user (userid)
;

create table testuser
(
	id int auto_increment
		primary key,
	username varchar(32) not null,
	password char(32) not null,
	constraint testuser_id_uindex
		unique (id)
)
;

