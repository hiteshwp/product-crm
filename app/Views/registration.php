<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title><?php echo SITE_TITLE; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.ico"); ?>">
        <!-- Bootstrap Css -->
        <link href="<?php echo base_url("assets/libs/alertifyjs/build/css/alertify.min.css"); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo base_url("assets/css/icons.min.css"); ?>" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo base_url("assets/css/app.min.css"); ?>" id="app-style" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url("assets/css/custom.css"); ?>" id="app-style" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
    <!-- <body data-layout="horizontal"> -->
    <div class="authentication-bg min-vh-100">
        <div class="bg-overlay bg-light"></div>
        <div class="container">
            <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="mb-4 pb-2">
                            <a href="javascript:void(0);" class="d-block auth-logo">
                                <img src="<?php echo base_url("assets/images/logo-dark.png"); ?>" alt="" height="30" class="auth-logo-dark me-start">
                                <img src="<?php echo base_url("assets/images/logo-light.png"); ?>" alt="" height="30" class="auth-logo-light me-start">
                            </a>
                        </div>
                        <div class="card" id="registrationcard">
                            <div class="card-body p-4"> 
                                <div class="text-center mt-2">
                                    <h5>Register New Company</h5>
                                    <p class="text-muted">Get your free webadmin account now.</p>
                                </div>
                                <div class="p-2 mt-4" id="registrationformwrapper">
                                    <form action="<?php echo base_url(); ?>company-registration" method="post" id="registrationform">
                                        <?php echo csrf_field(); ?>
                                        <div class="mb-3">
                                            <label class="form-label" for="username">Company Name</label>
                                            <div class="position-relative input-custom-icon">
                                                <input type="text" class="form-control" name="txtcompanyname" id="txtcompanyname" placeholder="Enter company name" required>
                                                 <span class="bx bx-home-alt"></span>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="username">Owner Name</label>
                                            <div class="position-relative input-custom-icon">
                                                <input type="text" class="form-control" name="txtownername" id="txtownername" placeholder="Enter owner name" required>
                                                 <span class="bx bx-user"></span>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="useremail">Email</label>
                                            <div class="position-relative input-custom-icon">
                                                <input type="email" class="form-control" name="txtemailaddress" id="txtemailaddress" placeholder="Enter email" required>  
                                                <span class="bx bx-mail-send"></span>
                                            </div>     
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup input-custom-icon">
                                                <span class="bx bx-lock-alt"></span>
                                                <input type="password" class="form-control" id="password-input" name="txtpassword" placeholder="Enter password" required>
                                                <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                                    <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                </button>
                                            </div>
                                        </div>                                
                                        <div class="mt-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit" id="btnregistration">Register</button>
                                            <input type="hidden" name="action" value="act_new_company_registratopm">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>                        
                    </div><!-- end col -->
                </div><!-- end row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center p-4">
                            <p>© <script>document.write(new Date().getFullYear())</script> <?php echo SITE_TITLE; ?>. Designed & Developed By Hitesh Prajapati</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end container -->
    </div>
    <!-- end authentication section -->
        <!-- JAVASCRIPT -->
        <script src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/libs/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/libs/metismenujs/metismenujs.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/libs/simplebar/simplebar.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/libs/eva-icons/eva.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/js/pages/pass-addon.init.js"); ?>"></script>
        <script src="<?php echo base_url("assets/libs/alertifyjs/build/alertify.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/js/pages/notification.init.js"); ?>"></script>
        <script src="<?php echo base_url("assets/js/parsley.js"); ?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#registrationform').parsley();
                alertify.set('notifier','position', 'top-right');
                $("body").on('submit', '#registrationform', function(event) {
                    event.preventDefault();
                    let redirectUrl = "<?php echo base_url(); ?>";

                    if($('#registrationform').parsley().isValid())
                    {
                        $.ajax({  
                            type:"POST",  
                            url:"<?php echo base_url("company-registration"); ?>",  
                            dataType: "json",
                            data: jQuery('#registrationform').serialize(), 
                            beforeSend: function(data){  
                                $('#btnregistration').attr('disabled',true);
                                $('#btnregistration').text('Please wait..');
                            },
                            success:function(data){  
                                $('#btnregistration').attr('disabled',false);
                                $('#btnregistration').text('Please wait..');
                                console.log(data);
                                if( data.status == "Success" )
                                {
                                    alertify.success(data.msg);
                                    setTimeout(function() {
                                        window.location = redirectUrl;
                                    }, 2000);
                                }
                                else
                                {
                                    alertify.error(data.msg)
                                }
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>