<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='icon' href='logo.png'/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="common.css"/>
    <link rel="stylesheet" href="styles/index.css"/>
    <title>SelfTraker</title>
  </head>
  <body>
  <div class="box">
        <div class="form_box">
            <h1 class="form_head">Self Tracker</h1>
            <div class="box_head">
                <div id="signup_tab"  onclick="toggle(true)">Sign Up</div>
                <div id="login_tab" class="active_tab" onclick="toggle(false)">Log In</div>
            </div>
            <div class="box_body">
                <!-- Login Form -->
                <form method="post" id="login" class="form" autocomplete="off">
                    <input id="login_username" class="form_input" type="text" required placeholder="Username">
                        <span class="form_label">Username</span>
                    </input>
                    <input id="login_password" class="form_input" type="password" required placeholder="Password">
                        <span class="form_label">Password</span>
                    </input>
                    <button id="login_btn" class="btn submit_btn">Log In</button>
                    <p id="login_message"></p>
                </form>
                <!-- Signup Form -->
                <form method="post" id="signup" class="nodisplay" autocomplete="off">
                    <input  id="signup_name" class="form_input" type="text" required placeholder="Full Name">
                        <span class="form_label">Full Name</span>
                    </input>
                    <input id="signup_username" class="form_input" type="text" required placeholder="Username">
                        <span class="form_label">Username</span>
                    </input>
                    <input  id="signup_password" class="form_input" type="password" required placeholder="Password">
                        <span class="form_label">Password</span>
                    </input>
                    <button id="signup_btn" class="btn submit_btn">Sign Up</button>
                    <p id="signup_message"></p>
                </form>
            </div>
        </div>
    </div>
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type='text/javascript'>
// To restrict form resubmission
  if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href ); 
   }
</script>
    <script src="scripts/toggle.js"></script>
    <script src="scripts/auth.js"></script>
  </body>
</html>