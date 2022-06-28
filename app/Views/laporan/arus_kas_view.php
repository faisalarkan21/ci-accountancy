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
                <div class="breadcrumb-item">Laporan Arus Kas</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card card-secondary">
                <div class="card-wrap">
                    <div class="card-header">
                        <h3><strong class="text-dark">Arus Kas</strong></h3>
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
                            Filter Laporan Arus Kas
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
                            <h5>Laporan Arus Kas</h5>
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

                            <table
                                class="table table-md table-hover text-dark  border-top border-left border-bottom border-right">
                                <tbody class="text-dark">
                                    <?php 
                                $total_debet = 0;
                                $total_kredit = 0;
                                $total_kas_plg = 0;
                                $total_bayar_kas= 0;
                                $total_beban_air = 0;
                                $total_beban_lis = 0;
                                $total_beban_rep = 0;
                                $total_ut_gaji = 0;
                                $total_bangunan = 0;
                                $total_modal_awl = 0;
                                $total_prive = 0;
                                
                                
                                ?>
                                    <tr>
                                        <th class="text-left">Arus kas dari Aktivitas Operasi
                                        </th>
                                        <th class="text-right"></th>
                                    </tr>
                                    <tr>
                                        <td class="text-left">penerimaan kas dari pelanggan
                                        </td>
                                        <?php foreach($jurnal as $row){ ?>
                                        <?php if($row->kode_akun == '411') : ?>
                                        <?php $total_kas_plg=$total_kas_plg+$row->kredit;  ?>
                                        <?php endif; ?>
                                        <?php } ?>
                                        <td class="text-right">Rp.
                                            <?= number_format(($totalkasplg=$total_kas_plg),0,',','.')?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">pembayaran kas kepada pemasok
                                        </td>
                                        <?php foreach($jurnal as $row){ ?>
                                        <?php if($row->kode_akun == '212-1') : ?>
                                        <?php $total_bayar_kas=$total_bayar_kas+$row->debet;  ?>
                                        <?php endif; ?>
                                        <?php } ?>
                                        <td class="text-right">Rp.
                                            <?= number_format(($totalbayarkas=$total_bayar_kas),0,',','.')?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">pembayaran untuk beban usaha
                                        </td>
                                        <?php foreach($jurnal as $row){ ?>
                                        <?php if($row->kode_akun == '511-1') : ?>
                                        <?php $total_beban_air=$total_beban_air+$row->debet;  ?>
                                        <?php elseif($row->kode_akun == '511-2') : ?>
                                        <?php $total_beban_lis=$total_beban_lis+$row->debet;  ?>
                                        <?php elseif($row->kode_akun == '511-4') : ?>
                                        <?php $total_beban_rep=$total_beban_rep+$row->debet;  ?>
                                        <?php endif; ?>
                                        <?php } ?>
                                        <td class="text-right">Rp.
                                            <?= number_format(($totalbeban=$total_beban_air+$total_beban_lis+$total_beban_rep),0,',','.')?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">pembayaran utang karyawan
                                        </td>
                                        <?php foreach($jurnal as $row){ ?>
                                        <?php if($row->kode_akun == '212-2') : ?>
                                        <?php $total_ut_gaji=$total_ut_gaji+$row->debet;  ?>
                                        <?php endif; ?>
                                        <?php } ?>
                                        <td class="text-right">Rp.
                                            <?= number_format(($totalutgaji=$total_ut_gaji),0,',','.')?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">pembayaran bunga dan adm. Bank

                                        </td>
                                        <td class="text-right">0</td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Arus Kas Netto dari Aktivitas Operasi

                                        </th>
                                        <th class="text-right">Rp.
                                            <?= number_format(($totalnetop=$totalkasplg-($totalbayarkas+$totalbeban+$totalutgaji)),0,',','.')?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th> </th>
                                        <th> </th>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Arus Kas untuk Aktivitas Investasi
                                        </th>
                                        <th class="text-right"></th>
                                    </tr>
                                    <tr>
                                        <td class="text-left">penerimaan bunga bank
                                        </td>
                                        <td class="text-right">0</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">pembayaran aset tetap
                                        </td>
                                        <?php foreach($jurnal as $row){ ?>
                                        <?php if($row->kode_akun == '121-2') : ?>
                                        <?php $total_bangunan=$total_bangunan+$row->debet;  ?>
                                        <?php endif; ?>
                                        <?php } ?>
                                        <td class="text-right">Rp.
                                            <?= number_format(($totalbangunan=$total_bangunan),0,',','.')?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td class="text-left">pembayaran aset lain-lain
                                        </td>
                                        <td class="text-right">0</td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Arus Kas Netto dari Aktivitas Investasi

                                        </th>
                                        <th class="text-right">Rp.
                                            <?= number_format(($totalbangunan),0,',','.')?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th> </th>
                                        <th> </th>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Arus Kas Untuk Aktivitas Pendanaan

                                        </th>
                                        <th class="text-right">
                                    </tr>
                                    <tr>
                                        <td class="text-left">modal
                                        </td>
                                        <?php foreach($jurnal as $row){ ?>
                                        <?php if($row->kode_akun == '311-1') : ?>
                                        <?php $total_modal_awl=$total_modal_awl+$row->kredit;  ?>
                                        <?php endif; ?>
                                        <?php } ?>
                                        <td class="text-right">Rp.
                                            <?= number_format(($totalmodalawl=$total_modal_awl),0,',','.')?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">prive
                                        </td>
                                        <?php foreach($jurnal as $row){ ?>
                                        <?php if($row->kode_akun == '311-2') : ?>
                                        <?php $total_prive=$total_prive+$row->debet;  ?>
                                        <?php endif; ?>
                                        <?php } ?>
                                        <td class="text-right">Rp.
                                            <?= number_format(($totalprive=$total_prive),0,',','.')?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <th class="text-left">Arus Kas Netto dari Aktivitas Pendanaan

                                        <th class="text-right">Rp.
                                            <?= number_format(($totalnetpendanaan=$totalmodalawl-$totalprive),0,',','.')?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th> </th>
                                        <th> </th>
                                    </tr>
                                    <tr>
                                        <th class="text-left">kenaikan/penurunan kas dan setara kas
                                        </th>
                                        <th class="text-right">Rp.
                                            <?= number_format(($totakhirkas=$totalnetpendanaan-$totalbangunan+$totalnetop),0,',','.')?>
                                        </th>

                                    </tr>
                                    <tr>
                                        <td class="text-left">Saldo awal kas periode sebelumnya
                                        </td>
                                        <td class="text-right">0</td>
                                    </tr>
                                    <tr class="">
                                        <th class="text-left">Saldo akhir kas periode
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
                                        <th class="text-right border-top">Rp.
                                            <?= number_format(($totakhirkas),0,',','.')?>
                                        </th>
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
                            <h5>Laporan Arus Kas</h5>
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