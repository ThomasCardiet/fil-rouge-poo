DROP TABLE IF EXISTS `polls`;
DROP TABLE IF EXISTS `poll_responses`;

CREATE TABLE `polls`
(
    `id`        INT AUTO_INCREMENT,
    `title`     TEXT                                 NULL,
    `author_id` INT                                  NULL,
    `icon`     TEXT                                 NULL,
    CONSTRAINT `polls_id_uindex`
        UNIQUE (`id`),
    CONSTRAINT `polls_users_id_fk`
        FOREIGN KEY (`author_id`) REFERENCES `poo_exo`.`users` (`id`)
);

ALTER TABLE `polls`
    ADD PRIMARY KEY (`id`);

CREATE TABLE `poll_responses`
(
    `id`      INT AUTO_INCREMENT
        PRIMARY KEY,
    `poll_id` INT  NULL,
    `content` TEXT NULL,
    `votes`   INT  NULL,
    CONSTRAINT `poll_responses_polls_id_fk`
        FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`)
);

