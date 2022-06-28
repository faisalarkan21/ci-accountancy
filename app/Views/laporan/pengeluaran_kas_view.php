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
                <div class="breadcrumb-item">Laporan Pengeluaran Kas</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Laporan Pengeluaran Kas</strong></h3>
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
                            Filter Laporan Pengeluaran Kas
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
                            <h5>Laporan Pengeluaran Kas
                            </h5>
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

                            <table class="table table-sm table-bordered table-hover bg-light">
                                <thead class="text-dark">

                                    <tr class=" table-primary text-center">
                                        <th rowspan="3" style="vertical-align:middle;" scope="col">Tanggal
                                        </th>
                                        <th rowspan="3" style="vertical-align:middle;" scope="col">Keterangan
                                        </th>
                                        <th rowspan="3" style="vertical-align:middle;" scope="col">Ref</th>
                                        <th colspan="3" style="vertical-align:middle;" scope="col">Debet</th>
                                        <th colspan="2" style="vertical-align:middle;" scope="col">Kredit</th>
                                    </tr>


                                    <tr class="table-primary text-center">
                                        <th rowspan="2" scope="col">Utang</th>
                                        <th rowspan="2" scope="col">Pembelian</th>
                                        <th rowspan="2" scope="col">Akun Lainnya</th>
                                    </tr>
                                    <tr class="table-primary text-center">
                                        <th rowspan="2" scope="col">Kas</th>
                                        <th rowspan="2" scope="col">Pot. Pembelian</th>
                                    </tr>


                                </thead>


                                <tbody class="text-dark">
                                    <?php 
                                $total_debet = 0;
                                $total_kredit = 0;
                                $total_pembelianbhn = 0;
                                $total_gaji = 0;
                                $total_prive = 0;
                                $total_bangunan = 0;
                                $total_bebanair = 0;
                                $total_bebanlis = 0;
                                $total_bebanrep = 0;
                                
                                foreach($jurnal as $row){
                                ?>

                                    <tr>
                                        <?php if($row->kode_akun == '212-1') : ?>
                                        <td class="text-left"><?= date_indo($row->tanggal)?></td>
                                        <td class="text-left">Utang Pembelian Bahan Baku</td>
                                        <td class="text-left">212-1</td>
                                        <?php $total_pembelianbhn=$total_pembelianbhn+$row->debet;  ?>
                                        <td class="text-left">Rp.
                                            <?= number_format($totbahan2=$total_pembelianbhn,0,',','.')?>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-left">Rp.
                                            <?= number_format($tot_pemb=$total_pembelianbhn,0,',','.')?>
                                        </td>

                                        <?php elseif($row->kode_akun == '212-2') : ?>
                                        <td class="text-left"><?= date_indo($row->tanggal)?></td>
                                        <td class="text-left">Utang Gaji</td>
                                        <td class="text-left">212-2</td>
                                        <?php $total_gaji=$total_gaji+$row->debet;  ?>

                                        <td class="text-left">Rp. <?= number_format($totgaji=$total_gaji,0,',','.')?>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <?php elseif($row->kode_akun == '311-2') : ?>
                                        <td class="text-left"><?= date_indo($row->tanggal)?></td>
                                        <td class="text-left">Prive</td>
                                        <td class="text-left">311-2</td>
                                        <?php $total_prive=$total_prive+$row->debet;  ?>
                                        <td></td>
                                        <td></td>
                                        <td class="text-left">Rp.
                                            <?= number_format($totprive=$total_prive,0,',','.')?></td>
                                        <td></td>
                                        <td></td>

                                        <?php elseif($row->kode_akun == '121-2') : ?>
                                        <td class="text-left"><?= date_indo($row->tanggal)?></td>
                                        <td class="text-left">Pembelian Aset Bangunan</td>
                                        <td class="text-left">121-2</td>
                                        <?php $total_bangunan=$total_bangunan+$row->debet;  ?>
                                        <td></td>
                                        <td class="text-left">Rp.
                                            <?= number_format($totbang=$total_bangunan,0,',','.')?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <?php elseif($row->kode_akun == '511-2') : ?>
                                        <td class="text-left"><?= date_indo($row->tanggal)?></td>
                                        <td class="text-left">Beban Listrik</td>
                                        <td class="text-left">511-2</td>
                                        <?php $total_bebanlis=$total_bebanlis+$row->debet;  ?>
                                        <td></td>
                                        <td></td>
                                        <td class="text-left">Rp.
                                            <?= number_format($totbeblis=$total_bebanlis,0,',','.')?></td>
                                        <td></td>
                                        <td></td>

                                        <?php elseif($row->kode_akun == '511-1') : ?>
                                        <td class="text-left"><?= date_indo($row->tanggal)?></td>
                                        <td class="text-left">Beban Air</td>
                                        <td class="text-left">511-1</td>
                                        <?php $total_bebanair=$total_bebanair+$row->debet;  ?>
                                        <td></td>
                                        <td></td>
                                        <td class="text-left">Rp.
                                            <?= number_format($totbebair=$total_bebanair,0,',','.')?></td>
                                        <td></td>
                                        <td></td>

                                        <?php elseif($row->kode_akun == '511-4') : ?>
                                        <td class="text-left"><?= date_indo($row->tanggal)?></td>
                                        <td class="text-left">Beban Reparasi Mesin</td>
                                        <td class="text-left">511-4</td>
                                        <?php $total_bebanrep=$total_bebanrep+$row->debet;  ?>
                                        <td></td>
                                        <td></td>
                                        <td class="text-left">Rp.
                                            <?= number_format($totbebrep=$total_bebanrep,0,',','.')?></td>
                                        <td></td>
                                        <td></td>


                                        <?php endif; ?>


                                    </tr>


                                    <?php } ?>
                                    <tr class="font-weight-bold">
                                        <td colspan="3" style="vertical-align:middle;" scope="col" class="text-center">
                                            Jumlah</td>
                                        <td class="text-left">Rp.
                                            <?= number_format($totbahan2+$totgaji,0,',','.')?>
                                        <td class="text-left">Rp.<?= number_format($totbang,0,',','.')?></td>
                                        <td class="text-left">Rp.
                                            <?= number_format($totbebair+$totbeblis+$totbebrep+$totprive,0,',','.')?>
                                        </td>
                                        <td class="text-left">Rp.
                                            <?= number_format($totbahan2,0,',','.')?>
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
                            <h5>Laporan Pengeluaran Kas
                            </h5>
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