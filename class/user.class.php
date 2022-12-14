<?php
class User {
    private $db;
    private int $ID;
    private string $login;
    private string $password;
    private string $firstName;
    private string $lastName;

    public function __construct(string $login, string $password) 
    {
        $this->login = $login;
        $this->password = $password;
        $this->firstName = "";
        $this->lastName = "";
        global $db;
        $this->db = &$db;
    }

    public function  __serialize(): array
    {
        return array(   
                        'ID' => $this->ID,
                        'login' => $this->login,
                        'password' => $this->password,
                        'firstName' => $this->firstName,
                        'lastName' => $this->lastName,
                    );
    }

    public function __unserialize(array $data): void
    {
        $this->ID = $data['ID'];
        $this->login = $data['login'];
        $this->password = $data['password'];
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
        global $db;
        $this->db = &$db;
    }
    
    /*public function isAuth() : bool {
        if(isset($this->id) && $this->id !=null)
            return true;
        else
            return false;
    }*/
    public function register() : bool {
        $passwordHash = password_hash($this->password, PASSWORD_ARGON2I);
        $query = "INSERT INTO user VALUES (NULL, ?, ?, ?, ?)";
        $preparedQuery = $this->db->prepare($query); 
        $preparedQuery->bind_param('ssss', $this->login, $passwordHash, 
                                            $this->firstName, $this->lastName);
        $result = $preparedQuery->execute();
        return $result;
    }

    public function login() : bool {
        $query = "SELECT * FROM user WHERE login = ? LIMIT 1";
        $preparedQuery = $this->db->prepare($query); 
        $preparedQuery->bind_param('s', $this->login);
        $preparedQuery->execute();
        $result = $preparedQuery->get_result();
        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $passwordHash = $row['password'];
            if(password_verify($this->password, $passwordHash)) {
                $this->ID = $row['ID'];
                $this->firstName = $row['firstName'];
                $this->lastName = $row['lastName'];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function setfirstName(string $firstName) {
        $this->firstName = $firstName;
    }
    public function setlastName(string $lastName) {
        $this->lastName = $lastName;
    }
    public function getName() : string {
        return $this->firstName . " " . $this->lastName;
    }

    public function save() : bool {
        $q = "UPDATE user SET
                firstName = ?,
                lastName = ?
                WHERE ID = ?";
        $preparedQuery = $this->db->prepare($q);
        $preparedQuery->bind_param("ssi", $this->firstName, $this->lastName, $this->ID);
        return $preparedQuery->execute();
    }
}
?>