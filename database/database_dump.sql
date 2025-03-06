-- CREATE TABLE IF NOT EXISTS "users" ("id" integer primary key autoincrement not null, "name" varchar not null, "email" varchar not null, "email_verified_at" datetime, "password" varchar not null, "is_admin" tinyint(1) not null default '0', "remember_token" varchar, "created_at" datetime, "updated_at" datetime);
INSERT INTO users VALUES(1,'Pemba Tamang','pemba@gmail.com',NULL,'$2y$12$zTS7Vyqp65I8/EqeiVRC1eTTfz/b/TyPPKdO7lXutApgaN7fguExS',1,NULL,'2024-10-03 04:26:27','2024-10-03 04:26:27');
INSERT INTO users VALUES(2,'Hom Bahadur Thapa Magar','test@gmail.com',NULL,'$2y$12$50bAOdXZyhyGMq96YJUGXehdNKyFtMsIE/kjd2m47V6yTC6ITpxOa',0,NULL,'2024-10-03 12:38:00','2024-10-03 12:38:00');
INSERT INTO users VALUES(3,'testing testing','testesta@gmail.com',NULL,'$2y$12$VMzATpHd2Wi23p4xia/21.G3wq687rCiADWZuc27nmNXigwzWafES',0,NULL,'2024-10-09 08:05:02','2024-10-09 08:05:02');

-- CREATE TABLE IF NOT EXISTS "exam_questions" ("id" integer primary key autoincrement not null, "question_number" text not null, "question_type" varchar check ("question_type" in ('text', 'image', 'audio')) not null, "question" text not null, "answer_type" varchar check ("answer_type" in ('text', 'image', 'audio')) not null, "option1" text not null, "option2" text not null, "option3" text not null, "option4" text not null, "correct_answer" text not null, "set" text not null, "created_at" datetime, "updated_at" datetime, "heading" varchar);
INSERT INTO exam_questions VALUES(1,'set_1_1','text','What is the admin name?','text','Pemba_option_1','Nma_option_2','Bom_option_3','Laxmi_option_4','option_1','set_1','2024-10-03 04:27:55','2024-10-03 04:27:55','Question 1 test.');
INSERT INTO exam_questions VALUES(2,'set_1_2','image','1727929757.jpg','text','Battlefield_option_1','Dating_option_2','Travel_option_3','Eating_option_4','option_1','set_1','2024-10-03 04:29:17','2024-10-03 04:29:17','Choose option according to image');
INSERT INTO exam_questions VALUES(3,'set_1_3','audio','1727930180.wav','text','bye bye_option_1','hello hello_option_2','Hello bye_option_3','hello world_option_4','option_4','set_1','2024-10-03 04:36:20','2024-10-03 04:36:20','Listen to audio, and choose option.');
INSERT INTO exam_questions VALUES(4,'set_2_1','text','fds','text','dsf_option_1','df_option_2','df_option_3','adf_option_4','option_1','set_2','2024-10-03 13:19:23','2024-10-03 13:19:23','fad');
INSERT INTO exam_questions VALUES(6,'set_1_4','audio','1728124158.wav','text','fsdf','fda','dfa','fsd','option_2','set_1','2024-10-05 03:43:24','2024-10-05 10:29:18','dfadsf');
INSERT INTO exam_questions VALUES(7,'set_1_5','text','fa','text','dsf_option_1','dfa_option_2','f_option_3','sf_option_4','option_1','set_1','2024-10-05 03:44:13','2024-10-05 03:44:13','PEMB');
INSERT INTO exam_questions VALUES(8,'set_1_55','text','fds','text','sdf_option_1','fd_option_2','fd_option_3','fs_option_4','option_1','set_1','2024-10-05 03:45:34','2024-10-05 03:45:34','df');
INSERT INTO exam_questions VALUES(9,'set_5_1','image','1728180827.jpg','text','s_option_1','s_option_2','s_option_3','s_option_4','option_1','set_5','2024-10-06 02:13:47','2024-10-06 02:13:47','test');
INSERT INTO exam_questions VALUES(10,'set_5_2','image','1728181078.jpg','text','ad_option_1','df_option_2','fa_option_3','fs_option_4','option_2','set_5','2024-10-06 02:17:58','2024-10-06 02:17:58','da');
INSERT INTO exam_questions VALUES(11,'set_5_3','image','1728181170.png','text','df_option_1','df_option_2','d_option_3','dsf_option_4','option_1','set_5','2024-10-06 02:19:31','2024-10-06 02:19:31','hello');
INSERT INTO exam_questions VALUES(12,'set_5_4','image','1728181256.png','text','df_option_1','fsd_option_2','df_option_3','fa_option_4','option_1','set_5','2024-10-06 02:20:57','2024-10-06 02:20:57','dfa');
INSERT INTO exam_questions VALUES(13,'set_7_1','image','1728181495.png','image','1728181495_option_1.png','1728181495_option_2.png','1728181495_option_3.png','1728181496_option_4.png','option_1','set_7','2024-10-06 02:24:56','2024-10-06 02:24:56','dfad');
INSERT INTO exam_questions VALUES(14,'set_7_2','image','1728181721.jpg','image','1728181722_option_1.jpg','1728181722_option_2.jpg','1728181722_option_3.jpg','1728181722_option_4.jpg','option_1','set_7','2024-10-06 02:28:42','2024-10-06 02:28:42','sdf');
INSERT INTO exam_questions VALUES(15,'set_7_3','image','1728181880.jpg','image','1728181880_option_1.jpg','1728181880_option_2.jpg','1728181880_option_3.jpg','1728181880_option_4.jpg','option_3','set_7','2024-10-06 02:31:20','2024-10-06 02:31:20','fsd');
INSERT INTO exam_questions VALUES(16,'set_7_4','image','1728182009.jpg','image','1728182009_option_1.jpg','1728182009_option_2.jpg','1728182009_option_3.jpg','1728182009_option_4.jpg','option_1','set_7','2024-10-06 02:33:29','2024-10-06 02:33:29','df');
INSERT INTO exam_questions VALUES(18,'set_100_2','image','1728987558.png','text','safsd_option_1','dfas_option_2','ffd_option_3','fda_option_4','option_2','set_100','2024-10-15 10:19:19','2024-10-15 10:19:19','fsd');

