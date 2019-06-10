<div class="table-responsive">
	<table class="center table">
		<thead>
			<tr>
				<th>Имя</th>
				<th>Фамилия</th>
				<th>Специализация</th>
				<th>Серия пасспорта</th>
				<th>Номер пасспорта</th>
				<th>Дата рождения</th>
				<th>Дата рождения</th>
				<th>Дата приема на работу</th>
				<th>Отделение</th>
			</tr>
		</thead>
		
		<?php foreach ($rows as $row): ?>
		
		<tr>
			<td><?php echo $row["doc_name"]; ?></td>
			<td><?php echo $row["doc_surname"]; ?></td>
			<td><?php echo $row["doc_spec"]; ?></td>
			<td><?php echo $row["doc_pass_series"]; ?></td>
			<td><?php echo $row["doc_pass_id"]; ?></td>
			<td><?php echo $row["doc_addres"]; ?></td>
			<td><?php echo print_date($row["doc_date_birthday"]); ?></td>
			<td><?php echo print_date($row["doc_date_empl"]); ?></td>
			<td><?php echo $row["dep_name"]; ?></td>
		</tr>

		<?php endforeach;?>

	</table>
</div>