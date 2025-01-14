
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
                    <form action="{{route('updateReservation' , ['reservation'=>$data['id']])}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">first name</label>
                            <input type="text" name="first_name" class="form-control" value="{{$data['first_name']}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">last name</label>
                            <input type="text" name="last_name" class="form-control" value="{{$data['last_name']}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">email</label>
                            <input type="text" name="email" class="form-control" value="{{$data['email']}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">tel_number</label>
                            <input type="text" name="tel_number" class="form-control" value="{{$data['tel_number']}}">
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label">res_date</label>
                            <input type="datetime-local" name="res_date" class="form-control" value="{{Session::get('EditReservatio_DateAndTime')}}">
                        </div> --}}
                        <div class="mb-3">
                            <label class="form-label">guest_number</label>
                            <input type="number" name="guest_number" class="form-control" value="{{$data['guest_number']}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Restautant Name</label>
                            <input type="hidden" name="category_id" class="form-control" value="{{$data['category_id']}}">
                            <input type="text" name="category" class="form-control" disabled value="{{$data['Restaurant']}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Choose Your Table</label>
                            <select id="table_id" name="table_id" class="form-multiselect block w-full mt-1">
                                <?php $arrayOfTable = [] ?>
                                @foreach ($reservation as $item)
                                    @foreach ($tables as $table)
                                        <?php
                                            if ( $item->table_id == $table->id ){
                                                if ($item->table_id == $data['table_id']){
                                                    continue;
                                                }
                                                array_push($arrayOfTable, $table->id);
                                                $reservationMaxTime = strtotime($item->res_date) + 7200;
                                                $reservationMinTime = strtotime($item->res_date) - 7200;
                                                $customerTimeChoosed = Session::get('EditReservatio_Date');
                                                if ( $customerTimeChoosed > $reservationMinTime && $customerTimeChoosed < $reservationMaxTime ) { ?>
                                                    <option value="{{ $item->id }} " disabled>
                                                        {{ $table->name }} - {{ $table->location }} - {{ $table->guest_number }} Guest - Reserved
                                                    </option>
                                                <?php } else {  ?>
                                                    <option value="{{ $table->id }}" >
                                                        {{ $table->name  }}  - {{ $table->guest_number }} Guest
                                                    </option>
                                            <?php } } ?>
                                    @endforeach
                                @endforeach
                                @foreach ($tables as $item)
                                    <?php if (!in_array($item->id, $arrayOfTable)) {?>
                                        <option value="{{ $item->id }}">
                                        {{ $item->name }} - {{ $item->location }} - {{ $item->guest_number }} Guest
                                        </option>
                                         <?php } ?>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="user_id" class="form-control">
                            <input type="hidden" name="res_date" value="{{Session::get('EditReservatio_DateAndTime')}}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Your Reservation</button>
                    </form>
                    <a href="{{route('yourreservation')}}"><button>Back To Your Reservation</button></a>

                </div>
            </div>

            @else

                    {{view('auth.login')}}

                    @endif

</body>

</html>
