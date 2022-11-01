-- -----------------------------------------------------
-- Data for table `user`
-- -----------------------------------------------------
START TRANSACTION;

INSERT INTO `user` (`id`,`pseudo`, `email`, `password`, `img`, `roles`, `created_at`, `updated_at`) VALUES (1, 'admin', 'admin@mail.fr', '$2y$10$Wu9LyPxOlv3dfSlZhDvQLuuu8agIsoG/Y7YQjyXCNctKvOrO4BSXq', DEFAULT, 2, DEFAULT, NULL),
(2, 'user', 'user@mail.fr', '$2y$10$Kr2iCL3ywK3paO1agjpT3uUOv6h.jyshrLe9gA2ZkAP.afXaNWqd.', DEFAULT, 1, DEFAULT, NULL),
(3, 'ameli', 'ameli@mail.fr', 'ameli', DEFAULT, 1, DEFAULT, NULL);

-- admin mdp crypt : $2y$10$Wu9LyPxOlv3dfSlZhDvQLuuu8agIsoG/Y7YQjyXCNctKvOrO4BSXq = admin
-- user mpd crypt : $2y$10$Kr2iCL3ywK3paO1agjpT3uUOv6h.jyshrLe9gA2ZkAP.afXaNWqd. = user

COMMIT;

-- -----------------------------------------------------
-- Data for table `category`
-- -----------------------------------------------------

INSERT INTO `category` (`id`,`name`, `color`, `img`, `created_at`, `updated_at`, `slug`) VALUES (1, 'nature', '#7AA95C', DEFAULT, DEFAULT, DEFAULT, 'nature'),
(2, 'musique', '#F0A1BF', DEFAULT, DEFAULT, DEFAULT, 'musique'),
(3, 'sport', '#7DC2A5', DEFAULT, DEFAULT, DEFAULT, 'sport'),
(4, 'animaux', '#f4a261', DEFAULT, DEFAULT, DEFAULT, 'animaux'),
(5, 'histoire', '#e9c46a', DEFAULT, DEFAULT, DEFAULT, 'histoire'),
(6, 'jeux vidéos', '#AFA4CE', DEFAULT, DEFAULT, DEFAULT, 'jeux-videos'),
(7, 'informatique', '#97999B', DEFAULT, DEFAULT, DEFAULT, 'informatique'),
(8, 'sciences', '#00A0B0', DEFAULT, DEFAULT, DEFAULT, 'sciences'),
(9, 'cinéma', '#BD3100', DEFAULT, DEFAULT, DEFAULT, 'cinema');

COMMIT;