-- CREATE TABLE IF NOT EXISTS "answers" ("id" integer primary key autoincrement not null, "candidate_id" integer not null, "question_num" text not null, "answer" text not null, "is_correct" tinyint(1) not null default '0', "set" text not null, "exam_start_time" datetime not null, "created_at" datetime, "updated_at" datetime, foreign key("candidate_id") references "users"("id") on delete cascade, foreign key("question_num") references "exam_questions"("question_number") on delete cascade);
INSERT INTO answers VALUES(1,1,'set_1_1','option_1',1,'set_1','2024 -10 -03 10:21:38','2024-10-03 04:36:47','2024-10-03 04:36:47');
INSERT INTO answers VALUES(2,1,'set_1_2','option_1',1,'set_1','2024 -10 -03 10:21:38','2024-10-03 04:36:51','2024-10-03 04:36:51');
INSERT INTO answers VALUES(3,1,'set_1_3','option_4',1,'set_1','2024 -10 -03 10:21:38','2024-10-03 04:36:57','2024-10-03 04:36:57');
INSERT INTO answers VALUES(4,1,'set_1_1','option_1',1,'set_1','2024 -10 -03 12:25:28','2024-10-03 06:40:38','2024-10-03 06:40:38');
INSERT INTO answers VALUES(5,1,'set_1_1','option_1',1,'set_1','2024 -10 -03 12:26:32','2024-10-03 06:41:35','2024-10-03 06:41:35');
INSERT INTO answers VALUES(6,1,'set_1_2','option_3',0,'set_1','2024 -10 -03 12:26:32','2024-10-03 06:54:27','2024-10-03 06:54:27');
INSERT INTO answers VALUES(7,1,'set_1_1','option_2',0,'set_1','2024 -10 -03 12:44:43','2024-10-03 06:59:49','2024-10-03 06:59:49');
INSERT INTO answers VALUES(8,1,'set_1_1','option_1',1,'set_1','2024 -10 -03 12:45:17','2024-10-03 07:00:20','2024-10-03 07:00:20');
INSERT INTO answers VALUES(9,1,'set_1_1','option_2',0,'set_1','2024 -10 -03 12:46:28','2024-10-03 07:01:30','2024-10-03 07:01:30');
INSERT INTO answers VALUES(10,1,'set_1_1','option_1',1,'set_1','2024 -10 -03 12:47:13','2024-10-03 07:02:17','2024-10-03 07:02:17');
INSERT INTO answers VALUES(11,1,'set_1_1','option_1',1,'set_1','2024 -10 -03 12:47:33','2024-10-03 07:02:34','2024-10-03 07:02:34');
INSERT INTO answers VALUES(12,1,'set_1_1','option_1',1,'set_1','2024 -10 -03 12:47:55','2024-10-03 07:02:59','2024-10-03 07:02:59');
INSERT INTO answers VALUES(13,1,'set_1_1','option_1',1,'set_1','2024 -10 -03 12:50:00','2024-10-03 07:05:02','2024-10-03 07:05:02');
INSERT INTO answers VALUES(14,1,'set_1_1','option_1',1,'set_1','2024 -10 -03 12:50:26','2024-10-03 07:05:28','2024-10-03 07:05:28');
INSERT INTO answers VALUES(15,1,'set_1_1','option_3',0,'set_1','2024 -10 -03 12:50:39','2024-10-03 07:05:41','2024-10-03 07:05:42');
INSERT INTO answers VALUES(16,1,'set_1_2','option_1',1,'set_1','2024 -10 -03 12:50:39','2024-10-03 07:05:44','2024-10-03 07:05:44');
INSERT INTO answers VALUES(17,1,'set_1_1','option_1',1,'set_1','2024 -10 -03 12:52:22','2024-10-03 07:07:24','2024-10-03 07:07:24');
INSERT INTO answers VALUES(18,1,'set_1_1','option_2',0,'set_1','2024 -10 -03 12:54:06','2024-10-03 07:09:09','2024-10-03 07:09:09');
INSERT INTO answers VALUES(19,1,'set_1_1','option_2',0,'set_1','2024 -10 -03 12:55:13','2024-10-03 07:10:16','2024-10-03 07:10:16');
INSERT INTO answers VALUES(20,1,'set_1_1','option_3',0,'set_1','2024 -10 -03 12:55:45','2024-10-03 07:10:46','2024-10-03 07:10:46');
INSERT INTO answers VALUES(21,1,'set_1_1','option_2',0,'set_1','2024 -10 -03 12:56:56','2024-10-03 07:12:07','2024-10-03 07:12:07');
INSERT INTO answers VALUES(22,1,'set_1_1','option_2',0,'set_1','2024 -10 -03 12:58:15','2024-10-03 07:13:17','2024-10-03 07:13:17');
INSERT INTO answers VALUES(23,1,'set_1_1','option_2',0,'set_1','2024 -10 -03 12:59:13','2024-10-03 07:14:19','2024-10-03 07:14:19');
INSERT INTO answers VALUES(24,1,'set_1_1','option_1',1,'set_1','2024 -10 -03 13:03:39','2024-10-03 07:18:40','2024-10-03 07:18:40');
INSERT INTO answers VALUES(25,1,'set_1_1','option_1',1,'set_1','2024 -10 -03 13:06:31','2024-10-03 07:21:33','2024-10-03 07:21:33');
INSERT INTO answers VALUES(26,1,'set_1_1','option_1',1,'set_1','2024 -10 -03 15:34:02','2024-10-03 09:49:04','2024-10-03 09:49:04');
INSERT INTO answers VALUES(27,1,'set_1_1','option_2',0,'set_1','2024 -10 -03 15:34:53','2024-10-03 09:49:55','2024-10-03 09:49:55');
INSERT INTO answers VALUES(28,1,'set_1_2','option_3',0,'set_1','2024 -10 -03 15:36:00','2024-10-03 09:51:03','2024-10-03 09:51:03');
INSERT INTO answers VALUES(29,1,'set_1_3','option_1',0,'set_1','2024 -10 -03 15:36:00','2024-10-03 09:51:05','2024-10-03 09:51:05');
INSERT INTO answers VALUES(30,1,'set_1_1','option_1',1,'set_1','2024 -10 -03 15:37:35','2024-10-03 09:52:37','2024-10-03 09:52:37');
INSERT INTO answers VALUES(31,1,'set_1_2','option_2',0,'set_1','2024 -10 -03 15:37:35','2024-10-03 09:52:42','2024-10-03 09:52:42');
INSERT INTO answers VALUES(32,1,'set_1_3','option_4',1,'set_1','2024 -10 -03 15:37:35','2024-10-03 09:52:44','2024-10-03 09:52:44');
INSERT INTO answers VALUES(33,1,'set_1_1','option_3',0,'set_1','2024 -10 -03 15:38:43','2024-10-03 09:53:45','2024-10-03 09:53:45');
INSERT INTO answers VALUES(34,1,'set_1_2','option_1',1,'set_1','2024 -10 -03 15:38:43','2024-10-03 09:53:47','2024-10-03 09:53:47');
INSERT INTO answers VALUES(35,1,'set_1_3','option_4',1,'set_1','2024 -10 -03 15:38:43','2024-10-03 09:53:48','2024-10-03 09:53:48');
INSERT INTO answers VALUES(36,2,'set_1_1','option_1',1,'set_1','2024 -10 -04 08:19:47','2024-10-04 02:34:53','2024-10-04 02:34:53');
INSERT INTO answers VALUES(37,2,'set_1_2','option_1',1,'set_1','2024 -10 -04 08:19:47','2024-10-04 02:34:56','2024-10-04 02:35:00');
INSERT INTO answers VALUES(38,2,'set_1_3','option_4',1,'set_1','2024 -10 -04 08:19:47','2024-10-04 02:35:13','2024-10-04 02:35:13');
INSERT INTO answers VALUES(39,2,'set_1_1','option_3',0,'set_1','2024 -10 -04 08:22:47','2024-10-04 02:38:36','2024-10-04 02:38:52');
INSERT INTO answers VALUES(40,2,'set_1_2','option_2',0,'set_1','2024 -10 -04 08:22:47','2024-10-04 02:38:40','2024-10-04 02:38:40');
INSERT INTO answers VALUES(41,2,'set_1_3','option_3',0,'set_1','2024 -10 -04 08:22:47','2024-10-04 02:38:44','2024-10-04 02:38:44');
INSERT INTO answers VALUES(42,2,'set_1_1','option_1',1,'set_1','2024 -10 -04 10:26:14','2024-10-04 04:42:52','2024-10-04 04:42:52');
INSERT INTO answers VALUES(43,2,'set_1_2','option_2',0,'set_1','2024 -10 -04 10:26:14','2024-10-04 04:42:57','2024-10-04 04:42:57');
INSERT INTO answers VALUES(44,2,'set_1_1','',0,'set_1','2024 -10 -04 11:12:54','2024-10-04 05:28:01','2024-10-04 05:28:01');
INSERT INTO answers VALUES(45,2,'set_1_2','',0,'set_1','2024 -10 -04 11:12:54','2024-10-04 05:28:04','2024-10-04 05:28:04');
INSERT INTO answers VALUES(46,2,'set_1_3','',0,'set_1','2024 -10 -04 11:12:54','2024-10-04 05:28:07','2024-10-04 05:28:07');
INSERT INTO answers VALUES(48,2,'set_1_1','',0,'set_1','2024 -10 -04 11:13:27','2024-10-04 05:28:29','2024-10-04 05:28:29');
INSERT INTO answers VALUES(49,2,'set_1_2','',0,'set_1','2024 -10 -04 11:13:27','2024-10-04 05:28:30','2024-10-04 05:28:30');
INSERT INTO answers VALUES(50,2,'set_1_3','',0,'set_1','2024 -10 -04 11:13:27','2024-10-04 05:28:32','2024-10-04 05:28:32');
INSERT INTO answers VALUES(51,2,'set_1_1','option_1',1,'set_1','2024 -10 -04 11:15:04','2024-10-04 05:30:06','2024-10-04 05:30:06');
INSERT INTO answers VALUES(52,2,'set_1_1','option_2',0,'set_1','2024 -10 -04 11:15:17','2024-10-04 05:30:20','2024-10-04 05:30:20');
INSERT INTO answers VALUES(53,2,'set_1_2','option_1',1,'set_1','2024 -10 -04 11:15:17','2024-10-04 05:30:21','2024-10-04 05:30:21');
INSERT INTO answers VALUES(54,2,'set_1_3','option_4',1,'set_1','2024 -10 -04 11:15:17','2024-10-04 05:30:23','2024-10-04 05:30:23');
INSERT INTO answers VALUES(56,2,'set_1_1','option_1',1,'set_1','2024 -10 -04 16:20:40','2024-10-04 10:36:27','2024-10-04 10:36:27');
INSERT INTO answers VALUES(57,2,'set_1_1','option_2',0,'set_1','2024 -10 -04 16:21:38','2024-10-04 10:36:46','2024-10-04 10:36:46');
INSERT INTO answers VALUES(58,2,'set_1_1','option_1',1,'set_1','2024 -10 -05 10:13:35','2024-10-05 04:28:38','2024-10-05 04:28:38');
INSERT INTO answers VALUES(59,2,'set_1_2','option_1',1,'set_1','2024 -10 -05 10:14:54','2024-10-05 04:29:58','2024-10-05 04:29:58');
INSERT INTO answers VALUES(60,2,'set_1_1','option_2',0,'set_1','2024 -10 -05 21:00:46','2024-10-05 15:16:17','2024-10-05 15:16:17');
INSERT INTO answers VALUES(61,2,'set_1_5','option_2',0,'set_1','2024 -10 -05 21:00:46','2024-10-05 15:16:20','2024-10-05 15:16:20');
INSERT INTO answers VALUES(62,2,'set_1_2','option_1',1,'set_1','2024 -10 -06 07:01:06','2024-10-06 01:16:39','2024-10-06 01:16:42');
INSERT INTO answers VALUES(63,2,'set_7_1','option_2',0,'set_7','2024 -10 -09 06:59:26','2024-10-09 01:14:29','2024-10-09 01:14:29');
INSERT INTO answers VALUES(64,2,'set_7_2','option_2',0,'set_7','2024 -10 -09 06:59:26','2024-10-09 01:14:31','2024-10-09 01:14:31');
INSERT INTO answers VALUES(65,2,'set_7_3','option_1',0,'set_7','2024 -10 -09 06:59:26','2024-10-09 01:14:33','2024-10-09 01:14:33');
INSERT INTO answers VALUES(66,2,'set_7_1','option_1',1,'set_7','2024 -10 -09 13:56:37','2024-10-09 08:12:00','2024-10-09 08:12:00');
INSERT INTO answers VALUES(67,2,'set_1_1','option_2',0,'set_1','2024 -10 -15 16:08:03','2024-10-15 10:23:05','2024-10-15 10:23:05');
INSERT INTO answers VALUES(68,2,'set_1_2','option_2',0,'set_1','2024 -10 -15 16:08:03','2024-10-15 10:23:07','2024-10-15 10:23:07');
INSERT INTO answers VALUES(69,2,'set_1_3','option_3',0,'set_1','2024 -10 -15 16:08:03','2024-10-15 10:23:08','2024-10-15 10:23:08');

