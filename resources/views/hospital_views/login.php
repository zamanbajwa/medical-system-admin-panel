<!DOCTYPE html>
<html lang="en">
    <?php include 'includes/head.php';?>
    <body>
        <section class="signin">
            <div class="container">
                <div class="row">
                    <div class="signinform">
                        <h1>SIGN IN</h1>
                        
                       <form action="<?=url('login')?>" method="post" >

                            <div class="form-group">
                                <?php if ($errors->any()){?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($errors->all() as $error) {?>
                                        <li><?php echo $error?></li>
                                   <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                        
                                <input type="text" class="form-control user" name="email"  placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control pass" name="password"  placeholder="Password">
                            </div>
                            <div class="form-check">
                                <input input type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                            </div>
                            <button type="submit" class="signinbutton">SIGN IN</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <script src="<?php echo asset('hospital/js/bootstrap.js')?>"></script>
        <script src="<?php echo asset('hospital/js/custom.js')?>"></script>
    </body>
</html>