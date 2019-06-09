<?php
	$stmt = $conn->prepare("
		SELECT s.m, AVG(s.cnt) FROM
			(SELECT YEAR(s_date), MONTH(s_date) as m, COUNT(*) as cnt FROM Schedule
			WHERE s_is_come = true
			GROUP BY YEAR(s_date), MONTH(s_date)) as s
			GROUP BY s.m;");
	$stmt->execute();
	$stats = $stmt->fetchAll();
	$info = "Среднее число пациентов в каждом месяце";
	include 'print_info.php';
?>
<div class="table-responsive">
	<table class="center table">
		<thead>
			<tr>	
				<th>Месяц</th>
				<th>Среднее число пациентов</th>
			</tr>
			</thead>
		<?php foreach ($stats as $stat): ?>

		<tr>
			<td><?php echo DateTime::createFromFormat('!m', $stat[0])->format('F'); ?></td>
			<td><?php echo (int)$stat[1]; ?></td>
		</tr>

		<?php endforeach;?>
	</table>
</div>
