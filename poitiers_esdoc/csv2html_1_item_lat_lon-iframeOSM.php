<html>
    <head>
            <meta charset="utf8">
    </head>
    <body>
<?php
$item_number = $_GET["id"];
$row = 1;

function curl_get_contents($url)
{
  $ch = curl_init();
  curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}


function geocode($address){
    // url encode the address
    $address = urlencode($address);
    $url = "http://nominatim.openstreetmap.org/?format=json&addressdetails=1&q={$address}&format=json&limit=1";
    // get the json response
    $resp_json = curl_get_contents($url);
    // decode the json
    $resp = json_decode($resp_json, true);
	$lat = $resp[0]['lat'];
	$lon = $resp[0]['lon'];
    return array($lat,$lon);
}

if (($handle = fopen("https://raw.githubusercontent.com/Lully/edu/master/poitiers_esdoc/liste_biblio.csv", "r")) !== FALSE) {
    
    while (($data = fgetcsv($handle, 0, ";", '"')) !== FALSE) {
        #la variable $data contient la ligne complète, sous forme de tableau
        #$num compte le nombre de colonnes
		if ($item_number == $data[0]) {
		$place = $data[6];
		echo "<div style='border-bottom: solid 1px grey; padding-top: 10px;'>";
		echo "<p>ID : " . $data[0] . "<br/>\n";
		echo "<p>N° source : " . $data[1] . "<br/>\n";
		echo "<p>Titre : " . $data[2] . "<br/>\n";
		echo "<p>Auteur : " . $data[3] . "<br/>\n";
		echo "<p>Date : " . $data[4] . "<br/>\n";
		echo "<p>Editeur : " . $data[5] . "<br/>\n";
		echo "<p>Lieu : " . $place . "<br/>\n";
		echo "</p>";
		$url = "https://nominatim.openstreetmap.org/search?q=" . urlencode($data[6]) . "&amp;format=json&amp;polygon=1&amp;addressdetails=1";
		echo "<p><a href='$url'>Lien OpenStreetMap</a></p>\n";
		// get the json response
		list($lat,$lon) = geocode($place);
		echo "<p>$lat - $lon</p>";
		echo "<iframe width='425' height='350' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='http://www.openstreetmap.org/export/embed.html?bbox=-6.987304687500001%2C42.21224516288584%2C9.843750000000002%2C50.62507306341437&amp;layer=mapnik&amp;marker=$lat%2C$lon' style='border: 1px solid black'></iframe><br/><small><a href='https://www.openstreetmap.org/?mlat=$lat&amp;mlon=$lon#map=6/46.582/1.428'>Afficher une carte plus grande</a></small>";
		echo "</div>";
		}
        
        $row++;
    }
    fclose($handle);
}
?>
    </body>
</html>