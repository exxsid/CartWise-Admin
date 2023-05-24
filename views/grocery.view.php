<?php
require_once 'utils/db.php';
include "views/partials/header.php";

$stores = $db->query("SELECT * FROM `grocery_store` LEFT JOIN users ON grocery_store.user_id = users.id WHERE status = 'Verified' ");
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "views/partials/sidebar.php" ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "partials/topbar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Grocery Stores</h1>
                    </div>

                    <!-- Contents goes here -->
                    <div class="mx-2">
                        <table class="table table-striped">
                            <thead>
                                <tr class="table-primary">
                                    <th scope="col">Store Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">TIN</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($stores)) :
                                    while ($store = mysqli_fetch_assoc($stores)) :
                                ?>
                                        <tr>
                                            <th scope="row"><?= $store['store_name'] ?></th>
                                            <td><?= $store['address'] ?></td>
                                            <td><?= $store['email'] ?></td>
                                            <td><?= $store['phone_number'] ?></td>
                                            <td><?= $store['tin'] ?></td>
                                            <td>
                                                <a href=<?= "?details=" . $store['user_id'] ?>>Details</a>
                                                <a href=<?= "?delete=" . $store['user_id'] ?>>Delete</a>
                                                <a href=<?= "?edit=" . $store['user_id'] ?>>Edit</a>
                                            </td>
                                        </tr>
                                <?php
                                    endwhile;
                                endif;
                                ?>

                            </tbody>
                        </table>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "views/partials/footer.php" ?>
            <!-- End of Footer -->