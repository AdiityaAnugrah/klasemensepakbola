<!DOCTYPE html>
<html>

<head>
    <title>Klasemen</title>
    <!-- Link Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">

    <!-- Link CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Link CSS Bootstrap Table -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/2.3.0/bootstrap-table.min.css">

    <style>
    body {
        background-color: #c0c0c0;
        /* Warna latar belakang halaman menjadi abu-abu */
        font-family: Arial, sans-serif;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin: 20px 0;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        /* Efek bayangan tabel */
        border-radius: 10px;
        /* Membuat sudut tabel melengkung */
        overflow: hidden;
        /* Menghilangkan garis tepi pada sudut tabel yang melengkung */
    }

    th,
    td {
        padding: 12px;
        text-align: center;
        /* Teks di tengah kolom */
        border-bottom: 1px solid #f2f2f2;
        /* Garis pada setiap baris untuk memisahkan data */
        color: #333;
        /* Warna teks lebih gelap */
    }

    th {
        background-color: #007bff;
        /* Latar belakang header kolom */
        color: #fff;
        /* Warna teks putih pada header */
    }

    tbody tr:hover {
        background-color: #f2f2f2;
        /* Efek hover pada baris */
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa;
        /* Latar belakang striping tabel */
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #f2f2f2;
        /* Latar belakang striping tabel */
    }

    .btn {
        margin-right: 10px;
        transition: background-color 0.3s ease;
        /* Efek transisi perubahan warna pada tombol */
    }

    .btn:hover {
        background-color: #00ff7e;
        /* Warna hijau ketika tombol dihover */
    }



    /* Perapian untuk setiap hasil pertandingan */
    .win {
        background-color: #dff0d8;
        /* Latar belakang hijau untuk menang */
    }

    .draw {
        background-color: #fcf8e3;
        /* Latar belakang kuning untuk seri */
    }

    .lose {
        background-color: #f2dede;
        /* Latar belakang merah untuk kalah */
    }

    /* Gaya Khusus untuk tombol */
    .btn-wrapper {
        margin-top: 20px;
        text-align: center;
        /* Mengatur posisi tombol menjadi di tengah */
    }

    /* Gaya Khusus untuk judul */
    .klasemen-title {
        text-align: center;
        font-size: 48px;
        font-weight: bold;
        color: #00abff;
        /* Warna teks biru */
        text-transform: uppercase;
        /* Mengubah teks menjadi huruf kapital */
        letter-spacing: 2px;
        /* Menambahkan jarak antara huruf */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        /* Efek bayangan teks */
        margin-bottom: 20px;
    }

    .table-note {
        font-size: 12px;
        color: #000;
        /* Warna teks diubah menjadi hitam pekat */
        font-weight: bold;
        /* Tulisan keterangan menjadi lebih tebal */
        text-align: left;
        margin-top: 5px;
        line-height: 1.5;
        position: absolute;
        bottom: 10px;
        left: 10px;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
        table {
            font-size: 14px;
        }

        .klasemen-title {
            font-size: 28px;
            margin-bottom: 30px;
        }

        .table-note {
            font-size: 10px;
        }

        .btn-wrapper {
            display: flex;
            flex-direction: column;
        }

        .btn {
            margin-bottom: 10px;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-4 klasemen-title">Klasemen Liga 1 Indonesia</h1>
        <div class="table-responsive">
            <table id="klasemenTable" class="table table-bordered table-striped" data-toggle="table"
                data-pagination="true" data-search="true" data-show-columns="true">
                <thead>
                    <tr>
                        <th data-field="No">No</th>
                        <th data-field="Klub">Klub</th>
                        <th data-field="Ma">Ma</th>
                        <th data-field="Me">Me</th>
                        <th data-field="S">S</th>
                        <th data-field="Ka">Ka</th>
                        <th data-field="GM">GM</th>
                        <th data-field="GK">GK</th>
                        <th data-field="Point">Point</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($klasemen as $index => $data): ?>
                    <?php
                            // Tambahkan class CSS berdasarkan hasil pertandingan
                            $resultClass = '';
                            if ($data['win'] > 0) {
                                $resultClass = 'win';
                            } elseif ($data['draw'] > 0) {
                                $resultClass = 'draw';
                            } elseif ($data['lose'] > 0) {
                                $resultClass = 'loss';
                            }
                            ?>
                    <tr class="<?= $resultClass ?>">
                        <td><?= $index + 1 ?></td>
                        <td><?= $data['club_name'] ?></td>
                        <td><?= $data['played'] ?></td>
                        <td><?= isset($data['win']) ? $data['win'] : 0 ?></td>
                        <td><?= isset($data['draw']) ? $data['draw'] : 0 ?></td>
                        <td><?= isset($data['lose']) ? $data['lose'] : 0 ?></td>
                        <td><?= isset($data['goals_for']) ? $data['goals_for'] : 0 ?></td>
                        <td><?= isset($data['goals_against']) ? $data['goals_against'] : 0 ?></td>
                        <td><?= isset($data['points']) ? $data['points'] : 0 ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="table-note">
            <span>Keterangan:<br>
                Ma = Main <br> Me = Menang <br> S = Seri <br> Ka = Kalah <br> GM = Gol Memasukkan <br>
                GK = Gol Kebobolan</span>
        </div>
        <div class="btn-wrapper">
            <a href="<?= base_url('KlasemenController/input_club') ?>" class="btn btn-primary">Tambah Klub</a>
            <a href="<?= base_url('KlasemenController/input_score_view') ?>" class="btn btn-primary">Input Skor
                Pertandingan</a>
            <a href="<?= base_url('klasemenController/input_score_multiple_view') ?>" class="btn btn-primary">Input Skor
                Multiple</a>
        </div>
    </div>

    <!-- Link jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Link JavaScript DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Link JavaScript Bootstrap Table -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/2.3.0/bootstrap-table.min.js"></script>

    <!-- Aktifkan DataTables dan Bootstrap Table -->
    <script>
    $(document).ready(function() {
        $('#klasemenTable').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "emptyTable": "Tidak ada data",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "search": "Cari:",
                "zeroRecords": "Tidak ditemukan data yang sesuai"
            }
        });
    });
    </script>

    <!-- Link Bootstrap 5 JavaScript (Optional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>