<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Varela Round' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="items.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="form.css">
    <!--
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    -->
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="cart.js" defer></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="ShowAdoptablePet.html">
            <img src="image/hope.jpg">
            <p1>Pet4U</p1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link home" href="ShowAdoptablePet.html">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link1" href="ShowAdoptablePet.html">Pet for Adoption</a>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                Donation
                </a>
                <div class="dropdown-menu">
                <a class="dropdown-item active" href="Donation.html">Donate</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="DonationRecords.html">Donate Records</a>
                
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                Manage Pet Information
                </a>
                <div class="dropdown-menu">
                <a class="dropdown-item active" href="ShowAdoptablePet.html">Pet for Adoption</a>
                <a class="dropdown-item" href="AdptAppSub.html">Adoption Application Submitted</a>
                <a class="dropdown-item" href="MyPet.html">My Pet</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item active" href="AddPetInfo.html">Add Pet Information</a>
                <a class="dropdown-item" href="PetInfoRecords.html">Pet Information Added</a>
                </div>
            </li>
            </ul>

            <form class="form-inline my-2 my-lg-0" style="margin-right: 10%;">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            
            <div style="right: 0;">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    <img src="image/login-avatar.png" alt="Avatar" class="avatar">
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item active" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Logout</a>
                </li>
            </ul>
            </div>
            
        </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>



    </div>
</body>
</html>
