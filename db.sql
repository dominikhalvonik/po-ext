-- -----------------------------------------------------
-- Table `portalove_ext`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portalove_ext`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(60) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `image` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portalove_ext`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portalove_ext`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cat_name` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cat_name_UNIQUE` (`cat_name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portalove_ext`.`posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portalove_ext`.`posts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `post_name` VARCHAR(150) NOT NULL,
  `perex` VARCHAR(255) NOT NULL,
  `content` TEXT NULL,
  `created_at` DATETIME NULL,
  `image` VARCHAR(255) NOT NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`, `users_id`),
  INDEX `fk_posts_users_idx` (`users_id` ASC),
  CONSTRAINT `fk_posts_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `portalove_ext`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portalove_ext`.`categories_has_posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portalove_ext`.`categories_has_posts` (
  `categories_id` INT NOT NULL,
  `posts_id` INT NOT NULL,
  PRIMARY KEY (`categories_id`, `posts_id`),
  INDEX `fk_categories_has_posts_posts1_idx` (`posts_id` ASC),
  INDEX `fk_categories_has_posts_categories1_idx` (`categories_id` ASC),
  CONSTRAINT `fk_categories_has_posts_categories1`
    FOREIGN KEY (`categories_id`)
    REFERENCES `portalove_ext`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_categories_has_posts_posts1`
    FOREIGN KEY (`posts_id`)
    REFERENCES `portalove_ext`.`posts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `portalove_ext`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `portalove_ext`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `content` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NULL,
  `posts_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`, `posts_id`, `users_id`),
  INDEX `fk_comments_posts1_idx` (`posts_id` ASC),
  INDEX `fk_comments_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_comments_posts1`
    FOREIGN KEY (`posts_id`)
    REFERENCES `portalove_ext`.`posts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `portalove_ext`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;