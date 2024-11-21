<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Varela Round' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="items.css">
    <link rel="stylesheet" href="footer.css">
    

    <title>Pet4U | Donation Records - Admin</title>
    <link rel="icon" type="image/png" href="image/hope.jpg">

    <style>
      a {
        text-decoration: none;
      }
    </style>
  </head>
  <body>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="cart.js" defer></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->

    <!--Header-->
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

    <div class="container-fluid">
      <div class="row" style="margin-top: 10px;">
        <div class="col-md-1"></div>
        <div class="col-md-1"></div>
        <div class="col-md-9">
          <div class="card border-0">
            <h5 class="title1 card-title">Donation Records</h5>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    
                    <style>
                      table {
                          width: 100%;
                          border-collapse: collapse;
                          margin-bottom: 20px;
                      }
              
                      th, td {
                          padding: 10px;
                          text-align: left;
                          border-bottom: 1px solid #ddd;
                      }
              
                      th {
                          background-color: #f4f4f4;
                      }
              
                      tr:hover {
                          background-color: #f1f1f1;
                      }
              
                      .download-icon {
                          text-align: center;
                          color: #007bff;
                          cursor: pointer;
                      }
              
                      .download-icon:hover {
                          color: #0056b3;
                      }
              
                      .download-icon i {
                          font-size: 18px;
                      }
                    </style>
              
                  <table>
                      <thead>
                          <tr>
                              <th>Donor Name</th>
                              <th>Donation Date</th>
                              <th>Amount</th>
                              <th>Receipt</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>John Doe</td>
                              <td>2024-08-20</td>
                              <td>RM 50</td>
                              <td class="download-icon">
                                  <a href="receipt1.pdf" download>
                                      <i class="fas fa-download"></i> <!-- Font Awesome Icon -->
                                  </a>
                              </td>
                          </tr>
                          <tr>
                              <td>Jane Smith</td>
                              <td>2024-08-22</td>
                              <td>RM 75</td>
                              <td class="download-icon">
                                  <a href="receipt2.pdf" download>
                                      <i class="fas fa-download"></i>
                                  </a>
                              </td>
                          </tr>
                          <!-- More records -->
                      </tbody>
                  </table>

                </div><br>
              </div>
              
              
            </div>
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                  <a class="page-link">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">Next</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>
    </div>
    <br>

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