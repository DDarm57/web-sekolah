<?php include "../pembina/layout_pembina/header.php" ?>

<?php
if (isset($_POST["update_gambar"])) {
    require '../pembina/pembina_controller/update.php';
    update_gambar($_POST);
}

if (isset($_POST["update_profil"])) {
    require '../pembina/pembina_controller/update.php';
    update_profil($_POST);
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profil</h1>
        <p class="d-none d-sm-inline-block"><a href="dashboard.php">Dashboard</a> / <strong>Profil</strong></p>
    </div>
    <div class="card rounded-5 mb-4">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="img-thumbnail" id="imgPreview" width="150" src="../admin/gambar/pembina/<?= $get_pembina["gambar_pembina"]; ?>">
                    <div class="text-center">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="gambar_lama" value="<?= $get_pembina["gambar_pembina"]; ?>">
                            <input type="file" name="file" class="form-control mt-2 mb-2" id="file_image">
                            <button type="submit" name="update_gambar" class="btn btn-sm btn-primary">Update Gambar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Edit Profile</h4>
                    </div>
                    <form action="" method="post">
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">NAMA</label><input type="text" name="nama_pembina" class="form-control" value="<?= $get_pembina["nama_pembina"]; ?>"></div>
                            <div class="col-md-12">
                                <label class="labels">NIP</label>
                                <input type="number" name="nip" class="form-control" value="<?= $get_pembina["nip"]; ?>">
                            </div>
                            <div class="col-md-12"><label class="labels">ALAMAT</label><input type="text" name="alamat_pembina" class="form-control" value="<?= $get_pembina["alamat_pembina"]; ?>"></div>
                            <div class="col-md-12"><label class="labels">NO HP</label><input type="text" name="no_hp" class="form-control" value="<?= $get_pembina["no_hp"]; ?>"></div>
                            <div class="col-md-12">
                                <div class="alert alert-info mt-2">Isi username dan password jika ingin mengubahnya juga</div>
                                <label class="labels">USERNAME</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">PASSWORD</label>
                                <input type="text" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" name="update_profil" type="submit">Update Profil</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../pembina/layout_pembina/footer.php" ?>