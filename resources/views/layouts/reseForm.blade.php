
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Agency - Start Bootstrap Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{URL::asset('storage/image/assets/favicon.ico')}}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        @vite(['resources/css/style.css', 'resources/js/app.js', ])
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="{{URL::asset('storage/image/assets/img/navbar-logo.svg')}}" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="/reservation">Reser</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                        @if (auth()->check())
                            <li class="nav-item"><a class="nav-link" href="/profile">Profile</a></li>
                            <li class="nav-item"><a href="{{route('logout')}}" class="nav-link">Logout</a>
                            </li>
                        @else
                            <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Login</a>
                            </li>
                            <li class="nav-item"><a href="{{route('register')}}" class="nav-link">Register</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>


    <!-- Content Start -->
    <div class="content">


        {{-- {{dd($table)}} --}}
    @if (auth()->check())

        <h1>reservation</h1>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded h-100 p-4" style="background-color: #fff !important; ">
                    <h5 class="mb-4">Add New reservation</h5>
                    <form action="{{route('LandingPage.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">first name</label>
                            <input type="text" name="first_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">last name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">tel_number</label>
                            <input type="text" name="tel_number" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">res_date</label>
                            <input type="datetime-local" onchange="showTable()" name="res_date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">guest_number</label>
                            <input type="number" name="guest_number" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Restautant Name</label>
                            <input type="hidden" name="category_id" class="form-control" value="{{ $categories->id }}">
                            <input type="text" name="category" class="form-control" disabled value="{{ $categories->name }}">
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Choose Your Table</label>
                            <select id="table_id" name="table_id"
                                class="form-multiselect block w-full mt-1">
                                @foreach ($tables as $item)
                                    <option value="{{ $item->id }}" <?php if($item->status == 'Reserved'){echo 'disabled';} ?>>
                                        {{ $item->name }} - {{ $item->location }} - {{ $item->guest_number }} Guest - {{$item->status}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="user_id" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Add reservation</button>
                    </form>
                </div>
            </div>

            {{-- <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="img">
                <button type="submit">click</button>
            </form> --}}

            @else

                    {{view('auth.login')}}

                    @endif


            <script>

                // function showTable(){
                //     document.getElementById("table").innerHTML = "
                //     <select id='table_id' name='table_id' class='form-multiselect block w-full mt-1'> @foreach ($tables as $item) @foreach ($reservation as $time) <?php if(isset($_POST['res_date'])){$x = $_POST['res_date']; $rest = substr($x, -5 , 2); $y = $reservation['StatusRes']; $timeRese = substr($y, -5 , 2); if( ($rest - $timeRese) < 2 && $item->status == 'Reserved' ){ ?> <option value='{{ $item->id }}' disabled> <?php } else { ?> <option value='{{ $item->id }}'> <?php } ?> {{ $item->name }} - {{ $item->location }} - {{ $item->guest_number }} Guest - {{$item->status}} </option> <?php } ?> @endforeach @endforeach </select>"
                // }

                    






            </script>

</body>

</html>

