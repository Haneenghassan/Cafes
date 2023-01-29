
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark" style="height: 100%;">
                <a href="index.html" class="navbar-brand mx-4 mb-3" style="color:black !important">
                    <img src="..\storage\image\256x256bb.jpg" style="border-radius: 50%;margin-left:30px" width="100px" height="100px" alt="0">
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="ms-3">
                        <h4 class="mb-0" style="margin-left:30px ">
                            {{ Auth::user()->name }}
                        </h4>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="/admin" class="nav-item nav-link dashboard"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="{{route('admin.category.index')}}" class="nav-item nav-link category"><i class="fa-solid fa-person-circle-question me-2"></i>categories</a>
                    <a href="{{route('admin.reservation.index')}}" class="nav-item nav-link reservation"><i class="fa-sharp fa-solid fa-comments-dollar me-2"></i>Reservations</a>
                    <a href="{{route('admin.user.index')}}" class="nav-item nav-link user"><i class="fa-sharp fa-solid fa-user-tie me-2"></i>Admins/Users</a>
                    <a href="{{route('logout')}}" class="nav-item nav-link"><i class="fa-sharp fa-solid fa-right-from-bracket me-2"></i>Logout</a>
                </div>
            </nav>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/chart/chart.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
