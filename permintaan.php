<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-success">
            <div class="panel-heading" align="center">
                <strong>DATA PENJUALAN</strong>
            </div>
            <br>

            <div class="form-group">
                <a class="btn btn-primary" href="?m=permintaan_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        
            <div class="panel-body">
            <table id="datatables" class="table table-bordered table-hover table-condensed" width="100%">
        <thead>
            <tr>
                <th bgcolor="success" style="color: white;">No</th>
                <th bgcolor="success" style="color: white;">Nama Periode</th>
                <?php foreach ($JENIS as $key => $val) : ?>
                    <th bgcolor="success" style="color: white;"><?= $val ?></th>
                <?php endforeach ?>
                <th bgcolor="success" style="color: white;">Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_periode WHERE tanggal LIKE '%$q%' ORDER BY kode_periode");
        $no = 0;
        $analisa = get_data();
        //echo '<pre>' . print_r($analisa, 1) . '</pre>';
        foreach ($rows as $row) : ?>
            <tr>
                <td><?= $row->kode_periode ?></td>
                <td><?= date('M-Y', strtotime($row->tanggal)) ?></td>
                <?php foreach ($analisa[$PERIODE[$row->kode_periode]] as $k => $v) : ?>
                    <td><?= $v ?></td>
                <?php endforeach ?>
                <td>
                    <a class="btn btn-xs btn-warning" href="?m=permintaan_ubah&ID=<?= $row->kode_periode ?>"><span class="glyphicon glyphicon-edit">Edit</span></a>
                    <a class="btn btn-xs btn-danger" href="aksi.php?act=permintaan_hapus&ID=<?= $row->kode_periode ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash">Hapus</span></a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
        </div>
    </div>
</div>
</div>
