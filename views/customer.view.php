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
                                                <a href="#" class="badge btn-info details_btn" data-id="<?= $customer['user_id'] ?>" onclick="handleDetailsBtn(event)">DETAILS</a>
                                                <a href="#" class="badge btn-primary edit_btn" data-id="<?= $customer['user_id'] ?>" onclick="handleEditBtn(event)">EDIT</a>
                                                <a href="#" class="badge btn-danger delete_btn" data-id="<?= $customer['user_id'] ?>" onclick="handleDeleteBtn(event)">DELETE</a>
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
                                <h4 class="fname"></h4>
                                <h4 class="lname"></h4>
                                <h4 class="email"></h4>
                                <h4 class="username"></h4>
                                <h4 class="phonenumber"></h4>
                                <h4 class="password"></h4>
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
                                        <label for="">First Name</label>
                                        <input type="text" id="fnameEdit" />
                                    </div>
                                    <div class="col">
                                        <label for="">Last Name</label>
                                        <input type="text" id="lnameEdit" />
                                    </div>
                                    <div class="col">
                                        <label for="">Email</label>
                                        <input type="text" id="emailEdit" />
                                    </div>
                                    <div class="col">
                                        <label for="">Username</label>
                                        <input type="text" id="usernameEdit" />
                                    </div>
                                    <div class="col">
                                        <label for="">Phone Number</label>
                                        <input type="text" id="phoneEdit" />
                                    </div>
                                    <div class="col">
                                        <label for="">Password</label>
                                        <input type="text" id="passwordEdit" />
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

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="idDelete">
                                <h4 class="deleteMessage"></h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger" onclick="deleteConfirmBtn()">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
            <script>
                function handleDetailsBtn(event) {
                    event.preventDefault();
                    var element = event.target;
                    var id = element.getAttribute('data-id');
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", "http://localhost/cartwise-admin/utils/fetchcustomers.php?id=" + id, true);
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
                    document.getElementsByClassName('fname')[0].textContent = "Firtname: " + data.firstname;
                    document.getElementsByClassName('lname')[0].textContent = "Lastname: " + data.lastname;
                    document.getElementsByClassName('email')[0].textContent = "Email: " + data.email;
                    document.getElementsByClassName('username')[0].textContent = "Username: " + data.username;
                    document.getElementsByClassName('phonenumber')[0].textContent = "Phone Number: " + data.phone_number;
                    document.getElementsByClassName('password')[0].textContent = "Password: " + data.password;

                    $('#viewModal').modal('show')
                }

                function handleEditBtn(event) {
                    event.preventDefault();
                    var element = event.target;
                    var id = element.getAttribute('data-id');
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", "http://localhost/cartwise-admin/utils/fetchcustomers.php?id=" + id, true);
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
                    document.getElementById('fnameEdit').value = data.firstname;
                    document.getElementById('lnameEdit').value = data.lastname;
                    document.getElementById('emailEdit').value = data.email;
                    document.getElementById('usernameEdit').value = data.username;
                    document.getElementById('phoneEdit').value = data.phone_number;
                    document.getElementById('passwordEdit').value = data.password;

                    $("#editModal").modal('show');
                }

                function saveEdit() {
                    var id = document.getElementById('idEdit').value;
                    var fname = document.getElementById('fnameEdit').value;
                    var lname = document.getElementById('lnameEdit').value;
                    var email = document.getElementById('emailEdit').value;
                    var uname = document.getElementById('usernameEdit').value;
                    var phone = document.getElementById('phoneEdit').value;
                    var password = document.getElementById('passwordEdit').value;

                    var xhr = new XMLHttpRequest();
                    var params = `?id=${id}&fname=${fname}&lname=${lname}&email=${email}&uname=${uname}&phone=${phone}&password=${password}`;
                    xhr.open("GET", "http://localhost/cartwise-admin/utils/fetchcustomers.php" + params, true);
                    xhr.responseType = "text";
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            var response = xhr.responseText;
                            $('#editModal').modal('hide');
                        }
                    }

                    xhr.send();
                }

                function handleDeleteBtn(event) {
                    event.preventDefault();
                    var element = event.target;
                    var id = element.getAttribute('data-id');

                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", "http://localhost/cartwise-admin/utils/fetchcustomers.php?id=" + id, true);
                    xhr.responseType = "text";
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            var response = JSON.parse(xhr.responseText);
                            displayDeleteModal(response[0]);
                        }
                    }
                    xhr.send();


                }

                function displayDeleteModal(data) {
                    document.getElementsByClassName('deleteMessage')[0].textContent = `Are your sure you want to delete ${data.firstname} ${data.lastname}?`;
                    document.getElementById('idDelete').value = data.user_id;

                    $("#deleteModal").modal("show");
                }

                function deleteConfirmBtn() {
                    var id = document.getElementById('idDelete').value;

                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", "http://localhost/cartwise-admin/utils/fetchcustomers.php?delete=" + id, true);
                    xhr.responseType = "text";
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            var response = xhr.responseText;
                            $('#deleteModal').modal('hide');
                        }
                    }

                    xhr.send();
                }
            </script>

            <!-- Footer -->
            <?php include "views/partials/footer.php" ?>
            <!-- End of Footer -->