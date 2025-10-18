<?php
require_once "config/koneksi.php";

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$selectCategory = mysqli_query($koneksi, "SELECT category_name FROM categories WHERE id = '$id'");
$category = mysqli_fetch_assoc($selectCategory);

if (isset($_POST['simpan'])) {
  $category_name = $_POST['category_name'];
  $insert = mysqli_query($koneksi, "INSERT INTO categories (category_name) VALUE ('$category_name')");

  header("location:category.php");
}
if (isset($_POST['update'])) {
  $category_name = $_POST['category_name'];
  $update = mysqli_query($koneksi, "UPDATE categories SET category_name='$category_name' WHERE id = '$id'");

  header('location:category.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=
  , initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1><?php echo isset($_GET['edit']) ? 'Update' : 'Tambah' ?> Kategori</h1>
  <form action="" method="post">
    <label for="">Category Name</label><br>
    <input type="text" name="category_name" value="<?php echo $category['category_name'] ?? '' ?>" required><br>
    <button type="submit" name="<?php echo isset($_GET['edit']) ? 'update' : 'simpan' ?>"><?php echo isset($_GET['edit']) ? 'Edit' : 'Create' ?></button>
  </form>
</body>

</html>