-- CREATE TABLE IF NOT EXISTS "exam_scores" ("id" integer primary key autoincrement not null, "candidate_id" integer not null, "exam_start_time" datetime not null, "korean_score" integer not null, "created_at" datetime, "updated_at" datetime, "set_number" varchar, foreign key("candidate_id") references "users"("id") on delete cascade);
INSERT INTO exam_scores VALUES(1,1,'2024 -10 -03 10:21:38',3,'2024-10-03 04:37:01','2024-10-03 04:37:01','set_1');
INSERT INTO exam_scores VALUES(2,1,'2024 -10 -03 12:25:28',1,'2024-10-03 06:40:40','2024-10-03 06:40:40','set_1');
INSERT INTO exam_scores VALUES(3,1,'2024 -10 -03 12:26:32',1,'2024-10-03 06:41:37','2024-10-03 06:41:37','set_1');
INSERT INTO exam_scores VALUES(4,1,'2024 -10 -03 12:26:32',1,'2024-10-03 06:50:24','2024-10-03 06:50:24','set_1');
INSERT INTO exam_scores VALUES(5,1,'2024 -10 -03 12:26:32',1,'2024-10-03 06:54:24','2024-10-03 06:54:24','set_1');
INSERT INTO exam_scores VALUES(6,1,'2024 -10 -03 12:26:32',2,'2024-10-03 06:54:28','2024-10-03 06:54:28','set_1');
INSERT INTO exam_scores VALUES(7,1,'2024 -10 -03 12:44:43',1,'2024-10-03 06:59:51','2024-10-03 06:59:51','set_1');
INSERT INTO exam_scores VALUES(8,1,'2024 -10 -03 12:45:17',1,'2024-10-03 07:00:21','2024-10-03 07:00:21','set_1');
INSERT INTO exam_scores VALUES(9,1,'2024 -10 -03 12:46:28',1,'2024-10-03 07:01:31','2024-10-03 07:01:31','set_1');
INSERT INTO exam_scores VALUES(10,1,'2024 -10 -03 12:46:28',1,'2024-10-03 07:01:56','2024-10-03 07:01:56','set_1');
INSERT INTO exam_scores VALUES(11,1,'2024 -10 -03 12:46:28',1,'2024-10-03 07:01:57','2024-10-03 07:01:57','set_1');
INSERT INTO exam_scores VALUES(12,1,'2024 -10 -03 12:46:28',1,'2024-10-03 07:01:57','2024-10-03 07:01:57','set_1');
INSERT INTO exam_scores VALUES(13,1,'2024 -10 -03 12:46:28',1,'2024-10-03 07:01:57','2024-10-03 07:01:57','set_1');
INSERT INTO exam_scores VALUES(14,1,'2024 -10 -03 12:46:28',1,'2024-10-03 07:01:58','2024-10-03 07:01:58','set_1');
INSERT INTO exam_scores VALUES(15,1,'2024 -10 -03 12:46:28',1,'2024-10-03 07:01:58','2024-10-03 07:01:58','set_1');
INSERT INTO exam_scores VALUES(16,1,'2024 -10 -03 12:46:28',1,'2024-10-03 07:01:58','2024-10-03 07:01:58','set_1');
INSERT INTO exam_scores VALUES(17,1,'2024 -10 -03 12:46:28',1,'2024-10-03 07:01:58','2024-10-03 07:01:58','set_1');
INSERT INTO exam_scores VALUES(18,1,'2024 -10 -03 12:46:28',1,'2024-10-03 07:01:58','2024-10-03 07:01:58','set_1');
INSERT INTO exam_scores VALUES(19,1,'2024 -10 -03 12:46:28',1,'2024-10-03 07:01:58','2024-10-03 07:01:58','set_1');
INSERT INTO exam_scores VALUES(20,1,'2024 -10 -03 12:46:28',1,'2024-10-03 07:01:59','2024-10-03 07:01:59','set_1');
INSERT INTO exam_scores VALUES(21,1,'2024 -10 -03 12:46:28',1,'2024-10-03 07:01:59','2024-10-03 07:01:59','set_1');
INSERT INTO exam_scores VALUES(22,1,'2024 -10 -03 12:46:28',1,'2024-10-03 07:01:59','2024-10-03 07:01:59','set_1');
INSERT INTO exam_scores VALUES(23,1,'2024 -10 -03 12:46:28',1,'2024-10-03 07:01:59','2024-10-03 07:01:59','set_1');
INSERT INTO exam_scores VALUES(24,1,'2024 -10 -03 12:47:13',1,'2024-10-03 07:02:19','2024-10-03 07:02:19','set_1');
INSERT INTO exam_scores VALUES(25,1,'2024 -10 -03 12:47:33',1,'2024-10-03 07:02:36','2024-10-03 07:02:36','set_1');
INSERT INTO exam_scores VALUES(26,1,'2024 -10 -03 12:47:55',1,'2024-10-03 07:03:01','2024-10-03 07:03:01','set_1');
INSERT INTO exam_scores VALUES(27,1,'2024 -10 -03 12:50:00',1,'2024-10-03 07:05:05','2024-10-03 07:05:05','set_1');
INSERT INTO exam_scores VALUES(28,1,'2024 -10 -03 12:50:26',1,'2024-10-03 07:05:30','2024-10-03 07:05:30','set_1');
INSERT INTO exam_scores VALUES(29,1,'2024 -10 -03 12:50:39',2,'2024-10-03 07:05:46','2024-10-03 07:05:46','set_1');
INSERT INTO exam_scores VALUES(30,1,'2024 -10 -03 12:52:22',1,'2024-10-03 07:07:26','2024-10-03 07:07:26','set_1');
INSERT INTO exam_scores VALUES(31,1,'2024 -10 -03 12:54:06',1,'2024-10-03 07:09:11','2024-10-03 07:09:11','set_1');
INSERT INTO exam_scores VALUES(32,1,'2024 -10 -03 12:55:13',1,'2024-10-03 07:10:18','2024-10-03 07:10:18','set_1');
INSERT INTO exam_scores VALUES(33,1,'2024 -10 -03 12:55:45',1,'2024-10-03 07:10:48','2024-10-03 07:10:48','set_1');
INSERT INTO exam_scores VALUES(34,1,'2024 -10 -03 12:56:56',1,'2024-10-03 07:12:09','2024-10-03 07:12:09','set_1');
INSERT INTO exam_scores VALUES(35,1,'2024 -10 -03 12:58:15',1,'2024-10-03 07:13:19','2024-10-03 07:13:19','set_1');
INSERT INTO exam_scores VALUES(36,1,'2024 -10 -03 12:59:13',1,'2024-10-03 07:14:21','2024-10-03 07:14:21','set_1');
INSERT INTO exam_scores VALUES(37,1,'2024 -10 -03 13:03:39',1,'2024-10-03 07:18:42','2024-10-03 07:18:42','set_1');
INSERT INTO exam_scores VALUES(38,1,'2024 -10 -03 13:06:31',1,'2024-10-03 07:21:34','2024-10-03 07:21:34','set_1');
INSERT INTO exam_scores VALUES(39,1,'2024 -10 -03 15:34:02',1,'2024-10-03 09:49:06','2024-10-03 09:49:06','set_1');
INSERT INTO exam_scores VALUES(40,1,'2024 -10 -03 15:34:53',1,'2024-10-03 09:49:56','2024-10-03 09:49:56','set_1');
INSERT INTO exam_scores VALUES(41,1,'2024 -10 -03 15:36:00',2,'2024-10-03 09:51:07','2024-10-03 09:51:07','set_1');
INSERT INTO exam_scores VALUES(42,1,'2024 -10 -03 15:37:35',3,'2024-10-03 09:52:46','2024-10-03 09:52:46','set_1');
INSERT INTO exam_scores VALUES(43,1,'2024 -10 -03 15:38:43',3,'2024-10-03 09:53:58','2024-10-03 09:53:58','set_1');
INSERT INTO exam_scores VALUES(44,2,'2024 -10 -04 08:19:47',3,'2024-10-04 02:35:22','2024-10-04 02:35:22','set_1');
INSERT INTO exam_scores VALUES(45,2,'2024 -10 -04 10:26:14',2,'2024-10-04 04:43:28','2024-10-04 04:43:28','set_1');
INSERT INTO exam_scores VALUES(46,2,'2024 -10 -04 11:12:54',4,'2024-10-04 05:28:10','2024-10-04 05:28:10','set_1');
INSERT INTO exam_scores VALUES(47,2,'2024 -10 -04 11:13:27',3,'2024-10-04 05:28:34','2024-10-04 05:28:34','set_1');
INSERT INTO exam_scores VALUES(48,2,'2024 -10 -04 11:15:04',1,'2024-10-04 05:30:07','2024-10-04 05:30:07','set_1');
INSERT INTO exam_scores VALUES(49,2,'2024 -10 -04 11:15:17',4,'2024-10-04 05:30:26','2024-10-04 05:30:26','set_1');
INSERT INTO exam_scores VALUES(50,2,'2024 -10 -04 16:20:40',1,'2024-10-04 10:36:33','2024-10-04 10:36:33','set_1');
INSERT INTO exam_scores VALUES(51,2,'2024 -10 -04 16:21:38',1,'2024-10-04 10:36:53','2024-10-04 10:36:53','set_1');
INSERT INTO exam_scores VALUES(52,2,'2024 -10 -05 10:13:35',1,'2024-10-05 04:28:43','2024-10-05 04:28:43','set_1');
INSERT INTO exam_scores VALUES(53,2,'2024 -10 -05 10:14:54',1,'2024-10-05 04:30:54','2024-10-05 04:30:54','set_1');
INSERT INTO exam_scores VALUES(54,2,'2024 -10 -05 21:00:46',2,'2024-10-05 15:16:22','2024-10-05 15:16:22','set_1');
INSERT INTO exam_scores VALUES(55,2,'2024 -10 -06 07:01:06',1,'2024-10-06 01:16:45','2024-10-06 01:16:45','set_1');
INSERT INTO exam_scores VALUES(56,2,'2024 -10 -09 06:59:26',3,'2024-10-09 01:14:34','2024-10-09 01:14:34','set_7');
INSERT INTO exam_scores VALUES(57,2,'2024 -10 -09 13:56:37',1,'2024-10-09 08:12:04','2024-10-09 08:12:04','set_7');
INSERT INTO exam_scores VALUES(58,2,'2024 -10 -15 16:08:03',3,'2024-10-15 10:23:19','2024-10-15 10:23:19','set_1');

