<?php

/**
 * User model
 */
class User implements Model
{
    public $id;
    public $username;
    public $password;
    public $is_admin;


    /**
     * User constructor.
     */
    public function __construct()
    {
        // default id = null (not exist in database)
        $this->id = null;
        $this->is_admin = false;
    }

    /**
     * Array to entity
     * Process array to entity
     * @param array $array
     */
    function arrayToEntity($array)
    {
        $this->id = $array['id'];
        $this->username = $array['username'];
        $this->password = $array['password'];
        $this->is_admin = $array['is_admin'];
    }

    /**
     * Save user in database
     */
    public function save()
    {

        if ($this->id != null) {
            $bdd = new Bdd();
            $sqlUpdateUser = "UPDATE User SET username = '$this->username', password = '$this->password' WHERE id = $this->id";
            $bdd->execute($sqlUpdateUser);
        } else {
            // check if username already exist
            $user = self::getByUsername($this->username);
            if ($user != null) {
                throw new Exception('Username already exist');
            }
            $sqlInsertUser = "INSERT INTO User (username, password, is_admin) VALUES ('$this->username', '$this->password', '$this->is_admin')";
            $bdd = new Bdd();
            $bdd->execute($sqlInsertUser);
            $this->id = self::lastInsertId();
        }
    }

    /**
     * Get a record by id
     * @param int $id
     * @return User
     */
    static function getById($id)
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM User JOIN UserGroupe ON User.id = UserGroupe.user_id WHERE User.id = $id";
        $stmt = $bdd->execute($sql);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user == false) {
            return null;
        }
        $usr = new User();
        $usr->arrayToEntity($user);
        return $usr;
    }

    /**
     * Get all records
     * @return User[]
     */
    static function getAll()
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM User";
        $stmt = $bdd->execute($sql);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($users == false) {
            return null;
        }
        $listUsers = [];
        foreach ($users as $user) {
            $usr = new User();
            $usr->arrayToEntity($user);
            $listUsers[] = $usr;
        }
        return $listUsers;
    }

    /**
     * Get a user by its username
     * @return User
     */
    static public function getByUsername($username)
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM User WHERE username = '$username'";
        $stmt = $bdd->execute($sql);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }
        $usr = new User();
        $usr->arrayToEntity($user);
        return $usr;
    }

    /**
     * Check if password is correct
     * @param $password
     * @return bool
     */
    public function checkPassword($password)
    {
        return $password == $this->password;
    }

    /**
     * lastInsertId
     * @return int
     */
    static public function lastInsertId()
    {
        $bdd = new Bdd();
        $sql = "SELECT MAX(id) FROM User";
        $stmt = $bdd->execute($sql);
        $id = $stmt->fetchColumn();
        return $id;
    }

    /**
     * Delete user
     */
    public function delete()
    {
        if ($this->id == null) {
            throw new Exception('User not exist in database');
        }
        $bdd = new Bdd();
        $sql = "DELETE FROM User WHERE id = $this->id";
        $bdd->execute($sql);
    }
}
