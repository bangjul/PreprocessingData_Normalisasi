<?php
	$txt_file = file_get_contents('iris.txt');
	$rows = explode("\n", $txt_file);
	$dataset = array(array());
	$i=0;
	foreach($rows as $row => $data){
	    $row_data = explode(';', $data);

	    $dataset[$i]['a'] = $row_data[0];
	    $dataset[$i]['b'] = $row_data[1];
	    $dataset[$i]['c'] = $row_data[2];
	    $dataset[$i]['d'] = $row_data[3];
	    $i++;
	}

	//decimal scalling
	$pangkat1 = 0;
	$pangkat2 = 0;
	$pangkat3 = 0;
	$pangkat4 = 0;
	$value = 10;
	$newdataset = array(array());
	for($x = 0 ; $x < count($dataset); $x++){
		$newdataset[$x]['a'] = $dataset[$x]['a'] / pow($value, $pangkat1);
		$newdataset[$x]['b'] = $dataset[$x]['b'] / pow($value, $pangkat2);
		$newdataset[$x]['c'] = $dataset[$x]['c'] / pow($value, $pangkat3);
		$newdataset[$x]['d'] = $dataset[$x]['d'] / pow($value, $pangkat4);

	}

	//print
	echo "pangkat A = $pangkat1 <br>";
	echo "pangkat B = $pangkat2 <br>";
	echo "pangkat C = $pangkat3 <br>";
	echo "pangkat D = $pangkat4 <br><br><br>";

	echo "<table>";
	echo "<tr>";
	echo "<th>kolom A</th>";
	echo "<th>kolom B</th>";
	echo "<th>kolom C</th>";
	echo "<th>kolom D</th>";
	echo "</tr>";


	for($x = 0 ; $x < count($newdataset) ; $x++){
		echo "<tr>";
		echo "<td>";
		echo round($newdataset[$x]['a'] , 3);
		echo "</td>";
		echo "<td>";
		echo round($newdataset[$x]['b'] , 3);
		echo "</td>";
		echo "<td>";
		echo round($newdataset[$x]['c'] , 3);
		echo "</td>";
		echo "<td>";
		echo round($newdataset[$x]['d'] , 3);
		echo "</td>";
	}
	echo "</table>";

?>