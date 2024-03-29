<?php $con = mysqli_connect("localhost", "root", "Anushka@25", "pr_project"); ?>

<?php

ob_start();

    // Variables to store form data
    $team_name = $team_email = $team_con1 = $team_con2 = $team_dob = $team_doj = $team_password = '';


    if(isset($_POST['submit'])){

        $team_name              = $_POST['pr_team_name'];
        $team_email             = $_POST['pr_team_email'];
        $team_con1              = $_POST['pr_team_con_1'];
        $team_con2             = $_POST['pr_team_con_2'];
        $team_dob               = $_POST['pr_team_dob'];
        $team_doj               = $_POST['pr_team_doj'];
        $team_password          = $_POST['password'];


        if ($_POST['password'] != $_POST['confirm_password']) {
          header('Location: team_insert.php');
          exit;
      }
      
        

        // Insert data into the database
        $insert_team_query = "INSERT INTO pr_team (
                                pr_team_name, 
                                pr_team_email, 
                                pr_team_con_1, 
                                pr_team_con_2, 
                                pr_team_dob, 
                                pr_team_doj,
                                pr_team_password
                                
                            ) VALUES (
                                '$team_name', 
                                '$team_email', 
                                '$team_con1', 
                                '$team_con2', 
                                '$team_dob',
                                '$team_doj',
                                '$team_password'
                            )";

        // Execute the SQL query

        if (mysqli_query($con, $insert_team_query)) {
          // Redirect to another page after successful insertion
          header('Location: team_insert.php');
          exit; // Make sure to exit after redirection
      } else {
          echo "Error: " . $insert_team_query . "<br>" . mysqli_error($con);
      }
        } 
        

   ob_end_flush(); 
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
      <div class="form-row">
        <label for="pr_team_name">Team Name</label>
        <input type="text" name="pr_team_name" id="pr_team_name" placeholder="Enter Team Name" required>
      </div>

      <div class="form-row">
        <label for="pr_team_email">Team Email</label>
        <input type="email" name="pr_team_email" id="pr_team_email" placeholder="Enter Team Email" required>
      </div>

      <div class="form-row">
        <label for="pr_team_con_1">Team Con1</label>
        <input type="text" name="pr_team_con_1" id="pr_team_con_1" placeholder="Enter Con 1" required>
      </div>

      <div class="form-row">
        <label for="pr_team_con_2">Team Con2</label>
        <input type="text" name="pr_team_con_2" id="pr_team_con_2" placeholder="Enter Con 2">
      </div>

      <!-- <div class="form-row">
        <label for="pr_team_image">Team Image</label>
        <input type="file" name="pr_team_image" id="pr_team_image" >
      </div> -->

      <div class="form-row">
        <label for="pr_team_dob">Team DOB</label>
        <input type="text" name="pr_team_dob" id="pr_team_dob" class="picker" placeholder="Enter Team DOB" required>
      </div>


      <div class="form-row">
        <label for="pr_team_doj">Team DOJ</label>
        <input type="text" class="picker" name="pr_team_doj" id="pr_team_doj" placeholder="Enter Team DOJ" required>
      </div>


      <div class="form-group form-row">
      <label for="pr_team_password">Password</label>
				    <input type="password" name="password" id="password" tabindex="1" placeholder="Password" class="form-control demoInputBox" onKeyUp="checkPasswordStrength();" maxlength="10" required><span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
                <div id="password-strength-status"></div>
				</div>

				<div class="form-group form-row">
        <label for="pr_team_cpassword">Confirm Password</label>
				    <input type="password" name="confirm_password" id="confirm_password" tabindex="1" class="form-control" placeholder="Confirm Password" maxlength="10" required><span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password2"></span>
				</div>
        <div id="msg"></div>

      <div class="buttonSubmit">
        <input type="submit" name="submit" value="Submit">
      </div>
    </div>
    <h3>Team Skill Details</h3>
  <table>
    <tr>
      <th>#</th>
      <th>Team Name</th>
      <th>Team Email</th>
      <th>Team Con1</th>
      <th>Team Con2</th>
      <th>Team DOB</th>
      <th>Team DOJ</th>
      <th>Operations</th>
    </tr>

    <?php
      $i = 1;
      $select_all_team_query = "SELECT * FROM pr_team";
      $select_all_team_query_sql = mysqli_query($con, $select_all_team_query);
      $count_select_all_team_query = mysqli_num_rows($select_all_team_query_sql);

      if($count_select_all_team_query  > 0){
        while ($row = $select_all_team_query_sql -> fetch_assoc()) {
          $id = $row['pr_team_id'];
    ?>

    <tr>
      <td><?php echo $i++ ?></td>
      <td><?php echo $row['pr_team_name']?></td>
      <td><?php echo $row['pr_team_email']?></td>
      <td><?php echo $row['pr_team_con_1']?></td>
      <td><?php echo $row['pr_team_con_2']?></td>
      <td><?php echo $row['pr_team_dob']?></td>
      <td><?php echo $row['pr_team_doj']?></td>

      <td class="operations">
        <a href="team_update.php?id=<?php echo $id; ?>" class="edit-button">Edit</a>
        <a href="team_delete.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure?')" class="delete-button">Delete</a>
      </td>
    </tr>

    <?php 
        }
      }
    ?>
  </table>
  
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
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

<script>
    

    $(document).ready(function(){

     
              $("#confirm_password").keyup(function(){
                 if ($("#password").val() != $("#confirm_password").val()) {
                     $("#msg").html("Passwords do not match").css("color","red");
                 }

                 if ($("#password").val() == $("#confirm_password").val()) {
                     $("#msg").html("Password matched").css({"color": "green", "font-weight": "bold"});
                 }

                 if($("#confirm_password").val() == ''){
                     $("#msg").html("").css("color","blue");

                 }  
                 


                }); 

                    // AJAX form submission
            $('#registration_form').submit(function(e){
                // e.preventDefault(); // prevent default form submission
                var password = $("#password").val();
                var confirm_password = $("#confirm_password").val();
                if (password != confirm_password) {
                    alert("Passwords do not match");
                    window.location.href = 'team_insert.php';
                     // exit submission if passwords don't match
                }
                
                // Log serialized form data
              console.log("Serialized form data:", $('#registration_form').serialize());
              
              
            });

            $.ajax({
                  type: 'POST',
                  url: '<?php echo $_SERVER["PHP_SELF"]; ?>', // Submit to the same PHP script
                  data: $('#registration_form').serialize(), // Serialize form data
                  success: function(response){
                      
                          // window.location.href = 'team_insert.php';
                      
                  },
                  error: function(xhr, status, error) {
                      console.error(xhr.responseText);
                  }
              });

                
    });

               


     
   </script>


  </body>
</html>




