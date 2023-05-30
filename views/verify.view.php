<?php
require_once 'utils/db.php';
include "views/partials/header.php";

$stores = $db->query("SELECT * FROM `grocery_store` LEFT JOIN users ON grocery_store.user_id = users.id WHERE status = 'Not Verified' ");
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
                        <h1 class="h3 mb-0 text-gray-800">Verify Grocery Store</h1>
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
                                                <a href="#" class="badge btn-info details_btn" data-id="<?= $store['user_id'] ?>" onclick="handleDetailsBtn(event)">DETAILS</a>
                                                <a href="#" class="badge btn-primary edit_btn">EDIT</a>
                                                <a href="#" class="badge btn-danger delete_btn">DELETE</a>
                                            </td>
                                        </tr>
                                <?php
                                    endwhile;
                                endif;
                                ?>

                            </tbody>
                        </table>
                    </div>

                    <!-- End Content -->


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- View Modal -->
            <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4 class="name"></h4>
                            <h4 class="address"></h4>
                            <h4 class="email"></h4>
                            <h4 class="phonenumber"></h4>
                            <h4 class="tin"></h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
            <script>
                function handleDetailsBtn(event) {
                    event.preventDefault();
                    var element = event.target;
                    var id = element.getAttribute('data-id');
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", "http://localhost/cartwise-admin/utils/fetchverify.php?id=" + id, true);
                    xhr.responseType = "text"
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            var response = JSON.parse(xhr.responseText);
                            displayData(response[0]);
                        }
                    };
                    xhr.send();
                }

                function displayData(data) {
                    document.getElementsByClassName('name')[0].textContent = "Store Name: " + data.store_name;
                    document.getElementsByClassName('address')[0].textContent = "Address: " + data.address;
                    document.getElementsByClassName('email')[0].textContent = "Email: " + data.email;
                    document.getElementsByClassName('phonenumber')[0].textContent = "Phone Number: " + data.phone_number;
                    document.getElementsByClassName('tin')[0].textContent = "TIN: " + data.tin;

                    $('#viewModal').modal('show')
                }
            </script>

            <!-- Footer -->
            <?php include "views/partials/footer.php" ?>
            <!-- End of Footer -->