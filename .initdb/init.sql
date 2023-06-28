drop table if exists `posts`;
create table `posts` (
  `id` bigint(20) unsigned not null auto_increment,
  `text` varchar(500) not null default '',
  `created_at` timestamp not null default CURRENT_TIMESTAMP,
  primary key (`id`)
);


