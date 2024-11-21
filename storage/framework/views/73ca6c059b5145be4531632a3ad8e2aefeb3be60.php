<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Pet4U')); ?></title>

    <!-- Fonts -->
   
    
    <link rel="stylesheet" href="<?php echo e(asset('css/footer.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/items.css')); ?>">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/header.css')); ?>">

    <!-- Scripts -->
     <!-- jQuery, Popper.js, and Bootstrap JS (Bootstrap 4) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="<?php echo e(asset('js/profile.js')); ?>"></script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    <p1><?php echo e(config('app.name', 'Pet4U')); ?></p1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                            <li class="nav-item active">
                                <a class="nav-link home" href="<?php echo e(url('/')); ?>"><?php echo e(__('Home')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('showAdp')); ?>"><?php echo e(__('Show Adoptable Pet')); ?></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">Donation</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item active" href="<?php echo e(route('donate')); ?>"><?php echo e(__('Donate')); ?></a>
                        <?php if(auth()->guard()->guest()): ?>
                        <?php else: ?>        
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><?php echo e(__('Donate Records')); ?></a>
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
                                    <a class="dropdown-item active" href="<?php echo e(route('pets.create')); ?>"><?php echo e(__('Add Pet Information')); ?></a>
                                    <a class="dropdown-item" href="PetInfoRecords.html">Pet Information Added</a>
                                </div>
                            </li>
                        <?php endif; ?>
                            
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            <?php if(Route::has('login')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::user()->username); ?>

                                    <?php if(auth()->user()->avatar): ?>
                                        <img src="<?php echo e(Storage::url(auth()->user()->avatar)); ?>" 
                                            alt="Avatar" 
                                            class="rounded-circle"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('images/image1.png')); ?>" 
                                            alt="Default Avatar" 
                                            class="rounded-circle"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                    <?php endif; ?>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item active" href="<?php echo e(route('showProfile')); ?>">
                                        <?php echo e(__('Profile')); ?>

                                    </a>

                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

        <!--FOOTER-->
    <footer style="padding: 3px; font-family: Varela Round;">
      <div class="container-fluid">
        <div class="card-group">
            <div class="card" style="margin-bottom: 0;">
              <div class="card-body">
                <h5 class="card-title">H.O.P.E - Homeless & Orphan Pets Exist</h5>
                <p class="card-text" style="text-align: center;">Homeless & Orphan Pets Exist - H.O.P.E. is a non profit and non-governmental organization which is currently located at Pekan Nanas, Johor. 
                  H.O.P.E. was established in April 2008 and was officially registered with the Registry of Societies of Malaysia on August 2009. H.O.P.E. is a 100% NO KILL animal shelter for all breeds of dogs and cats.</p>
              </div>
            </div>
            <div class="card" style="margin-bottom: 0;">
              <div class="card-body">
                <h5 class="card-title">Location</h5>
                <p class="card-text" style="text-align: center;">
                  <a href="https://goo.gl/maps/FU5KYr4CThApwXEf9" style="color: white;">
                    Pekan Nenas, Johor, Malaysia.
                  </a>
                </p>
              </div>
            </div>
            <div class="card" style="border-right: 0; margin-bottom: 0;">
              <div class="card-body">
                <h5 class="card-title">Contact Us</h5>
                <p class="card-text">CS: <a href="https://wa.me/60127167123" style="color: white;">+6012-716 7123</a>
                <br>E-mail: <a href=mailto:noreply@hopejb.org.my style="color: white;">noreply@hopejb.org.my</a>
                <br>E-mail: <a href=mailto:hopejbdonation@gmail.com style="color: white;">hopejbdonation@gmail.com</a></p>
                <div class="container-fluid"  style="border-top: 1px solid black;">
                    <a href="https://www.facebook.com/hopejb/" target="_blank">
                      &nbsp;<i class='bx bxl-facebook-circle'></i>
                    </a>
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="container-fluid">
        <center style="font-family: 'Varela Round'; color: white; background-color: orange;">
          <br>
          <p>
            <i class='bx bx-copyright'>2024</i> <span style="font-size: 20px;">HOPE</span> PPM-007-01-22122009<br>
            <span style="font-weight: bold;">Powered</span> by HOPE JB
          </p>  
          <br>        
        </center>
        </div>
    </footer>
</body>
</html>
<?php /**PATH D:\CourseTools\Laragon\laragon\www\BTPR2\resources\views/layouts/app.blade.php ENDPATH**/ ?>