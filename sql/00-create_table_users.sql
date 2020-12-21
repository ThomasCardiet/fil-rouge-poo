DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `id`        INT                        NOT NULL,
    `username`  TEXT                       NOT NULL COLLATE `utf8mb4_bin`,
    `email`     TEXT                       NOT NULL COLLATE `utf8mb4_bin`,
    `password`  TEXT(60)                   NOT NULL COLLATE `ascii_bin`
) ENGINE = InnoDB
  DEFAULT CHARSET = `utf8`
  COLLATE = `utf8_bin`;

ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `users_id_uindex` (`id`),
    ADD UNIQUE KEY `users_email_uindex` (`email`),
    MODIFY `id` INT NOT NULL AUTO_INCREMENT;

COMMIT;
