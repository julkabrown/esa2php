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
$todoliste = json_decode(file_get_contents("index.json"));
echo '<pre>';
print_r($todoliste);
echo '</pr>';


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
        /*
            Die beiden folgenden Listeneinträge <li></li> sind als Beispiel hier eingefügt.
            Sie müssen eine Schleife bauen, die alle vorhandenen Waren schreibt.
            In der Schleife ist dann nur ein Listeneintrag, den anderen können Sie löschen.
            Bei jedem Listeneintrag ist dann die ID oder der Zähler der Ware anzugeben.
            Außerdem muss die Menge und der Name der Ware in den <span>-Tags ausgegeben werden.
            Eine foreach-Schleife wird im Chat erklärt. Weitere Möglichkeiten: for oder while
        */

        // Schleife Beginn mit Bedingung einfügen

        ?>
        <li>
            <a href="index.php?action=mark&id=<?php /* echo $i */ ;?>" class="done" title="Ware als eingekauft markieren"></a>
            <span>Menge 1</span>
            <span>Ware 1</span>
            <a href="index.php?action=delete&id=" class="delete" title="Ware aus Liste löschen">löschen</a>
        </li>
        <li>
            <a href="index.php?action=mark&id=" class="done checked" title="Ware als eingekauft markieren"></a>
            <span>Menge 2</span>
            <span>Ware 2</span>
            <a href="index.php?action=delete&id=" class="delete" title="Ware aus Liste löschen">löschen</a>
        </li>
        <?php

$arr = array();

$arr[] = array("Name" => "Bananen", "Menge" => 2, "markiert" => 1);
$arr[] = array("Name" => "Erdbeeren", "Menge" => 3, "markiert" => 0);
$arr[] = array("Name" => "Eier", "Menge" => 6, "markiert" => 0);
$arr[] = array("Name" => "Tomaten", "Menge" => 5, "markiert" => 1);


for($i = 0; $i < count($arr) ; $i++) {
?>
      <li>
        <a href="index.php?action=mark&id=<?php echo $i;?>" class="done <?php if($arr[$i]["markiert"] == 1) echo "checked";?>" title="Ware als eingekauft markieren">Markieren</a>
        <span><?php echo $arr[$i]["Menge"];?> </span>
        <span><?php echo $arr[$i]["Name"];?> <?php if($arr[$i]["markiert"] == 1) echo "checked";?></span>
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
        <input type="text" placeholder="Text für neue Ware" name="Ware">
        <input type="submit" value="hinzufügen">
    </form>
</main>
<footer>
    <p>Name, Vorname - Hochschule</p>
</footer>
</body>
</html>
<?php
?>
