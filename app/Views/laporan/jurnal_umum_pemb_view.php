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
                <div class="breadcrumb-item">Jurnal Umum</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Jurnal Umum</strong></h3>
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
                            Filter Laporan Jurnal Umum
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" class="row">

                                <div class="col-md-4">
                                    <label class="form-label">Bulan</label>
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

                                <div class="col-md-3">
                                    <label class="form-label">Tahun</label>
                                    <select name="tahun" class="form-control" required>
                                        <option selected disabled value="">Pilih Tahun</option>
                                        <?php foreach($tahun as $rowt){ ?>
                                        <option><?= $rowt->tahun?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-3 d-flex align-items-center">
                                    <button type="submit" name="submit" class="btn btn-primary">Filter</button>
                                </div>

                            </form>
                        </div>
                    </div>

                    <?php 
                    if(isset($_POST['submit'])){
                    if($jurnal){?>
                    <div class="card my-5">
                        <div class="mx-auto text-center text-dark" style="width: 300px;">
                            <h5>CV Saudara Mulya Bersama</h5>
                        </div>
                        <div class="mx-auto text-center text-dark" style="width: 300px;">
                            <h5>Jurnal Umum</h5>
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
                        <div class="card-body px-3 py-3">

                            <table class="table table-bordered table-hover bg-light">
                                <thead class="text-dark">
                                    <tr class=" table-primary text-center">
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Ref</th>
                                        <th scope="col">Debet</th>
                                        <th scope="col">Kredit</th>
                                    </tr>
                                </thead>

                                <tbody class="text-dark">
                                    <?php 
                                $total_debet = 0;
                                $total_kredit = 0;
                                $id = "";
                                $nextid = "";
                                foreach($jurnal as $row){
                                    $nextid = $row->id;
                                    if($nextid != $id){
                                ?>

                                    <tr>
                                        <td class="text-center"><?= date_indo($row->tanggal)?></td>
                                        <td class="text-left"><?= $row->nama_akun?></td>
                                        <td class="text-center"><?= $row->kode_akun?></td>
                                        <td class="text-right">
                                            <?php if($row->debet == 0){ ?>
                                            -
                                            <?php }else{ ?>
                                            Rp. <?= number_format(($row->debet),0,',','.')?>
                                            <?php } ?>
                                        </td>
                                        <td class="text-right">
                                            <?php if($row->kredit == 0){ ?>
                                            -
                                            <?php }else{ ?>
                                            Rp. <?= number_format(($row->kredit),0,',','.')?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php }else{ ?>
                                    <tr>
                                        <td></td>
                                        <td class="text-center"><?= $row->nama_akun?></td>
                                        <td class="text-center"><?= $row->kode_akun?></td>
                                        <td class="text-right">
                                            <?php if($row->debet == 0){ ?>
                                            -
                                            <?php }else{ ?>
                                            Rp. <?= number_format(($row->debet),0,',','.')?>
                                            <?php } ?>
                                        </td>
                                        <td class="text-right">
                                            <?php if($row->kredit == 0){ ?>
                                            -
                                            <?php }else{ ?>
                                            Rp. <?= number_format(($row->kredit),0,',','.')?>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <?php
                                    }
                                    $total_debet = $total_debet + $row->debet; 
                                    $total_kredit = $total_kredit + $row->kredit; 
                                    $id = $row->id;                    
                                  } ?>

                                    <tr class="font-weight-bold">
                                        <td colspan="3" class="text-center">TOTAL</td>
                                        <td class="text-right">Rp. <?= number_format(($total_debet),0,',','.') ?>
                                        </td>
                                        <td class="text-right">Rp. <?= number_format(($total_kredit),0,',','.') ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php 
                    }else{?>
                    <div class="card my-5">
                        <div class="mx-auto text-center text-dark" style="width: 300px;">
                            <h5>CV Saudara Mulya Bersama</h5>
                        </div>
                        <div class="mx-auto text-center text-dark" style="width: 300px;">
                            <h5>Jurnal Umum</h5>
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
                        <div class="card-body px-3 py-5 text-center border-top">
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