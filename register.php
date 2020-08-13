<!DOCTYPE html>
<html>
<head>
	<?php include_once("templates/headerIncludes.php"); ?>
	<link rel="stylesheet" type="text/css" href="css/loginCss.css">

    <script>
        function checkuname()
        {
            var name=document.getElementById("username").value;
            
            if(name)
            {
                $.ajax({
                type: 'post',
                url: 'controller/checkUserName.php',
                data: {
                user_name:name,
                },

                    success: function (response) {
                        
                        $('#checkUserName').html(response);
                        if(response=="Username is available")    
                        {
                            $("#checkUserName").css('color', '#0AC02A', 'important');
                            return true;
                        }
                        else
                        {
                            $("#signupbtn").attr("disabled","disabled");
                            $("#signupbtn").css('cursor', 'no-drop', 'important');
                            $("#checkUserName").css('color', '#FF0004', 'important');
                            return false;
                        }
                    }
                });
            }

            else
            {
                $('#checkUserName').html("");
                $("#signupbtn").attr("disabled","disabled");
                $("#signupbtn").css('cursor', 'no-drop', 'important');
                return false;
            }
        }

        function checkuemail()
        {
            var email=document.getElementById("uEmail").value;
            
        
                if(email && validateEmail(email))
                {
                    $.ajax({
                    type: 'post',
                    url: 'controller/checkUserEmail.php',
                    data: {
                    user_email:email,
                    },

                        success: function (response) {
                            
                            $('#checkUserEmail').html(response);
                            if(response=="Email is available")    
                            {
                                $("#checkUserEmail").css('color', '#0AC02A', 'important');
                                return true;
                            }
                            else
                            {
                                $("#signupbtn").attr("disabled","disabled");
                                $("#signupbtn").css('cursor', 'no-drop', 'important');
                                $("#checkUserEmail").css('color', '#FF0004', 'important');
                                return false;
                            }
                        }
                    });
                }
                else
                {
                    $('#checkUserEmail').html("Your email is not a valid email");
                    $("#checkUserEmail").css('color', '#FF0004', 'important');
                    $("#signupbtn").attr("disabled","disabled");
                    $("#signupbtn").css('cursor', 'no-drop', 'important');
                    return false;
                } 

                
            }

            
        

        function validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        window.onload = function(){
            document.getElementById('username').value = '';
            document.getElementById('uEmail').value = '';
        }

        </script>

       
        <script>
            $(document).ready(function() {
              validate();
              $('input').on('keyup', validate);
            });

            function validate() {
              var inputsWithValues = 0;
              
              // get all input fields except for type='submit'
              var myInputs = $("input:not([type='submit'])");

              myInputs.each(function(e) {
                // if it has a value, increment the counter
                if ($(this).val()) {
                  inputsWithValues += 1;
                }
              });

              if (inputsWithValues == myInputs.length) {
                $("#signupbtn").prop("disabled", false);
                $("#signupbtn").css('cursor', 'pointer', 'important');
              } else {
                $("#signupbtn").prop("disabled", true);
                $("#signupbtn").css('cursor', 'no-drop', 'important');
              }
            }
        </script>

        <script>
            
            function signup(){
                var userFirst = document.getElementById('userFirst').value;
                var userLast = document.getElementById('userLast').value;
                var uEmail = document.getElementById('uEmail').value;
                var cNumber = document.getElementById('cNumber').value;
                var usercity = document.getElementById('usercity').value;
                var adline2 = document.getElementById('adline2').value;
                var udistrict = document.getElementById('udistrict').value;
                var olyear = document.getElementById('olyear').value;
                var userFirst = document.getElementById('userFirst').value;

                var uemail_alert = document.getElementById('checkUserEmail').textContent;
                var uname_alert = document.getElementById('checkUserName').textContent;

                if(uemail_alert!=="Email already exists" && uname_alert !== "Username already exists"){
                    if(userFirst && userLast && uEmail && cNumber && usercity && adline2 && udistrict && olyear && userFirst){
                        document.getElementById("registerform").submit();
                    }
                    else{
                        swal({title: "Sign up Failed!!",
                        text: "All the fields are required",
                        type: "warning",
                        icon: "warning",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        closeOnConfirm: false,
                        confirmButtonText: "OK!"});
                    }
                }else{
                    $("#signupbtn").attr("disabled","disabled");
                    $("#signupbtn").css('cursor', 'no-drop', 'important');
                }

                
            }


            

        </script>
        

