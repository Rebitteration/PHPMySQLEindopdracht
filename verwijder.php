<html>
<head>
    <meta charset="utf-8">
    <title>Verwijderd</title>
</head>

<body>
<?php
// validatie van de input: int?
if(isset($_GET['reactie_id']) && filter_var($_GET['reactie_id'], FILTER_VALIDATE_INT))
{
    $reactie_id = [$_GET['reactie_id']];

    $db = new PDO('mysql:host=localhost;dbname=reacties','pmauser','123');

    $query = "DELETE FROM reacties WHERE id = ? ";
    $stmt = $db->prepare($query);
    $stmt->execute($reactie_id);
    echo 'De reactie is verwijderd!<br>';
    echo 'Ga terug naar de <a href="reacties.php">reacties</a>.<br>';
}else
{
    echo "Ongeldige aanvraag";
}
?>

</body>

</html>