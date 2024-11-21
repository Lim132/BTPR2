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
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="payment.css">
    <link rel="stylesheet" href="header.css">
    
    <title>Pet4U | Donation</title>
    <link rel="icon" type="image/jpg" href="image/hope.jpg">
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="ShowAdoptablePet.html">
        <img src="image/hope.jpg">
        <p1>Pet4U</p1>
      </a>
    </nav>
    <h1 style="text-align:center; text-decoration-line: underline; color: orange;"><strong>Donation</strong></h1>
   
    <div>
      <div class="container-fluid">
        <div class="row" style="margin-top: 10px;">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div class="card border-0">
                <div class="row">
                    <div class="col-md-12">
                      <center>
                          <br>
                            <table action="" id="validateTable">
                                <tbody class="container-fluid">
                                    <tr>
                                        <td colspan="2" class="col-width">Name : &nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="col-width"><input style="width: 100%;" type="text" id="FName" name="FName" placeholder="First Name"></td>
                                        <td class="col-width"><input style="width: 100%;"  type="text" id="LName" name="LName" placeholder="Last Name"></td>
                                    </tr>
                                      
                                    <tr>
                                        <td colspan="2" class="col-width">Email Address : &nbsp;</td>
                                        <td class="col-width"><input style="width: 100%;" type="text" id="email" name="email" placeholder="Eg: lxxx@gmail.com"></td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" class="col-width">Phone No. : &nbsp;</td>
                                        <td class="col-width"><input style="width: 100%;" type="text" id="phone" name="phone" placeholder="Eg: 012xxxxxxx"></td>
                                    </tr>
      
                                    <tr>
                                        <td colspan="2">Address : &nbsp;</td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="3"><input style="width: 100%;" type="text" id="address1" name="address1" placeholder="Street Address 1"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="3"><input style="width: 100%;" type="text" id="address2" name="address2" placeholder="Street Address 2"></td>
                                    </tr>
      
                                    <tr>
                                        <td colspan="2" class="col-width">State : &nbsp;</td>
                                        <td class="col-width">
                                          <select name="state" id="state" style="width: 100%; border: 1px solid">
                                            <option>Select State</option>
                                            <option value="Johor">Johor</option>
                                            <option value="Kedah">Kedah</option>
                                            <option value="Kelantan">Kelantan</option>
                                            <option value="Melaka">Melaka</option>
                                            <option value="Sembilan">Negeri Sembilan</option>
                                            <option value="Pahang">Pahang</option>
                                            <option value="Perak">Perak</option>
                                            <option value="Perlis">Perlis</option>
                                            <option value="Sabah">Sabah</option>
                                            <option value="Sarawak">Sarawak</option>
                                            <option value="Selangor">Selangor</option>
                                            <option value="Terengganu">Terengganu</option>
                                            <option value="KL">Wp Kuala Lumpur</option>
                                            <option value="Labuan">Wp Labuan</option>
                                            <option value="Puterajaya">Wp Puterajaya</option>
                                            <option value="other">Other</option>
                                          </select>
                                        </td>                                  
                                    </tr>
                                    
                                    <tr>
                                      <td colspan="2" class="col-width">City : &nbsp;</td>
                                      <td class="col-width"><input style="width: 100%;" type="text" id="city" name="city"></td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" class="col-width">Postcode : &nbsp;</td>
                                        <td class="col-width"><input style="width: 100%;" type="text" id="postcode" name="postcode"></td>
                                    </tr>
                                   
                                    <tr>
                                        <td colspan="2">Amount(RM) : &nbsp;</td>
                                        <td><input style="width: 100%;" type="text" id="donateAmount" name="donateAmount" placeholder="Eg: 60"></td>
                                    </tr>
                                </tbody>
                            </table>
                      </center>    
                    </div>
                </div>
            </div>
            
            
              <div id="paymentModal" class="modal" style="z-index: 9999;">
                <div class="modal-content" style="height: 100%;">
                  <center>
                    <img src="image/DuitNow.jpg" alt="Payment Image" style="height: 300px; width: 300px; margin-top: 200px;">
                    <br><br>
                    <a href="successful.html" class="btn btn-danger btn-xs">Complete Payment</a>&nbsp;                    
                    <button class="btn btn-danger btn-xs" onclick="closeModal()">Cancel</button>
                    <br><br>
                  </center>
                </div>
              </div>
            

          </div>
          <div class="col-md-1"></div>
          <div class="go-total">
            <div class="totalcart" style="height: 70px;">
              <center>
                <a href="ShowAdoptablePet.html" style="line-height: 70px;"><button class="btn btn-danger btn-xs">Back</button></a>&nbsp;
                <button type="submit" class="btn btn-danger btn-xs" onclick="validateAndSubmit()">Donate</button>
              </center>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- import script here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="cart.js"></script>
    <script>
      // Get the total from localStorage
      var totalAmount = localStorage.getItem("cartTotal");
      document.getElementById('subtotalDisplay').value = totalAmount;
      document.getElementById("totalDisplay").value = totalAmount;
      // Calculate and update the total
      function calculateTotal() {
          var subtotal = parseFloat(totalAmount);
          var promoDiscount = 0;
          var total = subtotal;
          // Check the promo code and apply discount
          var promoCodeInput = document.getElementById("promo");
          var validPromoCode = "wewewe"; // Replace with the correct promo code
          var promoCode = promoCodeInput.value;
          promoCode=promoCode.toUpperCase();
          if (promoCode === "WEWEWE" || promoCode === "MEMBER2023") {
              promoDiscount = total * 0.05; // Replace with the desired discount percentage
              document.getElementById('promocheck').textContent = "Discount 5%";
          }
          else if (promoCode === "MEMBER1718") {
              promoDiscount = total * 0.1; // Replace with the desired discount percentage
              document.getElementById('promocheck').textContent = "Discount 10%";
          }
          else{
            discount = 0;
            document.getElementById('promocheck').textContent = "Invalid Promo Code";
          }
  
          total -= promoDiscount;
  
          // Update discount and total input values
          document.getElementById("discount").value = promoDiscount.toFixed(2);
          document.getElementById("totalDisplay").value = total.toFixed(2);
      }
    </script>
    <script>
      function validateAndSubmit() {
        if (validateTable()) {
          confirmPayment(); // Call the function to proceed with payment
        } else {
          // Validation failed, prevent form submission and show alert
          alert("Please fill in all required fields.");
        }
      }

      function validateTable() {
        var fName = document.getElementById("FName").value;
        var lName = document.getElementById("LName").value;
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone").value;
        var address1 = document.getElementById("address1").value;
        var address2 = document.getElementById("address2").value;
        var state = document.getElementById("state").value;
        var city = document.getElementById("city").value;
        var postcode = document.getElementById("postcode").value;

        if (
          fName === "" ||
          lName === "" ||
          email === "" ||
          phone === "" ||
          address1 === "" ||
          address2 === "" ||
          state === "Select State" ||
          city === "" ||
          postcode === ""
        ) {
          return false; // Validation failed
        }
        return true; // Validation succeeded
      }

      function confirmPayment() {
        showQRCode();
      }

      function showQRCode() {
        // Display the QR code image and other relevant content
        document.getElementById("paymentModal").style.display = "block";
      }

      function closeModal() {
        // Close the modal (hide QR code image)
        document.getElementById("paymentModal").style.display = "none";
      }
    </script> 
    <br><br><br><br>
  </body>
</html>
