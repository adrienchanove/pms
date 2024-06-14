<?php
/**
 * Log Model
 */

 /*
 -- 		Log
CREATE TABLE IF NOT EXISTS log ( 
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	date          DATETIME 	  DEFAULT CURRENT_TIMESTAMP,
	message       TEXT
);
*/

class Log implements Model
{
    public $id;
    public $date;
    public $message;

    /**
     * Log constructor
     */
    public function __construct()
    {
        // default id = null (not exist in database)
        $this->id = null;
    }

    /**
     * Array to entity
     * Process array to entity
     * @param array $array
     */
    function arrayToEntity($array)
    {
        $this->id = $array['id'] ?? null;
        $this->date = $array['date'];
        $this->message = $array['message'];
    }

    /**
     * Save log in database
     */
    public function save()
    {
        if ($this->id != null) {
            $bdd = new Bdd();
            $sqlUpdateLog = "UPDATE log SET date = '$this->date', message = '$this->message' WHERE id = $this->id";
            $bdd->execute($sqlUpdateLog);
        } else {
            $sqlInsertLog = "INSERT INTO log (date, message) VALUES ('$this->date', '$this->message')";
            $bdd = new Bdd();
            $bdd->execute($sqlInsertLog);
            $this->id = self::lastInsertId();
        }
    }

    /**
     * Get all logs
     * @return array
     */
    public static function getAll()
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM log";
        $result = $bdd->execute($sql);
        $logs = [];
        foreach ($result as $log) {
            $logEntity = new Log();
            $logEntity->arrayToEntity($log);
            $logs[] = $logEntity;
        }
        return $logs;
    }

    /**
     * Get log by id
     * @param int $id
     * @return Log
     */
    public static function getById($id)
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM log WHERE id = $id";
        $result = $bdd->execute($sql);
        $log = new Log();
        $log->arrayToEntity($result[0]);
        return $log;
    }

    /**
     * Get last insert id
     * @return int
     */
    public static function lastInsertId()
    {
        $bdd = new Bdd();
        $sql = "SELECT Max(id) as id FROM log";
        $result = $bdd->execute($sql);
        return $result[0]['id'];
    }

}