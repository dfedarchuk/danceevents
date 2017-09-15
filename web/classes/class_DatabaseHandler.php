<?php

class DatabaseHandler
{
    /**
     * The database singleton instance
     * @var PDO
     */
    private static $mainConnection = null;
    private static $domainConnection = null;

    public static function getMainConnection()
    {
        if (self::$mainConnection === null) {

            $username = _DIRECTORYDB_USER;
            $password = _DIRECTORYDB_PASS;
            $databaseHost = _DIRECTORYDB_HOST;
            $databaseName = _DIRECTORYDB_NAME;

            try {
                self::$mainConnection = new PDO("mysql:host={$databaseHost};dbname={$databaseName};charset=utf8",
                    $username, $password);
                self::$mainConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
            }
        }

        return self::$mainConnection;
    }

    public static function getDomainConnection($domainId = SELECTED_DOMAIN_ID)
    {
        if (self::$domainConnection === null) {
            try {

                $mainConnection = self::getMainConnection();
                $statement = $mainConnection->prepare("
                    SELECT
                        database_host     AS 'host',
                        database_port     AS 'port',
                        database_name     AS 'database',
                        database_username AS 'username',
                        database_password AS 'password',
                        status            AS 'status'
                    FROM Domain
                    WHERE id = :id
                ");

                $statement->execute([":id" => $domainId]);

                if ($result = $statement->fetchObject()) {
                    if (strtolower($result->status) == "a") {
                        self::$domainConnection = new PDO(
                            "mysql:host={$result->host};dbname={$result->database};charset=utf8",
                            $result->username,
                            $result->password
                        );
                        self::$domainConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }
                }

            } catch (PDOException $e) {
            }
        }

        return self::$domainConnection;
    }
}
