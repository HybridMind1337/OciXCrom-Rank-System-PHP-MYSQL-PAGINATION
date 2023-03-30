<?php
const DB_HOST = 'localhost';
const DB_NAME = 'amxx';
const DB_USER = 'amxx';
const DB_PASSWORD = 'amxx';

try {
    $pdo = new PDO(sprintf('mysql:host=%s;dbname=%s', DB_HOST, DB_NAME), DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

$results_per_page = 10;
$stmt = $pdo->query("SELECT COUNT(*) FROM crxranks");
$num_of_results = $stmt->fetchColumn();
$num_of_pages = ceil($num_of_results / $results_per_page);

$page = !isset($_GET['page']) ? 1 : $_GET['page'];

if (!is_numeric($page) || $page < 1 || $page > $num_of_pages) {
    http_response_code(404);
    echo "Invalid page number";
    exit;
}

$this_page_first_result = ($page - 1) * $results_per_page;

$stmt = $pdo->query("SELECT * FROM crxranks LIMIT $this_page_first_result, $results_per_page");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OciXCrom Rank System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
if ($stmt->rowCount() > 0) {
?>
<div class="table-responsive container mt-5">
    <table class="table table-dark table-striped text-center">
        <thead>
        <tr>
            <th><i class="fa-regular fa-user text-warning"></i> Player</th>
            <th><i class="fa-solid fa-angles-right text-warning"></i> XP</th>
            <th><i class="fa-solid fa-turn-up text-warning"></i> Level</th>
            <th><i class="fa-regular fa-circle-right text-warning"></i> Next XP</th>
            <th><i class="fa-regular fa-star text-warning"></i> Rank</th>
            <th><i class="fa-regular fa-star-half-stroke text-warning"></i> Next Rank</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row["Player"] . "</td>";
            echo "<td>" . $row["XP"] . "</td>";
            echo "<td>" . $row["Level"] . "</td>";
            echo "<td>" . $row["Next XP"] . "</td>";
            echo "<td>" . $row["Rank"] . "</td>";
            echo "<td>" . $row["Next Rank"] . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <?php
    } else {
        echo "0 results";
    }
    echo "<nav aria-label='Page navigation'><ul class='pagination'>";
    if ($page > 1) {
        echo "<li class='page-item'><a class='page-link' href='index.php?page=1'>&laquo;</a></li>";
        echo "<li class='page-item'><a class='page-link' href='index.php?page=" . ($page - 1) . "'>&lt;</a></li>";
    }
    $start_page = max(1, $page - 2);
    $end_page = min($num_of_pages, $page + 2);
    if ($start_page > 1) {
        echo "<li class='page-item'><a class='page-link' href='index.php?page=" . ($start_page - 1) . "'>&hellip;</a></li>";
    }
    for ($i = $start_page; $i <= $end_page; $i++) {
        echo "<li class='page-item";
        if ($i == $page) {
            echo " active";
        }
        echo "'><a class='page-link' href='index.php?page=" . $i . "'>" . $i . "</a></li>";
    }
    if ($end_page < $num_of_pages) {
        echo "<li class='page-item'><a class='page-link' href='index.php?page=" . ($end_page + 1) . "'>&hellip;</a></li>";
    }
    if ($page < $num_of_pages) {
        echo "<li class='page-item'><a class='page-link' href='index.php?page=" . ($page + 1) . "'>&gt;</a></li>";
        echo "<li class='page-item'><a class='page-link' href='index.php?page=" . $num_of_pages . "'>&raquo;</a></li>";
    }
    echo "</ul></nav>";
    ?>
</div>

<script src="https://kit.fontawesome.com/0afe5d78c1.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
