<?xml version="1.0" encoding="utf-8"?>
<root>
<?php
header('Content-Type: text/xml', 'encoding: utf-8');

$item_number = $_GET["id"];
$row = 1;
if (($handle = fopen("test.csv", "r")) !== FALSE) {
    $headers = fgetcsv($handle, 0, ';' , '"');
    
    while (($data = fgetcsv($handle, 0, ";", '"')) !== FALSE) {
        #la variable $data contient la ligne complète, sous forme de tableau
        #$num compte le nombre de colonnes
        $num = count($data);
        
        if ($row == $item_number) {
            #echo "<p> $num champs à la ligne $row: <br /></p>\n";
            echo "  <item>\n";
    
            
            #Pour chaque valeur (cellule), on affiche le contenu précédé de l'entête correspondant
            for ($c=0; $c < $num; $c++) {
                echo "    <" . $headers[$c] . ">";
                echo $data[$c];
                echo "</" . $headers[$c] . ">\n";
        }
        echo "  </item>\n";
        }
        $row++;
    }
    fclose($handle);
}
?>

</root>

