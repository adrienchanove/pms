<?php
/**
 * Pricing Model
 */

/*
-- 		Pricing
CREATE TABLE IF NOT EXISTS pricing ( 
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	price         FLOAT,
	idSeason      INTEGER,
	idHousing     INTEGER,
	FOREIGN KEY (idSeason) REFERENCES season(id),
	FOREIGN KEY (idHousing) REFERENCES housing(id)
);
*/

class Pricing implements Model
{
    public $id;
    public $price;
    public $idSeason;
    public $idHousing;

    /**
     * Pricing constructor
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
        $this->price = $array['price'];
        $this->idSeason = $array['idSeason'];
        $this->idHousing = $array['idHousing'];
    }

    /**
     * Save pricing in database
     */
    public function save()
    {
        if ($this->id != null) {
            $bdd = new Bdd();
            $sqlUpdatePricing = "UPDATE pricing SET price = $this->price, idSeason = $this->idSeason, idHousing = $this->idHousing WHERE id = $this->id";
            $bdd->execute($sqlUpdatePricing);
        } else {
            $sqlInsertPricing = "INSERT INTO pricing (price, idSeason, idHousing) VALUES ($this->price, $this->idSeason, $this->idHousing)";
            $bdd = new Bdd();
            $bdd->execute($sqlInsertPricing);
            $this->id = self::lastInsertId();
        }
    }

    /**
     * Get all pricings
     */
    public static function getAll()
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM pricing";
        $result = $bdd->execute($sql);
        $pricings = [];

        foreach ($result as $row) {
            $pricing = new Pricing();
            $pricing->arrayToEntity($row);
            $pricings[] = $pricing;
        }

        return $pricings;
    }

    /**
     * Get pricing by id
     * @param int $id
     */
    public static function getById($id)
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM pricing WHERE id = $id";
        $result = $bdd->execute($sql);
        $pricing = new Pricing();
        $pricing->arrayToEntity($result[0]);
        return $pricing;
    }

    /**
     * Delete pricing in database
     */
    public function delete()
    {
        $db = new Bdd();
        $sql = "DELETE FROM pricing WHERE id = $this->id";
        $db->execute($sql);
    }

    /**
     * get last insert id
     * @return int
     */
    static function lastInsertId()
    {
        $bdd = new Bdd();
        $sql = "SELECT MAX(id) as id FROM pricing";
        $stmt = $bdd->execute($sql);
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        return $id['id'];
    }
}