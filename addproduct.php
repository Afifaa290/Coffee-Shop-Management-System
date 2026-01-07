<?php 
include 'db.php';

// Default values
$id = "";
$name = "";
$price = "";
$description = "";

// If edit mode
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    $data = mysqli_fetch_assoc($result);

    $name = $data['name'];
    $price = $data['price'];
    $description = $data['description'];
}

// Save (insert/update)
if (isset($_POST['save'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if ($_POST['id'] == "") {
        // Insert
        $query = "INSERT INTO products (name, price, description)
                  VALUES ('$name','$price','$description')";
    } else {
        // Update
        $id = $_POST['id'];
        $query = "UPDATE products SET 
                  name='$name', 
                  price='$price', 
                  description='$description'
                  WHERE id=$id";
    }

    mysqli_query($conn, $query);
    header("Location: showproduct.php");
}
?>

<?php include 'header.php'; ?>

  <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">About Us</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Add Product</p>
            </div>
        </div>
    </div>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                <?php echo ($id == "") ? "Add Product" : "Update Product"; ?>
            </h3>
        </div>
        <div class="card-body">

            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="name" 
                           value="<?php echo $name; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price (PKR)</label>
                    <input type="number" step="0.01" class="form-control" name="price"
                           value="<?php echo $price; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3"><?php echo $description; ?></textarea>
                </div>

                <button type="submit" class="btn btn-success" name="save">
                    <?php echo ($id == "") ? "Add Product" : "Update Product"; ?>
                </button>

                <a href="showproduct.php" class="btn btn-secondary">Back</a>
            </form>

        </div>
    </div>
</div>



    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Description</th>
        <th>Action</th>
    </tr>

    <?php
    $result = mysqli_query($conn, "SELECT * FROM products");

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['price']}</td>
            <td>{$row['description']}</td>
            <td>
                <a href='edit.php?id={$row['id']}'>Edit</a> | 
                <a href='delete.php?id={$row['id']}'>Delete</a>
            </td>
        </tr>";
    }
    ?>
</table>













    
<?php include 'footer.php'; ?>