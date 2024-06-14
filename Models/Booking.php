<?php

/**
 * Booking Model
 * 
 */

 /*
 -- 		Booking
CREATE TABLE IF NOT EXISTS booking ( 
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	name		  VARCHAR(250),
	nbPlaces      INTEGER,
	dateStart     DATE,
	dateEnd       DATE,
	idHousing     INTEGER,
	paid		  FLOAT,
	FOREIGN KEY (idHousing) REFERENCES housing(id)
);
*/

class Booking implements Model
{
    public $id;
    public $name;
    public $nbPlaces;
    public $idHousing;
    public $startDate;
    public $endDate;
    public $paid;

    /**
     * Booking constructor
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
        $this->nbPlaces = $array['nbPlaces'];
        $this->idHousing = $array['idHousing'];
        $this->startDate = $array['dateStart'];
        $this->endDate = $array['dateEnd'];
        $this->paid = $array['paid'];
    }

    /**
     * Save booking in database
     */
    public function save()
    {
        if ($this->id != null) {
            $bdd = new Bdd();
            $sqlUpdateBooking = "UPDATE booking SET name = '$this->name', nbPlaces = '$this->nbPlaces', idHousing = '$this->idHousing', dateStart = '$this->startDate', dateEnd = '$this->endDate', paid = '$this->paid' WHERE id = $this->id";
            $bdd->execute($sqlUpdateBooking);
        } else {
            $sqlInsertBooking = "INSERT INTO booking (name, nbPlaces, idHousing, dateStart, dateEnd, paid) VALUES ('$this->name', '$this->nbPlaces', '$this->idHousing', '$this->startDate', '$this->endDate', '$this->paid')";
            $bdd = new Bdd();
            $bdd->execute($sqlInsertBooking);
            $this->id = self::lastInsertId();
        }
    }

    /**
     * Get all bookings
     * @return array
     */
    public static function getAll()
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM booking";
        $result = $bdd->execute($sql);
        $bookings = [];
        foreach ($result as $row) {
            $booking = new Booking();
            $booking->arrayToEntity($row);
            $bookings[] = $booking;
        }
        return $bookings;
    }

    /**
     * Get booking by id
     * @param int $id
     * @return Booking
     */
    public static function getById($id)
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM booking WHERE id = $id";
        $result = $bdd->execute($sql);
        $booking = new Booking();
        $booking->arrayToEntity($result[0]);
        return $booking;
    }

    /**
     * Get last insert id
     * @return int
     */
    public static function lastInsertId()
    {
        $bdd = new Bdd();
        $sql = "SELECT MAX(id) AS id FROM booking";
        $stmt = $bdd->execute($sql);
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        return $id['id']; 
    }



    
}
