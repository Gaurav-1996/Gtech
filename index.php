<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>e-DUMP</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.css" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script>
       /* function validate(){
         
            var user=document.getElementById('username').value;
            var pass=document.getElementById('password').value;
            alert(user);
            alert(pass)
            if(user != '' || pass != ''){
                alert("Both username and password is required!")
                return false;
            }
       
           return true;
        }*/
        </script>
        
    </head>
    <body>
        <?php
        require 'dbconnection.php';
        if(isset($_POST['submit'])){
			@session_start();
            $username=$_POST['username'];
            $pass=$_POST['password'];
            $query="SELECT * from login_details where Id=".$username." and Password='".$pass."'";
            $run=mysqli_query($connect,$query) or mysqli_error($connect);
            if(mysqli_num_rows($run) > 0){
                $row=mysqli_fetch_assoc($run);
                $_SESSION['role']=$row['Role'];
				//echo $_SESSION['role'];
				
                $_SESSION['userid']=$row['Id'];
                 $_SESSION['userid'];
				 $_SESSION['department']=$row['department'];
                header("Location: dash.php");
            }
            else{
                ?>
                <script>swal(
                  'Something Went Wrong!',
                  'Invalid Credentials!',
                  'danger'
                );</script>
                <?php
               
            }
        }
        ?>
        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
        	<div class=" card-box">
            <div class="panel-heading"> 
                <h3 class="text-center"> Sign In to <strong class="text-custom">e-DUMP</strong> </h3>
            </div> 


            <div class="panel-body">
            <form class="form-horizontal m-t-20" method="POST" action="index.php" onsubmit="return validate();">
                
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" name="username" id="username" placeholder="Username" required="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password"  name="password" id="password" placeholder="Password" required="">
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup">
                                Remember me
                            </label>
                        </div>
                        
                    </div>
                </div>
                
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-lg btn-block text-uppercase waves-effect waves-light" name="submit" type="submit" >Log In</button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a href="page-recoverpw.html" class="text-dark"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                    </div>
                </div>
            </form> 
            
            </div>   
            </div>                              
               
            
        </div>
        
        

        
    	<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>


        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
	
	</body>
</html>