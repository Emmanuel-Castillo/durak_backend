-- Initial database migration script
-- Dependencies:
-- 1. Running MySQL server
-- 2. Database named 'durak_db' created

START TRANSACTION;
    CREATE TABLE utility_migrations (
        id INT PRIMARY KEY AUTO_INCREMENT,
        migration_filename VARCHAR(255) NOT NULL,
        applied_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE user_account (
        user_id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(20) NOT NULL,
        level INT DEFAULT 0,
        experience INT DEFAULT 0,
        created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
    );
        
    CREATE TABLE user_login (
        user_id INT NOT NULL,
        email VARCHAR(255) NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
    );

    ALTER TABLE user_account AUTO_INCREMENT = 100000;
    ALTER TABLE user_login ADD UNIQUE (email);

    ALTER TABLE user_login ADD CONSTRAINT
    FOREIGN KEY (user_id) REFERENCES user_account (user_id)
    ON DELETE CASCADE;

    INSERT INTO utility_migrations (migration_filename) VALUES ('20260901-initial_db_migration.sql');
COMMIT;
