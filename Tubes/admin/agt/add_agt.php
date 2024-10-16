<?php

$carikode = mysqli_query($koneksi, "SELECT id_anggota FROM tb_anggota ORDER BY id_anggota DESC");
if ($carikode) {
    $datakode = mysqli_fetch_array($carikode);
    if ($datakode) {
        $kode = $datakode['id_anggota'];
        $urut = substr($kode, 1, 3);
        $tambah = (int) $urut + 1;

        if (strlen($tambah) == 1) {
            $format = "A" . "00" . $tambah;
        } else if (strlen($tambah) == 2) {
            $format = "A" . "0" . $tambah;
        } else if (strlen($tambah) == 3) {
            $format = "A" . $tambah;
        }
    } else {
        $format = "A001";
    }
} else {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<section class="content-header">
    <h1>
        Tambah Anggota
        <small>Data anggota</small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="index.php">
                <i class="fa fa-home"></i>
                <b>Si Perpustakaan</b>
            </a>
        </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah anggota</h3>
                </div>
                
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label>ID anggota</label>
                            <input type="text" name="id_anggota" id="id_anggota" class="form-control" value="<?php echo $format; ?>"
                                readonly/>
                        </div>

                        <div class="form-group">
                            <label>Nama Anggota</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Anggota">
                        </div>

                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jekel" id="jekel" class="form-control" required>
                                <option>-- Pilih --</option>
                                <option>Laki-laki</option>
                                <option>Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" name="NIM" id="NIM" class="form-control" placeholder="NIM">
                        </div>

                        <div class="form-group">
                            <label>No HP</label>
                            <input type="number" name="no_hp" id="no_hp" class="form-control" placeholder="No HP">
                        </div>

                    </div>

                    <div class="box-footer">
                        <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
                        <a href="?page=MyApp/data_agt" class="btn btn-warning">Batal</a>
                    </div>
                </form>
            </div>
</section>

<?php

if (isset($_POST['Simpan'])) {
    
    $sql_simpan = "INSERT INTO tb_anggota (id_anggota, nama, jekel, NIM, no_hp) VALUES (
       '".$_POST['id_anggota']."',
      '".$_POST['nama']."',
      '".$_POST['jekel']."',
      '".$_POST['NIM']."',
      '".$_POST['no_hp']."')";
    $query_simpan = mysqli_query($koneksi, $sql_simpan);
    mysqli_close($koneksi);

    if ($query_simpan) {

        echo "<script>
        Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/data_agt';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/add_agt';
            }
        })</script>";
    }
}
?>
