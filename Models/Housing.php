<?php

/**
 * Housing Model
 * 
 */

class Housing implements Model
{
    public $id;
    public $name;
    public $description;
    public $typeId;

    /**
     * Housing constructor
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
        $this->description = $array['description'];
        $this->typeId = $array['type_id'];
    }

    /**
     * Save housing in database
     */
    public function save()
    {
        if ($this->id != null) {
            $bdd = new Bdd();
            $sqlUpdateHousing = "UPDATE Housing SET name = '$this->name', description = '$this->description', type_id = '$this->typeId' WHERE id = $this->id";
            $bdd->execute($sqlUpdateHousing);
        } else {
            $sqlInsertHousing = "INSERT INTO Housing (name, description, type_id) VALUES ('$this->name', '$this->description', '$this->typeId')";
            $bdd = new Bdd();
            $bdd->execute($sqlInsertHousing);
            $this->id = self::lastInsertId();
        }
    }

    /**
     * Get all housings
     */
    public static function getAll()
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM Housing";
        $result = $bdd->execute($sql);
        $housings = [];
        foreach ($result as $row) {
            $housing = new Housing();
            $housing->arrayToEntity($row);
            $housings[] = $housing;
        }
        return $housings;
    }

    /**
     * Get a record by id
     * @param int $id
     * @return Housing
     */
    static function getById($id)
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM Housing WHERE id = $id";
        $stmt = $bdd->execute($sql);
        $housingArray = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($housingArray == false) {
            return null;
        }
        $housing = new Housing();
        $housing->arrayToEntity($housingArray);
        return $housing;
    }

    /**
     * Get last insert id
     * @return int
     */
    static function lastInsertId()
    {
        $bdd = new Bdd();
        $sql = "SELECT MAX(id) as id FROM Housing";
        $stmt = $bdd->execute($sql);
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        return $id['id'];
    }

}
