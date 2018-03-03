<html>
    <head>
            <meta charset="utf8">
    </head>
    <body>
<?php
$item_number = $_GET["id"];
$row = 1;
if (($handle = fopen("test.csv", "r")) !== FALSE) {
    $headers = fgetcsv($handle, 0, ';' , '"');
    
    while (($data = fgetcsv($handle, 0, ";", '"')) !== FALSE) {
        #la variable $data contient la ligne complète, sous forme de tableau
        #$num compte le nombre de colonnes
        $num = count($data);
        
        #Condition : si le numéro de ligne correspond au paramètre ID dans l'en-tête
        if ($item_number == $row) {
            echo "<p> $num champs à la ligne $row: <br /></p>\n";
            
            #Pour chaque valeur (cellule), on affiche le contenu précédé de l'entête correspondant
            for ($c=0; $c < $num; $c++) {
                echo $headers[$c] . " : " . $data[$c] . "<br />\n";
            }
        }
        
        $row++;
        
    }
    fclose($handle);
}
?>
    </body>
</html>