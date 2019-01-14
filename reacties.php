<html>
<head>
    <meta charset="UTF-8">
    <title>Reacties weergave</title>
</head>
<body>
    <table>
    <?php
        $db = new PDO('mysql:host=localhost;dbname=reacties','pmauser','123');
        $query = "SELECT reacties.id, personen.naam, personen.email, reacties.reactie, reacties.datum
        FROM personen, reacties
        WHERE reacties.persoon_id = personen.id;
        ORDER BY reacties.datum";
        $result = $db->query($query);

        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr><td>van <a href='mailto:" . $row["email"] . "'>" . $row["naam"] . "</a></td>
            <td>op " . $row["datum"] . "</td></tr>\n";
            echo "<tr><td colspan='2'>" . $row['reactie'] . "</td></tr>\n";
            echo "<tr><td colspan='2'><a href='verwijder.php?reactie_id=" . $row["id"] . "'>Verwijder   </td></tr>\n";
            
        }
    ?>
    </table>
</body>
</html>
