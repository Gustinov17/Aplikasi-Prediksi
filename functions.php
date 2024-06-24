<?php

error_reporting(~E_NOTICE & ~E_DEPRECATED);
session_start();
include 'config.php';
include 'includes/db.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
include 'includes/ma_class.php';

$mod = $_GET['m'];
$act = $_GET['act'];

function br_to_enter($text)
{
    return str_replace("\r\n", '<br />', $text);
}

function kode_oto($field, $table, $prefix, $length)
{
    global $db;
    $var = $db->get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    if ($var) {
        return $prefix . substr(str_repeat('0', $length) . (substr($var, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}

function set_value($key = null, $default = null)
{
    global $_POST;
    if (isset($_POST[$key]))
        return $_POST[$key];

    if (isset($_GET[$key]))
        return $_GET[$key];

    return $default;
}

$rows = $db->get_results("SELECT * FROM tb_periode ORDER BY kode_periode");
foreach ($rows as $row) {
    $PERIODE[$row->kode_periode] = $row->tanggal;
}

$rows = $db->get_results("SELECT * FROM tb_jenis_sabun ORDER BY kode_jenis");
foreach ($rows as $row) {
    $JENIS[$row->kode_jenis] = $row->nama_jenis;
}

function get_jenis_option($SELECTed = 0)
{
    global $JENIS;
    $a = '';
    foreach ($JENIS as $key => $value) {
        if ($key == $SELECTed)
            $a .= "<option value='$key' SELECTed>$value->nama_jenis</option>";
        else
            $a .= "<option value='$key'>$value->nama_jenis</option>";
    }
    return $a;
}

function get_bobot_normal($bobot)
{
    $arr = array();
    foreach ($bobot as $key => $val) {
        $arr[$key] = $val / array_sum($bobot);
    }
    return $arr;
}

function get_rank($array)
{
    $data = $array;
    arsort($data);
    $no = 1;
    $new = array();
    foreach ($data as $key => $value) {
        $new[$key] = $no++;
    }
    return $new;
}

function get_analisa($awal, $akhir)
{
    global $db;

    $rows = $db->get_results("SELECT tanggal, kode_jenis, SUM(nilai) AS nilai
    FROM tb_permintaan_sabun r INNER JOIN tb_periode p ON p.kode_periode=r.kode_periode
    WHERE tanggal>='$awal' AND tanggal<='$akhir'
    GROUP BY YEAR(tanggal), MONTH(tanggal), kode_jenis
    ORDER BY r.kode_periode, kode_jenis");

    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_jenis][$row->tanggal] = $row->nilai;
    }
    return $arr;
}


function get_data()
{
    global $db, $PERIODE;

    $rows = $db->get_results("SELECT * 
    FROM tb_permintaan_sabun r 
    ORDER BY kode_periode, kode_jenis");

    $data = array();
    foreach ($rows as $row) {
        $data[$PERIODE[$row->kode_periode]][$row->kode_jenis] = $row->nilai;
    }
    return $data;
}

function get_xy($analisa, $x)
{
    $arr = array();
    foreach ($analisa as $key => $val) {
        foreach ($val as $k => $v) {
            $arr[$key][$k] = $v * $x[$k];
        }
    }
    return $arr;
}

function get_x()
{
    global $PERIODE;
    $total = count($PERIODE);

    $genap = ($total % 2 == 0);

    $min = $genap ? $total * -1 + 1 : ceil($total / 2 * -1);

    $a = $min;
    $arr = array();

    $sudah = false;
    foreach ($PERIODE as $key) {
        // if($genap && $a==1 && !$sudah){
        //     $arr[$key] = 0;
        //     $sudah = true;
        //     continue;
        // }
        $arr[$key] = $a;
        $a += $genap ? 2 : 1;
    }

    return $arr;
}

function get_arr_next($next_periode, $min_periode, $max_periode)
{
    $arr = array();
    if ($next_periode < $min_periode) {
        for ($a = $next_periode; $a < $min_periode; $a++) {
            $arr[] = $a;
        }
    } else if ($next_periode > $max_periode) {
        for ($a = $max_periode + 1; $a <= $next_periode; $a++) {
            $arr[] = $a;
        }
    } else {
        $arr[] = $next_periode;
    }
    return $arr;
}

function get_arr_next_hasil($arr_next, $nilai_a, $nilai_b, $max_periode, $max_x)
{
    global $PERIODE;
    $arr = array();
    foreach ($nilai_a as $key => $val) {
        foreach ($arr_next as $k) {
            $a = $nilai_a[$key];
            $b = $nilai_b[$key];
            $x = count($PERIODE) % 2 == 0 ? ($k - $max_periode) * 2 + $max_x : ($k - $max_periode) + $max_x;
            $arr[$key][$k] = array(
                'a' => $a,
                'b' => $b,
                'x' => $x,
                'next' => $a + $b * $x,
            );
        }
    }
    //echo '<pre>' . print_r($arr, 1) . '</pre>';
    return $arr;
}

function get_total_populasi($analisa)
{
    $arr = array();
    foreach ($analisa as $key => $val) {
        $arr[$key] = array_sum($val);
    }
    return $arr;
}


function get_total_xy($xy)
{
    $arr = array();
    foreach ($xy as $key => $val) {
        $arr[$key] = array_sum($val);
    }
    return $arr;
}

function get_x_kuadrat($x)
{
    $arr = array();
    foreach ($x as $key => $val) {
        $arr[$key] = $val * $val;
    }
    return $arr;
}

function get_a($total_populasi)
{
    global $PERIODE;

    $arr = array();
    foreach ($total_populasi as $key => $val) {
        $arr[$key] = $val / count($PERIODE);
    }
    return $arr;
}

function get_b($total_xy, $total_x_kuadrat)
{
    global $PERIODE;

    $arr = array();
    foreach ($total_xy as $key => $val) {
        $arr[$key] = $val / $total_x_kuadrat;
    }
    return $arr;
}

function esc_field($str)
{
    return addslashes($str);
}

function redirect_js($url)
{
    echo '<script type="text/javascript">window.location.replace("' . $url . '");</script>';
}

function alert($url)
{
    echo '<script type="text/javascript">alert("' . $url . '");</script>';
}

function print_msg($msg, $type = 'danger')
{
    echo ('<div class="alert alert-' . $type . ' alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $msg . '</div>');
}

function print_error($msg)
{
    die('<!DOCTYPE html>
    <html>
        <head><title>Error</title>
        <link href="../assets/css/united-bootstrap.min.css" rel="stylesheet"/>
        <body>
            <div class="container" style="margin:20px auto; width:400px">
                <p class="alert alert-warning">' . $msg . ' <a href="javascript:history.back(-1)">Kembali</a></p>                
            </div>
        </body>
    </html>');
}

function tgl_indo($date)
{
    $tanggal = explode('-', $date);

    $array_bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $bulan = $array_bulan[$tanggal[1] * 1];

    return $tanggal[2] . ' ' . $bulan . ' ' . $tanggal[0];
}
