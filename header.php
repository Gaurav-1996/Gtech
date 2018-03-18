<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
		<meta name="author" content="Coderthemes">
        
		<link rel="shortcut icon" href="assets/images/favicon_1.ico">

		<title>e-DUMP</title>
		
		<!-- Plugin Css-->

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
        <style>
		select:focus{
    min-width:158px;
    color:yellow;
}   
            input[type=text],input[type=date],input[type=number], input[type=submit],select, textarea {
			  -webkit-transition: all 0.30s ease-in-out;
			  -moz-transition: all 0.30s ease-in-out;
			  -ms-transition: all 0.30s ease-in-out;
			  -o-transition: all 0.30s ease-in-out;
			  outline: none;
			  padding: 3px 0px 3px 3px;
			  margin: 5px 1px 3px 0px;
			  border: 1px solid #DDDDDD;
}
 input[type=button]:focus{
 color:blue;
 }
input[type=text]:focus,input[type=date]:focus,input[type=number]:focus,input[type=submit]:focus,select:focus, textarea:focus ,option:focus{
  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
  padding: 3px 0px 3px 3px;
  margin: 5px 1px 3px 0px;
  border: 1px solid rgba(81, 203, 238, 1);
  background-color:#FCFFC6;
  
}
select:active, select:hover {
  outline-color: red
}
        </style>
	</head>

	<body class="fixed-left">

		<!-- Begin page -->
		<div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="index.html" class="logo"><i class="icon-shield icon-flip-vertical"></i><span>e-DUMP</span></a>
                        <!-- Image Logo here -->
                        <!--<a href="index.html" class="logo">-->
                            <!--<i class="icon-c-logo"> <img src="assets/images/logo_sm.png" height="42"/> </i>-->
                            <!--<span><img src="assets/images/logo_light.png" height="20"/></span>-->
                        <!--</a>-->
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>
							 <ul class="nav navbar-nav navbar-right pull-right">
                               
                               
                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="assets/images/users/avatar.jpg" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                     
                                       
                                        <li><a href="logout.php"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>

                           

                           </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
				
            </div>
            <!-- Top Bar End -->