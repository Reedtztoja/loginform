<?php
class User {
    private $db;
    private int $id;
    private string $login;
    private string $passwordHash;
    private string $firstName;
    private string $lastName;

    public function __construct(string $login, string $password) 
    {
        $this->login = $login;
        $this->password_hash = password_hash($password, PASSWORD_ARGON2I);
        global $db;
        $this->db = &$db;
    }
    
    public function isAuth() : bool {
        if(isset($this->id) && $this->id !=null)
            return true;
        else
            return false;
    }
    public function login() {
        $query = "SELECT + FROM user WHERE login = ? LIMIT 1";
        $preparedQuery = $this->db->prepare($query);
        $preparedQuery->bind_param('s', $this->login);
        $preparedQuery->execute();
        $result = $preparedQuery->get_result();
    }
    public function logout() {
        
    }
    public function register() {
        
    }
}
?>