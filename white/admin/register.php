<?php
    require('dependencies/head.php');
    require('dependencies/layoutSidenav.php');
    require('db/dbConnect.php');

if( isset($_POST['name']) ){
    
    $password =  $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $username =  $_POST['username'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];

    // Girilen Şifreler Doğrumu? start
    if( $password !=$confirmPassword ){
        header("Location: register.php?msg=1");
        exit;
    }
    // Girilen Şifreler Doğrumu? end
    //Böyle bir kullanıcı varmı? start
    $q = $db->prepare("SELECT * FROM users WHERE username=:userName");
    $q->execute(array( 
        "userName" => $username
    ));
    $ctl= $q->rowCount();
    if($ctl){
        header("Location: register.php?msg=2");
        exit;
    }
    //Böyle bir kullanıcı varmı? end
    //Kullanıcı Kayıt Start
    $q= $db->prepare("INSERT INTO users SET 
                        username=:UserName, name=:Name ,surname=:Surname,  password=:Password");
    $insert = $q->execute(array(
        "UserName"=>$username,
        "Name"=>$name,
        "Surname"=>$surname,
        "Password"=>$password
    ));

    if($insert){
        header("Location: register.php?msg=3");
        exit;
    }else{
        header("Location: register.php?msg=4");
        exit;
    }
    //Kullanıcı Kayıt End



}
?>   
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Kullanıcı Oluştur</h3></div>
                        <div class="card-body">
                            <form action="register.php" method="POST" >
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputFirstName">Adı:</label>
                                            <input class="form-control py-4" name="name" id="inputFirstName" type="text" placeholder="Kullanıcı Adı" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputLastName">Soyadı:</label>
                                            <input class="form-control py-4" name="surname" id="inputLastName" type="text" placeholder="Kullanıcı soyadı"  required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="username">Kullanıcı adı</label>
                                    <input class="form-control py-4"  name="username"  id="username"  type="text" aria-describedby="emailHelp" placeholder="Kullanıcı adı" required />
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Şifre:</label>
                                            <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Şifre" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputConfirmPassword">Şifre Kontrol</label>
                                            <input class="form-control py-4" name="confirmPassword" id="inputConfirmPassword" type="password" placeholder="Şifre Kontrol"  required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" >Kullanıcı Oluştur</button></div>
                                <?php   
                                                    if(isset($_GET['msg'])){

                                                        if($_GET['msg']==1){
                                                            echo "<h6 style='color:red'> <b> Girilen Şifreler Eşleşmiyor </b> </h6>";
                                                        }elseif($_GET['msg']==2){
                                                            echo "<h6 style='color:red'> <b> Zaten Böyle Bİr Kullanıcı Var! </b> </h6>";

                                                        }elseif($_GET['msg']==3){
                                                            echo "<h6 style='color:blue'> <b> Kayıt Başarılı! </b> </h6>";

                                                        }elseif($_GET['msg']==4){
                                                            echo "<h6 style='color:red'> <b> Kayıt Başarısız! </b> </h6>";

                                                        }
                                                        

                                                    }?>

                            </form>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </main>


<?php
    require('dependencies/footer.php');
   
?> 