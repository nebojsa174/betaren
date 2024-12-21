<?php

include '../app/config/config.php';
include '../app/config/database.php';

$limit = 10;
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$start = ($page - 1) * $limit;

$query = "SELECT * FROM objava_videa WHERE obrisan=0";

if (!empty($_POST['query'])) {
    $query .= ' AND naslov LIKE "%' . str_replace(' ', '%', $_POST['query']) . '%"';
}

$filter_query = $query . ' LIMIT ' . $start . ', ' . $limit;

$resultQuery = mysqli_query($conn, $query);
$total_data = mysqli_num_rows($resultQuery);

$result = mysqli_query($conn, $filter_query);
$total_filter_data = mysqli_num_rows($result);

$output = '<div style="padding-left:20px;"><label>Ukupno objava sa videom: ' . $total_data . '</label></div>';

$output .= '                  
            <thead>
                <tr>
                    <th class="text-uppercase text-center text-xxs font-weight-bolder" style="color: black;">ID</th>
                    <th class="text-uppercase text-center text-xxs font-weight-bolder" style="color: black;">Naslov</th>
                    <th class="text-uppercase text-center text-xxs font-weight-bolder" style="color: black;">Datum</th>
                    <th class="text-uppercase text-center text-xxs font-weight-bolder" style="color: black;">Obriši</th>                      
                </tr>
            </thead>';

if ($total_filter_data > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $output .= '
        <tr>
            <td class="align-middle text-center text-sm">
                <h6 class="text-xs mb-0 text-secondary">' . $row['id'] . '</h6>
            </td>
            <td class="align-middle text-center text-sm">
                <h6 class="text-xs mb-0 text-secondary">' . $row['naslov'] . '</h6>
            </td>
            <td class="align-middle text-center text-sm">
                <h6 class="text-xs mb-0 text-secondary">' . $row['datum'] . '</h6>
            </td>
            <td class="align-middle text-center text-sm">
                <a href="brisanje-videa.php?id=' . $row['id'] . '" class="font-weight-bold" onclick="return confirm(\'Da li ste sigurni da želite obrisati ovaj video?\');">
                    <i class="fa-solid fa-trash-can"></i> Obriši
                </a>
            </td>
        </tr>';
    }
} else {
    $output .= '
    <tr>
        <td colspan="8" align="center">Nema tražene objave</td>
    </tr>';
}

$output .= '<br /><br /><div align="center"><ul class="pagination">';

// Pagination logic
$total_links = ceil($total_data / $limit);
$previous_link = '';
$next_link = '';
$page_link = '';

$page_array = [];
$showing_first_last = 5; // Number of pages to show at the start and end

if ($total_links <= $showing_first_last * 2 + 2) {
    // If the total number of pages is small, show all pages
    for ($count = 1; $count <= $total_links; $count++) {
        $page_array[] = $count;
    }
} else {
    // If there are many pages, show a subset with ellipsis
    if ($page < $showing_first_last + 1) {
        // Show start pages
        for ($count = 1; $count <= $showing_first_last + 1; $count++) {
            $page_array[] = $count;
        }
        $page_array[] = '...';
        $page_array[] = $total_links;
    } elseif ($page > $total_links - $showing_first_last) {
        // Show end pages
        $page_array[] = 1;
        $page_array[] = '...';
        for ($count = $total_links - $showing_first_last; $count <= $total_links; $count++) {
            $page_array[] = $count;
        }
    } else {
        // Show pages around the current page
        $page_array[] = 1;
        $page_array[] = '...';
        for ($count = $page - 1; $count <= $page + 1; $count++) {
            $page_array[] = $count;
        }
        $page_array[] = '...';
        $page_array[] = $total_links;
    }
}

// Generate previous link
if ($page > 1) {
    $previous_page = $page - 1;
    $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_page . '">Prethodna</a></li>';
} else {
    $previous_link = '<li class="page-item disabled"><a class="page-link">Prethodna</a></li>';
}

// Generate next link
if ($page < $total_links) {
    $next_page = $page + 1;
    $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="' . $next_page . '">Sledeća</a></li>';
} else {
    $next_link = '<li class="page-item disabled"><a class="page-link">Sledeća</a></li>';
}

// Generate page links
$page_link = '';
foreach ($page_array as $count) {
    if ($count == '...') {
        $page_link .= '<li class="page-item disabled"><a class="page-link">...</a></li>';
    } else {
        $active_class = ($count == $page) ? ' active' : '';
        $page_link .= '<li class="page-item' . $active_class . '"><a class="page-link" href="javascript:void(0)" data-page_number="' . $count . '">' . $count . '</a></li>';
    }
}
$output .= $previous_link . $page_link . $next_link;
$output .= '</ul></div>';

echo $output;

?>
