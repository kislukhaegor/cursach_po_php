<?php
	$stmt = $conn->prepare("
		SELECT d.doc_name , d.doc_surname, d.doc_pass_series, d.doc_pass_id, d.doc_addres, d.doc_date_birthday, d.doc_date_empl, dep.dep_name
			FROM Doctors as d LEFT JOIN Visits as v USING(doc_id)
			JOIN Departments as dep USING(dep_id)
			WHERE vis_id is NULL;");
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$info = "Врачи, не принявшие ни одного пациента";
	include 'print_info.php';
	include "print_doctors.php";
?>