<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="{{ url('/') }}/">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PC FORGE Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    
    <link rel="stylesheet" href="admin/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin/css/font.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <link rel="stylesheet" href="admin/css/style.default.css" id="theme-stylesheet">
    <link rel="stylesheet" href="admin/css/custom.css">
    <link rel="shortcut icon" href="admin/img/favicon.ico">
    
    <style>
        /* Custom styles to remove unwanted dashboard elements */
        .stats-1, .stats-2, .stats-3, .stats-4 {
            display: none !important;
        }
        .chart-col {
            display: none !important;
        }
        .dash-box {
            display: none !important;
        }
        .statistic-box {
            display: none !important;
        }
        
        /* Welcome message styling */
        .welcome-message {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .welcome-message h3 {
            color: #ff4d00;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .admin-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .feature-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            border-left: 4px solid #ff4d00;
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
        }
        
        .feature-card i {
            color: #ff4d00;
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .feature-card h5 {
            color: #333;
            margin-bottom: 10px;
        }
        
        .feature-card p {
            color: #666;
            font-size: 14px;
        }
        
        /* Quick stats styling */
        .quick-stats {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
        }
        
        .stat-item {
            text-align: center;
            padding: 15px;
        }
        
        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #ff4d00;
        }
        
        .stat-label {
            color: #666;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>
    <header class="header">  
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid d-flex align-items-center justify-content-between">
                <div class="navbar-header">
                    <a href="{{ route('dashboard') }}" class="navbar-brand">
                        <div class="brand-text brand-big visible text-uppercase">
                            <strong style="color: #ff4d00;">PC</strong><strong>FORGE</strong> Admin
                        </div>
                        <div class="brand-text brand-sm"><strong style="color: #ff4d00;">PF</strong>A</div>
                    </a>
                    <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
                </div>
                
                <div class="list-inline-item logout">  
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" 
                           style="color: #333; text-decoration: none; padding: 5px 15px; border: 1px solid #ddd; border-radius: 4px;">
                            <i class="fa fa-sign-out"></i> Log Out
                        </a>
                    </form>              
                </div>
            </div>
        </nav>
    </header>
    
    <div class="d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="sidebar-header d-flex align-items-center">
                <div class="avatar"><img src="{{ asset('jomar.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
                <div class="title">
                    <h1 class="h5">JOMAR</h1>
                    <p>PC FORGE Admin</p>
                </div>
            </div>
            
            <span class="heading">Main</span>
            <ul class="list-unstyled">
                <li class="active"><a href="{{ route('dashboard') }}"> <i class="icon-home"></i>Dashboard</a></li>
                
                <li><a href="#categoryDropdown" aria-expanded="false" data-toggle="collapse"> 
                    <i class="icon-folder"></i>Category Management</a>
                    <ul id="categoryDropdown" class="collapse list-unstyled">
                        <li><a href="{{ route('admin.addcategory') }}">Add Category</a></li>
                        <li><a href="{{ route('admin.viewcategory') }}">View Categories</a></li>
                    </ul>
                </li>
                
                <li><a href="#productDropdown" aria-expanded="false" data-toggle="collapse"> 
                    <i class="icon-box"></i>Product Management</a>
                    <ul id="productDropdown" class="collapse list-unstyled">
                        <li><a href="{{ route('admin.addproduct') }}">Add Product</a></li>
                        <li><a href="{{ route('admin.viewproduct') }}">View Products</a></li>
                    </ul>
                </li>
                
                <li><a href="{{ route('admin.view_orders') }}"> 
                    <i class="icon-shopping-cart"></i>Order Management</a>
                </li>
                
                <li><a href="#usersDropdown" aria-expanded="false" data-toggle="collapse">
                    <i class="icon-user"></i>User Management</a>
                    <ul id="usersDropdown" class="collapse list-unstyled">
                        <li><a href="{{ route('admin.viewusers') }}">View Users</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Admin Dashboard</h2>
                </div>
            </div>
            
            <section class="no-padding-top no-padding-bottom">
                <!-- SIMPLE SOLUTION: Just yield all sections -->
                @yield('add_category')
                @yield('view_category')
                @yield('update_category')
                @yield('add_product')
                @yield('view_orders')
                @yield('view_users')
                @yield('user_details')
                
                <!-- Show default dashboard only if no content exists -->
                @php
                    $hasContent = false;
                    $sections = ['add_category', 'view_category', 'update_category', 'add_product', 'view_orders', 'view_users', 'user_details'];
                @endphp
                
                @foreach($sections as $section)
                    @if(View::hasSection($section))
                        @php $hasContent = true; @endphp
                    @endif
                @endforeach
                
                @if(!$hasContent)
                    <!-- Default dashboard view when admin logs in -->
                    <div class="container-fluid">
                        <div class="welcome-message">
                            <h3>Welcome to PC FORGE Admin Panel</h3>
                            <p>Manage your e-commerce store efficiently. Add products, manage categories, view orders, and monitor user activities.</p>
                            
                            <div class="row quick-stats">
                                <div class="col-md-3 col-sm-6">
                                    <div class="stat-item">
                                        <div class="stat-number" id="total-orders">{{ $totalOrders ?? 0 }}</div>
                                        <div class="stat-label">Total Orders</div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="stat-item">
                                        <div class="stat-number" id="total-products">{{ $totalProducts ?? 0 }}</div>
                                        <div class="stat-label">Total Products</div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="stat-item">
                                        <div class="stat-number" id="total-users">{{ $totalUsers ?? 0 }}</div>
                                        <div class="stat-label">Total Users</div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="stat-item">
                                        <div class="stat-number" id="total-categories">{{ $totalCategories ?? 0 }}</div>
                                        <div class="stat-label">Categories</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="admin-features">
                            <div class="feature-card">
                                <i class="fa fa-box"></i>
                                <h5>Product Management</h5>
                                <p>Add, edit, and manage your PC components and gaming rigs inventory.</p>
                                <a href="{{ route('admin.viewproduct') }}" class="btn btn-sm btn-outline-primary">Manage Products</a>
                            </div>
                            
                            <div class="feature-card">
                                <i class="fa fa-shopping-cart"></i>
                                <h5>Order Management</h5>
                                <p>View and process customer orders, update status, and track deliveries.</p>
                                <a href="{{ route('admin.view_orders') }}" class="btn btn-sm btn-outline-primary">View Orders</a>
                            </div>
                            
                            <div class="feature-card">
                                <i class="fa fa-users"></i>
                                <h5>User Management</h5>
                                <p>Monitor registered users, view customer details and activities.</p>
                                <a href="{{ route('admin.viewusers') }}" class="btn btn-sm btn-outline-primary">View Users</a>
                            </div>
                            
                            <div class="feature-card">
                                <i class="fa fa-tags"></i>
                                <h5>Category Management</h5>
                                <p>Organize products with categories like CPUs, GPUs, Motherboards, etc.</p>
                                <a href="{{ route('admin.viewcategory') }}" class="btn btn-sm btn-outline-primary">Manage Categories</a>
                            </div>
                        </div>
                        
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mb-0">Recent Activities</h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group">
                                    <div class="list-group-item">
                                        <small class="text-muted">Just now</small>
                                        <p class="mb-1">You logged in to the admin panel</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </section>
            
            <footer class="footer">
                <div class="footer__block block no-margin-bottom">
                    <div class="container-fluid text-center">
                        <p class="no-margin-bottom">PC FORGE Admin Panel - E-Commerce Management System</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/popper.js/umd/popper.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin/vendor/jquery.cookie/jquery.cookie.js"></script>
    <script src="admin/vendor/chart.js/Chart.min.js"></script>
    <script src="admin/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="admin/js/charts-home.js"></script>
    <script src="admin/js/front.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.stats-1, .stats-2, .stats-3, .stats-4').remove();
            $('.chart-col').remove();
            $('.dash-box').remove();
            $('.statistic-box').remove();
            $('.box').not('.messages-box').hide();
        });
    </script>
</body>
</html>