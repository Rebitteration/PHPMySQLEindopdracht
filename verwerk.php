<?php

    $correct = false;

       //filtering inputs
    if(
        isset($_POST['naam']) && $_POST['naam'] != '' &&
        isset($_POST['email']) && $_POST['email'] != '' &&
        isset($_POST['reactie']) && $_POST['reactie'] != ''
    ){
        $naam = filter_var($_POST['naam'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $reactie = filter_var($_POST['reactie'], FILTER_SANITIZE_STRING);
        $correct = true;
    }
    
    //processing inputs

    //Was alles correct ingevuld? if
    if($correct) { // Opslaan!

        $db = new PDO('mysql:host=localhost;dbname=reacties', 'pmauser','123');

        $query = "SELECT id FROM personen WHERE name = ? AND email = ?";
        $stmt = $db->prepare($query);
        $stmt->execute(array($naam, $email));

        if($stmt->rowCount() > 0)
        {
            // If person-exists, row is database, persoon_id is row['id']
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $persoon_id = $row['id'];
        }else
        {
            $query = "INSERT INTO personen(naam,email) VALUES (?,?)";
            $stmt = $db->prepare($query);
            $stmt->execute(array($naam,$email));
                //Vraag de ID van de zojuist toegevoegde persoon op
            $persoon_id = $db->lastInsertId();
        }

        // Voeg de reactie toe in de tabel reacties. Gebruik de ID van de zojuist toegevoegde persoon
        $query = "INSERT INTO reacties(persoon_id, reactie, datum) VALUES (?,?,?)";
        $stmt = $db->prepare($query);
        $stmt->execute(array($persoon_id,$reactie, date('Y-m-d H:i:s')));


        echo "<br /><br />Bovenstaande informatie is opgeslagen!<br />\n";
    } else{
     // Er is ergens een foute waarde ingevoerd, geef de bezoeker de

        echo "<br /><br />Er is een foute waarde ingevoerd, <a href=\"javascript:history.back();\">ga terug</a>.<br />\n";
    }
?>

