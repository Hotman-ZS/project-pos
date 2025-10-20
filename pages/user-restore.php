<?php
// include;
// include_once;
// require_once;
// require;
require_once 'config/koneksi.php';

$query = mysqli_query($koneksi, "SELECT r.name AS role_name, u.* FROM users u LEFT JOIN roles r ON r.id = u.role_id WHERE deleted_at IS NOT NULL ORDER BY u.id DESC");

$users = mysqli_fetch_all($query, MYSQLI_ASSOC);

// disini parameter delete
// $_GET 
// isset, empty
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $delete = mysqli_query($koneksi, "DELETE FROM users WHERE id='$id'");
  // redirect
  header("location:?page=user-restore&hapus=berhasil");
}

if (isset($_GET['restore'])) {
  $id = $_GET['restore'];
  $restore = mysqli_query($koneksi, "UPDATE users SET deleted_at=null WHERE id = $id");
  header("location:user.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data User</title>
</head>

<body>
  <h1>Restore Data User</h1>
  <div align="right">
    <a href="?page=user&hapus=berhasil" class="btn btn-secondary">Back</a>
  </div>
  <br>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $key => $value): ?>
        <tr>
          <td><?php echo $key += 1 ?></td>
          <td><?php echo $value['name'] ?></td>
          <td><?php echo $value['email'] ?></td>
          <td><?php echo $value['role_name'] ?></td>
          <td>
            <a class="btn btn-primary" href="user-restore.php?restore=<?php echo $value['id'] ?>" onclick="return confirm('Apakah anda yakin mau me-restore?')">Restore Data</a>
            <a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"
              href="?page=user-restore&delete=<?php echo $value['id'] ?>">
              Delete
            </a>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</body>

</html>