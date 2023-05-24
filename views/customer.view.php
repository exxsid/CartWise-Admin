<?php
require_once 'utils/db.php';
include "views/partials/header.php";

$customers = $db->query("SELECT * FROM customer 
LEFT JOIN users ON customer.user_id = users.id;");
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
                        <h1 class="h3 mb-0 text-gray-800">Customers</h1>
                    </div>

                    <!-- Contents goes here -->

                    <div class="mx-2">
                        <table class="table table-striped">
                            <!-- table header -->
                            <thead>
                                <tr class="table-primary">
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Password</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <!-- end table header -->
                            <tbody>
                                <?php
                                if (mysqli_num_rows($customers)) :
                                    while ($customer = mysqli_fetch_assoc($customers)) :
                                ?>
                                        <tr>
                                            <th scope="row"><?= $customer['firstname'] ?></th>
                                            <td><?= $customer['lastname'] ?></td>
                                            <td><?= $customer['email'] ?></td>
                                            <td><?= $customer['username'] ?></td>
                                            <td><?= $customer['phone_number'] ?></td>
                                            <td><?= $customer['password'] ?></td>
                                            <td>
                                                <a href=<?= "?details=" . $customer['user_id'] ?>>Details</a>
                                                <a href=<?= "?delete=" . $customer['user_id'] ?>>Delete</a>
                                                <a href=<?= "?edit=" . $customer['user_id'] ?>>Edit</a>
                                            </td>
                                        </tr>
                                <?php
                                    endwhile;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- End table -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "views/partials/footer.php" ?>
            <!-- End of Footer -->