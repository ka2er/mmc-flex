create table test (
  test_id            INTEGER NOT NULL PRIMARY KEY,
  test_text   VARCHAR(100)
);

create table video_codec(
	id integer not null primary key,
	name varchar(100)
);

create table audio_codec(
	id integer not null primary key,
	name varchar(100)
);

create table lang(
	id integer not null primary key,
	name varchar(100)
);

create table quality(
	id integer not null primary key,
	name varchar(100)
);

