<?php
include("../../sql/bd.php");
//var_dump($_POST);

$result = mysql_query("SELECT * FROM users WHERE id1C=" . $_SESSION['id1C'], $db);
$myrow = mysql_fetch_array($result);
$Super = $myrow['Super'];

if (empty($_POST['login'])) {
    $proekt = $_SESSION['id1C'];
} else {
    $proekt = $_POST['login'];
};

if (!isset($_POST['KodKA']) || $_POST['KodKA'] == ' ' || $_POST['KodKA'] == '' || $_POST['KodKA'] == 'ВсеЗадания') {
    $pKodKA = " ";
} elseif ($_POST['KodKA'] == "Не по маршруту") {
    $KodKA = $_POST['KodKA'];
    $pKodKA = " and (Zadania.KodKA='')";
} else {
    $KodKA = $_POST['KodKA'];
    $pKodKA = " and (Zadania.KodKA='$KodKA')";
};

if ($proekt <> 999999) {
    $pProekt = " and ((users.id1C='$proekt') or (id1C1='$proekt') or (id1C2='$proekt'))";
} elseif ($_SESSION['login'] == "Admin") {
    $pProekt = " ";
} else {
    $pProekt = " and ((id1C1='$proekt') or (id1C2='$proekt'))";
};

include 'selectuser.php';
echo "<br>";

if (empty($_POST['table'])) {
    $table = 'clients';
} else {
    $table = $_POST['table'];
}

if (empty($_POST['exp'])) {
    $exp = 'ТекущийМаршрут';
} else {
    $exp = $_POST['exp'];
}

if (empty($_POST['category'])) {
    $category = '';
} else {
    $category = $_POST['category'];
}

if (empty($_POST['completed'])) {
    $completed = '';
} else {
    $completed = $_POST['completed'];
}

switch ($category) {
    case 'ПерезаключенияДоговоров':
        $pCategory = "(Category=1)";
        break;
    case 'ЗаданияОтСупервайзера':
        $pCategory = "(Category=2) or (Category=5)";
        break;
    case 'ОборотТовара':
        $pCategory = "((Category=3) or (Category=4))";
        break;
    default:
        $pCategory = "(1=1)";
}

$days = array(1 => "ПН", "ВТ", "СР", "ЧТ", "ПТН", "СБ", "ВС");
$DayToday = $days[date("N")];
if ($exp == 'ТекущийМаршрут') {
    $pMarshrut = "INNER JOIN Marshrut on (Marshrut.KodKA = Zadania.KodKA) and (Marshrut.Proekt = Zadania.Proekt) and (VisitDay like '%" . $DayToday . "%')";
} else {
    $pMarshrut = "LEFT JOIN Marshrut on (Marshrut.KodKA = Zadania.KodKA)";
};


if (!isset($_POST['KodTT']) || $_POST['KodTT'] == ' ' || $_POST['KodTT'] == '' || $_POST['KodTT'] == 'ВсеЗадания') {
    $pKodTT = " ";
} elseif ($_POST['KodTT'] == "Не по маршруту") {
    $KodTT = $_POST['KodTT'];
    $pKodTT = " and (Zadania.KodTT='')";
} else {
    $KodTT = $_POST['KodTT'];
    $pKodTT = " and (Zadania.KodTT='$KodTT')";
};

include 'table_' . $table . '.php';

