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
	//sigmoidal
	$eks = 2.718281828;
	$dataSigmoidal = array(array());
	for($z = 0 ; $z < count($dataset); $z++){
		$dataSigmoidal[$z]['a'] = (1 - pow($eks, -($newdataset[$z]['a']))) / (1 + pow($eks, -($newdataset[$z]['a'])));
		$dataSigmoidal[$z]['b'] = (1 - pow($eks, -($newdataset[$z]['b']))) / (1 + pow($eks, -($newdataset[$z]['b'])));
		$dataSigmoidal[$z]['c'] = (1 - pow($eks, -($newdataset[$z]['c']))) / (1 + pow($eks, -($newdataset[$z]['c'])));
		$dataSigmoidal[$z]['d'] = (1 - pow($eks, -($newdataset[$z]['d']))) / (1 + pow($eks, -($newdataset[$z]['d']))); 
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
		echo $dataSigmoidal[$x]['a'];
		echo "  === ";
		echo $dataSigmoidal[$x]['b'];
		echo " ===  ";
		echo $dataSigmoidal[$x]['c'];
		echo "  === ";
		echo $dataSigmoidal[$x]['d'];
		echo "<br>";
	}


?>