</head>
<body style="background-image: url(images/loginback.jpeg);">

        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" id="registerform" method="POST" action="controller/newMember.php">
                    <span class="login100-form-title p-b-26">
                        Welcome to<br> Master-Exams
                    </span>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" id="userFirst" name="userFirst" placeholder="First Name" required minlength="3">
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" id="userLast" name="userLast" placeholder="Last Name" required minlength="3">
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="email" onkeyup="checkuemail()" onblur="checkuemail()"  name="uEmail" id="uEmail" placeholder="Email">
                    </div>
                    <lable id="checkUserEmail" style="font-weight: bold; font-size: 12px;margin-top: -2.8em;position: absolute;"></lable>


                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" id="cNumber" name="cNumber" placeholder="Contact Number" onkeypress="allowNumbersOnly(event)" required maxlength="10">
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" id="usercity" name="usercity" placeholder="Address(Line 1)" required minlength="3">
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" id="adline2" name="adline2" placeholder="Address(Line 2)" required minlength="3">
                    </div>

                    

                    <div class="wrap-input2100 validate-input">
                        <select name="udistrict" id="udistrict" required>
                            <option value="">District</option>
                            <option value="Ampara">Ampara</option>
                            <option value="Anuradhapura">Anuradhapura</option>
                            <option value="Badulla">Badulla</option>
                            <option value="Batticaloa">Batticaloa</option>
                            <option value="Colombo">Colombo</option>
                            <option value="Galle">Galle</option>
                            <option value="Gampaha">Gampaha</option>
                            <option value="Hambantota">Hambantota</option>
                            <option value="Jaffna">Jaffna</option>
                            <option value="Kalutara">Kalutara</option>
                            <option value="Kandy">Kandy</option>
                            <option value="Kegalle">Kegalle</option>
                            <option value="Kilinochchi">Kilinochchi</option>
                            <option value="Kurunegala">Kurunegala</option>
                            <option value="Mannar">Mannar</option>
                            <option value="Matale">Matale</option>
                            <option value="Matara">Matara</option>
                            <option value="Monaragala">Monaragala</option>
                            <option value="Mullaitivu">Mullaitivu</option>
                            <option value="Nuwara Eliya">Nuwara Eliya</option>
                            <option value="Polonnaruwa">Polonnaruwa</option>
                            <option value="Puttalam">Puttalam</option>
                            <option value="Ratnapura">Ratnapura</option>
                            <option value="Trincomalee">Trincomalee</option>
                            <option value="Vavuniya">Vavuniya</option>
                        </select>
                    </div>

                    <div class="wrap-input2100 validate-input">
                        <select name="olyear" id="olyear" required>
                            <option value="">O/L Year</option>
                            <option value="2010 O/L">2010 O/L</option>
                            <option value="2011 O/L">2011 O/L</option>
                            <option value="2012 O/L">2012 O/L</option>
                            <option value="2013 O/L">2013 O/L</option>
                            <option value="2014 O/L">2014 O/L</option>
                            <option value="2015 O/L">2015 O/L</option>
                            <option value="2016 O/L">2016 O/L</option>
                            <option value="2017 O/L">2017 O/L</option>
                            <option value="2018 O/L">2018 O/L</option>
                            <option value="2019 O/L">2019 O/L</option>
                            <option value="2020 O/L">2020 O/L</option>
                            <option value="2021 O/L">2021 O/L</option>
                            <option value="2022 O/L">2022 O/L</option>
                            <option value="2023 O/L">2023 O/L</option>
                            <option value="2024 O/L">2024 O/L</option>
                            <option value="2025 O/L">2025 O/L</option>
                            <option value="2026 O/L">2026 O/L</option>
                            <option value="2027 O/L">2027 O/L</option>
                            <option value="2028 O/L">2028 O/L</option>
                            <option value="2029 O/L">2029 O/L</option>
                            <option value="2030 O/L">2030 O/L</option>
                            <option value="2031 O/L">2031 O/L</option>
                            <option value="2032 O/L">2032 O/L</option>
                            <option value="2033 O/L">2033 O/L</option>
                            <option value="2034 O/L">2034 O/L</option>
                            <option value="2035 O/L">2035 O/L</option>
                        </select>
                    </div>

                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" onkeyup="checkuname()" onkeydown="checkuname()" onblur="checkuname()" onkeypress="removeSpace(event)" id="username" name="username" placeholder="Username"  minlength="5">
                    </div>
                    <lable id="checkUserName" style="font-weight: bold; font-size: 12px;margin-top: -2.8em;position: absolute;"></lable>
                </form>
                    

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn" onclick="signup()" id="signupbtn"  disabled="disabled" 
                            	style="background: #891130;
    									background-image: -webkit-linear-gradient(left, #891130 0%, #e0878a 51%, #891130 100%);
    									background-image: linear-gradient(to right, #891130 0%, #e0878a 51%, #891130 100%);" 	
                            >
                                Sign Up
                            </button>
                        </div>
                    </div>

                    <div class="text-center p-t-115" style="margin-top: 1em;">
                        <span class="txt1">
                            Already member?
                        </span>

                        <a class="txt2" href="login.php">
                            Sign In
                        </a>
                    </div>
               

            </div>
        </div>



        <?php include_once("templates/jsIncludes.php"); ?> 

    </body>

</html>