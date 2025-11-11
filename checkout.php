<?php
require 'header.php';
ob_start();
ob_flush();
ob_clean();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION['user_id'])) {
    $userIds = $_SESSION['user_id'];
} else {
    echo '<script>window.location.href="login.php";</script>';
}

$cartd = mysqli_query($conn, "SELECT * FROM cart WHERE userid = '$userIds'");

if (mysqli_num_rows($cartd) == 0) {
    echo '<script>window.location.href="index.php";</script>';
}

if (!empty($_SESSION['amount'])) {
    unset($_SESSION['amount']); // unset amount session variable if already set
}

// Fetch user data
$selectUser = mysqli_query($conn, "SELECT * FROM users WHERE id='$userIds'");
$fetchUser = mysqli_fetch_array($selectUser);
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    #dropdown {
        border: 1px solid #ccc;
        max-height: 200px;
        overflow-y: auto;
        display: none;
        position: absolute;
        z-index: 1000;
        background-color: white;
        width: 31%;
    }

    .dropdown-item {
        padding: 8px;
        cursor: pointer;
    }

    .dropdown-item:hover {
        background-color: #f0f0f0;
    }

    /* Basic styling for error messages */
    .error-message {
        color: red;
        font-size: 0.9em;
        margin-top: 5px;
        display: none;
        /* Initially hidden */
    }

    input:invalid:not(:placeholder-shown) {
        border-color: red;
    }

    /* Some basic layout to see the form better */
</style>

<section class="inner-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb">
                    <a href="index.php" class="hover">Home</a>
                    <span>|</span>
                    <a href="#">Checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- checkout main wrapper start -->
<div class="checkout-page-wrapper section-padding">
    <div class="container">

        <div class="row">
            <?php if (isset($msg)) {
                echo $msg;
            } ?>

            <form id="formId" method="POST">
                <div class="row">
                    <!-- LEFT SIDE: Billing Details -->
                    <div class="col-lg-8">
                        <div class="checkout-billing-details-wrap">
                            <h5 class="checkout-title">Billing Details</h5>
                            <div class="billing-form-wrap">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="firstname" class="required">Name</label>
                                            <input type="text" id="firstname" placeholder="Enter Name" oninput="allowOnlyText(this)" name="name" value="<?php echo $fetchUser['name']; ?>" />
                                            <p class="error-message" id="firstname-error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="email" class="required">Email Id</label>
                                            <input type="email" id="email" placeholder="Enter Email" name="email" value="<?php echo $fetchUser['email']; ?>" />
                                            <p class="error-message" id="email-error"></p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="phone" class="required">Phone</label>
                                            <input type="text" name="phone" id="phone" maxlength="10" readonly value="<?php echo htmlspecialchars($fetchUser['mobile'] ?? ''); ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');" placeholder="Enter Your Phone Number">
                                            <p class="error-message" id="phone-error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="email" class="required">Country</label>
                                            <select name="country" id="ul-checkout-country" required>
                                                <option data-placeholder="true" selected disabled>Select Country</option>
                                                <option value="India" selected>India</option>
                                            </select>
                                            <p class="error-message" id="country-error"></p>
                                        </div>
                                    </div>

                                     <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="address3" class="required">Landmark / Nearby</label>
                                            <input type="text" name="address3" id="address3" value="<?php echo $fetchUser['address2']; ?>" placeholder="Apartment / Landmark" autocomplete="off">
                                            <p class="error-message" id="address3-error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="address2" class="required">District</label>
                                            <input type="text" id="address2" placeholder="Enter District" name="address2" oninput="allowOnlyText(this)" value="<?php echo $fetchUser['address2']; ?>" />
                                            <p class="error-message" id="address2-error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="address1" class="required">Address (House/Locality)</label>
                                            <input type="text" name="address1" id="address1" placeholder="Enter Street Address" value="<?php echo $fetchUser['address']; ?>" autocomplete="off">
                                            <p class="error-message" id="address1-error"></p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="pincode" class="required">Pin Code</label>
                                            <input type="text" name="pincode" id="pincode" maxlength="6" value="<?php echo htmlspecialchars($fetchUser['pincode'] ?? ''); ?>" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" placeholder="Enter Your Postcode">
                                            <p class="error-message" id="pincode-error"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="city_name" class="required">City</label>
                                            <input type="text" id="city_name" value="<?php echo htmlspecialchars($fetchUser['city'] ?? ''); ?>" name="city" required readonly>
                                            <p class="error-message" id="city-error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="state_name" class="required">State</label>
                                            <input type="text" id="state_name" value="<?php echo htmlspecialchars($fetchUser['state'] ?? ''); ?>" name="state" required readonly>
                                            <p class="error-message" id="state-error"></p>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $cartdata = mysqli_query($conn, "SELECT SUM(price) as totalprice, SUM(mrp) as totalmrp, id FROM cart WHERE userid = '" . $_SESSION['user_id'] . "' ");
                    $fetchcartdata = mysqli_fetch_array($cartdata);
                    $totalprice = $fetchcartdata['totalprice'] ?? 0;
                    $totalmrp = $fetchcartdata['totalmrp'] ?? 0;
                    $discount = $totalmrp - $totalprice;
                    $_SESSION['amount'] = $totalprice;
                    ?>
                    <div class="col-lg-4">
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Order Summary</h5>
                            <div class="order-summary-content">
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>Cart Total</td>
                                                <td>&#8377; <?= $totalmrp; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="dis">Discount (-)</td>
                                                <td class="dis">&#8377; <?= $discount; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Sub Total</td>
                                                <td>&#8377; <?= $totalprice; ?></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="dis">Delivery Charge (+)</td>
                                                <td class="dis">&#8377; 0</td>
                                            </tr>
                                            <tr>
                                                <td>Total Amount (Inc. GST)</td>
                                                <td>&#8377; <?= $totalprice; ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <!-- Payment Buttons -->
                                <div class="order-payment-method">
                                    <div class="summary-footer-area">
                                        <div class="custom-control custom-checkbox mb-20">
                                            <input type="checkbox" class="custom-control-input" id="terms" required>
                                            <label class="custom-control-label" for="terms">
                                                I agree to the <a href="terms.php">terms and conditions</a>.
                                            </label>
                                        </div>

                                        <input type="hidden" name="amnt" value="<?= $totalprice ?>">
                                        <button type="submit" name="placeorder" class="btn btn-sqr check-valid1" >Proceed To Pay</button>
                                        <!-- <button type="submit" name="placeorder" class="btn btn-sqr check-valid1" onclick="validateAndSetFormA('epay.php')">Proceed To Pay</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<!-- checkout main wrapper end -->

