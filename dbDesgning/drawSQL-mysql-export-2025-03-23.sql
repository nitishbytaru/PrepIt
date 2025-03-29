CREATE TABLE `users`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `users` ADD UNIQUE `users_email_unique`(`email`);
CREATE TABLE `goals`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `userid` BIGINT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `start_date` DATE NOT NULL,
    `end_date` DATE NOT NULL,
    `time_per_week` INT NOT NULL,
    `priority` ENUM('high', 'medium', 'low') NOT NULL DEFAULT 'high',
    `preferred_start_time` TIME NOT NULL,
    `preferred_end_time` TIME NOT NULL
);
CREATE TABLE `timeslots`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` BIGINT NOT NULL,
    `intervel` INT NOT NULL,
    `preferred_start_time` JSON NOT NULL,
    `preferred_end_time` JSON NOT NULL,
    `working_days` ENUM(
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday'
    ) NOT NULL,
    `compensation_days` ENUM(
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday'
    ) NOT NULL
);
ALTER TABLE
    `timeslots` ADD UNIQUE `timeslots_user_id_unique`(`user_id`);
CREATE TABLE `tasks`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `goal_id` BIGINT NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `planned_date` DATE NOT NULL,
    `planned_start_time` TIME NOT NULL,
    `planned_end_time` TIME NOT NULL,
    `actual_start_time` TIME NULL,
    `actual_end_time` TIME NULL,
    `status` ENUM(
        'pending',
        'completed',
        'dismissed',
        'postponed',
        'failed'
    ) NOT NULL
);
CREATE TABLE `postponed_tasks`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `original_task_id` BIGINT NOT NULL,
    `goal_id` INT NOT NULL,
    `original_date` DATE NOT NULL,
    `original_start_time` TIME NOT NULL,
    `original_end_time` TIME NOT NULL,
    `new_date` DATE NOT NULL,
    `new_start_time` TIME NOT NULL,
    `new_end_time` TIME NOT NULL,
    `reason` TEXT NOT NULL,
    `status` ENUM('completed', 'pending', 'failed') NOT NULL DEFAULT 'pending'
);
ALTER TABLE
    `goals` ADD CONSTRAINT `goals_userid_foreign` FOREIGN KEY(`userid`) REFERENCES `users`(`id`);
ALTER TABLE
    `timeslots` ADD CONSTRAINT `timeslots_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`);
ALTER TABLE
    `tasks` ADD CONSTRAINT `tasks_goal_id_foreign` FOREIGN KEY(`goal_id`) REFERENCES `goals`(`id`);
ALTER TABLE
    `postponed_tasks` ADD CONSTRAINT `postponed_tasks_original_task_id_foreign` FOREIGN KEY(`original_task_id`) REFERENCES `tasks`(`id`);
ALTER TABLE
    `postponed_tasks` ADD CONSTRAINT `postponed_tasks_goal_id_foreign` FOREIGN KEY(`goal_id`) REFERENCES `goals`(`id`);