<?php
/* Template Name: Custom Registration
*/
get_header();
global $wp;
global $wpdb;

if ($_POST) {
    $username = $wpdb->prepare($_POST['username']);
    $email = $wpdb->prepare($_POST['email']);
    $password = $wpdb->prepare($_POST['password']);
    $confirmpassword = $wpdb->prepare($_POST['confirmpassword']);
    $phonenumber = $wpdb->prepare($_POST['phonenumber']);

    $error = array();
    if (strpos($username, ' ') !== FALSE) {
        $error['username_space'] = "Username has Space";
    }

    if (empty($username)) {
        $error['username_empty'] = "Needed Username must";
    }

    if (username_exists($username)) {
        $error['username_exists'] = "Username already exists";
    }

    if (!is_email($email)) {
        $error['email_valid'] = "Email has no valid value";
    }

    if (email_exists($email)) {
        $error['email_existence'] = "Email already exists";
    }

    if (strcmp($password, $confirmpassword) !== 0) {
        $error['password'] = "Password didn't match";
    }

    if (count($error) == 0) {

        wp_create_user($username, $password, $email);
        echo "User Created Successfully";
        exit();
    }

}

?>
<div class="container" id="signupformid" style="padding-top:2%">
    <div class="row">        

        <div class="col-sm">

            <div class="card">
                <h5 class="card-header text-center"><?php 
                $nval = (explode("/", site_url($wp->request)));
                print_r(ucwords(end($nval))); ?></h5>
                <div class="card-body">
                <?php if($error){ ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> <?php 
                        if($error){
                            foreach($error as $key => $element) {
                                echo $key . ": " . $element . "<br>";
                            };
                        }
                        
                        ?>
                </div>
                    <?php } ?>
                
                    <!-- <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                    <form method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="username">username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="confirmpassword">Confirm Password</label>
                                <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Re-enter Password">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="phonenumber">Phonenumber</label>
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber">
                            </div>
                        </div>
                
                        <button type="submit" class="btn btn-primary">Sign Up</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>


<?php
get_footer('other');
?>