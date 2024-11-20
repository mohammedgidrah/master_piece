@extends('dashboard.maindasboard')
@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">MASA Admin Dashboard</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Users</p>
                                    <h4 class="card-title">{{ $users }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fa-solid fa-layer-group"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Categories</p>
                                    <h4 class="card-title">{{ $categorys }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fa-solid fa-basket-shopping"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Products</p>
                                    <h4 class="card-title">{{ $products }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="far fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Orders</p>
                                    <h4 class="card-title">{{ $orders }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Status Chart (Pie Chart) -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Status Chart</h5>
                        <canvas id="all_chart"
                            style="max-height: 400px; display: block; box-sizing: border-box; height: 400px; width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">users Chart</h5>
                        <canvas id="users_chart"
                            style="max-height: 400px; display: block; box-sizing: border-box; height: 400px; width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">product stock Chart</h5>
                        <canvas id="stock_chart"
                            style="max-height: 400px; display: block; box-sizing: border-box; height: 400px; width: 100%;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Daily Sales Section -->
            <div class="col-md-4">
                <div class="card card-primary card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Daily Sales</div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="mb-4 mt-2">
                            <h1>${{ $sales }}</h1>
                        </div>
                        <div class="pull-in">
                            <canvas id="dailySalesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Registrations Chart (Bar Chart) -->
        <div class="row">
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Registrations</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="min-height: 375px">
                            <canvas id="registrationsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('dashboard.footer')
    </div>
    </div>
    
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Safely inject PHP variables into JavaScript
            const users = @json($users);
            const categorys = @json($categorys);
            const products = @json($products);
            const orders = @json($orders);
            const adminCount = @json($adminCount); // Ensure 'admins' is passed correctly from the controller
            const userCount = @json($userCount); 
            const instock = @json($instock);
            const outofstock = @json($outofstock);
            const monthlyRegistrations = @json($monthlyRegistrations);

            // Initialize the Pie Chart for status
            new Chart(document.querySelector('#all_chart'), {
                type: 'pie',
                data: {
                    labels: ['Users', 'Categories', 'Products', 'Orders'],
                    datasets: [{
                        label: 'Current',
                        data: [users, categorys, products, orders],
                        backgroundColor: [
                            '#cce5ff', // Light blue for Users
                            '#d4edda', // Light green for Categories
                            '#ff6384', // Red for Products
                            'rgba(251, 238, 120, 0.635)', // Yellow with transparency for Orders
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    },
                }
            });
    
            // Initialize the Pie Chart for Users and Admins
            new Chart(document.querySelector('#users_chart'), {
                type: 'pie',
                data: {
                    labels: ['Users', 'Admins'],
                    datasets: [{
                        label: 'Current',
                        data: [userCount, adminCount],
                        backgroundColor: [
                            '#cce5ff',  
                            '#ff6384',  
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    },
                }
            });
            new Chart(document.querySelector('#stock_chart'), {
                type: 'pie',
                data: {
                    labels: ['in stock', 'out of stock'],
                    datasets: [{
                        label: 'Current',
                        data: [ instock,  outofstock],
                        backgroundColor: [
                            '#cce5ff',  
                            '#ff6384',  
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    },
                }
            });
        
            // Initialize the Registrations Bar Chart
            new Chart(document.querySelector('#registrationsChart'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Registrations',
                    data: Object.values(monthlyRegistrations), // Use values from the PHP array
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        });
    </script>
    
    
{{-- @endpush --}}
