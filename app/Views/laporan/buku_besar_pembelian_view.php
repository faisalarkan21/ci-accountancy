<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Laporan</a></div>
                <div class="breadcrumb-item">Buku Besar</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Buku Besar</strong></h3>
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
                    <div class="card">
                        <div class="card-header text-dark">
                            <h6>Filter Laporan Buku Besar</h6>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" class="text-dark">

                                <div class="row">
                                    <div class="col-md-3 align-items-center">
                                        <h6>Periode</h6>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">
                                            <h6>Bulan</h6>
                                        </label>
                                        <select name="bulan" class="form-control" required>
                                            <option selected disabled value="">Pilih Bulan</option>
                                            <?php foreach($bulan as $rowb){ ?>
                                            <?php if($rowb->bulan == 'January'):?>
                                            <option id='akhirbln' name='akhirbln' value='<?= $rowb->bulan?>'>
                                                Januari</option>
                                            <?php elseif($rowb->bulan == 'February'): ?>
                                            <option id='akhirbln' name='akhirbln' value='<?= $rowb->bulan?>'>
                                                Februari</option>
                                            <?php elseif($rowb->bulan == 'March'): ?>
                                            <option id='akhirbln' name='akhirbln' value='<?= $rowb->bulan?>'>
                                                Maret</option>
                                            <?php elseif($rowb->bulan == 'April'): ?>
                                            <option id='akhirbln' name='akhirbln' value='<?= $rowb->bulan?>'>
                                                April</option>
                                            <?php elseif($rowb->bulan == 'May'): ?>
                                            <option id='akhirbln' name='akhirbln' value='<?= $rowb->bulan?>'>
                                                Mei</option>
                                            <?php elseif($rowb->bulan == 'June'): ?>
                                            <option id='akhirbln' name='akhirbln' value='<?= $rowb->bulan?>'>
                                                Juni</option>
                                            <?php elseif($rowb->bulan == 'July'): ?>
                                            <option id='akhirbln' name='akhirbln' value='<?= $rowb->bulan?>'>
                                                Juli</option>
                                            <?php elseif($rowb->bulan == 'August'): ?>
                                            <option id='akhirbln' name='akhirbln' value='<?= $rowb->bulan?>'>
                                                Agustus</option>
                                            <?php elseif($rowb->bulan == 'September'): ?>
                                            <option id='akhirbln' name='akhirbln' value='<?= $rowb->bulan?>'>
                                                September</option>
                                            <?php elseif($rowb->bulan == 'October'): ?>
                                            <option id='akhirbln' name='akhirbln' value='<?= $rowb->bulan?>'>
                                                Oktober</option>
                                            <?php elseif($rowb->bulan == 'November'): ?>
                                            <option id='akhirbln' name='akhirbln' value='<?= $rowb->bulan?>'>
                                                November</option>
                                            <?php elseif($rowb->bulan == 'December'): ?>
                                            <option id='akhirbln' name='akhirbln' value='<?= $rowb->bulan?>'>
                                                Desember</option>
                                            <?php endif;?>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">
                                            <h6>Tahun</h6>
                                        </label>
                                        <select name="tahun" class="form-control" required>
                                            <option selected disabled value="">Pilih Tahun</option>
                                            <?php foreach($tahun as $rowt){ ?>
                                            <option><?= $rowt->tahun?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-3  align-items-center">
                                        <h6> Nama COA</h6>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="coa" class="form-control" required>
                                            <option selected disabled value="">Pilih COA</option>
                                            <?php foreach($coa as $rowc){ ?>
                                            <option><?= $rowc->nama_akun?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-7 mt-4  align-items-center">
                                    <button type="submit" name="submit" class="btn btn-primary">Filter</button>
                                </div>

                            </form>
                        </div>
                    </div>

                    <?php 
                if(isset($_POST['submit'])){
                    if($buku_besar){?>
                    <div class="card my-5">
                        <div class="mx-auto text-center text-dark" style="width: 300px;">
                            <h5>CV Saudara Mulya Bersama</h5>
                        </div>
                        <div class="mx-auto text-center text-dark" style="width: 300px;">
                            <h5>Buku Besar</h5>
                        </div>
                        <div class="mx-auto text-center text-dark" style="width: 300px;">
                            <h5>Per
                                <?php if($_POST['bulan'] == 'January'): ?>
                                31
                                <?php elseif($_POST['bulan'] == 'February'): ?>
                                28
                                <?php elseif($_POST['bulan'] == 'March' ): ?>
                                31
                                <?php elseif($_POST['bulan'] == 'April'): ?>
                                30
                                <?php elseif($_POST['bulan'] == 'May'): ?>
                                31
                                <?php elseif($_POST['bulan'] == 'June'): ?>
                                30
                                <?php elseif($_POST['bulan'] == 'July'): ?>
                                31
                                <?php elseif($_POST['bulan'] == 'August'): ?>
                                31
                                <?php elseif($_POST['bulan'] == 'September'): ?>
                                30
                                <?php elseif($_POST['bulan'] == 'October'): ?>
                                31
                                <?php elseif($_POST['bulan'] == 'November'): ?>
                                30
                                <?php elseif($_POST['bulan'] == 'December'): ?>
                                31


                                <?php endif;?>
                                <?php if($_POST['bulan'] == 'January'):?>
                                Januari
                                <?php elseif($_POST['bulan'] == 'February'): ?>
                                Februari
                                <?php elseif($_POST['bulan'] == 'March'): ?>
                                Maret
                                <?php elseif($_POST['bulan'] == 'April'): ?>
                                April
                                <?php elseif($_POST['bulan'] == 'May'): ?>
                                Mei
                                <?php elseif($_POST['bulan'] == 'June'): ?>
                                Juni
                                <?php elseif($_POST['bulan'] == 'July'): ?>
                                Juli
                                <?php elseif($_POST['bulan'] == 'August'): ?>
                                Agustus
                                <?php elseif($_POST['bulan'] == 'September'): ?>
                                September
                                <?php elseif($_POST['bulan'] == 'October'): ?>
                                Oktober
                                <?php elseif($_POST['bulan'] == 'November'): ?>
                                November
                                <?php elseif($_POST['bulan'] == 'December'): ?>
                                Desember
                                <?php endif;?>
                                <?= $_POST['tahun']?>
                            </h5>
                        </div>

                    </div>
                    <div class="card-body px-3 py-2">
                        <div class="text-dark" style="width: 300px;">
                            <h6>Nama Akun : <?= $_POST['coa']?></h6>
                        </div>
                        <table class="table table-bordered table-hover bg-light">
                            <thead class="text-dark">

                                <tr class=" table-primary text-center">
                                    <th rowspan="3" style="vertical-align:middle;" scope="col">Tanggal</th>
                                    <th rowspan="3" style="vertical-align:middle;" scope="col">Keterangan
                                    </th>
                                    <th rowspan="3" style="vertical-align:middle;" scope="col">Ref</th>
                                    <th rowspan="3" style="vertical-align:middle;" scope="col">Debet</th>
                                    <th rowspan="3" style="vertical-align:middle;" scope="col">Kredit</th>
                                    <th colspan="2" scope="col">Saldo</th>
                                </tr>


                                <tr class="table-primary text-center">
                                    <th rowspan="2" scope="col">Debet</th>
                                    <th rowspan="2" scope="col">Kredit</th>
                                </tr>


                            </thead>

                            <tbody class="text-dark">
                                <tr class="text-center">

                                    <td></td>
                                    <td>Saldo Awal</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                                <?php 
                                $debet = 0;
                                $kredit = 0;
                                foreach($buku_besar as $row){
                                    $debet = $debet + $row->debet;
                                    $kredit = $kredit + $row->kredit;
                                    $kredit2 = $kredit - $debet;
                                ?>


                                <?php if($_POST['coa']=="Kas" || "Beban Air") : ?>
                                <tr>
                                    <td class="text-center"><?= date_indo($row->tanggal)?></td>

                                    <?php if($row->kode_akun == '512-5'  ) : ?>
                                    <td class="text-center">Kas</td>
                                    <?php elseif($row->kode_akun == '512-6'  ) : ?>
                                    <td class="text-center">Kas</td>
                                    <?php elseif($row->kode_akun == '210'  ) : ?>
                                    <td class="text-center">Persediaan Bahan Baku</td>
                                    <?php elseif($row->kode_akun == '116-1'  ) : ?>
                                    <td class="text-center">Utang</td>
                                    <?php elseif($row->id == 'BPEM1' ) : ?>
                                    <td class="text-center">Beban Pemesanan</td>
                                    <?php elseif($row->id == 'BPNY1'  ) : ?>
                                    <td class="text-center">Beban Penyimpanan</td>
                                    <?php endif; ?>

                                    <?php if($row->kode_akun == '512-5'  ) : ?>
                                    <td class="text-center">111</td>
                                    <?php elseif($row->kode_akun == '512-6'  ) : ?>
                                    <td class="text-center">111</td>
                                    <?php elseif($row->kode_akun == '210'  ) : ?>
                                    <td class="text-center">116-1</td>
                                    <?php elseif($row->kode_akun == '116-1'  ) : ?>
                                    <td class="text-center">210</td>
                                    <?php elseif($row->id == 'BPEM1' ) : ?>
                                    <td class="text-center">512-5</td>
                                    <?php elseif($row->id == 'BPNY1'  ) : ?>
                                    <td class="text-center">512-6</td>
                                    <?php endif; ?>
                                    <td class="text-center">
                                        <?php if($row->debet == 0){ ?>
                                        -
                                        <?php }else{ ?>
                                        Rp. <?= number_format(($row->debet),0,',','.')?>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($row->kredit == 0){ ?>
                                        -
                                        <?php }else{ ?>
                                        Rp. <?= number_format($row->kredit,0,',','.')?>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($row->debet == 0){ ?>
                                        -
                                        <?php }else{ ?>
                                        Rp. <?= number_format($debet,0,',','.')?>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($row->kredit == 0){ ?>
                                        -
                                        <?php }else{ ?>
                                        Rp. <?= number_format(($kredit),0,',','.')?>
                                        <?php } ?>
                                    </td>
                                </tr>



                                <?php endif;  ?>

                                <?php }?>

                            </tbody>
                        </table>

                    </div>
                </div>

                <?php 
                    }else{?>
                <div class="card my-5">
                    <div class="card-header">
                        <h5 class="fw-bold">Laporan Buku Besar <?= $_POST['coa']?> &nbsp; </h5>
                        <h5> Periode <?= $_POST['bulan']?> Tahun <?= $_POST['tahun']?></h5>
                    </div>
                    <div class="card-body px-3 py-3 text-center">
                        <h1>Maaf Data Tidak Ditemukan</h1>
                    </div>
                </div>
                <?php   
                    }
                }else{?>
                <div class="d-flex justify-content-center align-items-center p-5 my-5">
                    <h1>Silahkan Melakukan Filter Terlebih Dahulu</h1>
                </div>
                <?php } ?>
            </div>
        </div>
</div>
</section>
</div>

<?= $this->endSection();?>