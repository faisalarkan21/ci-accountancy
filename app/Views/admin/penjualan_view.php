<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Penjualan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a
                        href="<?= base_url('/dashboard/dashboard_admin') ?>">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Data</a></div>
                <div class="breadcrumb-item">Penjualan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Penjualan</strong></h3>
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
                                <div class="row justify-content-end">
                                    <div class="">
                                        <button class="btn btn-danger " data-toggle="modal"
                                            data-target="#tambahModalPenjualan"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data Penjualan
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <button class="btn btn-primary " data-toggle="modal"
                                            data-target="#tambahModalBarang"><i class="fa fa-fw fa-folder-plus"></i>
                                            Tambah Data Barang
                                        </button>
                                    </div>
                                    <div class="ml-3">
                                        <button class="btn btn-success " data-toggle="modal"
                                            data-target="#prosesjurnal"><i class="fa fa-fw fa-folder-plus"></i>
                                            Proses Ke Jurnal
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav nav-pills" id="myTab2" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link  active" id="home-tab1" data-toggle="pill" href="#daftar"
                                        role="tab" aria-controls="home" aria-selected="true">Daftar Penjualan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="home-tab2" data-toggle="pill" href="#history" role="tab"
                                        aria-controls="home" aria-selected="false">History</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade show active" id="daftar" role="tabpanel"
                                    aria-labelledby="home-tab1">
                                    <table id="daftarpenj"
                                        class="table table-sm table-bordered table-hover text-center table-responsive-lg ">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Penjualan</th>
                                                <th scope="col">Nama Pelanggan</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Jumlah Barang</th>
                                                <th scope="col">Harga Jual</th>
                                                <th scope="col">Harga Ongkir</th>
                                                <th scope="col">Merchant</th>
                                                <th scope="col">Ekspedisi</th>
                                                <th scope="col">No Resi</th>
                                                <th scope="col">Status</th>

                                                <th scope="col" style="width: 100;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datapenjualan as $row) : ?>
                                                <td class="align-middle"> <?= $row['id_penjualan'];?>
                                                </td>
                                                <td class="align-middle"> <?= $row['nama_customer'];?>
                                                </td>
                                                <td>
                                                    <?php foreach ($datapenjualanall as $row2) : ?>
                                                    <?php if ($row2['id_penjualan'] == $row['id_penjualan']) : ?>
                                                    <p><?= $row2['nama_barang']; ?></p>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td>
                                                    <?php foreach ($datapenjualanall as $row2) : ?>
                                                    <?php if ($row2['id_penjualan'] == $row['id_penjualan']) : ?>
                                                    <p><?= $row2['jmlh_barang']; ?></p>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td>
                                                    <?php foreach ($datapenjualanall as $row2) : ?>
                                                    <?php if ($row2['id_penjualan'] == $row['id_penjualan']) : ?>
                                                    <p>Rp. <?= number_format($row2['total_harga'],0,',','.') ?></p>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="align-middle">Rp.
                                                    <?= number_format($row['harga_ongkir'],0,',','.');?>
                                                </td>
                                                <td>
                                                    <?php foreach ($datapenjualanall as $row2) : ?>
                                                    <?php if ($row2['id_penjualan'] == $row['id_penjualan']) : ?>
                                                    <p><?= ($row2['nama_merchant']) ?></p>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="align-middle"> <?= $row['nama_ekspedisi'];?>
                                                </td>
                                                <td class="align-middle"> <?= $row['no_resi'];?>
                                                </td>
                                                <td class="align-middle"><?php if($row['no_resi'] == '' ): ?>
                                                    <a>Belum Diproses</a>
                                                    <?php elseif($row['click'] == '1' ) : ?>
                                                    <a>Transaksi Selesai</a>
                                                    <?php else :  ?>
                                                    <a>Sedang Dalam Pengiriman</a>
                                                    <?php endif;  ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?php if($row['no_resi'] == '' ): ?>
                                                    <button class="btn btn-primary" data-toggle="modal"
                                                        data-target="#kirimPenjualan" id="btn-kirim"
                                                        data-idpenjualan="<?= $row['id_penjualan']; ?>"
                                                        data-noresi="<?=$row['no_resi']; ?>">
                                                        Kirim
                                                    </button>
                                                    <!-- <button type="button" data-toggle="modal"
                                                        data-target="#modalHistory" id="btn-selesai"
                                                        class="btn btn-success"
                                                        data-idpenjualan="<?= $row['id_penjualan']; ?>"
                                                        data-namacustomer="<?= $row['nama_customer']; ?>"
                                                        data-alamatcustomer="<?= $row['alamat']; ?>"
                                                        data-notelp="<?= $row['no_telp']; ?>"
                                                        data-namamerchant="<?= $row['nama_merchant']; ?>"
                                                        data-namaekspedisi="<?= $row['nama_ekspedisi']; ?>"
                                                        data-noresi="<?= $row['no_resi']; ?>"
                                                        data-harga="<?= $row['total_harga']; ?>"
                                                        data-ongkir="<?= $row['harga_ongkir']; ?>"
                                                        data-retur="<?= $row['tgl_retur']; ?>"> Uang Diterima
                                                    </button> -->
                                                    <?php elseif($row['click'] == '1' ) : ?>
                                                    <a class="align-middle text-dark "></a>
                                                    <?php else :  ?>
                                                    <button class="btn btn-primary mb-2" data-toggle="modal"
                                                        data-target="#returPenjualan" id="btn-retur"
                                                        data-idpenjualan="<?= $row['id_penjualan']; ?>"
                                                        data-namacustomer="<?= $row['nama_customer']; ?>"
                                                        data-alamatcustomer="<?= $row['alamat']; ?>"
                                                        data-notelp="<?= $row['no_telp']; ?>"
                                                        data-namamerchant="<?= $row['nama_merchant']; ?>"
                                                        data-namaekspedisi="<?= $row['nama_ekspedisi']; ?>"
                                                        data-noresi="<?= $row['no_resi']; ?>"
                                                        data-harga="<?= $row['total_harga']; ?>"
                                                        data-tglkirims="<?= $row['tgl_kirim']; ?>"
                                                        data-ongkir="<?= $row['harga_ongkir']; ?>">
                                                        Retur
                                                    </button>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#modalHistory" id="btn-selesai"
                                                        class="btn btn-success"
                                                        data-idpenjualan="<?= $row['id_penjualan']; ?>"
                                                        data-namacustomer="<?= $row['nama_customer']; ?>"
                                                        data-alamatcustomer="<?= $row['alamat']; ?>"
                                                        data-notelp="<?= $row['no_telp']; ?>"
                                                        data-namamerchant="<?= $row['nama_merchant']; ?>"
                                                        data-namaekspedisi="<?= $row['nama_ekspedisi']; ?>"
                                                        data-noresi="<?= $row['no_resi']; ?>"
                                                        data-harga="<?= $row['total_harga']; ?>"
                                                        data-ongkir="<?= $row['harga_ongkir']; ?>"
                                                        data-tglkirims="<?= $row['tgl_kirim']; ?>"> Uang Diterima
                                                    </button>

                                                    <?php endif;  ?>
                                                </td>
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="home-tab2">
                                    <table id="daftarhistory"
                                        class="table table-xl table-hover table-responsive-xl table-bordered text-center">
                                        <thead>
                                            <tr class="table-primary">
                                                <th scope="col">ID Penjualan</th>
                                                <th scope="col">Nama Pelanggan</th>
                                                <th scope="col">Alamat</th>
                                                <th scope="col">Nomor Telepon</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Jumlah Barang</th>
                                                <th scope="col">Total Akhir</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark bg-light">
                                            <tr>
                                                <?php foreach($datahistorypenjualan as$row) : ?>
                                                <td> <?= $row['id_penjualan'];?>
                                                </td>
                                                <td> <?= $row['nama_customer'];?>
                                                </td>
                                                <td> <?= $row['alamat'];?>
                                                </td>
                                                <td> <?= $row['no_telp'];?>
                                                </td>
                                                <td> <?= $row['nama_barang'];?>
                                                </td>
                                                <td> <?= $row['jmlh_barang'];?>
                                                </td>
                                                <td>Rp. <?= number_format($row['total_harga'],0,',','.');?>
                                                </td>
                                                <td> <?= $row['status'];?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-success" type="button" data-toggle="modal"
                                                        data-target="#detailhis" id="btn-detail"
                                                        data-iddet="<?= $row['id']; ?>"
                                                        data-idjual="<?= $row['id_penjualan']; ?>"
                                                        data-namacs="<?= $row['nama_customer']; ?>"
                                                        data-alamatcs="<?= $row['alamat']; ?>"
                                                        data-notelpcs="<?= $row['no_telp']; ?>"
                                                        data-namabarang="<?= $row['nama_barang']; ?>"
                                                        data-jmlhbarang="<?= $row['jmlh_barang']; ?>"
                                                        data-subttl="<?= number_format($row['sub_total'],0,',','.'); ?>"
                                                        data-totalpenj="<?= number_format($row['total_harga'],0,',','.'); ?>"
                                                        data-status="<?= $row['status']; ?>"
                                                        data-tglkirim="<?= date_indo($row['tgl_kirim']); ?>"
                                                        data-tglretur="<?= date_indo($row['tgl_retur']); ?>"
                                                        data-tgljual="<?= date_indo($row['tgl_penjualan']); ?>"
                                                        data-noresi="<?= $row['no_resi']; ?>"
                                                        data-buktibyr="<?=$row['bukti_bayar'];?>"
                                                        data-ongkir="<?= $row['harga_ongkir']; ?>"
                                                        data-statushis="<?= $row['status']; ?>"
                                                        data-namaekspedisi="<?= $row['nama_ekspedisi']; ?>">
                                                        Detail
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                    <div class="row justify-content-end">
                                        <table class="table table-hover table-borderless text-left col-5 mr-3">
                                            <thead>
                                                <tr class="table-primary">
                                                    <th scope="col">Total</th>
                                                    <th scope="col" class="text-right">
                                                        <?= $datatotalproduk['jmlh_barang']; ?>
                                                    </th>
                                                </tr>

                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<form method="POST" action="<?= base_url('/admin/insert_resi') ?>">
    <div class="modal fade" id="kirimPenjualan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Masukan Nomor Resi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <input type="text" class="form-control" name="no_resi" id="no_resi">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_penjualan" name="id_penjualan">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form method="POST" action="<?= base_url('/admin/penjualan') ?>">
    <div class="modal fade" id="tambahModalPenjualan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Penjualan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="id_penjualan" id="id_penjualan"
                                    value="<?= $getidpenjualan?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Customer</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="nama_customer" name="nama_customer">
                                    <?php foreach($datacustomer as $row) : ?>
                                    <option value="<?=$row['nama_customer'];?>"><?=$row['nama_customer'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Merchant</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="nama_merchant" name="nama_merchant">
                                    <?php foreach($datamerchant as $row) : ?>
                                    <option value="<?=$row['nama_merchant'];?>"><?=$row['nama_merchant'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Barang</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="nama_barang" name="nama_barang">
                                    <?php foreach($dataproduct as $row) : ?>
                                    <option value="<?=$row['nama_barang'];?>"><?=$row['nama_barang'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jumlah Barang</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jmlh_barang" id="jmlh_barang">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Harga Ongkir</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="harga_ongkir" id="harga_ongkir">
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Ekspedisi</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="nama_ekspedisi" name="nama_ekspedisi">
                                    <?php foreach($dataekspedisi as $row) : ?>
                                    <option value="<?=$row['nama_ekspedisi'];?>"><?=$row['nama_ekspedisi'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Save</button>
                </div>
            </div>
        </div>
    </div>
</form>


<form method="POST" action="<?= base_url('/admin/tambah_barang') ?>">
    <div class="modal fade" id="tambahModalBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">ID Penjualan</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="id_penjualan" name="id_penjualan">
                                    <?php foreach($selectidpenjualan as $row) : ?>
                                    <option value="<?=$row['id_penjualan'];?>"><?=$row['id_penjualan'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Merchant</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="nama_merchant" name="nama_merchant">
                                    <?php foreach($datamerchant as $row) : ?>
                                    <option value="<?=$row['nama_merchant'];?>"><?=$row['nama_merchant'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Nama Barang</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="nama_barang" name="nama_barang">
                                    <?php foreach($dataproduct as $row) : ?>
                                    <option value="<?=$row['nama_barang'];?>"><?=$row['nama_barang'];?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Jumlah Barang</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="jmlh_barang" id="jmlh_barang">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Save</button>
                </div>
            </div>
        </div>
    </div>
</form>


<div class="modal fade" id="modalHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('admin/update_history_penjualan') ?>" method="post"
                enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Penjualan Selesai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-4">
                            <label class="col-sm-4">Upload Bukti Pembayaran</label>
                            <div class="col-sm-6">
                                <input type="file" class="dropify" data-height="180" id="file_upload"
                                    name="file_upload">
                            </div>
                        </div>
                        <h5 class="text-dark mt-3">Anda yakin barang sudah dikirim dan selesai?</h5>
                        <input type="hidden" id="id_penjualan" name="id_penjualan">
                        <input type="hidden" id="nama_customer" name="nama_customer">
                        <input type="hidden" id="alamat" name="alamat">
                        <input type="hidden" id="no_telp" name="no_telp">
                        <input type="hidden" id="nama_merchant" name="nama_merchant">
                        <input type="hidden" id="nama_ekspedisi" name="nama_ekspedisi">
                        <input type="hidden" id="no_resi" name="no_resi">
                        <input type="hidden" id="tgl_kirim" name="tgl_kirim">
                        <input type="hidden" id="total_harga" name="total_harga">
                        <input type="hidden" id="harga_ongkir" name="harga_ongkir">
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

<div class="modal fade" id="returPenjualan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('admin/update_retur') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Retur Penjualan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-4">
                            <label class="col-sm-4">Upload Bukti Retur</label>
                            <div class="col-sm-6">
                                <input type="file" class="dropify" data-height="180" id="file_upload"
                                    name="file_upload">
                            </div>
                        </div>
                        <h5 class="text-dark mt-3">Anda yakin barang sudah diretur?</h5>
                        <input type="hidden" id="id_penjualan" name="id_penjualan">
                        <input type="hidden" id="nama_customer" name="nama_customer">
                        <input type="hidden" id="alamat" name="alamat">
                        <input type="hidden" id="no_telp" name="no_telp">
                        <input type="hidden" id="nama_merchant" name="nama_merchant">
                        <input type="hidden" id="nama_ekspedisi" name="nama_ekspedisi">
                        <input type="hidden" id="no_resi" name="no_resi">
                        <input type="hidden" id="tgl_kirim" name="tgl_kirim">
                        <input type="hidden" id="total_harga" name="total_harga">
                        <input type="hidden" id="harga_ongkir" name="harga_ongkir">
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

<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('admin/delete_history_penjualan') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title text-dark" id="exampleModalLabel">Delete History Penjualan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <h5 class="text-dark mt-3">Anda yakin ingin menghapus data History Penjualan?</h5>
                        <input type="hidden" id="id_history" name="id_history">
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

<form method="POST" action="<?= base_url('admin/jurnal_penjualan') ?>" enctype="multipart/form-data">
    <div class="modal fade" id="prosesjurnal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Tambah Data Penjualan Ke Jurnal Per Bulan
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="window.location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="form-group row align-items-center mt-3">
                            <label class="col-sm-4">Pilih Bulan</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="bln_jurnal" name="bln_jurnal">
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label class="col-sm-4">Pilih Tahun</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="thn_history" name="thn_history">
                                    <?php foreach($tahunhistory as $row) : ?>
                                    <?php if($row['tahun']== '0') : ?>
                                    <a></a>
                                    <?php else: ?>
                                    <option value="<?=$row['tahun'];?>">
                                        <?=$row['tahun'];?></option>
                                    <?php endif; ?>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onClick="window.location.reload();">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal  fade" id="detailhis">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Detail History Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    onClick="window.location.reload();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card card-primary">
                    <table class="table table-lg no-margin">
                        <tbody>
                            <!-- <tr>
                                <th>ID History</th>
                                <td>: <span id="id_hist"></span></td>
                            </tr> -->
                            <tr>
                                <th>ID Penjualan</th>
                                <td>: <span id="id_penjualan"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Customer</th>
                                <td>: <span id="nama_cus"></span></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>: <span id="alamat"></span></td>
                            </tr>
                            <tr>
                                <th>No Telepon</th>
                                <td>: <span id="no_telp"></span></td>
                            </tr>
                            <tr>
                                <th>Nama Barang</th>
                                <td>: <span id="nama_barang"></span></td>
                            </tr>
                            <tr>
                                <th>Jumlah Barang</th>
                                <td>: <span id="jmlh_barang"></span></td>
                            </tr>
                            <tr>
                                <th>Sub Total</th>
                                <td>: <span id="sub_total"></span></td>
                            </tr>
                            <tr>
                                <th>Harga Ongkir</th>
                                <td>: <span id="harga_ongkir"></span></td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <td>: <span id="total_harga"></span></td>
                            </tr>
                            <tr>
                                <th>Ekspedisi</th>
                                <td>: <span id="nama_ekspedisi"></span></td>
                            </tr>
                            <tr>
                                <th>Nomor Resi</th>
                                <td>: <span id="no_resi"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Kirim</th>
                                <td>: <span id="tgl_kirim"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Terjual</th>
                                <td>: <span id="tgl_jual"></span></td>
                            </tr>
                            <tr>
                                <th>Tanggal Retur</th>
                                <td>: <span id="tgl_retur"></span></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>: <span id="status"></span></td>
                            </tr>
                            <tr>
                                <th>Bukti Bayar</th>
                                <td><img src="" width="300" height="150" id="upload_gambar"></img></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $(document).on('click', '#btn-detail', function() {
        var idser = $(this).data('iddet');
        var idpen = $(this).data('idjual');
        var cs = $(this).data('namacs');
        var alamat = $(this).data('alamatcs');
        var telp = $(this).data('notelpcs');
        var barang = $(this).data('namabarang');
        var jmlh = $(this).data('jmlhbarang');
        var resi = $(this).data('noresi');
        var retur = $(this).data('tglretur');
        var jual = $(this).data('tgljual');
        var ekspedisi = $(this).data('namaekspedisi');
        var kirim = $(this).data('tglkirim');
        var sub = $(this).data('subttl');
        var total = $(this).data('totalpenj');
        var bukti = $(this).data('buktibyr');
        var base_url = "http://localhost/ci-akuntansi/template/assets/img/bukti-bayar-penjualan/"
        var hrgongkir = $(this).data('ongkir');
        var sts = $(this).data('statushis');
        $('.table #id_hist').text(idser);
        $('.table #id_penjualan').text(idpen);
        $('.table #nama_cus').text(cs);
        $('.table #alamat').text(alamat);
        $('.table #no_telp').text(telp);
        $('.table #jmlh_barang').text(jmlh);
        $('.table #nama_barang').text(barang);
        $('.table #nama_ekspedisi').text(ekspedisi);
        $('.table #no_resi').text(resi);
        $('.table #total_harga').text(total);
        $('.table #harga_ongkir').text(hrgongkir);
        $('.table #sub_total').text(sub);
        $('.table #upload_gambar').attr('src', base_url + bukti);
        $('.table #tgl_kirim').text(kirim);
        $('.table #tgl_jual').text(jual);
        $('.table #tgl_retur').text(retur);
        $('.table #status').text(sts);
    })

    $(document).on('click', '#btn-kirim', function() {
        var id = $(this).data('idpenjualan');
        var resi = $(this).data('noresi');
        $('.modal-footer #id_penjualan').val(id);
        $('.modal-body #no_resi').val(resi);
    })

    $(document).on('click', '#btn-selesai', function() {
        var id = $(this).data('idpenjualan');
        var customer = $(this).data('namacustomer');
        var alamat = $(this).data('alamatcustomer');
        var telp = $(this).data('notelp');
        var merchant = $(this).data('namamerchant');
        var ekspedisi = $(this).data('namaekspedisi');
        var resi = $(this).data('noresi');
        var tgl = $(this).data('retur');
        var hrg = $(this).data('harga');
        var ong = $(this).data('ongkir');
        var kirim = $(this).data('tglkirims');
        $('.modal-body #id_penjualan').val(id);
        $('.modal-body #nama_customer').val(customer);
        $('.modal-body #alamat').val(alamat);
        $('.modal-body #no_telp').val(telp);
        $('.modal-body #nama_merchant').val(merchant);
        $('.modal-body #nama_ekspedisi').val(ekspedisi);
        $('.modal-body #no_resi').val(resi);
        $('.modal-body #tgl_retur').val(tgl);
        $('.modal-body #total_harga').val(hrg);
        $('.modal-body #harga_ongkir').val(ong);
        $('.modal-body #tgl_kirim').val(kirim);
    })

    $(document).on('click', '#btn-retur', function() {
        var id = $(this).data('idpenjualan');
        var customer = $(this).data('namacustomer');
        var alamat = $(this).data('alamatcustomer');
        var telp = $(this).data('notelp');
        var merchant = $(this).data('namamerchant');
        var ekspedisi = $(this).data('namaekspedisi');
        var resi = $(this).data('noresi');
        var hrg = $(this).data('harga');
        var ong = $(this).data('ongkir');
        var kirim = $(this).data('tglkirims');
        $('.modal-body #id_penjualan').val(id);
        $('.modal-body #nama_customer').val(customer);
        $('.modal-body #alamat').val(alamat);
        $('.modal-body #no_telp').val(telp);
        $('.modal-body #nama_merchant').val(merchant);
        $('.modal-body #nama_ekspedisi').val(ekspedisi);
        $('.modal-body #no_resi').val(resi);
        $('.modal-body #total_harga').val(hrg);
        $('.modal-body #harga_ongkir').val(ong);
        $('.modal-body #tgl_kirim').val(kirim);
    })



    $(document).on('click', '#btn-hapus', function() {
        $('.modal-body #id_history').val($(this).data('id'));

    })

})
</script>
<script>
$(document).ready(function() {
    $('#daftarpenj').DataTable({
        responsive: true
    });
    $('#daftarhistory').DataTable({
        responsive: true
    });


});
</script>

<script>
$(document).ready(function() {
    $('.dropify').dropify({
        messages: {
            'default': 'Click Here !',
        }
    });
});
</script>
<script>
$(document).ready(function() {

})
</script>

<?= $this->endSection();?>