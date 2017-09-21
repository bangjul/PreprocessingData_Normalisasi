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

	// for($x = 0 ; $x < count($dataset) ; $x++){
	// 	echo $dataset[$x]['a'];
	// 	echo " ";
	// 	echo $dataset[$x]['b'];
	// 	echo " ";
	// 	echo $dataset[$x]['c'];
	// 	echo " ";
	// 	echo $dataset[$x]['d'];
	// 	echo " ";
	// 	echo $dataset[$x]['e'];
	// 	echo "<br>";
	// }
	
	//rata-rata per kolom
	$jumlahA = 0;
	$jumlahB = 0;
	$jumlahC = 0;
	$jumlahD = 0;
	for ($x = 0 ; $x < count($dataset); $x++){
		$jumlahA = $jumlahA + $dataset[$x]['a'];
		$jumlahB = $jumlahB + $dataset[$x]['b'];
		$jumlahC = $jumlahC + $dataset[$x]['c'];
		$jumlahD = $jumlahD + $dataset[$x]['d']; 
	}
	$rataA = $jumlahA / count($dataset);
	$rataB = $jumlahB / count($dataset);
	$rataC = $jumlahC / count($dataset);
	$rataD = $jumlahD / count($dataset);

	//standart deviasi per kolom
	$pangkat = 2;
	$A = 0;
	$B = 0;
	$C = 0;
	$D = 0;
	for($y = 0; $y < count($dataset); $y++){
		$A = $A + pow(($dataset[$y]['a'] - $rataA), $pangkat);
		$B = $B + pow(($dataset[$y]['b'] - $rataB), $pangkat);
		$C = $C + pow(($dataset[$y]['c'] - $rataC), $pangkat);
		$D = $D + pow(($dataset[$y]['d'] - $rataD), $pangkat);
	}

	$stdA = $A / count($dataset);
	$stdB = $B / count($dataset);
	$stdC = $C / count($dataset);
	$stdD = $D / count($dataset);
	

	//Z-Score
	$newdataset = array(array());
	for($x = 0 ; $x < count($dataset); $x++){
		$newdataset[$x]['a'] = ($dataset[$x]['a'] - $rataA) / $stdA;
		$newdataset[$x]['b'] = ($dataset[$x]['b'] - $rataB) / $stdB;
		$newdataset[$x]['c'] = ($dataset[$x]['c'] - $rataC) / $stdC;
		$newdataset[$x]['d'] = ($dataset[$x]['d'] - $rataD) / $stdD;

	}

	//print
	echo "mean A = $rataA <br>";
	echo "mean B = $rataB <br>";
	echo "mean C = $rataC <br>";
	echo "mean D = $rataD <br><br><br>";


	echo "stdA = $stdA <br>";
	echo "stdB = $stdB <br>";
	echo "stdC = $stdC <br>";
	echo "stdD = $stdD <br><br><br>";

	for($x = 0 ; $x < count($newdataset) ; $x++){
		echo $newdataset[$x]['a'];
		echo "  === ";
		echo $newdataset[$x]['b'];
		echo " ===  ";
		echo $newdataset[$x]['c'];
		echo "  === ";
		echo $newdataset[$x]['d'];
		echo "<br>";
	}


?>