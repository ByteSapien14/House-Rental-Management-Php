<?php
class User
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function loginTenant($username, $password)
    {
        $sql = "SELECT * FROM tenant WHERE email=? AND pwd=? LIMIT 1";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $query = "SELECT fname FROM tenant WHERE email=? AND pwd=? LIMIT 1";
            $stmt = mysqli_prepare($this->conn, $query);
            mysqli_stmt_bind_param($stmt, "ss", $username, $password);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $data = mysqli_fetch_assoc($res);
            $name = $data['fname'];

            return $name;
        }

        return false;
    }

    public function loginOwner($username, $password)
    {
        $sql = "SELECT * FROM owner WHERE email=? AND pwd=? LIMIT 1";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $query = "SELECT fname FROM owner WHERE email=? AND pwd=? LIMIT 1";
            $stmt = mysqli_prepare($this->conn, $query);
            mysqli_stmt_bind_param($stmt, "ss", $username, $password);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $data = mysqli_fetch_assoc($res);
            $name = $data['fname'];

            return $name;
        }

        return false;
    }
}
class Authentication
{
    public static function login($user, $username, $password, $role)
    {
        if ($role == "tenant") {
            $name = $user->loginTenant($username, $password);
        } else {
            $name = $user->loginOwner($username, $password);
        }

        if ($name) {
            $_SESSION['username'] = $name;
            $_SESSION['ltype'] = $role;
            $_SESSION['email'] = $username;
            header('location:home.php');
        } else {
            echo "<script type='text/javascript'>alert('You Have Entered Incorrect Details! Login Failed')
            window.location.href='index.php';
            </script>";
        }
    }  
}

session_start();
include("connection.php");

if (isset($_GET['loginrent'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];
    $role = $_GET["role"];

    $user = new User($conn);
    Authentication::login($user, $username, $password, $role);
}

?>
