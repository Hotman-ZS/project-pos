<?php
include '../config/koneksi.php';

$queryCat   = mysqli_query($koneksi, "SELECT * FROM  categories");
$fetchCats  = mysqli_fetch_all($queryCat, MYSQLI_ASSOC);

// query product 

$queryProducts    = mysqli_query($koneksi, "SELECT c.category_name, p.* FROM products p LEFT JOIN categories c ON c.id = p.category_id");
$fetchProducts    = mysqli_fetch_all($queryProducts, MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Point Of Sale</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/aldo.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body>

  <!-- container-fluid -->
  <div class="container-fluid container-pos">
    <div id="card"></div>
    <div class="row h-100">
      <div class="col-md-7 product-section">
        <div class="mb-4">
          <h4 class="mb-3" id="product-title">
            <i class="fas fa-store"></i>
            Product
          </h4>
          <input type="text" id="searchProduct"
            class="form-control search-box" placeholder="Find Product...">
        </div>
        <div class="mb-4">
          <button class="btn btn-primary category-btn active" onclick="filterCategory('all', this)">All Menu</button>
          <?php foreach ($fetchCats as $cat): ?>
            <button class="btn btn-outline-primary category-btn" onclick="filterCategory('<?php echo $cat['category_name'] ?>', this)"><?php echo $cat['category_name'] ?></button>
          <?php endforeach  ?>
        </div>
        <div class="row" id="productGrid"></div>

      </div>
      <div class="col-md-5 cart-section">
        <div class="cart-header mb-3 mt-3">
          <h4>Cart</h4>
          <small>Order # <span class="orderNumber">001</span></small>
        </div>
        <div class="cart-items" id="cartItems">
          <div class="text-center text-muted mt-5">
            <i class="bi bi-cart mb-3"></i>
            <p>Cart Empty</p>
          </div>
        </div>

        <div class="cart-footer">
          <div class="total-section">
            <div class="d-flex justify-content-between mb-2">
              <span>Subtotal</span>
              <span id="subtotal">Rp. 100.000</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Pajak (10%)</span>
              <span id="tax">Rp. 10.000</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Total</span>
              <span id="total">Rp. 110.000</span>
            </div>
          </div>
          <div class="row g-2">
            <div class="col-md-6">
              <button class="btn btn-checkout btn-outline-danger w-100">
                <i class="bi bi-trash"></i> Clear Cart
              </button>
            </div>
            <div class="col-md-6">
              <button class="btn btn-checkout btn-primary w-100">
                <i class="bi bi-cash"></i> Process Payment
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>


  <script>
    const products = <?php echo json_encode($fetchProducts); ?>
  </script>

  <script src="../assets/js/aldo.js"></script>

</body>

</html>