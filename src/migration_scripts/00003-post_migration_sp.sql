DELIMITER //
CREATE OR REPLACE PROCEDURE post_migration_sp
(
    IN sqlFile VARCHAR(255)
)
BEGIN
	INSERT INTO utility_migrations (migration_filename) VALUES (sqlFile);
END; //
DELIMITER ;