-- CREATE TABLE IF NOT EXISTS "exam_routines" ("id" integer primary key autoincrement not null, "exam_date" date not null, "set" varchar not null, "created_at" datetime, "updated_at" datetime, "is_active" tinyint(1) not null default '1');
INSERT INTO exam_routines VALUES(7,'2024-10-03','set_1','2024-10-03 13:38:39','2024-10-03 13:38:39',1);
INSERT INTO exam_routines VALUES(8,'2024-10-04','set_2','2024-10-04 02:26:02','2024-10-04 02:28:43',0);
INSERT INTO exam_routines VALUES(9,'2024-10-04','set_1','2024-10-04 02:28:43','2024-10-04 02:29:58',0);
INSERT INTO exam_routines VALUES(10,'2024-10-04','set_2','2024-10-04 02:29:58','2024-10-04 02:30:12',0);
INSERT INTO exam_routines VALUES(11,'2024-10-04','set_1','2024-10-04 02:30:12','2024-10-04 10:18:35',0);
INSERT INTO exam_routines VALUES(12,'2024-10-04','set_1','2024-10-04 10:18:35','2024-10-04 10:30:20',0);
INSERT INTO exam_routines VALUES(13,'2024-10-04','set_1','2024-10-04 10:30:20','2024-10-04 10:30:20',1);
INSERT INTO exam_routines VALUES(14,'2024-10-05','set_1','2024-10-05 03:39:54','2024-10-05 03:39:54',1);
INSERT INTO exam_routines VALUES(15,'2024-10-06','set_1','2024-10-06 01:10:39','2024-10-06 02:20:11',0);
INSERT INTO exam_routines VALUES(16,'2024-10-06','set_5','2024-10-06 02:20:11','2024-10-06 02:25:37',0);
INSERT INTO exam_routines VALUES(17,'2024-10-06','set_7','2024-10-06 02:25:37','2024-10-06 02:34:03',0);
INSERT INTO exam_routines VALUES(18,'2024-10-06','set_7','2024-10-06 02:34:03','2024-10-06 02:34:03',1);
INSERT INTO exam_routines VALUES(19,'2024-10-08','set_1','2024-10-08 02:25:23','2024-10-08 02:25:23',1);
INSERT INTO exam_routines VALUES(20,'2024-10-09','set_7','2024-10-09 01:14:20','2024-10-09 01:14:20',1);
INSERT INTO exam_routines VALUES(21,'2024-10-15','set_1','2024-10-15 10:22:49','2024-10-15 10:22:49',1);
INSERT INTO exam_routines VALUES(22,'2024-12-18','set_1','2024-12-18 15:30:54','2024-12-18 15:30:54',1);

