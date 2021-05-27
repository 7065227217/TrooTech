<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url();?>assets/admin/images/favicon.png">
    <title>Admin</title>
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/css/et-line-font/et-line-font.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/css/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/css/simple-lineicon/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/plugins/datatables/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/plugins/formwizard/jquery-steps.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/plugins/dropify/dropify.min.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/plugins/chartist-js/chartist.min.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/plugins/chartist-js/chartist-plugin-tooltip.css"> 
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/css/font/stylesheet.css"> 
    <style type="text/css">
        .eyepassword .fa-eye-slash{
            position: absolute;
            top: 11px;
            right: 15px;
            font-size: 17px;
            color: gray;
        }
        .eyepassword .fa-eye {
            position: absolute;
            top: 11px;
            bottom: 40px;
            right: 15px;
            font-size: 17px;
            color: gray;
        }

        .errorPrint{
            font-size: 12px;
            color: #af2000 !important;
            padding: 5px 5px;
            display: none;
        }
        .errorPrint2{
            font-size: 12px;
            color: #af2000 !important;
            padding: 5px 5px;
        }
    </style>
</head>

<body class="login-page sty1">

    <div class="container-fluid  wl-login">
    <div class="container">
        <div class="login-box"> 
         <div class="form-section">
            
            <h3>Hi, TrooTech!!</h3>
            <p>Login to Admin Panel</p>
            <form method="post" id="regForm">
              <div class="form-group">  
                <input type="email" id="email" class="form-control" name="email" placeholder="Email" onkeypress="submissionAction(this,'button');">
                <p class="errorPrint" id="emailError"></p>
              </div>
              <div class="form-group eyepassword"> 
                <input type="password" id="password" class="form-control" name="password" data-warning="errorWarning2" placeholder="Password" onkeypress="submissionAction(this,'button');">
                <a href="#"><i class="eyepassword fa fa-eye-slash" onclick="showPassword(this)"></i></a>
                <p class="errorPrint" id="passwordError"></p>
                <?=$this->session->flashdata('response');?>
                <div class="text-danger" style="display:none;cursor: pointer;text-align: left;" id="errorWarning2"><span id="errorMsg2"></span></div>
              </div>
              <button type="button" id="button" class="btn btn-primary mybtns-send "  onclick="login(this)">Sign In</button>
            </form>
   </div>
   </div>
 </div> 
 </div> 
    <script src="<?php echo site_url('assets/admin/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/js/bizadmin.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/jquery-sparklines/jquery.sparkline.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/jquery-sparklines/sparkline-int.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/raphael/raphael-min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/morris/morris.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/functions/dashboard1.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/js/demo.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/formwizard/jquery-steps.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/dropify/dropify.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/chartjs/chart.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/chartjs/chart-int.js'); ?>"></script> 
</body>

</html>
<script type="text/javascript">
    function submissionAction(o,f){
        if (event.keyCode === 13) {
            event.preventDefault();
            $("#"+f).click();
        }
    }
    function login(o){
       $(".errorPrint").css('display', 'none');
       $(".errorPrint2").css('display', 'none');
        var idValidate = false;
        $(".form-control").each(function (index, value) {
            if ($(this).val()) {
                $("#" + $(this).attr('id') + 'Error').css('display', 'none');
            } else {
                idValidate = true;
                $("#" + $(this).attr('id') + 'Error').empty();
                $("#" + $(this).attr('id') + 'Error').append('*' + $(this).attr('placeholder') + ' is required field');
                $("#" + $(this).attr('id') + 'Error').css('display', 'block');
            }
        });
        if (idValidate) {
            return false;
        } else {
            $("#regForm").submit();
        }
    }
    
    function showPassword(obj) {
        var type = $("#password").attr('type');
        if (type == 'text') {
            $("#password").attr('type', 'password');
            $(obj).removeClass('fa-eye');
            $(obj).addClass('fa-eye-slash');
        } else {
            $("#password").attr('type', 'text');
            $(obj).removeClass('fa-eye-slash');
            $(obj).addClass('fa-eye');
        }
    }
      
</script>  