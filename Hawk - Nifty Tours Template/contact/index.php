<?php

//connect to database
try
{
  $pdo = new PDO('mysql:host=localhost;dbname=ironhawk_niftyinteg', 'ironhawk_niftyin', 'ntniftyinp0o9');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
  $error = 'Unable to connect to the database server. Please contact us by phone or email until we get this fixed. Thank You.';
  include 'error.html.php';
  exit();
}



//Begin insert query to write form data to database

if (array_key_exists('ntEmail', $_POST)) {

  //Variables from the contact form
  $ntName = $_POST['ntName'];
  $ntEmail = $_POST['ntEmail'];
  $ntDate = $_POST['ntDate'];
  $ntTour = $_POST['ntTour'];
  $ntMessage = $_POST['ntMessage'];

    try {
        $sql = 'INSERT INTO niftycontact SET
        name = :name,
        email = :email,
        date = :date,
        tour = :tour,
        message = :message';
        $s = $pdo->prepare($sql);
        $s->bindvalue(':name', $_POST['ntName']);
        $s->bindvalue(':email', $_POST['ntEmail']);
        $s->bindvalue(':date', $_POST['ntDate']);
        $s->bindvalue(':tour', $_POST['ntTour']);
        $s->bindvalue(':message', $_POST['ntMessage']);
        $s->execute();
        
   } 
    
    catch (PDOException $e) {
        $error = 'Error fetching content: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }
    include 'success.html.php';
} else {

    include 'contact.html.php';
}
