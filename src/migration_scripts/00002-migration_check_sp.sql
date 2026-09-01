-- Pre-migration check stored procedure
-- How to call:
-- CALL pre_migration_check('migration_script.sql', 'pre_requisite_script.sql');

-- Inputs:
-- sqlFile: New migration script to be executed
-- sqlFilePreReq: Single pre-requisite migration script that MUST be executed beforehand

DELIMITER //
CREATE OR REPLACE PROCEDURE pre_migration_check
(
    IN sqlFile VARCHAR(255),
    IN sqlFilePreReq VARCHAR(255)
)
BEGIN
    SET @checkPassed = TRUE;
    SET @failureMessage = NULL;

    IF sqlFilePreReq IS NOT NULL
       AND NOT EXISTS (
           SELECT 1
           FROM utility_migrations
           WHERE migration_filename = sqlFilePreReq
       )
    THEN
        SET @checkPassed = FALSE;
        SET @failureMessage = CONCAT(
            'This script has a dependency on another script: ',
            sqlFilePreReq
        );
    END IF;
    
    IF EXISTS (
           SELECT 1
           FROM utility_migrations
           WHERE migration_filename = sqlFile
       ) 
    THEN
        SET @checkPassed = FALSE;
        SET @failureMessage = 'This script has already been executed';
    END IF;

    IF @checkPassed = FALSE THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = @failureMessage;
    END IF;
END; //
DELIMITER ;
