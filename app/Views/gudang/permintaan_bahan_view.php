<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Permintaan Bahan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_gudang') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Permintaan Bahan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Permintaan Bahan</strong></h3>
                    </div>

                    <?php 
                    if(isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors()?>
                    </div>
                    <?php endif;?>

                    <?php if(isset($error)): ?>
                    <div class='alert alert-danger'><?= $error;?></div>
                    <?php endif; ?>

                    <?php if(session()->getFlashdata('error')):?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif;?>

                    <?php if(session()->getFlashdata('success')):?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif;?>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                            </div>
                            <ul class="nav nav-pills " id="myTab2" role="tablist">
                                <li class="nav-item  ">
                                    <a class="nav-link active" id="home-tab1" data-toggle="pill" href="#permintaan"
                                        role="tab" aria-controls="home" aria-selected="true">Permintaan Bahan</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active " id="permintaan" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftarbahan" class="table table-hover table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Permintaan</th>
                                                <th scope="col">Nama Bahan</th>
                                                <th scope="col">Jumlah Bahan Dibutuhkan</th>
                                                <th scope="col">Satuan</th>
                                                <th scope="col">Biaya Bahan</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datapermintaan as $row) : ?>
                                                <td> <?= $row['id_permintaan'];?>
                                                </td>
                                                <td><?= $row['nama_bahan'];?>
                                                </td>
                                                <td><?= $row['jmlh_permintaan'];?>
                                                </td>
                                                <td><?= $row['satuan'];?>
                                                </td>
                                                <td>Rp. <?= number_format($row['biaya_bahan'],0,',','.');?>
                                                </td>
                                                <td>
                                                    <?php if($row['status'] == 'Menunggu Diterima'):?>
                                                    <button class="btn btn-warning mt-2 mb-2" data-toggle="modal"
                                                        data-target="#Terima" id="btn-terima"
                                                        data-idterima="<?= $row['id_permintaan']; ?>"
                                                        data-jmlhpermintaan="<?= $row['jmlh_permintaan']; ?>"
                                                        data-namabahan="<?= $row['nama_bahan']; ?>"
                                                        data-satuan="<?= $row['satuan']; ?>" data-status="Diterima">
                                                        Proses..
                                                    </button>
                                                    <?php elseif($row['status'] == 'Diterima'):?>
                                                    <button class="btn btn-success mt-2 mb-2">
                                                        Selesai Proses
                                                    </button>

                                                    <?php endif;?>

                                                </td>
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<div class="modal fade" id="Terima" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('gudang/Terima_tolak') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Proses Permintaan
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Yakin ingin memproses permintaan?
                        </h5>
                        <input type="hidden" id="id_permintaan" name="id_permintaan">
                        <input type="hidden" id="status" name="status">
                        <input type="hidden" id="jmlh_permintaan" name="jmlh_permintaan">
                        <input type="hidden" id="nama_bahan" name="nama_bahan">
                        <input type="hidden" id="satuan" name="satuan">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
$(document).ready(function() {
    $(document).on('click', '#btn-terima', function() {
        var id = $(this).data('idterima');
        var stat = $(this).data('status');
        var jmlh = $(this).data('jmlhpermintaan');
        var nama = $(this).data('namabahan');
        var pcs = $(this).data('satuan');
        $('.modal-body #id_permintaan').val(id);
        $('.modal-body #status').val(stat);
        $('.modal-body #jmlh_permintaan').val(jmlh);
        $('.modal-body #nama_bahan').val(nama);
        $('.modal-body #satuan').val(pcs);

    })

    $(document).on('click', '#btn-hapus-bayar', function() {
        $('.modal-body #id_pembayaranut').val($(this).data('id'));

    })

    $(document).on('click', '#btn-hapus-history', function() {
        $('.modal-body #id_history').val($(this).data('id'));

    })

})
</script>

<script>
$(document).ready(function() {
    $('#daftarbahan').DataTable({
        responsive: true

    });



});
</script>

<?= $this->endSection();?>