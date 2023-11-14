<?php $n = 1;
include '../koneksi.php';
$query_sosialMedia = mysqli_query($conn, "SELECT * FROM sosial_media");
while ($row = mysqli_fetch_array($query_sosialMedia)) {
    echo '<tr>
        <th scope="row">' . $n++ . '</th>
        <td>' . $row["tipe_sosialMedia"] . '</td>
        <td>' . $row["link_sosialMedia"] . '</td>
        <td>' . $row["count_klik"] . '</td>
        <td>
            <a href="#" class="btn btn-sm btn-warning edit-sosial" data-id_s=' . $row["id_sosialMedia"] . '  data-tipe_s=' . $row["tipe_sosialMedia"] . ' data-link_s=' . $row["link_sosialMedia"] . '><i class="fas fa-pen"></i></a>
        </td>
    </tr>';
};
