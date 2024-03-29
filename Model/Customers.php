<?php

namespace RMS;

require_once __DIR__ . '/../Model/Base.php';

//password: defaultpassword 
class Customers extends Base
{
    protected $ds;
    private $limit = 10;
    protected $base_url;


    function __construct()
    {
        $base = new Base();
        $this->base_url = $base->base_url;
        $this->ds = $base->ds;
    }


    /**
     * to check if the username already exists
     *
     * @param string $username
     * @return boolean
     */
    public function isUsernameExists($username)
    {
        $query = 'SELECT * FROM Customers where username = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $resultArray = $this->ds->select($query, $paramType, $paramValue);
        $count = 0;
        if (is_array($resultArray)) {
            $count = count($resultArray);
        }
        if ($count > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * to check if the email already exists
     *
     * @param string $email
     * @return boolean
     */
    public function isEmailExists($email)
    {
        $query = 'SELECT * FROM Customers where email = ?';
        $paramType = 's';
        $paramValue = array(
            $email
        );
        $resultArray = $this->ds->select($query, $paramType, $paramValue);
        $count = 0;
        if (is_array($resultArray)) {
            $count = count($resultArray);
        }
        if ($count > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * to signup / register a user
     *
     * @return string[] registration status message
     */
    public function registerUser()
    {
        $response = null;
        $isUsernameExists = $this->isUsernameExists($_POST["username"]);
        $isEmailExists = $this->isEmailExists($_POST["email"]);
        if ($isUsernameExists) {
            $response = array(
                "status" => "error",
                "message" => "Username already exists."
            );
        } else if ($isEmailExists) {
            $response = array(
                "status" => "error",
                "message" => "Email already exists."
            );
        } else {
            if (!empty($_POST["password"])) {

                // PHP's password_hash is the best choice to use to store passwords
                // do not attempt to do your own encryption, it is not safe
                $hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
            }
            $query = 'INSERT INTO Customers (username, password, email) VALUES (?, ?, ?)';
            $paramType = 'sss';
            $paramValue = array(
                $_POST["username"],
                $hashedPassword,
                $_POST["email"]
            );
            $memberId = $this->ds->insert($query, $paramType, $paramValue);
            if (!empty($memberId)) {
                $response = array(
                    "status" => "success",
                    "message" => "You have registered successfully."
                );
            }
        }
        return $response;
    }

    public function getUser($username)
    {
        $query = 'SELECT * FROM Customers where username = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $memberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $memberRecord;
    }

    public function getAllUsers()
    {
        $query = 'SELECT * FROM Customers';
        $memberRecord = $this->ds->select($query);
        return $memberRecord;
    }

    public function loginUser()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $loginPassword = 0;
        $memberRecord = $this->getUser($username);

        if (!empty($memberRecord)) {
            $hashedPassword = $memberRecord[0]["password"];
            //verify password
            if (password_verify($password, $hashedPassword)) {
                $loginPassword = 1;
            }
        }

        if ($loginPassword == 1) {
            $_SESSION['username'] = $memberRecord[0]["username"];
            $_SESSION['userId'] = $memberRecord[0]["id"];
            $_SESSION['isLoggedIn'] = true;
            session_write_close();
            $url = $this->base_url . "/menu";
            header("Location: $url");
            exit();
        } else {
            $loginStatus = "Invalid username or password.";
            return $loginStatus;
        }
    }

    protected function validate($username, $password)
    {
        if (empty($username) && empty($password)) {
            return "Username & password are empty";
        } else if (empty($username)) {
            return "Username is empty";
        } else if (empty($password)) {
            return "Password is empty";
        }
        return true;
    }

    public function logoutUser()
    {
        session_destroy();
        $url = $this->base_url . "/login";
        header("Location: $url");
        exit();
    }

    public function searchCustomer($name)
    {
        $name = '%' . $name . '%';
        $query = "SELECT * from Customers WHERE username LIKE ?";
        $paramType = 's';
        $paramValue = array($name);
        $menus = $this->ds->select($query, $paramType, $paramValue);
        return json_encode($menus, JSON_PRETTY_PRINT);
    }
}
