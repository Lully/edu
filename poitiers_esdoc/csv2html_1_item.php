<html>
    <head>
            <meta charset="utf8">
    </head>
    <body>
<?php
$item_number = $_GET["id"];
$row = 1;
if (($handle = fopen("https://raw.githubusercontent.com/Lully/edu/master/poitiers_esdoc/liste_biblio.csv", "r")) !== FALSE) {
    
    while (($data = fgetcsv($handle, 0, ";", '"')) !== FALSE) {
        #la variable $data contient la ligne complète, sous forme de tableau
        #$num compte le nombre de colonnes
		if ($item_number == $data[0]) {
			echo "<div style='border-bottom: solid 1px grey; padding-top: 10px;'>";
			echo "<p>ID : " . $data[0] . "<br/>";
			echo "<p>N° source : " . $data[1] . "<br/>";
			echo "<p>Titre : " . $data[2] . "<br/>";
			echo "<p>Auteur : " . $data[3] . "<br/>";
			echo "<p>Date : " . $data[4] . "<br/>";
			echo "<p>Editeur : " . $data[5] . "<br/>";
			echo "<p>Lieu : " . $data[6] . "<br/>";
			echo "</p>";
			echo "</div>";        
		}
        $row++;
    }
    fclose($handle);
}
?>
    </body>
</html>