-- CREATE TABLE IF NOT EXISTS "students" ("id" integer primary key autoincrement not null, "name" varchar not null, "dob" date not null, "gender" varchar not null, "address" text not null, "contact_number" varchar not null, "email" varchar not null, "enrollment_date" date not null, "present_qualification" varchar not null, "father_name" varchar not null, "mother_name" varchar not null, "profession" varchar not null, "parents_phone_number" varchar not null, "profile_picture" varchar, "created_at" datetime, "updated_at" datetime, "total_amount_to_pay" numeric not null default '0', "is_korean" tinyint(1) not null default '0', "password" varchar);
INSERT INTO students VALUES(1,'Smriti Khadka','2004-05-25','F','Pokhara, Nepal','9807654321','smriti.khadka@yahoo.com','2023-08-20','Intermediate','Ganesh Khadka','Laxmi Khadka','Teacher','9803214567','profile2.jpg',NULL,'2024-12-18 13:29:52',0,1,'$2y$12$ek/fV0uoCUzR1O5U6hEXA.C8SAzkq85./TehSX9WljE2YnXyadBNa');
INSERT INTO students VALUES(3,'Bikash Tamang','2006-01-12','M','Chitwan, Nepal','9804567890','bikash.tamang@hotmail.com','2024-06-05','High School','Kamal Tamang','Maya Tamang','Farmer','9809876543',NULL,NULL,NULL,0,0,NULL);
INSERT INTO students VALUES(5,'Prakash Rai','2005-03-10','M','Biratnagar, Nepal','9803456789','prakash.rai@example.com','2024-02-01','High School','Dhan Rai','Meena Rai','Doctor','9808765431','profile5.jpg',NULL,NULL,0,0,NULL);
INSERT INTO students VALUES(6,'hero','2004-07-03','M','Sed eos sed labore d','927','hexyze@mailinator.com','1978-01-17','Dignissimos et dolor','Zena Curry','Brenda Lewis','Pariatur Excepteur','1234567890','1734355429.jpg','2024-12-16 13:13:54','2024-12-16 13:23:49',0,0,NULL);
INSERT INTO students VALUES(7,'Piper Reyes','1973-09-29','M','Sint ad commodi labo','162','kisysumuku@mailinator.com','2005-04-10','Eu molestiae laborum','Ferris Everett','Nola Roberts','Iusto sequi maxime v','1234567890',NULL,'2024-12-16 13:25:01','2024-12-16 13:25:01',0,0,NULL);
INSERT INTO students VALUES(8,'Sasha Long','1997-02-09','O','Perspiciatis enim m','883','ficup@mailinator.com','1974-06-23','Sunt repellendus D','Anika Ramirez','Stephen Benjamin','Perferendis odio qui','987643210','1734356165.jpg','2024-12-16 13:33:36','2024-12-16 13:36:05',0,0,NULL);
INSERT INTO students VALUES(9,'Rajesh Shrestha','2002-05-15','M','Kathmandu, Nepal','9801234567','rajesh.shrestha@example.com','2024-01-10','High School','Ramesh Shrestha','Sita Shrestha','Farmer','9807654321',NULL,NULL,NULL,0,0,NULL);
INSERT INTO students VALUES(11,'Bikash Thapa','2000-08-05','M','Chitwan, Nepal','9803456789','bikash.thapa@example.com','2024-03-05','Intermediate','Bishnu Thapa','Manisha Thapa','Businessman','9809876543',NULL,NULL,NULL,0,0,NULL);
INSERT INTO students VALUES(12,'Sunita KC','1999-07-10','F','Lalitpur, Nepal','9804567890','sunita.kc@example.com','2024-01-25','Bachelors Degree','Keshav KC','Mina KC','Nurse','9800987654',NULL,NULL,NULL,0,0,NULL);

