<?php

/**
 * 
 * Template Name: Custom Login Page
 */

global $user_ID;
global $wpdb;

if (!$user_ID) {
    // user in logged out state
    if ($_POST) {
        $username =  $_POST['username'];
        $password =  $_POST['password'];

        $login_array = array();
        $login_array['user_login'] = $username;
        $login_array['user_password'] = $password;
        
        

        $verify_user = wp_signon($login_array, true);
        if (!is_wp_error($verify_user)) {
            
            
            echo "<script>window.location='" . site_url() . "'</script>";
            
        } else {

            echo $verify_user->get_error_message();
        }
    } else {
        get_header();
     ?>
    <div class="wrapper">
        <div class="section-2">
            <svg class="anime_item rectangle anime" viewBox="0 0 129.33 129.33" data-color="secondary">
                <rect x="7.5" y="7.5" width="114.33" height="114.33" />
            </svg>
            <svg class="anime_item round anime" viewBox="0 0 100 100" data-color="light">
                <circle r="25" cx="50" cy="50"></circle>
            </svg>
            <svg class="anime_item triangle anime" viewBox="0 0 137.4 121.82" data-color="info">
                <polygon points="12.84 114.32 68.7 15.27 124.56 114.32 12.84 114.32" />
            </svg>
            <svg class="anime_item plus rotate" viewBox="0 0 7.06 7.06" data-color="warning">
                <path d="M2.16,4.58a1,1,0,0,1-.59-1.35h0a1,1,0,0,1,1.35-.6l5,1.94a1,1,0,0,1,.59,1.35h0a1,1,0,0,1-1.35.59Z" transform="translate(-1.5 -1.04)" />
                <path d="M3.09,6.68A1,1,0,0,0,3.69,8h0A1,1,0,0,0,5,7.44L7,2.46a1,1,0,0,0-.6-1.35h0A1,1,0,0,0,5,1.71Z" transform="translate(-1.5 -1.04)" />
            </svg>


            <div class="container">

                <div class="row items data-cols-3-4">
                    <div class="col-md-12 col-sm-12 p-3">
                        <div class="card">
                            <h2 class="text-center">Login</h2>
                            <!-- <img class="card-img-top" src="http://amazon.test/wp-content/themes/aquila/src/assets/image/design.jpg" alt="Card image cap"> -->
                            <div class="card-body" data-aos="fade-up">
                                <form method="post">
                                    <div class="form-group">
                                        <label for="username">Username / Email</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username/Email" />
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" />
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="btn_submit">Log In </button>
                                    </div>

                                </form>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>



    </div>
<?php
    }
} else {

    wp_redirect(site_url());

?>



<?php
}

get_footer('other');

?>