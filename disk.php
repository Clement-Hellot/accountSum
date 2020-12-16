<?php
header('Content-Type: application/json');

require_once('./utils/classeBDD.php');
$bdd = new BDD();


if (isset($_POST['time'])) {
	switch ($_POST['time']) {

		case 'D':
			$time = "DAY";
			$period = -3;
			break;
		case 'S':
			$time = "WEEK";
			$period = -1;
			break;
		case 'M':
			$time = "MONTH";
			$period = -1;
			break;
		case 'Y':
			$time = "YEAR";
			$period = -1;
			break;

		default:
			$time = "YEAR";
			$period = '-YEAR(MAX(date))+1';
			break;
	}
}

$sql = "SELECT code_type.Libelle,ABS(sum(montant)) as montant from comptes
join Code_Type  on Code_Type.Cat=comptes.type
where date >= 
(
	select dateadd($time,$period,max(date)) from comptes
)
GROUP BY code_type.Libelle";

$result = $bdd->LireDonneesPDO1($sql,$tab);


$data = array();
foreach ($tab as $row) {
	$data[] = $row;
}



echo json_encode($data);
?>