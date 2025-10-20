<?php
// require_once "config/koneksi.php";
$selectCategory = mysqli_query($koneksi, "SELECT * FROM categories");
$categories = mysqli_fetch_all($selectCategory, MYSQLI_ASSOC);
// var_dump($categories);

if (isset($_POST['simpan'])) {
  $c_id           = $_POST['category_id'];
  $p_name         = $_POST['product_name'];
  $p_price        = $_POST['product_price'];
  $p_description  = $_POST['product_description'];
  $p_photo        = $_FILES['product_photo'];

  $filePath       = "assets/uploads/" . time() . "-" . $p_photo['name'];
  move_uploaded_file($p_photo['tmp_name'], $filePath);

  $insertProduct  = mysqli_query($koneksi, "INSERT INTO products (category_id, product_name, product_price, product_description, product_photo) VALUES ('$c_id', '$p_name', '$p_price', '$p_description', '$filePath')");

  if ($insertProduct) {
    header("location:?page=product");
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Tambah Product</h3>
    </div>
    <div class="card-body">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="w-50">
          <label for="" class="form-label">Category Name</label>
          <select class="form-select" name="category_id" required>
            <option value="">--Pilih Kategori--</option>
            <?php foreach ($categories as $c) {
              // var_dump($c);
            ?>
              <option value="<?php echo $c['id'] ?>">
                <?= $c['category_name'] ?>
              </option>
            <?php
            }
            ?>
          </select>
          <label for="" class="form-label">Product Name</label>
          <input class="form-control" type="text" name="product_name" required>
          <label for="" class="form-label">Photo</label>
          <input class="form-control" type="file" name="product_photo">
          <label for="" class="form-label">Price</label>
          <input class="form-control" type="number" name="product_price" required>
          <label for="" class="form-label">Description</label>
          <textarea class="form-control" name="product_description" cols="30" rows="5" required></textarea>
          <button type="submit" name="simpan" class="btn btn-primary mt-2">ADD</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>