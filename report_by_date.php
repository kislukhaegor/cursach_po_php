<?php

if (!isset($_POST['send'])) {
	include 'report_form_date.html';
	exit();
}

$date = $_POST['report'];
$stmt = $conn->prepare("
		SELECT d.doc_surname as surname, s.cab_num as cab_num, COUNT(*) as cnt_pat, c.cnt as cnt_pat_come FROM schedule as s
        JOIN Doctors as d USING(doc_id)
        JOIN (SELECT doc_id, cab_num, COUNT(*) as cnt FROM schedule
            WHERE s_is_come = true 
            GROUP BY doc_id, cab_num) as c
        ON(s.doc_id = c.doc_id
        AND s.cab_num = c.cab_num)
        WHERE s.s_date = :date
        GROUP BY s.doc_id, s.cab_num;");
$stmt->execute(array(':date' => $date));
$reports = $stmt->fetchAll();
$info = "Отчет за $date";
include 'print_info.php';
?>
<div class="table-responsive">
	<table class="center table">
		<thead>
			<tr>
				<th>Фамилия</th>
				<th>Кабинет</th>
				<th>Записано пациентов</th>
				<th>Пришло пациентов</th>
			</tr>
		</thead>
		<?php foreach ($reports as $rep): ?>

		<tr>
			<td><?php echo $rep["surname"]; ?></td>
			<td><?php echo $rep["cab_num"]; ?></td>
			<td><?php echo $rep["cnt_pat"]; ?></td>
			<td><?php echo $rep["cnt_pat_come"]; ?></td>
		</tr>

		<?php endforeach; ?>
	</table>
</div>