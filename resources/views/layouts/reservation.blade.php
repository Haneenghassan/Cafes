
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
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" style="background-color: black !important">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="{{URL::asset('storage/image/assets/img/navbar-logo.svg')}}" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="/yourreservation">Reser</a></li>
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

@if (auth()->check())

<h1>Your Reservation</h1>



<div class="container-fluid pt-4 px-4" style="margin-bottom: 30px;">
     <div class="row g-4">
         <div class="col-12">
             <div class="bg-secondary rounded h-100 p-4" style="background-color: #fff !important; ">
                 <div class="table-responsive">
                     <table class="table">
                         <thead>
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Name</th>
                                 <th scope="col">Date</th>
                                 <th scope="col">Restaurant</th>
                                 <th scope="col">Table</th>
                                 <th scope="col">Guest</th>
                                 <th scope="col">Location</th>
                                 <th scope="col">Status</th>
                                 <th scope="col">Edit</th>
                                 <th scope="col">Delete</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $i = 1; ?>
                             @foreach ($data as $item)
                             @if ( $item['StatusRes'] != 'Deleted')
                                 <tr>
                                     <th scope="col">{{$i++}}</th>
                                     <th scope="col">{{$item['Name']}}</th>
                                     <th scope="col">{{$item['Date']}}</th>
                                     <th scope="col">{{$item['Restaurant']}}</th>
                                     <th scope="col">{{$item['Table']}}</th>
                                     <th scope="col">{{$item['Guest']}}</th>
                                     <th scope="col">{{$item['Location']}}</th>
                                     <th scope="col" id="change">{{$item['StatusRes']}}</th>
                                     <th scope="col"><a href="{{route('editYourReservation' , ['reservation'=>$item['id']])}}"><button style="background-color: green; color:white; padding:5px; border-radius:4px">Edit</button></a></th>
                                     <th scope="col"><a href="{{route('delete' , ['reservation'=>$item['id']])}}"><button style="background-color: red; color:white; padding:5px; border-radius:4px">Delete</button></a></th>
                                 </tr>
                            @endif
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>

@else

    {{view('auth.login')}}

@endif
    </body>
