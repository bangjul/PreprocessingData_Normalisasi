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
	    $dataset[$i]['e'] = $row_data[4];
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
	$max1 = 0;
	$max2 = 0;
	$max3 = 0;
	$max4 = 0;
	$tot1 = 8;
	$tot2 = 8;
	$tot3 = 8;
	$tot4 = 8;
	for($x=0 ; $x < count($dataset) ; $x++){
		
		if($dataset[$x]['a'] > $max1){
		 	$max1 = $dataset[$x]['a'];
		}
		if($dataset[$x]['b'] > $max2){
		 	$max2 = $dataset[$x]['b'];
		}
		if($dataset[$x]['c'] > $max3){
		 	$max3 = $dataset[$x]['c'];
		}
		if($dataset[$x]['d'] > $max4){
		 	$max4 = $dataset[$x]['d'];
		}

		//min
		if($dataset[$x]['a'] < $tot1){
		 	$min1 = $dataset[$x]['a'];
		 	$tot1 = $min1;
		}
		if($dataset[$x]['b'] < $tot2){
		 	$min2 = $dataset[$x]['b'];
		 	$tot2 = $min2;
		}
		if($dataset[$x]['c'] < $tot3){
		 	$min3 = $dataset[$x]['c'];
		 	$tot3 = $min3;
		}
		if($dataset[$x]['d'] < $tot4){
		 	$min4 = $dataset[$x]['d'];
		 	$tot4 = $min4;
		}
	}
	
	echo "maxA= $max1 maxB= $max2 maxC= $max3 maxD= $max4 <br>";
	echo "minA= $min1 minB= $min2 minC= $min3 minD= $min4 <br><br>";

	$newmin = 0;
	$newmax = 1;
	$newdataset = array(array());
	for($x = 0 ; $x < count($dataset); $x++){
		$newdataset[$x]['a'] = (($dataset[$x]['a'] - $min1) * ($newmax - $newmin)) / (($max1 - $min1)+$newmin);
		$newdataset[$x]['b'] = (($dataset[$x]['b'] - $min2) * ($newmax - $newmin)) / (($max2 - $min2)+$newmin);
		$newdataset[$x]['c'] = (($dataset[$x]['c'] - $min3) * ($newmax - $newmin)) / (($max3 - $min3)+$newmin);
		$newdataset[$x]['d'] = (($dataset[$x]['d'] - $min4) * ($newmax - $newmin)) / (($max4 - $min4)+$newmin);

	}

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