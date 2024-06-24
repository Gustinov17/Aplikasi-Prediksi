
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-success">
            <div class="panel-heading" align="center">
                <strong>DATA PRODUK</strong>
            </div>
            <br>

            <div class="form-group">
                <a class="btn btn-primary" href="?m=jenisabun_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        
            <div class="panel-body">
                <table id="datatables" class="table table-bordered table-hover table-condensed" width="100%" >
                    <thead>
            <tr>
                <th bgcolor="success" style="color: white;">Kode</th>
                <th bgcolor="success" style="color: white;">Nama Produk</th>
                
                <th bgcolor="success" style="color: white;">Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_jenis_sabun WHERE nama_jenis LIKE '%$q%' ORDER BY kode_jenis");
        $no = 0;
        foreach ($rows as $row) : ?>
            <tr>
                <td><?= $row->kode_jenis ?></td>
                <td><?= $row->nama_jenis ?></td>
                <td>

                    
                    <a class="btn btn-xs btn-warning" href="?m=jenisabun_ubah&ID=<?= $row->kode_jenis ?>"><span class="glyphicon glyphicon-edit">Edit</span></a>
                    <a class="btn btn-xs btn-danger" href="aksi.php?act=jenisabun_hapus&ID=<?= $row->kode_jenis ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash">Hapus</span></a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
        </div>
    </div>
</div>
</div>
