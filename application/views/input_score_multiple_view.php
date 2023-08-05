<!DOCTYPE html>
<html>

<head>
    <title>Input Skor Pertandingan</title>
    <!-- Link Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">
    <style>
    /* Custom CSS untuk tampilan form */
    body {
        background-color: #c0c0c0;
        /* Warna latar belakang halaman menjadi abu-abu */
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .container h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #007bff;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-group input[type="number"],
    .form-group select {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-group input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }

    .form-group input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .add-score-btn {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    .add-score-btn:hover {
        background-color: #218838;
    }

    .btn-back {
        text-align: center;
        margin-top: 15px;
    }

    .score-row {
        margin-bottom: 15px;
    }

    .btn-back {
        text-align: center;
        margin-top: 15px;
    }

    .klasemen-title {
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        color: #007bff;
        /* Warna teks biru */
        text-transform: uppercase;
        /* Mengubah teks menjadi huruf kapital */
        letter-spacing: 2px;
        /* Menambahkan jarak antara huruf */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        /* Efek bayangan teks */
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-5 mb-4 klasemen-title">Input Skor Pertandingan</h1>
        <form id="scoreForm" action="<?= base_url('klasemenController/process_input_score_multiple') ?>" method="post">
            <div id="scoresContainer">
                <!-- Default score row -->
                <div class="score-row row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="club1_id">Nama Klub Pertama:</label>
                            <select name="club1_id[]" class="form-control" required>
                                <option value="" disabled selected>Pilih Klub Pertama</option>
                                <?php foreach ($clubs as $club): ?>
                                <option value="<?= $club['id'] ?>"><?= $club['club_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="club2_id">Nama Klub Kedua:</label>
                            <select name="club2_id[]" class="form-control" required>
                                <option value="" disabled selected>Pilih Klub Kedua</option>
                                <?php foreach ($clubs as $club): ?>
                                <option value="<?= $club['id'] ?>"><?= $club['club_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="score1">Skor Pertama:</label>
                            <input type="number" name="score1[]" class="form-control" required min="0">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="score2">Skor Kedua:</label>
                            <input type="number" name="score2[]" class="form-control" required min="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group btn-container text-center">
                <button type="button" class="add-score-btn" id="addScoreBtn">Tambah Skor</button>
                <button type="button" class="add-score-btn" id="submitBtn">Simpan Skor</button>
            </div>
            <div class="btn-back">
                <a href="<?= base_url('KlasemenController') ?>" class="btn btn-secondary btn-sm">Kembali ke Klasemen</a>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Link SweetAlert JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#addScoreBtn").click(function() {
            var newScoreRow = $(".score-row").eq(0).clone();
            $("#scoresContainer").append(newScoreRow);
            newScoreRow.find("input[type='number']").val("");
            newScoreRow.find("select").prop("selectedIndex", 0);
        });
        $("#submitBtn").click(function(event) {
            event.preventDefault();
            var emptyFields = $("input[type='number']:not([value!=''])").length + $("select").filter(
                function() {
                    return $(this).val() === "";
                }).length;
            if (emptyFields > 0) {
                Swal.fire({
                    title: 'Maaf!',
                    text: 'Silahkan isi form dahulu!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }
            var club1_ids = $("select[name='club1_id[]']").map(function() {
                return this.value;
            }).get();
            var club2_ids = $("select[name='club2_id[]']").map(function() {
                return this.value;
            }).get();
            for (var i = 0; i < club1_ids.length; i++) {
                if (club1_ids[i] !== "" && club2_ids[i] !== "" && club1_ids[i] === club2_ids[i]) {
                    Swal.fire({
                        title: 'Maaf!',
                        text: 'Tim tidak dapat melawan tim yang sama!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                if (club1_ids[i] !== "" && club2_ids[i] !== "") {
                    checkExistingMatch(club1_ids[i], club2_ids[i]);
                    return;
                }
            }
            $("#scoreForm").submit();
        });

        function checkExistingMatch(club1_id, club2_id) {
            fetch('<?= base_url('klasemenController/check_existing_match') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-type': 'application/x-www-form-urlencoded'
                    },
                    body: `club1_id=${encodeURIComponent(club1_id)}&club2_id=${encodeURIComponent(club2_id)}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        Swal.fire({
                            title: 'Maaf!',
                            text: 'Pertandingan kedua klub sudah ada!',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Simpan Skor',
                            text: 'Apakah Anda yakin ingin menyimpan skor pertandingan?',
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, Simpan!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#scoreForm").submit();
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memeriksa data. Silakan coba lagi.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }
    });
    </script>
</body>

</html>