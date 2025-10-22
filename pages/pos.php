  <?php
  $p_query = mysqli_query($koneksi, "SELECT * FROM orders ORDER BY id DESC");
  $products = mysqli_fetch_all($p_query, MYSQLI_ASSOC);

  if (isset($_GET['delete'])) {
    $id     = $_GET['delete'];

    $s_photo  = mysqli_query($koneksi, "SELECT product_photo FROM products WHERE id = $id");
    $row      = mysqli_fetch_assoc($s_photo);
    $filePath = $row['product_photo'];

    if (file_exists($filePath)) {
      unlink($filePath);
    }
    $delete = mysqli_query($koneksi, "DELETE FROM products WHERE id = $id");
    if ($delete) {
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
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Products</h3>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-end p-2">
              <a href="pos/add-pos.php" class="btn btn-primary"> <i class="bi bi-plus-circle"></i>Add POS</a>
            </div>
            <table class="table table-bordered table-striped">
              <tr>
                <th>No</th>
                <th>Order Code</th>
                <th>Order Date</th>
                <th>Order Ammount</th>
                <th>Order Change</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
              <?php
              foreach ($products as $key => $value) {
              ?>
                <tr>
                  <td><?php echo $key + 1 ?></td>
                  <td><?php echo $value['order_code'] ?></td>
                  <td><?php echo $value['order_date'] ?></td>
                  <td><?php echo $value['order_ammount'] ?></td>
                  <td><?php echo $value['order_change'] ?></td>
                  <td><?php echo $value['order_status'] ?></td>
                  <td>
                    <a class="btn btn-success btn-sm" href="?page=tambah-product&edit=<?php echo $value['id'] ?>" class="btn btn-success btn-sm">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus')"
                      href="?page=product&delte=<?php echo $value['id'] ?> ">
                      <i class="bi bi-trash"></i>
                    </a>
                  </td>


                </tr>
              <?php
              }
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>

  </body>

  </html>