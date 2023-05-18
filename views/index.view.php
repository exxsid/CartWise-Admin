<?php
include "views/partials/header.php";
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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Total Grocery Store card -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <h4>Total Grocery Stores</h4>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">50</div>
                                            <span>Stores</span>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-shopping-cart fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total customers -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <h4>Total Customers</h4>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                1,000
                                            </div>
                                            <span>Customers</span>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Grocery lists -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <h4>Total Grocery Lists</h4>
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                2,546
                                            </div>
                                            <span>List</span>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Content Row -->

                    <div class="col">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7 in-active-chart">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Active and Inactive Customers</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <div id="chartContainer" style="height: 100%; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- daily count of created list -->
                        <div class="col-xl-8 col-lg-7 in-active-chart">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Daily Created List</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <div id="chartContainerDaily" style="height: 100%; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <!-- End of Main Content -->

                <!-- Chart -->
                <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                <?php include './js/chart-activeinactive.php' ?>
                <?php include './js/chart-dailycreatedlist.php' ?>
                <!-- Footer -->
                <?php include "views/partials/footer.php" ?>
                <!-- End of Footer -->