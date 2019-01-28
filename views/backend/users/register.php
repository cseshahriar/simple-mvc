<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../assets/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../assets/css/AdminLTE.min.css"> 
  <!-- iCheck -->
  <link rel="stylesheet" href="../../assets/css/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font --> 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p> 
    <form action="/user/register" method="post">    
          <div class="form-group">
          <label for="name">Name <span class="text-danger">*</span></label> 
          <input type="text" name="name" class="form-control <?php echo (!empty($data['name_error'])) ? 'is-invalid' : ''; ?>" placeholder="Name" value="<?= $data['name'] ?>"> 
           <small class="invalid-feedback"><?= $data['name_error'] ?></small>  
          </div>

          <div class="form-group"> 
            <label for="email">Email address <span class="text-danger">*</span></label>
            <input type="text" name="email" class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" placeholder="Email" value="<?= $data['email'] ?>"> 
            <small class="invalid-feedback"><?= $data['email_error'] ?></small>  
          </div>

          <div class="form-group">
            <label for="password">Password <span class="text-danger">*</span></label>
             <input type="password" name="password" class="form-control <?php echo (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>" placeholder="Password" value="<?= $data['password'] ?>"> 
            <small class="invalid-feedback"><?= $data['password_error'] ?></small>  
          </div>

          <div class="form-group">
            <label for="password">Confirm Password <span class="text-danger">*</span></label>
            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : ''; ?>" placeholder="Confirm Pasword" value="<?= $data['confirm_password'] ?>">  
            <small class="invalid-feedback"><?= $data['confirm_password_error'] ?></small> 
          </div> 
          <div class="row"> 
            <div class="col">
            <button type="submit" class="btn btn-success btn-block">Register</button>  
            </div>
          </div> 
      </form>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="../../../assets/js/jquery-3.3.1.slim.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../../assets/js/popper.min.js"></script>
<script src="../../../assets/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../../assets/js/icheck.min.js"></script> 
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