<?php require 'footer.php'; ?>

<script>
    function allowOnlyText(input) {
        input.value = input.value.replace(/[^a-zA-Z\s]/g, '');
    }

    function validateForm() {
        let isValid = true;

        // Reset all error messages
        document.querySelectorAll('.error-message').forEach(el => el.style.display = 'none');

        // Full Name validation
        const firstname = document.getElementById('firstname');
        if (firstname.value.trim() === '') {
            document.getElementById('firstname-error').innerText = 'Full Name is required.';
            document.getElementById('firstname-error').style.display = 'block';
            isValid = false;
        }

        // Country validation (assuming "Select Country" is disabled and India is pre-selected)
        const country = document.getElementById('ul-checkout-country');
        if (country.value === 'Select Country' || country.value === null) {
            document.getElementById('country-error').innerText = 'Please select a country.';
            document.getElementById('country-error').style.display = 'block';
            isValid = false;
        }

        // Street Address validation
        const address1 = document.getElementById('address1');
        if (address1.value.trim() === '') {
            document.getElementById('address1-error').innerText = 'Street Address is required.';
            document.getElementById('address1-error').style.display = 'block';
            isValid = false;
        }

        // Address / Landmark validation
        const address2 = document.getElementById('address2');
        if (address2.value.trim() === '') {
            document.getElementById('address2-error').innerText = 'Address / Landmark is required.';
            document.getElementById('address2-error').style.display = 'block';
            isValid = false;
        }

        // State validation (assuming it's filled by pincode lookup or pre-filled)
        const state_name = document.getElementById('state_name');
        if (state_name.value.trim() === '') {
            document.getElementById('state-error').innerText = 'State is required and should be filled automatically by pincode.';
            document.getElementById('state-error').style.display = 'block';
            isValid = false;
        }

        // City validation (assuming it's filled by pincode lookup or pre-filled)
        const city_name = document.getElementById('city_name');
        if (city_name.value.trim() === '') {
            document.getElementById('city-error').innerText = 'City is required and should be filled automatically by pincode.';
            document.getElementById('city-error').style.display = 'block';
            isValid = false;
        }

        // ZIP Code validation
        const pincode = document.getElementById('pincode');
        if (pincode.value.trim() === '' || pincode.value.length !== 6 || !/^\d+$/.test(pincode.value)) {
            document.getElementById('pincode-error').innerText = 'Please enter a valid 6-digit ZIP Code.';
            document.getElementById('pincode-error').style.display = 'block';
            isValid = false;
        }

        // Phone validation
        const phone = document.getElementById('phone');
        if (phone.value.trim() === '' || phone.value.length !== 10 || !/^\d+$/.test(phone.value)) {
            document.getElementById('phone-error').innerText = 'Please enter a valid 10-digit phone number.';
            document.getElementById('phone-error').style.display = 'block';
            isValid = false;
        }

        // Email validation
        const email = document.getElementById('email');
        if (email.value.trim() === '' || !/\S+@\S+\.\S+/.test(email.value)) {
            document.getElementById('email-error').innerText = 'Please enter a valid email address.';
            document.getElementById('email-error').style.display = 'block';
            isValid = false;
        }

        return isValid;
    }

    function validateAndSetFormA(actionUrl) {

        var pinCheck = document.getElementById('pincode');
        fetch(`/get-location.php?pin=${pinCheck}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data && data.city_name && data.state_name) {

                } else {
                    return false;
                }
            })
            .catch(error => {
                return false;
            });

        if (validateForm()) {
            $('#formId').attr('action', actionUrl);
            $('#formId').submit(); // Manually submit the form if validation passes
        } else {
            // Prevent default form submission if validation fails
            event.preventDefault();
        }
    }

    // Pincode lookup functionality
    document.getElementById('pincode').addEventListener('keyup', function() {
        const pincode = this.value;
        const pincodeError = document.getElementById('pincode-error');

        // Clear previous error message for pincode
        pincodeError.style.display = 'none';

        // Only proceed if pincode length is 6 and contains only digits
        if (pincode.length === 6 && /^\d+$/.test(pincode)) {
            fetchCityAndState(pincode);
        } else {
            // Clear fields and show error message if pincode is invalid
            document.getElementById('city_name').value = '';
            document.getElementById('state_name').value = '';
            document.getElementById('state_name').readOnly = false;
            document.getElementById('city_name').readOnly = false;
            if (pincode.length > 0 && (pincode.length !== 6 || !/^\d+$/.test(pincode))) {
                pincodeError.innerText = "Please enter a valid 6-digit pincode.";
                pincodeError.style.display = 'block';
            }
        }
    });

    function fetchCityAndState(pincode) {
        // Replace this URL with your actual API endpoint for pincode lookup
        // Example: If you have a backend endpoint like /api/get-location.php?pincode=123456
        fetch(`get-location?pin=${pincode}`) // Make sure this endpoint exists and returns city_name and state_name
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data && data.city_name && data.state_name) {
                    document.getElementById('city_name').value = data.city_name;
                    document.getElementById('state_name').value = data.state_name;
                    document.getElementById("state_name").readOnly = true;
                    document.getElementById("city_name").readOnly = true;
                    document.getElementById('pincode-error').style.display = 'none'; // Hide error if successful
                    // $('.check-valid1').prop('disabled', false).attr('onclick', "validateAndSetFormA('epay.php')");
                    // $('.check-valid2').prop('disabled', false).attr('onclick', "validateAndSetFormA('nd/intent.php')");
                    // $('.check-valid3').prop('disabled', false).attr('onclick', "validateAndSetFormA('ft/intent.php')");
                    // $('.check-valid4').prop('disabled', false).attr('onclick', "validateAndSetFormA('paysprint/createorder.php')");
                    // $('.check-valid5').prop('disabled', false).attr('onclick', "validateAndSetFormA('paysprint2/createorder.php')");
                } else {
                    document.getElementById('city_name').value = '';
                    document.getElementById('state_name').value = '';
                    document.getElementById("state_name").readOnly = false;
                    document.getElementById("city_name").readOnly = false;
                    document.getElementById('pincode-error').innerText = "City and State not found for this pincode. Please enter manually.";
                    document.getElementById('pincode-error').style.display = 'block';
                    // $('.check-valid1').prop('disabled', true).removeAttr('onclick');
                    // $('.check-valid2').prop('disabled', true).removeAttr('onclick');
                    // $('.check-valid3').prop('disabled', true).removeAttr('onclick');
                    // $('.check-valid4').prop('disabled', true).removeAttr('onclick');
                    // $('.check-valid5').prop('disabled', true).removeAttr('onclick');
                }
            })
            .catch(error => {
                console.error('Error fetching city and state:', error);
                document.getElementById('city_name').value = '';
                document.getElementById('state_name').value = '';
                document.getElementById("state_name").readOnly = false;
                document.getElementById("city_name").readOnly = false;
                document.getElementById('pincode-error').innerText = "Error fetching location data. Please try again or enter manually.";
                document.getElementById('pincode-error').style.display = 'block';
                // $('.check-valid1').prop('disabled', true).removeAttr('onclick');
                // $('.check-valid2').prop('disabled', true).removeAttr('onclick');
                // $('.check-valid3').prop('disabled', true).removeAttr('onclick');
                // $('.check-valid4').prop('disabled', true).removeAttr('onclick');
                // $('.check-valid5').prop('disabled', true).removeAttr('onclick');
            });
    }

    var autopincode = "<?php echo htmlspecialchars($fetchUser['pincode'] ?? ''); ?>";
    
    if (autopincode) {
        fetch(`get-location?pin=${autopincode}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data && data.city_name && data.state_name) {
                    document.getElementById('city_name').value = data.city_name;
                    document.getElementById('state_name').value = data.state_name;
                    document.getElementById("state_name").readOnly = true;
                    document.getElementById("city_name").readOnly = true;
                    document.getElementById('pincode-error').style.display = 'none';
                    // $('.check-valid1').prop('disabled', false).attr('onclick', "validateAndSetFormA('epay.php')");
                    // $('.check-valid2').prop('disabled', false).attr('onclick', "validateAndSetFormA('nd/intent.php')");
                    // $('.check-valid3').prop('disabled', false).attr('onclick', "validateAndSetFormA('ft/intent.php')");
                    // $('.check-valid4').prop('disabled', false).attr('onclick', "validateAndSetFormA('paysprint/createorder.php')");
                    // $('.check-valid5').prop('disabled', false).attr('onclick', "validateAndSetFormA('paysprint2/createorder.php')");

                } else {
                    document.getElementById('city_name').value = '';
                    document.getElementById('state_name').value = '';
                    document.getElementById("state_name").readOnly = false;
                    document.getElementById("city_name").readOnly = false;
                    document.getElementById('pincode-error').innerText = "City and State not found for this pincode. Please enter manually.";
                    document.getElementById('pincode-error').style.display = 'block';
                    // $('.check-valid1').prop('disabled', true).removeAttr('onclick');
                    // $('.check-valid2').prop('disabled', true).removeAttr('onclick');
                    // $('.check-valid3').prop('disabled', true).removeAttr('onclick');
                    // $('.check-valid4').prop('disabled', true).removeAttr('onclick');
                    // $('.check-valid5').prop('disabled', true).removeAttr('onclick');
                }
            })
            .catch(error => {
                console.error('Error fetching city and state:', error);
                document.getElementById('city_name').value = '';
                document.getElementById('state_name').value = '';
                document.getElementById("state_name").readOnly = false;
                document.getElementById("city_name").readOnly = false;
                document.getElementById('pincode-error').innerText = "Error fetching location data. Please try again or enter manually.";
                document.getElementById('pincode-error').style.display = 'block';
                // $('.check-valid1').prop('disabled', true).removeAttr('onclick');
                // $('.check-valid2').prop('disabled', true).removeAttr('onclick');
                // $('.check-valid3').prop('disabled', true).removeAttr('onclick');
                // $('.check-valid4').prop('disabled', true).removeAttr('onclick');
                // $('.check-valid5').prop('disabled', true).removeAttr('onclick');
            });
    }
    // Address Autocomplete functionality
    $(document).ready(function() {
        $("#address1").on("input", function() {
            var query = $(this).val();
            if (query.length >= 3) { // Start searching after 3 characters for better results
                $.ajax({
                    url: "fetch_address.php", // The PHP file that fetches data
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $("#dropdown").html(data).show();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error fetching address suggestions:", textStatus, errorThrown);
                        $("#dropdown").hide();
                    }
                });
            } else {
                $("#dropdown").hide();
            }
        });

        // Handle the selection from the dropdown
        $(document).on("click", ".dropdown-item", function() {
            var address = $(this).data("address");
            var pincode = $(this).data("pincode");
            var city = $(this).data("city");
            var district = $(this).data("district");
            var state = $(this).data("state");

            $("#address1").val(address); // Keep only the street address in address1
            $("#address2").val(district || ''); // Use district for address2/landmark if available
            $("#pincode").val(pincode || '');
            $("#city_name").val(city || '');
            $("#state_name").val(state || '');

            $("#pincode").attr("readonly", true);
            $("#city_name").attr("readonly", true);
            $("#address2").attr("readonly", true); // Make address2 readonly if populated from autocomplete
            $("#state_name").attr("readonly", true);
            $("#dropdown").hide();

            // Clear any previous error messages for these fields
            $('#address1-error').hide();
            $('#address2-error').hide();
            $('#pincode-error').hide();
            $('#city-error').hide();
            $('#state-error').hide();
        });

        // Hide dropdown when clicking outside
        $(document).click(function(event) {
            if (!$(event.target).closest("#address1, #dropdown").length) {
                $("#dropdown").hide();
            }
        });
    });
</script>