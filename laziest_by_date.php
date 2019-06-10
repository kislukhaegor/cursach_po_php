<?php

if (!isset($_POST['send'])) {
	$info = "Врачи, которые не вели приема";
	include 'print_info.php';
	include 'report_form_date.html';
	exit();
}

$date = $_POST['report'];
$stmt = $conn->prepare("
	SELECT d.doc_name, d.doc_surname, d.doc_spec, d.doc_pass_series, d.doc_pass_id, d.doc_addres, d.doc_date_birthday, d.doc_date_empl, dep.dep_name
	FROM Doctors as d
	JOIN Departments as dep USING(dep_id)
	LEFT JOIN
		(SELECT Distinct(doc_id) as doc_id
        FROM Doctors as d
        JOIN Schedule as s USING(doc_id) WHERE s_date = :date) as nested
	USING(doc_id)
    WHERE nested.doc_id is NULL;
    ");
$stmt->execute(array(':date' => $date));
$rows = $stmt->fetchAll();
$info = "Врачи, которые не вели приема $date";
include 'print_info.php';
include 'print_doctors.php';
?>