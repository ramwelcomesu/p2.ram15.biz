<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        echo "users_controller construct called<br><br>";
    } 

    public function index() {
        echo "This is the index page";
    }

       

    public function signup() {
        # Setup view
        $this->template->content = View::instance('v_users_signup');
        $this->template->title   = "Sign Up";

        # Render template
        echo $this->template;
    }

    public function p_signup() {
        # Dump out the results of POST to see what the form submitted
        //echo '<pre>';
        //print_r($_POST);
        //echo '</pre>';   

        # More data we want stored with the user
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

        # Encrypt the password  
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);            

        # Create an encrypted token via their email address and a random string
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 

        # Insert this user into the database
        $user_id = DB::instance(DB_NAME)->insert('users', $_POST);

        # For now, just confirm they've signed up - 
        # You should eventually make a proper View for this
        echo 'You\'re signed up';  
    }
   


    public function login() {

        # Setup view
        $this->template->content = View::instance('v_users_login');
        $this->template->title   = "Login";

        # Render template
        echo $this->template;

    }



    public function p_login() {

        # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Hash submitted password so we can compare it against one in the db
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Search the db for this email and password
        # Retrieve the token if it's available
        $q = "SELECT token 
            FROM users 
            WHERE email = '".$_POST['email']."' 
            AND password = '".$_POST['password']."'";

        $token = DB::instance(DB_NAME)->select_field($q);

        # If we didn't find a matching token in the database, it means login failed
        if(!$token) {

            # Send them back to the login page
            Router::redirect("/users/login/");

        # But if we did, login succeeded! 
        } else {

            /* 
            Store this token in a cookie using setcookie()
            Important Note: *Nothing* else can echo to the page before setcookie is called
            Not even one single white space.
            param 1 = name of the cookie
            param 2 = the value of the cookie
            param 3 = when to expire
            param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
            */
            setcookie("token", $token, strtotime('+1 year'), '/');

            # Send them to the main page - or whever you want them to go
            Router::redirect("/users/profile/");

        }
    }





    public function logout() {
        echo "This is the logout page";
    }

    //public function profile($user_name = NULL) {


      /* # Create a new View instance
        $view = View::instance('v_users_profile');

        # Pass information to the view instance
        $view->user_name = $user_name;

        # Render View
        echo $view;
        */
   
      /*  if($user_name == NULL) {
            echo "No user specified";
        }
        else {
            echo "This is the profile for ".$user_name;
        } */
    //}

        public function profile() {

            # If user is blank, they're not logged in; redirect them to the login page
            if(!$this->user) {
                Router::redirect('/users/login');
            }

            # If they weren't redirected away, continue:

            # Setup view
            $this->template->content = View::instance('v_users_profile');
            $this->template->title   = "Profile of".$this->user->first_name;

            # Render template
         //   echo $this->template;
        }



    public function db_test(){
        # Our SQL command
        $q = "INSERT INTO users SET 
        first_name = 'Sam', 
        last_name = 'Seaborn',
        email = 'seaborn@whitehouse.gov'";
        echo $q;

        # Run the command
        echo DB::instance(DB_NAME)->query($q);

    }

} # end of the class
