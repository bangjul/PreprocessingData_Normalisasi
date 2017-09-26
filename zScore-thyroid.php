<?php
	$txt_file = file_get_contents('newthyroid.txt');
	$rows = explode("\n", $txt_file);
	$dataset = array(array());
	$i=0;
	foreach($rows as $row => $data){
	    $row_data = explode(';', $data);

	    $dataset[$i]['a'] = $row_data[0];
	    $dataset[$i]['b'] = $row_data[1];
	    $dataset[$i]['c'] = $row_data[2];
	    $dataset[$i]['d'] = $row_data[3];
	    $dataset[$i]['e'] = $row_data[4];
	    $i++;
	}

	
	
	//rata-rata per kolom
	$jumlahA = 0;
	$jumlahB = 0;
	$jumlahC = 0;
	$jumlahD = 0;
	$jumlahE = 0;
	for ($x = 0 ; $x < count($dataset); $x++){
		$jumlahA = $jumlahA + $dataset[$x]['a'];
		$jumlahB = $jumlahB + $dataset[$x]['b'];
		$jumlahC = $jumlahC + $dataset[$x]['c'];
		$jumlahD = $jumlahD + $dataset[$x]['d'];
		$jumlahE = $jumlahE + $dataset[$x]['e']; 
	}
	$rataA = $jumlahA / count($dataset);
	$rataB = $jumlahB / count($dataset);
	$rataC = $jumlahC / count($dataset);
	$rataD = $jumlahD / count($dataset);
	$rataE = $jumlahE / count($dataset);

	//standart deviasi per kolom
	$pangkat = 2;
	$A = 0;
	$B = 0;
	$C = 0;
	$D = 0;
	$E = 0;
	for($y = 0; $y < count($dataset); $y++){
		$A = $A + pow(($dataset[$y]['a'] - $rataA), $pangkat);
		$B = $B + pow(($dataset[$y]['b'] - $rataB), $pangkat);
		$C = $C + pow(($dataset[$y]['c'] - $rataC), $pangkat);
		$D = $D + pow(($dataset[$y]['d'] - $rataD), $pangkat);
		$E = $E + pow(($dataset[$y]['e'] - $rataE), $pangkat);
	}

	$stdA = $A / count($dataset);
	$stdB = $B / count($dataset);
	$stdC = $C / count($dataset);
	$stdD = $D / count($dataset);
	$stdE = $E / count($dataset);
	

	//Z-Score
	$newdataset = array(array());
	for($x = 0 ; $x < count($dataset); $x++){
		$newdataset[$x]['a'] = ($dataset[$x]['a'] - $rataA) / $stdA;
		$newdataset[$x]['b'] = ($dataset[$x]['b'] - $rataB) / $stdB;
		$newdataset[$x]['c'] = ($dataset[$x]['c'] - $rataC) / $stdC;
		$newdataset[$x]['d'] = ($dataset[$x]['d'] - $rataD) / $stdD;
		$newdataset[$x]['e'] = ($dataset[$x]['e'] - $rataE) / $stdE;
	}

	//print
	echo "mean A = $rataA <br>";
	echo "mean B = $rataB <br>";
	echo "mean C = $rataC <br>";
	echo "mean D = $rataD <br>";
	echo "mean E = $rataE <br><br><br>";


	echo "stdA = $stdA <br>";
	echo "stdB = $stdB <br>";
	echo "stdC = $stdC <br>";
	echo "stdD = $stdD <br>";
	echo "stdE = $stdE <br><br><br>";

	echo "<table>";
	echo "<tr>";
	echo "<th>kolom A</th>";
	echo "<th>kolom B</th>";
	echo "<th>kolom C</th>";
	echo "<th>kolom D</th>";
	echo "<th>kolom E</th>";
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
		echo "<td>";
		echo round($newdataset[$x]['e'] , 3);
		echo "</td>";
	}

	echo "</table>";


?>