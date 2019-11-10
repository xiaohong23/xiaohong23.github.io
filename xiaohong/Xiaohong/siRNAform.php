
<html><head><title>Microarray data for differential expression genes of Sipa1 siRNA cell line</title></head>
<body background="background.jpg">
<br><font size=6><strong><center><p>Microarray Data of Sipa1 siRNA Cell Line</center></strong></font><br><br>
<font size=5><p>The differentially expressed genes from the criteria you defined</font><br><br>

<?php
$pvalue   = ($_POST['Pcutoff']);
$log2 =($_POST['Lcutoff']);
$selection=($_POST['selection']);

mysql_connect ("localhost","xiaohong","azalea23!") or die ("I cannot connect to the database because: ".mysql_error());
mysql_select_db ("microarray") or die(mysql_error());
if ($selection=="PValue") {
	$data = mysql_query("select * from sirnaweb where p_value <'$pvalue' and p_value!=0 order by p_value");
}
elseif ($selection=="Log2Diff") {
	$data = mysql_query("select * from sirnaweb where abs(Diff_M) >'$log2' order by Diff_M");
}
elseif ($selection=="PValueLog") {
	$data = mysql_query("select * from sirnaweb where abs(Diff_M) >'$log2' and p_value<'$pvalue' and p_value!=0 order by p_value");
}

if (!$data) {    die("Query to show fields from table failed");}

echo "<table border=\"1\" cellspacing=\"2\" cellpadding=\"5\">"; 
echo "<tr><th bgcolor=#dddddd align=\"left\">AffyID</th>";
echo "<th bgcolor=#dddddd align=\"left\">Gene Name</th>";
echo "<th bgcolor=#dddddd align=\"left\">Accession No.</th>";
echo "<th bgcolor=#dddddd align=\"left\">Symbol</th>";
echo "<th bgcolor=#dddddd align=\"left\">Intensity</th>";
echo "<th bgcolor=#dddddd align=\"left\">Log2 diff</th>";
echo "<th bgcolor=#dddddd align=\"left\">p value</th></tr>";

while($info=mysql_fetch_array($data)) 
{ 
echo "<tr>"; 
echo "<td bgcolor=#dddddd align=\"left\">".$info["AffyID"]."</td>"; 
echo "<td bgcolor=#dddddd align=\"left\">".$info["GENENAME"]."</td>"; 
echo "<td bgcolor=#dddddd align=\"left\">".$info["ACCNUM"]."</td>"; 
echo "<td bgcolor=#dddddd align=\"left\">".$info["SYMBOL"]."</td>"; 
echo "<td bgcolor=#dddddd align=\"left\">".$info["AVERAGE"]."</td>"; 
echo "<td bgcolor=#dddddd align=\"left\">".$info["Diff_M"]."</td>"; 
echo "<td bgcolor=#dddddd align=\"left\">".$info["p_value"]."</td>"; 
echo "</tr>";
} 
echo "</table>"; 
?> 
</body></html>

