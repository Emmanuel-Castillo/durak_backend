SET @sqlFile = 'REPLACE_ME.sql';
SET @sqlFilePreReq = '00001-initial_db_migration.sql';

CALL pre_migration_check(@sqlFile, @sqlFilePreReq);

-- ENTER SQL HERE

CALL post_migration_sp(@sqlFile);