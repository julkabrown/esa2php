<?php
/*
EA2 Grundgerüst

Hier im oberen Abschnitt der Datei können Sie die Verarbeitung der
$_GET oder $_POST Variablen durchführen und auf die verschiedenen
Aktionen reagieren.
Auch das Lesen und Schreiben der Werte in eine Datei kann hier oben stehen.
Das Behandeln einer Aktion startet i.d.R. mit einer if-Abfrage, um festzustellen, was geklickt wurde.

Sie benötigen folgende Aktionen:

Lesen der Waren aus der Datei (wenn bereits Waren vorhanden sind).
Hinzufügen einer neuen Ware (wenn Formular ausgefüllt).
Markieren einer Ware (wenn Link "markieren" geklickt).
Löschen  einer Ware (wenn Link "löschen" geklickt).
Schreiben aller Waren in die Datei (wird immer komplett neu geschrieben).


*/

$arr = array();

if(file_exists($FILENAME = 'index.json')) {
    $jsonIn = file_get_contents($FILENAME);
    $arr = json_decode($jsonIn, true);
}

if (!empty($_GET)) {    //prüfen ob GET nicht leer ist
    if ($_GET['action'] == 'delete') {  // prüfen ob Get Action delete übergeben wird
        array_splice($arr, $_GET['id'], 1); // entsprechendes arry löschen
    }


    if ($_GET['action'] == 'mark'){
        if ($arr[$_GET['id']]["completed"] == 0) {
            $arr[$_GET['id']]["completed"] = true;
            } else {
            $arr[$_GET['id']]["completed"] = false;

        }

        }

}


    if (!empty($_POST)) {
        $arr[] = array("Name" => $_POST["Name"],
            "Menge" => $_POST["Menge"],
            "completed" => false);

    }



$json = json_encode($arr, JSON_PRETTY_PRINT);
file_put_contents($FILENAME, $json);





/*
Ab hier erfolgt die HTML-Ausgabe
*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ISP - Gerüst der Einsendeaufgabe 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/main.css" />
</head>
<body>
<header>
    <h2>EA2 - Einkaufsliste</h2>
</header>
<main>
    <ul id="todolist">

  <?php

for($i = 0; $i < count($arr) ; $i++) {
?>
      <li>
        <a href="index.php?action=mark&id=<?php echo $i;?>" class="done <?php if($arr[$i]["completed"] == 1) echo "checked";?>" title="Ware als eingekauft markieren"></a>
        <span><?php echo $arr[$i]["Menge"];?> </span>
        <span><?php echo $arr[$i]["Name"];?> <?php if($arr[$i]["completed"] == 1) echo "checked";?></span>
        <a href="index.php?action=delete&id=<?php echo $i;?>" class="delete" title="Ware aus Liste löschen">löschen</a>
      </li>
<?php
}

// Schleife Ende einfügen
?>

    </ul>
    <div class="spacer"></div>
    <form id="add-todo" action="index.php" method="post">
        <input type="number" placeholder="Menge" name="Menge" Min="1" Max="10">
        <input type="text" placeholder="Text für neue Ware" name="Name">
        <input type="submit" value="hinzufügen">
    </form>
</main>
<footer>
    <p>Braun, Juliette - THB</p>
</footer>
</body>
</html>
<?php
?>
