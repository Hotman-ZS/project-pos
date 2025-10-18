<?php
require_once "config/koneksi.php";
$q_categories = mysqli_query($koneksi, "SELECT * FROM categories");
$categories = mysqli_fetch_all($q_categories, MYSQLI_ASSOC);
// var_dump($categories);

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $q_delete = mysqli_query($koneksi, "DELETE FROM categories WHERE id = '$id'");
  header("location:category.php");
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
  <div align="right">
    <a href="tambah-category.php">Tambah</a>
  </div>
  <table border="1" style="width: 100%">
    <tr>
      <th>No</th>
      <th>Category Name</th>.
      <th>Actions</th>
    </tr>
    <?php
    foreach ($categories as $key => $category) {
    ?>
      <tr>
        <td><?php echo $key + 1 ?></td>
        <td><?php echo $category['category_name'] ?></td>
        <td>
          <a href="tambah-category.php?edit=<?php echo $category['id'] ?>">Edit</a>
          <form action="category.php?delete=<?php echo $category['id'] ?>" method="post" onclick="return confirm('Apakah ingin di hapus?')">
            <button type="submit">Delete</button>
          </form>
        </td>
      </tr>
    <?php
    }
    ?>
  </table>
</body>

</html>