<?php



$id        = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$id'");
$rowEdit   = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['update'])) {
  // $_POST
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = sha1($_POST['password']);

  if ($password) {
    $query = mysqli_query($koneksi, "UPDATE users
    SET name='$name', email='$email', password='$password' WHERE id='$id'");
  } else {
    $query = mysqli_query($koneksi, "UPDATE users
    SET name='$name', email='$email' WHERE id='$id'");
  }

  // $edited = mysqli_query($koneksi, $query);

  if ($query) {
    header("location:user.php?ubah=berhasil");
  }
}

if (isset($_POST['simpan'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = sha1($_POST['password']);

  $query = mysqli_query(
    $koneksi,
    "INSERT INTO users (name, email, password) 
        VALUES ('$name','$email','$password')"
  );

  if ($query) {
    header("location:?page=user&=berhasil");
  }
}

// echo "<pre>";
// print_r($rowEdit);
// echo "</pre>";
?>


<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">
          <?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?> User
        </h3>
        <form action="" method="post">
          <div class="mb-3">
            <label for="" class="form-label">Name *</label>
            <input type="text" name="name" class="form-control" placeholder="Enter your name" required value="<?php echo $rowEdit['name'] ?? ''  ?>">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="text" name="email" class="form-control" placeholder="Enter your email" required value="<?php echo $rowEdit['email'] ?? '' ?>">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password * <small>Kosongkan jika tidak ingin mengubah</small></label>
            <br>
            <input type="password" name="password" class="form-control" placeholder="Enter your password">
          </div>
          <br>
          <div class="mb-3">
            <button class="btn btn-primary" type="submit" name="<?= $id ? 'update' : 'simpan' ?>">
              <?= $id ? 'Simpan perubahan' : 'Simpan' ?>
            </button>
            <a href="?page=user" class="btn btn-secondary">Back</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>