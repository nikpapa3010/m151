<?php 
require_once 'database.php';
require_once 'model/customermodel.php';

class CustomerRepository
{
    // database connection
    private $pdo = null;

    // ctor
    function __constructor()
    {

    }

    function getAll()
    {
        $sql = "SELECT * from customers order by id desc";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, "CustomerModel");
    }


    function delete()
    {
        
    if (!empty($_POST)) {
    
        $id = $_POST['id'];

        $pdo = Database::connect();
        $sql = "DELETE  from customers WHERE id = :id";
        $q = $pdo->prepare($sql);
        $q->execute(array(":id" => $id));
        Database::disconnect();
        header("Location: index.php");
  
    } 
    }


    function Read()
    {
                
        $id = null; 
        
        if (null==$id) 
        {
            header("Location: index.php");
        } 
        else 
        {
            // Query customer by id

            $pdo = Database::connect();
            $sql = "SELECT *  from customers WHERE id = :id";
            $q = $pdo->prepare($sql);
            $q->execute(array(":id" => $id));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();
        }
    }


    function Create()
    {
                
        if ( !empty($_POST)) 
        {
            // keep track validation errors
            $nameError = null;
            $emailError = null;
            $mobileError = null;

            // keep track post values
            $name = $_POST['name'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];

            // validate input
            $valid = true;
            if (empty($name)) {
                    $nameError = 'Please enter Name';
                    $valid = false;
            }

            if (empty($email)) {
                    $emailError = 'Please enter Email Address';
                    $valid = false;
            } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
                    $emailError = 'Please enter a valid Email Address';
                    $valid = false;
            }

            if (empty($mobile)) {
                    $mobileError = 'Please enter Mobile Number';
                    $valid = false;
            }

            // TODO
            // insert data
            
            if ($valid)
            {
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO customers (name, email, mobile) values(?,?,?)";
                $q = $pdo->prepare($sql);
                $q->execute(array($name,$email,$mobile));
                Database::disconnect();
                header("Location: index.php");
            }

        }
    }


    function Update()
    {
                
        $id = null;
        if (!empty($_GET['id'])) {
                $id = $_REQUEST['id'];
        }

        if ( null==$id ) {
                header("Location: index.php");
        }

        if (!empty($_POST)) 
        {
                // keep track validation errors
                $nameError = null;
                $emailError = null;
                $mobileError = null;

                // keep track post values
                $name = $_POST['name'];
                $email = $_POST['email'];
                $mobile = $_POST['mobile'];

                // validate input
                $valid = true;
                if (empty($name)) {
                        $nameError = 'Please enter Name';
                        $valid = false;
                }

                if (empty($email)) {
                        $emailError = 'Please enter Email Address';
                        $valid = false;
                } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
                        $emailError = 'Please enter a valid Email Address';
                        $valid = false;
                }

                if (empty($mobile)) {
                        $mobileError = 'Please enter Mobile Number';
                        $valid = false;
                }

                // update data
                if ($valid) 
                {
                        // TODO
                        // Update customer
            $pdo = Database::connect();
            $sql = "UPDATE customers SET name= :name, email= :email, mobile= :mobile WHERE id = :id";
            $q = $pdo->prepare($sql);
            $q->execute(array(":name" => $name, ":email" => $email, ":mobile" => $mobile ,":id" => $id));
                Database::disconnect();
                header("Location: index.php");
                }
        } else 
        {
                // TODO
                // Query customer by id
                $pdo = Database::connect();
                $sql = "SELECT * FROM customers where id = :id";
                $q = $pdo->prepare($sql);
                $q->execute(array(":id" => $id));
                $data = $q->fetch(PDO::FETCH_ASSOC);
                $name = $data['name'];
                $email = $data['email'];
                $mobile = $data['mobile'];
                Database::disconnect();

                
        }
    }
    

}
?>