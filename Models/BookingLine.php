<?php

/**
 * BookingLine Model
 */

 /*
 -- 		BookingLine
CREATE TABLE IF NOT EXISTS bookingLine (
	id            INTEGER         PRIMARY KEY AUTOINCREMENT,
	idBooking     INTEGER,
	libelle       VARCHAR(250),
	quantity      INTEGER,
	htPrice       FLOAT,
	FOREIGN KEY (idBooking) REFERENCES booking(id)
);
*/

class BookingLine implements Model
{
    public $id;
    public $idBooking;
    public $libelle;
    public $quantity;
    public $htPrice;

    /**
     * BookingLine constructor
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
        $this->idBooking = $array['idBooking'];
        $this->libelle = $array['libelle'];
        $this->quantity = $array['quantity'];
        $this->htPrice = $array['htPrice'];
    }

    /**
     * Save bookingLine in database
     */
    public function save()
    {
        if ($this->id != null) {
            $bdd = new Bdd();
            $sqlUpdateBookingLine = "UPDATE bookingLine SET idBooking = $this->idBooking, libelle = '$this->libelle', quantity = $this->quantity, htPrice = $this->htPrice WHERE id = $this->id";
            $bdd->execute($sqlUpdateBookingLine);
        } else {
            $sqlInsertBookingLine = "INSERT INTO bookingLine (idBooking, libelle, quantity, htPrice) VALUES ($this->idBooking, '$this->libelle', $this->quantity, $this->htPrice)";
            $bdd = new Bdd();
            $bdd->execute($sqlInsertBookingLine);
            $this->id = self::lastInsertId();
        }
    }

    /**
     * Get all bookingLines
     */
    public static function getAll()
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM bookingLine";
        $result = $bdd->execute($sql);
        $bookingLines = [];

        foreach ($result as $row) {
            $bookingLine = new BookingLine();
            $bookingLine->arrayToEntity($row);
            $bookingLines[] = $bookingLine;
        }

        return $bookingLines;
    }

    /**
     * Get bookingLine by id
     * @param int $id
     */
    public static function getById($id)
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM bookingLine WHERE id = $id";
        $result = $bdd->execute($sql);
        $bookingLine = new BookingLine();
        $bookingLine->arrayToEntity($result[0]);
        return $bookingLine;
    }

    /**
     * Delete bookingLine in database
     */
    public function delete()
    {
        $db = new Bdd();
        $sql = "DELETE FROM bookingLine WHERE id = $this->id";
        $db->execute($sql);
    }

    /**
     * Get last insert id
     */
    static function lastInsertId()
    {
        $bdd = new Bdd();
        $sql = "SELECT MAX(id) AS id FROM bookingLine";
        $stmt = $bdd->execute($sql);
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        return $id['id'];
    }

}