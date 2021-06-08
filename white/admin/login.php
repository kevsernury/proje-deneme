<?php

require("db/dbConnect.php");
session_start();
 if( isset($_SESSION['username'])){
    header("Location: index.php");
    exit;
}



if(isset($_POST['username']) && isset($_POST['password'])  ){
    require('db/dbConnect.php');
    $q = $db->prepare("SELECT * FROM users WHERE username=:user AND password=:pass");
    $q->execute(array(
        'user'=> $_POST['username'],
        'pass'=>$_POST['password']
    ));

   
    $ctl= $q->rowCount();
    if($ctl){
        $user=$q->fetch();
        session_start();
        $_SESSION['username'] = $user['username'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['surname'] = $user['surname'];
        header("Location: index.php");
        exit;
    }else{

        header("Location: login.php?msg=2");
        exit;
    }

   
 
}

?>

<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Page Title - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Giriş</h3></div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                                <div class="form-group">
                                                    
                                                    <?php   
                                                    if(isset($_GET['msg'])){

                                                        if($_GET['msg']==1){
                                                            echo "<h6 style='color:red'> <b> GİRİŞ YAPINIZ! </b> </h6>";
                                                        }
                                                        elseif($_GET['msg']==2){
                                                            echo "<h6 style='color:red'> <b> Kullanıcı Adı Veya Şifre Hatalı! </b> </h6>";
                                                        }

                                                    }?>         
                                                
                                                    <label class="small mb-1" for="inputEmailAddress">Kullanıcı Adınız : </label>
                                                    <input class="form-control py-4" name="username" id="inputEmailAddress" type="text" placeholder="Kullanıcı Adınız" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputPassword">Şifreniz : </label>
                                                    <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Şifreniz" />
                                                </div>
                                                <div class="form-group">
                                        
                                                </div>
                                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                
                                                    <button class="btn btn-primary">Giriş</button>
                                                </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.html">Kayıt Ol!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
