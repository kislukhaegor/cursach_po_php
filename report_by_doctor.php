<?php

if (!isset($_POST['send'])) {
    $info = "Отчет врача за март 2017";
    include 'print_info.php';
	include 'report_by_surname.html';
	exit();
}

$surname = $_POST['report'];
$stmt = $conn->prepare("
    SELECT p.pat_surname as surname, v.vis_date as vis_date, v.vis_diag as diagnose FROM Visits as v
    JOIN Patients as p using(pat_id)
    JOIN Doctors as d using(doc_id)
    WHERE YEAR(v.vis_date) = 2017
        AND MONTH(v.vis_date) = 03
        AND d.doc_surname = :surname;
    ");
$stmt->execute(array(':surname' => $surname));
$reports = $stmt->fetchAll();
$info = "Отчет врача $surname за март 2017";
include 'print_info.php';
?>

<div class="table-responsive py-4">
    <table class="center table">
        <thead>
            <tr>
        		<th>Фамилия</th>
        		<th>Дата</th>
        		<th>Диагноз</th>
        	</tr>
        </thead>
    	<?php foreach ($reports as $rep): ?>

    	<tr>
    		<td><?php echo $rep["surname"]; ?></td>
    		<td><?php echo print_date($rep["vis_date"]); ?></td>
    		<td><?php echo $rep["diagnose"]; ?></td>
    	</tr>

    	<?php endforeach;?>
    </table>
</div>
