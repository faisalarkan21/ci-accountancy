<?= $this->extend("templates/main");?>

<?= $this->section('content');?>

<script src="template/assets/assets/js/jquery.selectric.js"></script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, <?= ucfirst($userdata->nama);?></h2>
            <p class="section-lead">
                Silahkan Ubah Informasi Tentang Kamu di Halaman ini.
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">

                            <?php if($userdata->profil_pic != ''):?>
                            <img alt="image" src='<?= ($userdata->profil_pic);?>'
                                class="rounded-circle profile-widget-picture">
                            <?php else:?>
                            <img alt="image" src='<?= base_url('template')?>/assets/img/avatar/avatar-1.png'
                                class="rounded-circle profile-widget-picture">
                            <?php endif;?>
                            <div class="profile-widget-items">

                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-6">
                            <button class="btn btn-primary" type="button" data-toggle="modal"
                                data-target="#editModalAvatar">
                                <i class="fa fa-fw fa-camera"></i>
                                <span>Change Photo</span>
                            </button>
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
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#tentang"
                                            role="tab" aria-controls="home" aria-selected="true">Tentang Saya</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2"
                                            role="tab" aria-controls="profile" aria-selected="false">Profil
                                            Perusahaan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab2" data-toggle="tab" href="#contact2"
                                            role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-bordered" id="myTab3Content">
                                    <div class="tab-pane fade show active" id="tentang" role="tabpanel"
                                        aria-labelledby="home-tab2">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <strong>Nama Lengkap</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <p>: <?= ucfirst($userdata->nama);?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <strong>Email</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <p>: <?= ($userdata->email);?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile2" role="tabpanel"
                                        aria-labelledby="profile-tab2">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <strong>Nama Perusahaan</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <p>: <?= ucfirst($userdata->nama_perusahaan);?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <strong>Alamat Perusahaan</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <p>: <?= ucfirst($userdata->alamat);?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact2" role="tabpanel"
                                        aria-labelledby="contact-tab2">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <strong>Nomor Telepon</strong>
                                            </div>
                                            <div class="col-md-8">
                                                <p>: <?= ($userdata->no_telp);?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-danger" data-toggle="modal" data-target="#editModalPassword">Edit
                                    Password</button>
                                <button class="btn btn-success" data-toggle="modal" data-target="#editModalProfil">Edit
                                    Profile</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Edit Password-->
<form method="POST" action="<?= base_url('profile/change_password') ?>">
    <div class="modal fade" id="editModalPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Password Lama</label>
                        <input type="password" class="form-control" name="opwd" id="opwd">
                    </div>

                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" class="form-control" name="npwd" id="npwd">
                    </div>

                    <div class="form-group">
                        <label>Ketik Ulang Password</label>
                        <input type="password" class="form-control" name="cnpwd" id="cnpwd">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Password-->


<!-- Modal Change Profil Pict-->
<form method="POST" action="<?= base_url('profile/avatar') ?>">
    <div class="modal fade" id="editModalAvatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                        <div class="col-sm-12 col-md-7">
                            <div class="custom-file">
                                <label class="custom-file-label">Choose File</label>
                                <input type="file" class="custom-file-input" name="avatar" id="avatar" />
                            </div>
                        </div>
                        <div class="img-preview"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="upload" value="Upload"> Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Change Profil Pict-->

<!-- Modal Edit Profil-->
<form method="POST" action="<?= base_url('profile/edit_profil') ?>">
    <div class="modal fade" id="editModalProfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" id="nama"
                            placeholder="<?= ($userdata->nama);?>">
                    </div>

                    <div class="form-group">
                        <label>Nama Perusahaan</label>
                        <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan"
                            placeholder="<?= ($userdata->nama_perusahaan);?>">
                    </div>

                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" class="form-control" name="no_telp" id="no_telp"
                            placeholder="<?= ($userdata->no_telp);?>">
                    </div>

                    <div class="form-group">
                        <label>Alamat Perusahaan</label>
                        <textarea class="form-control" type="text" id="alamat" rows="3" name="alamat" data-height="100"
                            placeholder="<?= ($userdata->alamat);?>"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="update"> Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Edit Password-->
<script>
function previewImg(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.img-preview').html('<img style="width: 100%" src="' + e.target.result + '" />');
        }
        reader.readerAsDataURL(input.files[0]);
    }
}

$('#avatar').change(function() {
    previewImg(this);
});
</script>

<!-- Page Specific JS File -->
<script src="template/assets/js/page/features-post-create.js"></script>
<script src="template/assets/assets/js/jquery.uploadPreview.min.js"></script>
<script src="template/assets/assets/js/jquery.selectric.min.js"></script>

<?= $this->endSection();?>