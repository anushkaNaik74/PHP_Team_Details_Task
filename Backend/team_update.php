<?php $con = mysqli_connect("localhost", "root", "Anushka@25", "pr_project"); 

if (!$con) {
    die('error in db' . mysqli_error($con));
}

// Variables to store form data
$team_id = $team_name = $team_email = $team_con1 = $team_con2 = $team_dob = $team_doj = $team_password = '';


// Fetch data for editing when the page loads
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $select_team = "SELECT * FROM pr_team WHERE pr_team_id = $id";
    $run = $con->query($select_team);
    if ($run->num_rows > 0) {
        $row                    = $run->fetch_assoc();
        $team_id                = $row['pr_team_id'];
        $team_name              = $row['pr_team_name'];
        $team_email             = $row['pr_team_email'];
        $team_con1              = $row['pr_team_con_1'];
        $team_con2              = $row['pr_team_con_2'];
        $team_dob               = $row['pr_team_dob'];
        $team_doj               = $row['pr_team_doj'];
    }
}


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        

            
        // Retrieve other form fields
        $team_name              = $_POST['pr_team_name'];
        $team_email             = $_POST['pr_team_email'];
        $team_con1              = $_POST['pr_team_con_1'];
        $team_con2              = $_POST['pr_team_con_2'];
        $team_dob               = $_POST['pr_team_dob'];
        $team_doj               = $_POST['pr_team_doj'];
        $team_password          = $_POST['password'];

        if ($_POST['password'] != $_POST['confirm_password']) {
          echo "Passwords do not match";
          exit;
      }

        // Update data in the database
        $update_team = "UPDATE pr_team SET 
                                    pr_team_name    = '$team_name', 
                                    pr_team_email   = '$team_email', 
                                    pr_team_con_1   = '$team_con1', 
                                    pr_team_con_2   = '$team_con2', 
                                    pr_team_dob     = '$team_dob',
                                    pr_team_doj     = '$team_doj',
                                    pr_team_password = '$team_password'
                                WHERE pr_team_id    = '$team_id'";

        // Execute the SQL query
        if (mysqli_query($con, $update_team)) {
            echo '<script>alert("User Registered Successfully");</script>';
            header('location: team_insert.php');
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"/>
    <title>Team</title>
    <link rel="stylesheet" href="../Styles/team_insert.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
  <form id="registration_form" method="post" enctype="multipart/form-data">
    <div class="wrapper">
    <input type="hidden" name="pr_team_id" value="<?php echo $team_id; ?>">
      <div class="form-row">
        <label for="pr_team_name">Team Name</label>
        <input type="text" name="pr_team_name" id="pr_team_name" placeholder="Enter Team Name" value="<?php echo $team_name; ?>">
      </div>

      <div class="form-row">
        <label for="pr_team_email">Team Email</label>
        <input type="email" name="pr_team_email" id="pr_team_email" placeholder="Enter Team Email" value="<?php echo $team_email; ?>">
      </div>

      <div class="form-row">
        <label for="pr_team_con_1">Team Con1</label>
        <input type="text" name="pr_team_con_1" id="pr_team_con_1" placeholder="Enter Con 1" value="<?php echo $team_con1; ?>">
      </div>

      <div class="form-row">
        <label for="pr_team_con_2">Team Con2</label>
        <input type="text" name="pr_team_con_2" id="pr_team_con_2" placeholder="Enter Con 2" value="<?php echo $team_con2; ?>">
      </div>

      <div class="form-row">
        <label for="pr_team_dob">Team DOB</label>
        <input type="text" name="pr_team_dob" id="pr_team_dob" class="picker" placeholder="Enter Team DOB" value="<?php echo $team_dob; ?>">
      </div>

      <div class="form-row">
        <label for="pr_team_doj">Team DOJ</label>
        <input type="text" name="pr_team_doj" id="pr_team_doj" class="picker" placeholder="Enter Team DOJ" value="<?php echo $team_doj; ?>">
      </div>

      <div class="form-group form-row">
      <label for="pr_team_password">Password</label>
				    <input type="password" name="password" id="password"  class="form-control" tabindex="1" placeholder="Password" class="demoInputBox" onKeyUp="checkPasswordStrength();" maxlength="10" required><span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
                <div id="password-strength-status"></div>
				</div>

				<div class="form-group form-row">
        <label for="pr_team_cpassword">Confirm Password</label>
				    <input type="password" name="confirm_password" id="confirm_password" tabindex="1" class="form-control" placeholder="Confirm Password" required><span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password2"></span>
				</div>
        <div id="msg"></div>

      <div class="buttonSubmit">
        <input type="submit" name="update" value="Update">
      </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- jQuery UI -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>

    <!-- Other scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>

    <script type="text/javascript">
$(function(){
    $('.picker').datetimepicker({
        timepicker:false,
        datepicker:true,
        format:'d-m-Y',
        step:30,
        weeks:true,        
    });
})
</script>

<script>
     $("body").on('click', '.toggle-password', function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $("#password");
  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }

});
     
   </script>  
   <script>
     $("body").on('click', '.toggle-password2', function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $("#confirm_password");
  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }

});
     
   </script>





   <script>
     function checkPasswordStrength() {
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
            if ($('#password').val().length < 5) {
                $('#password-strength-status').removeClass();
                $('#password-strength-status').addClass('weak-password');
                $('#password-strength-status').html("Weak (password 5 - 10 characters long and include atleast 1alphabets,1 number & 1 symbol .)");
                $('#register-submit').prop('disabled', true);
                $('#password').keyup(function(){
                    if($(this).val().length ==0)
                        
                        $('#register-submit').attr('disabled',false);
                })
                $('#password').keyup(function(){
                    this.value = this.value.replace(/\s/g,'');
                 })


            } else {
                if ($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(special_characters)) {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('strong-password');
                    $('#password-strength-status').html("Strong");
                    $('#register-submit').prop('disabled', false);

                } else {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('medium-password');
                    $('#password-strength-status').html("Medium (min password length is 5 characters and include atleast 1 alphabet,1 number & 1 symbol .)");
                    $('#register-submit').prop('disabled', true);
                }
            }

                    }
   </script>
   <script>
$(document).ready(function(){

    $("#confirm_password").keyup(function(){
        if ($("#password").val() != $("#confirm_password").val()) {
            $("#msg").html("Passwords do not match").css("color","red");
        } else {
            $("#msg").html("Password matched").css({"color": "green", "font-weight": "bold"});
        }
    });

    // AJAX form submission
    $('#registration_form').submit(function(e){
        e.preventDefault(); // prevent default form submission
        var password = $("#password").val();
        var confirm_password = $("#confirm_password").val();
        if (password != confirm_password) {
            alert("Passwords do not match");
            return; // exit submission if passwords don't match
        }
        
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(response){
                
                        window.location.href = 'team_insert.php';
                    
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred: " + xhr.responseText); // Display the response from the server
            }
        });
    });
});
</script>



   <script>

   </script>
<script>
  $(document).ready(function(){
    
    $('#password').keyup(function(){
        if($(this).val().length ==0)            
            $('#register-submit').attr('disabled',true);    
        })

});

</script>
<script>
 $('#password').keyup(function(){ 
var str = $('#password').val();
var regex =  /^[A-Za-z0-9.!@#$%*]+$/;

if(regex.test(str) != true) {
    $('#password-strength-status').html("only !@#$%&* symbols are allowed)");
}
 })
</script>

  
  </body>
</html>





