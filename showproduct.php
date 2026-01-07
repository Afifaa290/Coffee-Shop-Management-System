
<?php include 'db.php'; ?>
<?php include 'header.php'; ?>
  <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">About Us</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Show Product</p>
            </div>
        </div>
    </div>

<div class="container mt-4">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Product List</h3>
        </div>

        <div class="card-body">
            <a href="addproduct.php" class="btn btn-success mb-3">Add New Product</a>

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="20%">Name</th>
                        <th width="10%">Price</th>
                        <th>Description</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM products");

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['description']}</td>
                        <td>
                            <a href='addproduct.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='showproduct.php?delete={$row['id']}' 
                                onclick='return confirm(\"Are you sure?\")' 
                                class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?php
// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
    echo "<script>window.location='showproduct.php'</script>";
}
?>














    
<?php include 'footer.php'; ?>