-- CREATE TABLE IF NOT EXISTS "student_payments" ("id" integer primary key autoincrement not null, "student_id" integer not null, "payment_type" varchar not null, "amount" numeric not null, "payment_method" varchar not null, "payment_date" date not null, "transaction_id" varchar, "remarks" text, "created_at" datetime, "updated_at" datetime, foreign key("student_id") references "students"("id") on delete cascade);
INSERT INTO student_payments VALUES(1,5,'Admission Fee',5000,'Cash','2024-01-15',NULL,'Paid in full',NULL,NULL);
INSERT INTO student_payments VALUES(2,5,'Course Fee',15000,'Khalti','2024-02-10','TXN001234','First installment paid',NULL,NULL);
INSERT INTO student_payments VALUES(3,2,'Admission Fee',5000,'Bank Transfer','2024-02-25','TXN001567','Full payment',NULL,NULL);
INSERT INTO student_payments VALUES(4,3,'Admission Fee',5000,'Cash','2024-03-10',NULL,'Paid in full',NULL,NULL);
INSERT INTO student_payments VALUES(5,3,'Course Fee',10000,'Cash','2024-03-15',NULL,'Half paid',NULL,NULL);
INSERT INTO student_payments VALUES(6,12,'Admission Fee',5000,'Khalti','2024-01-30','TXN009876','Full payment',NULL,NULL);
INSERT INTO student_payments VALUES(7,3,'First initial',10000,'Khalti','2024-12-16','xfadf','sdfa','2024-12-16 15:28:01','2024-12-16 15:28:01');
INSERT INTO student_payments VALUES(8,2,'Hic doloribus libero',30,'In recusandae Perfe','1971-01-15','Sed pariatur Itaque','Cupiditate fugiat c','2024-12-16 15:50:15','2024-12-16 15:50:15');
INSERT INTO student_payments VALUES(9,2,'Voluptate rerum nihi',40,'Omnis placeat omnis','1999-02-19','Ab ipsum id quisqua','Harum atque eaque mi','2024-12-16 15:51:52','2024-12-16 15:51:52');
INSERT INTO student_payments VALUES(10,2,'Voluptate rerum nihi',40,'Omnis placeat omnis','1999-02-19','Ab ipsum id quisqua','Harum atque eaque mi','2024-12-16 15:52:28','2024-12-16 15:52:28');
INSERT INTO student_payments VALUES(11,2,'Commodi minima optio',42,'Ut sunt laboriosam','1986-12-16','Voluptate aute simil','Consequat Tempore','2024-12-16 15:52:37','2024-12-16 15:52:37');
INSERT INTO student_payments VALUES(12,2,'Voluptatem natus ani',83,'Deserunt ut porro co','2014-12-23','Quaerat non vero mai','Dolorum odit omnis i','2024-12-17 04:11:35','2024-12-17 04:11:35');
INSERT INTO student_payments VALUES(13,2,'Labore esse quod sus',78,'Ipsa voluptatem dis','1978-12-13','Eum possimus rerum','Quidem eum exercitat','2024-12-17 04:12:54','2024-12-17 04:12:54');
INSERT INTO student_payments VALUES(15,8,'Neque sed nihil ad m',3,'Veniam accusamus et','2005-09-03','Tempore commodi et','Quo vel in irure vol','2024-12-17 05:30:11','2024-12-17 05:30:11');
INSERT INTO student_payments VALUES(16,7,'Rem dolore aspernatu',63,'Recusandae Do ut di','1980-10-27','Beatae voluptate bla','Nostrud do eos ut ut','2024-12-17 05:34:00','2024-12-17 05:34:00');
INSERT INTO student_payments VALUES(17,11,'Cumque cupiditate co',31,'Perspiciatis impedi','1999-06-14','Itaque sint digniss','Veniam molestiae om','2024-12-18 12:25:49','2024-12-18 12:25:49');

COMMIT;
