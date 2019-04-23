create table post(
	pid integer auto_increment,
	uid integer,
	titel varchar(100),
	description varchar(2200),
	link varchar(32),

	anzahl smallint,
	einhet varchar(7),
	gewicht decimal(8,2),

	score int,
	likes int,
	comment int, 
	primary key (pid),
	foreign key (uid) references user on delete cascade
)engine = innodb;

create table user(
	uid integer auto_increment,
	hashpsw varchar(100) not null,
	uname varchar(100) not null,
	email varchar(100) not null,
	description varchar(2200),

	location varchar(10),
	tel varchar(100),
	vname varchar(100),
	nname varchar(100),

	created datetime,
	modified datetime,
	permission int,
 
	primary key (uid),
)engine = innodb;

create table vote(

	pid integer,
	vote tinyint,
	uid integer,
	
	primary key (pid, uid),
	foreign key (uid) references user on delete cascade,
	foreign key (pid) references post on delete cascade
)engine = innodb;

create table like(
	
	pid integer,
	uid integer,
	
	primary key (pid, uid),
	foreign key (uid) references user on delete cascade,
	foreign key (pid) references post on delete cascade
)engine = innodb;

create table comment(
	
	cid integer auto_increment,
	pid integer,
	uid integer,

	titel varchar(100),
	descreption varchar(2200),
	
	primary key (pid, uid, cid),
	foreign key (uid) references user on delete cascade,
	foreign key (pid) references post on delete cascade
)engine = innodb;

create table reply(
	
	cid integer,
	replyid integer,
	
	primary key (replyid, cid),
	foreign key (cid) references comment on delete cascade,
	foreign key (replyid) references comment on delete cascade
)engine = innodb;

create table tag(
	
	tid integer auto_increment,

	name varchar(100),
	descreption varchar(2200),
	
	primary key (tid),
)engine = innodb;

create table tagalias(
	
	tid integer,

	alias varchar(100),
	
	primary key (tid),
	foreign key (tid) references tag on delete cascade
)engine = innodb;

create table taged(
	
	pid integer,
	tid integer,
	
	primary key (tid, uid),
	foreign key (uid) references user on delete cascade,
	foreign key (tid) references tag on delete cascade
)engine = innodb;

create table filter(
	
	fid integer auto_increment,

	name varchar(100),
	descreption varchar(2200),
	
	primary key (fid),
)engine = innodb;

create table filteredtag(
	
	fid integer,
	tid integer,
	
	primary key (fid, tid),
	foreign key (fid) references filter on delete cascade,
	foreign key (tid) references tag on delete cascade
)engine = innodb;