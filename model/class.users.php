<?php
include_once 'db.php';

class users extends Db
{
    public function usersLogin($username, $password)
    {
        try {
            $sql = "SELECT * FROM users WHERE username = :username";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($count == 1 && !empty($row)) {
                // Verify password
                $hashed_password = $row['password'];
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, login successful
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['fname'] = $row['first_name'];
                    $_SESSION['lname'] = $row['last_name'];
                    $_SESSION['role'] = $row['role'];
                    unset($row['password']);
                    return $row;
                } else {
                    // Password is incorrect, login failed
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // echo "ERROR" . $e->getMessage();
            return false;
        }
    }
    public function usersRegister($username, $password, $email, $firstName, $lastName)
    {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try {
            $sql = "INSERT INTO users (username,password,email,first_name,last_name) VALUES (:username,:password,:email,:fname,:lname)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":fname", $firstName, PDO::PARAM_STR);
            $stmt->bindParam(":lname", $lastName, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count == 1) {
                return true;
            }
        } catch (PDOException $e) {
            // echo "ERROR" . $e->getMessage();
            return false;
        }
    }
    public function deleteUser($id)
    {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count == 1) {
                return true;
            }
        } catch (PDOException $e) {
            // echo "ERROR" . $e->getMessage();
            return false;
        }
    }

    public function isLoggedIn()
    {
        if (!empty($_SESSION['username'])) {
            return true;
        } else {
            return false;
        }
    }
    // public function usersLogout()
    // {
    //     session_destroy();
    //     unset($_SESSION['username']);
    //     unset($_SESSION['email']);
    //     unset($_SESSION['password']);
    //     unset($_SESSION['fname']);
    //     unset($_SESSION['lname']);
    //     unset($_SESSION['role']);
    //     return true;
    // }
}
// $user = new users();
// print_r($user->usersLogin('admin', 'admin'));
// echo $user->usersRegister('test1', 'test1', 'test1@@email.com', 'test', '01');
// echo $_SESSION['username'];
// echo $_SESSION['email'];
// echo $_SESSION['fname'];
// echo $_SESSION['lname'];
// echo $_SESSION['role'];
// echo $user->isLoggedIn();
