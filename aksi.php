<?php
require_once 'functions.php';

/** LOGIN */
if ($mod == 'login') {
    $Username = esc_field($_POST['Username']);
    $Password = esc_field($_POST['Password']);

    $row = $db->get_row("SELECT * FROM tb_user WHERE Username='$Username' AND Password='$Password'");
    if ($row) {
        $_SESSION['login'] = $row->Username;
        $_SESSION['level'] = $row->level;
        redirect_js("index.php");
    } else {
        print_msg("Salah kombinasi username dan password.");
    }
} elseif ($act == 'logout') {
    unset($_SESSION['login']);
    header("location:index.php?m=login");
} else if ($mod == 'password') {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];

    $row = $db->get_row("SELECT * FROM tb_user WHERE Username='$_SESSION[login]' AND Password='$pass1'");

    if ($pass1 == '' || $pass2 == '' || $pass3 == '')
        print_msg('Field bertanda * harus diisi.');
    elseif (!$row)
        print_msg('Password lama salah.');
    elseif ($pass2 != $pass3)
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else {
        $db->query("UPDATE tb_user SET Password='$pass2' WHERE Username='$_SESSION[login]'");
        print_msg('Password berhasil diubah.', 'success');
    }
}
else if ($mod == 'password_lupa') {
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];

    $row = $db->get_row("SELECT * FROM tb_user WHERE Nama_lengkap='$nama_lengkap'");

    if ($nama_lengkap == '' || $pass2 == '' || $pass3 == '')
        print_msg('Field bertanda * harus diisi.');
    elseif (!$row)
        print_msg('Nama Lengkap Salah.');
    elseif ($pass2 != $pass3)
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else {
        $db->query("UPDATE tb_user SET Username='$username', Password='$pass2' WHERE Nama_lengkap='$nama_lengkap'");
        print_msg('Password berhasil diubah.', 'success');
    }
}


/** periode */
elseif ($mod == 'permintaan_tambah') {
    $kode_periode = $_POST['kode_periode'];
    $tanggal = $_POST['tanggal'];
    if ($kode_periode == '' || $tanggal == '')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    elseif ($db->get_row("SELECT * FROM tb_periode WHERE kode_periode='$kode_periode'"))
        print_msg("Kode sudah ada!");
    elseif ($db->get_row("SELECT * FROM tb_periode WHERE tanggal='$tanggal' AND kode_periode<>'$kode_periode'"))
        print_msg("Periode sudah ada!");
    else {
        $db->query("INSERT INTO tb_periode (kode_periode, tanggal) VALUES ('$kode_periode', '$tanggal')");
        foreach ($_POST['nilai'] as $key => $val) {
            $db->query("INSERT INTO tb_permintaan_sabun(kode_periode, kode_jenis, nilai) VALUES ('$kode_periode', '$key', '$val')");
        }
        redirect_js("index.php?m=permintaan");
    }
} else if ($mod == 'permintaan_ubah') {
    $tanggal = $_POST['tanggal'];
    if ($tanggal == '')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    elseif ($db->get_row("SELECT * FROM tb_periode WHERE tanggal='$tanggal' AND kode_periode<>'$_GET[ID]'"))
        print_msg("Periode sudah ada!");
    else {
        $db->query("UPDATE tb_periode SET tanggal='$tanggal' WHERE kode_periode='$_GET[ID]'");
        foreach ($_POST['nilai'] as $key => $val) {
            $db->query("UPDATE tb_permintaan_sabun SET nilai='$val' WHERE id='$key'");
        }
        redirect_js("index.php?m=permintaan");
    }
} else if ($act == 'permintaan_hapus') {
    $kode_periode = $_GET['ID'];
    $db->query("DELETE FROM tb_periode WHERE kode_periode='$kode_periode'");
    $db->query("DELETE FROM tb_permintaan_sabun WHERE kode_periode='$kode_periode'");
    header("location:index.php?m=permintaan");
}

/** KRITERIA */
if ($mod == 'jenisabun_tambah') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];


    if ($kode == '' || $nama == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif ($db->get_results("SELECT * FROM tb_jenis_sabun WHERE kode_jenis='$kode'"))
        print_msg("Kode sudah ada!");
    else {
        $db->query("INSERT INTO tb_jenis_sabun (kode_jenis, nama_jenis) VALUES ('$kode', '$nama')");
        $db->query("INSERT INTO tb_permintaan_sabun(kode_periode, kode_jenis, nilai) SELECT kode_periode, '$kode', -1  FROM tb_periode");
        redirect_js("index.php?m=jenisabun");
    }
} else if ($mod == 'jenisabun_ubah') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];


    if ($kode == '' || $nama == '')
        print_msg("Field bertanda * tidak boleh kosong!");
    else {
        $db->query("UPDATE tb_jenis_sabun SET nama_jenis='$nama' WHERE kode_jenis='$_GET[ID]'");
        redirect_js("index.php?m=jenisabun");
    }
} else if ($act == 'jenisabun_hapus') {
    $db->query("DELETE FROM tb_jenis_sabun WHERE kode_jenis='$_GET[ID]'");
    $db->query("DELETE FROM tb_permintaan_sabun WHERE kode_jenis='$_GET[ID]'");
    header("location:index.php?m=jenisabun");
}