<?php
/**
 * Season Model
 */


/*
-- 		Season
CREATE TABLE IF NOT EXISTS season ( 
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	name          VARCHAR(250),
	startMonth    INTEGER,
	endMonth      INTEGER
);
*/
class Season implements Model
{
    public $id;
    public $name;
    public $startMonth;
    public $endMonth;

    /**
     * Season constructor
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
        $this->name = $array['name'];
        $this->startMonth = $array['startMonth'];
        $this->endMonth = $array['endMonth'];
    }

    /**
     * Save season in database
     */
    public function save()
    {
        if ($this->id != null) {
            $bdd = new Bdd();
            $sqlUpdateSeason = "UPDATE season SET name = '$this->name', startMonth = $this->startMonth, endMonth = $this->endMonth WHERE id = $this->id";
            $bdd->execute($sqlUpdateSeason);
        } else {
            $sqlInsertSeason = "INSERT INTO season (name, startMonth, endMonth) VALUES ('$this->name', $this->startMonth, $this->endMonth)";
            $bdd = new Bdd();
            $bdd->execute($sqlInsertSeason);
            $this->id = self::lastInsertId();
        }
    }

    /**
     * Get all seasons
     */
    public static function getAll()
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM season";
        $result = $bdd->execute($sql);
        $seasons = [];
        foreach ($result as $row) {
            $season = new Season();
            $season->arrayToEntity($row);
            $seasons[] = $season;
        }
        return $seasons;
    }
    

    /**
     * Delete season in database
     */
    public function delete()
    {
        $db = new Bdd();
        $sql = "DELETE FROM season WHERE id = $this->id";
        $db->execute($sql);
    }

    /**
     * Get season by id
     * @param int $id
     * @return Season
     */
    public static function getById($id)
    {
        $db = new Bdd();
        $sql = "SELECT * FROM season WHERE id = $id";
        $stmt = $db->execute($sql);
        $season = new Season();
        $season->arrayToEntity($stmt[0]);
        return $season;
    }

    /**
     * Get last insert id
     * @return int
     */
    static function lastInsertId()
    {
        $db = new Bdd();
        $sql = "SELECT MAX(id) as id FROM season";
        $stmt = $db->execute($sql);
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        return $id['id'];
    }

}