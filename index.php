<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Больница</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <nav class="site-header py-1">
        <div class="container px-0 d-flex flex-column flex-md-row justify-content-between">
            <a class="py-2 px-1" href="/">На главную страницу</a>
            <a class="py-2 px-1" href="/report?type=date">Отчет по дате</a>
            <a class="py-2 px-1" href="/report?type=doctor">Отчет по врачам</a>
            <a class="py-2 px-1" href="/oldest">Работает дольше всех</a>
            <a class="py-2 px-1" href="/avg">Статистика по пациентам</a>
            <a class="py-2 px-1" href="/laziest">Самые ленивые врачи</a>
            <a class="py-2 px-1" href="/laziest_by_date">Самые ленивые врачи по дате</a>
            <a class="py-2 px-1" href="/add_visit">Записаться на прием</a>
        </div>
    </nav>
    <div>
    <div class="container">
        <?php
        $database = "mydb";
        $login = "root";
        $password = "322228TUjh2019";

        include 'dbconnect.php';
        if (isset($_GET['report'])) {
            if (!isset($_GET['type'])) {
                include 'report_by_date.php';
                exit();
            }
            if ($_GET['type'] == 'doctor') {
                include 'report_by_doctor.php';
                exit();
            }
            if ($_GET['type'] == 'date') {
                include 'report_by_date.php';
                exit();
            }
        }

        if (isset($_GET['oldest'])) {
            include 'oldest.php';
            exit();
        }

        if (isset($_GET['avg'])) {
            include 'avg.php';
            exit();
        }

        if (isset($_GET['laziest_by_date'])) {
            include 'laziest_by_date.php';
            exit();
        }
        if (isset($_GET['laziest'])) {
            include 'laziest.php';
            exit();
        }
        if (isset($_GET['add_visit'])) {
            include 'add_visit.php';
            exit();
        }
        include 'print_background.html';
        exit();
        ?>
    </div>
</body>
</html>
<?php
    function print_date($date) {
        return substr($date, 0, 10);
    }
?>