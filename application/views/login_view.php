<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">    
    
    <title>FAQ</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
    
</head>
    <body>
        <div class="container">

            <div class="col-md-6">
                    <!--<form action="<?php echo base_url(); ?>login/process" method="post">

                            <input type="hidden" name="act" value="login" />
                            <div><div class="frmlbl">User ID: </div>
                            <input name="username" type="text" id="username" /></div><br />
                            <div><div class="frmlbl">Password: </div>
                            <input name="password" type="password" id="password" /></div><br />
                            <div><div class="frmlbl">&nbsp; </div>
                            <input type="submit" name="Submit" value="Log In" /></div>
                    </form> -->
            <form class="form-signin" action="<?php echo base_url(); ?>login/process" method="post">
                <div class="col-md-9"><h2 class="form-signin-heading">sign in</h2></div>
                 <div class="col-md-9">
                <input type="text" class="form-control" placeholder="Email address" required autofocus>
                 </div>
                 <div class="col-md-9">
                <input type="password" class="form-control" placeholder="Password" required>                
                 </div>
                 <div class="col-md-9">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                 </div>
            </form>
            </div>      
            </div>
    </body>   
</html>