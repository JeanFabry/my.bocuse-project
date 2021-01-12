<?php 
session_start();

//----------------------BASE DE DONNEE COONEXION-----------------------------
include('secret.php');


    try{
        $bdd= new PDO("mysql:host=localhost;dbname=MyBocus;charset=utf8", "$user", "$pwd", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    catch (Exception $e)
    {
    die('Erreur : ' . $e->getMessage());
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBocuse</title>
    <link rel="stylesheet" href="style.css">
</head>

<body id="loginpage">
    <section class="header">
        <div class="logincontainer">
            <div class="titre_soustitre">
                <h1 class="titre">Welcome to your MyBocuse space</h1>
                <h2 class="soustitre">please sign in to enter the website.</h2>
                <a href="user.php">TEST</a>
            </div>
            <div>
            <?php
            if(isset($_POST['email']) && isset($_POST['password'])){
                $request = $bdd->prepare('SELECT email, password FROM Students WHERE email = ?') or die(print_r($bdd->errorInfo()));
                $request->execute([
                    $_POST['email']  
                ]);
                $data = $request->fetch(); 
                
            if(!empty($data)){
            if(password_verify($_POST['password'], $data['password'])){ // attention
                $_SESSION['SessionOK'] = true;
                $_SESSION['email'] = $data['email'];

            }
            }
        }

if($_SESSION){
    header("Location: ./welcome.php");

}else{
    include("./form.php");
}
?>

            </div>
        </div>
        <div class="images">
            <img src="./assets/img/loginimage.jpg" alt="" width="500px" height="730px">
        </div>
    </section>
</body>

</html>