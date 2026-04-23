<table>
<tr>
<th>Texto</th>
<th>i</th>
</tr>
<?php
$i = 1;
while( $i <= 10){
	echo "<tr>";
	echo "<td>El valor de i es:</td><td>".$i."</td>";
	echo "</tr>\n";
	$i++;
}//Fin while $i
?>
</table>