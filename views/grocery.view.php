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
                                    <th scope="col">Actions</th>
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
                                                <a href="#" class="badge btn-primary edit_btn" data-id="<?= $store['user_id'] ?>" onclick="handleEditBtn(event)">EDIT</a>
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

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" id="idEdit">
                                <div class="col">
                                    <label for="">Store Name</label>
                                    <input type="text" id="nameEdit" />
                                </div>
                                <div class="col">
                                    <label for="">Address</label>
                                    <input type="text" id="addressEdit" />
                                </div>
                                <div class="col">
                                    <label for="">Email</label>
                                    <input type="text" id="emailEdit" />
                                </div>
                                <div class="col">
                                    <label for="">Phone Number</label>
                                    <input type="text" id="phoneEdit" />
                                </div>
                                <div class="col">
                                    <label for="">TIN</label>
                                    <input type="text" id="tinEdit" />
                                </div>
                                <div class="col">
                                    <label for="">Status</label>
                                    <select name="" id="statusEdit">
                                        <option value="verified">Verified</option>
                                        <option value="notverified">Not Verified</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" onclick="saveEdit()">Save</button>

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
                    xhr.open("GET", "http://localhost/cartwise-admin/utils/fetchgrocery.php?id=" + id, true);
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

                function handleEditBtn(event) {
                    event.preventDefault();
                    var element = event.target;
                    var id = element.getAttribute('data-id')
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", "http://localhost/cartwise-admin/utils/fetchgrocery.php?id=" + id, true);
                    xhr.responseType = "text";
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            var response = JSON.parse(xhr.responseText);
                            displayEditModal(response[0]);
                        }
                    }
                    xhr.send();
                }

                function displayEditModal(data) {
                    document.getElementById('idEdit').value = data.id;
                    document.getElementById('nameEdit').value = data.store_name;
                    document.getElementById('addressEdit').value = data.address;
                    document.getElementById('emailEdit').value = data.email;
                    document.getElementById('phoneEdit').value = data.phone_number;
                    document.getElementById('tinEdit').value = data.tin;
                    document.getElementById('statusEdit').value = data.status == "Verified" ? "verified" : "notverified";
                    var select = document.getElementById("statusEdit");
                    var selectedOption = select.options[select.selectedIndex];
                    var selectedText = selectedOption.text;
                    console.log(selectedText);
                    $('#editModal').modal('show');
                }

                function saveEdit() {
                    var xhr = new XMLHttpRequest();
                    var url = "http://localhost/cartwise-admin/utils/fetchgrocery.php";
                    var id = document.getElementById('idEdit').value;
                    var name = document.getElementById('nameEdit').value;
                    var address = document.getElementById('addressEdit').value;
                    var email = document.getElementById('emailEdit').value;
                    var phone = document.getElementById('phoneEdit').value;
                    var tin = document.getElementById('tinEdit').value;
                    var select = document.getElementById("statusEdit");
                    var selectedOption = select.options[select.selectedIndex];
                    var status = selectedOption.text;

                    var params = `?id=${id}&store_name=${name}&address=${address}&email=${email}&phone_number=${phone}&tin=${tin}&status=${status}`
                    xhr.open("GET", url + params, true);
                    xhr.responseType = "text";
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Request completed successfully
                            var response = xhr.responseText;
                            $('#editModal').modal('hide');
                        }
                    };

                    xhr.send();
                }
            </script>

            <!-- Footer -->
            <?php include "views/partials/footer.php" ?>
            <!-- End of Footer -->