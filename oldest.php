<?php
	$stmt = $conn->prepare("
		SELECT d.doc_name, d.doc_surname, d.doc_spec, d.doc_pass_series, d.doc_pass_id, d.doc_addres, d.doc_date_birthday, d.doc_date_empl, dep.dep_name
			FROM Doctors as d 
			JOIN Departments as dep USING(dep_id)
			WHERE doc_date_dism is NULL
				AND doc_date_empl = (SELECT MIN(doc_date_empl) FROM Doctors)");
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$info = "Врач, работающий дольше всех";
	include "print_info.php";
	include "print_doctors.php";
?>