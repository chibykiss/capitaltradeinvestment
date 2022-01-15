<?php
 require_once 'vendor/autoload.php';
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// use CoinGate\CoinGate;

class topspin{
 public $dbuser,$dbpassword,$dbname,$dbhost,$conn;
    
    function dbcon(){
    
       // $this->dbhost = "us-cdbr-iron-east-02.cleardb.net";
       // $this->dbuser = "b4cf30256d742f";
       // $this->dbpassword ="a94cd51b";
       // $this->dbname = "heroku_4a813fe41df145d";
       // $this->conn = mysqli_connect($this->dbhost,$this->dbuser,$this->dbpassword,$this->dbname);
       // if(!$this->conn){
       //     echo " database connection error ";
       //  }

      $this->dbhost = "localhost";
       $this->dbuser = "root";
       $this->dbpassword = "";
       $this->dbname = "bitinvest";
       $this->conn = mysqli_connect($this->dbhost,$this->dbuser,$this->dbpassword,$this->dbname);
       if(!$this->conn){
           echo " database connection error ";
        }
// 
     // $this->dbhost = "localhost";
     // $this->dbuser = "cryptofo_user";
     // $this->dbpassword ="^?MnE.e(-39W";
     // $this->dbname = "cryptofo_new";
     // $this->conn = mysqli_connect($this->dbhost,$this->dbuser,$this->dbpassword,$this->dbname);
     // if(!$this->conn){
     //     echo " database connection error ";
     // }

    }   
    function signup(){
      // print_r($_POST);
      $ref='';
      if (isset($_POST["signup"])) {
        if (!isset($_GET["id"]) || empty($_GET["id"])) {
          $ref = "cup";
        }else{
          $ref = mysqli_real_escape_string($this->conn, trim($_GET['id'])); 
        }
      $error = array();
      // $ref = "cup";
      $un = mysqli_real_escape_string($this->conn, trim($_POST['username']));  
      $fn = mysqli_real_escape_string($this->conn, trim($_POST['fullname']));  
      // $ln = mysqli_real_escape_string($this->conn, trim($_POST['ln']));  
      $em = mysqli_real_escape_string($this->conn, trim($_POST['em']));
      $ph =  mysqli_real_escape_string($this->conn, trim($_POST['phone']));
      $pass = mysqli_real_escape_string($this->conn, trim($_POST['pass']));
      $conpass = mysqli_real_escape_string($this->conn, trim($_POST['conpass']));
      $pfm = "no";
      $btc = mysqli_real_escape_string($this->conn, trim($_POST["btc"]));
      $ether = "no";
      $lite = "no";
      $sq = "no";
      $sa = "no";
      $c_code = rand(10000,90000);
      $c_code = md5($c_code);
      // $ph = "no";
      $checkq = " SELECT * FROM `customer` WHERE  `u_name` = '$un' ";
      $process4 = mysqli_query($this->conn , $checkq);
      if(mysqli_num_rows($process4) == 1 ) {
          $error[] = "Username has already been taken by another customer";
      }
    //   //   check for phone number
    //   $checkq1 = " SELECT * FROM `customer` WHERE  `phone` = '$ph' ";
    //   $process3 = mysqli_query($this->conn , $checkq1);
    //   if( mysqli_num_rows($process3) == 1 ) {
    //       $error[] = " Phone number already exist ";
    //   }

    //   //check if phone number is numeric

      // if (!is_numeric($ph)) {
      //    $error[] = "Phone number should contain only numbers "; 
      // }

      // check for email
      $checkq2 = " SELECT * FROM `customer` WHERE  `email` = '$em' ";
      $process2 = mysqli_query($this->conn , $checkq2);
      if(mysqli_num_rows($process2) == 1) { 
          $error[] = "Email already exist";
      }

      // check for password
      // $pass = hash('sha256', $pass);
      // $conpass = hash('sha256' , $conpass);
      $checkq2 = " SELECT * FROM `customer` WHERE  `password` = '$pass' ";
      $process = mysqli_query($this->conn , $checkq2);
      if(mysqli_num_rows($process) == 1) { 
          $error[] = "Password already exist";
      }
      // check for referals
    //   if (empty($ref)) {
    //       $ref = "cup";
    //   }else {
    //   $checkq6 = " SELECT * FROM `customer` WHERE  `u_name` = '$ref' ";
    //   $process1 = mysqli_query($this->conn , $checkq6);
    //   if( mysqli_num_rows($process1) == " " ) { 
    //       $error[] = " Referral is invalid,leave blank if you don't have a refferal id  ";
    //       }
    //   }

      if($pass != $conpass) {
          $error[] = "password and confirm password don't match";
      }  

       // check pass
      // $checkq7 = "SELECT * FROM `customer` WHERE  `password` = '$pass'";
      // $process7 = mysqli_query($this->conn , $checkq7);    
      // if(mysqli_num_rows($process7) == 1) {
      //     $error[] = "Password is already taken ";
      // }  

      $hash = "CUS_".rand(1000000,9000000);   
      
      if(empty($error)){
          
      $query =" INSERT INTO `customer` (`f_name`, `customer_hash`,`ref`, `u_name`, `email`, `phone`, `refr_id`,`password`, `btc`, `time`, `confirm_code`) VALUES ('$fn', '$hash','$ref', '$un', '$em', '$ph', 'auto', '$pass', '$btc',NOW(),'$c_code')";
          $process = mysqli_query($this->conn , $query);
          if ($process) {
              
          $sql = mysqli_query($this->conn, "INSERT INTO `refferals` ( `ref`, `user_id`, `ref_date`) VALUES ('$ref', '$un', NOW())");
          if ($sql) {
            // echo '
            // <div class="alert alert-info">
            //     Registered! A confirmation link has been sent to your email <br>
            //     Pls confirm your email before login
            //   <a href="login.php" class="btn btn-default">Back to login </a>
            //  </div>
            // ';
            // exit();
            $email = new \SendGrid\Mail\Mail(); 
            $email->setFrom("info@ctiinvestment.com", " Capitaltrade Investment  ");
            $email->setSubject($fn.'  Account has been created successfully ');
            $email->addTo($em, $fn);
            $email->addContent("text/plain", "
                   Dear valued customer thank you for joining  Capitaltrade Investment  ");
            $email->addContent(
                "text/html",   '
      
                  <!DOCTYPE html>
                  <html>
                  <head>
                    <title>Account confirmation mail</title>
                         <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
                  </head>
                                      
                  <body style="margin: 20px 20px 20px 20px; border: 1px solid #f7923a;  padding: 5px 5px 5px 5px; font-family: "Cabin", sans-serif;">
                    
                    <div style="background: #fff; color: #fff; text-align: center; padding-top: 15px; padding-bottom: 15px;">
                      <img src="/img/logo/fxlogob.png"><h1 style="margin-top: 0px;">  Capitaltrade Investment   </h1>
                    </div>
                  
                    <div style="background:#333; padding: 20px 20px 20px 20px; color: antiquewhite; ">
                     Capitaltrade Investment   was founded at the end of 2016. The founders of our world-class cryptocurrency company got to know each other by using the same platform for buying and selling Bitcoins. As our cryptocurrency investment company and its user base grew.
                  
                      The members cryptocurrency are pumped into different financial disciplines, but our common faith in cryptocurrencies has brought us together. We are all strong believers in the future of digital currencies and we love being part of this growing community!
                    </div>
                    
                    <h3>Welcome  ('.$un.') , </h3>
                    <p style="font-family: sans-serif; font-size: 14px; text-align: justify; height: 100px;"> 
                    Welcome to  Capitaltrade Investment   network where your cryptocurrencies are invested.Thank you for being part of a fast-growing area of the world investment. Invest cryptocurrency and get heavy returns off upto 21% investment.</p>
                    
                    <div style="margin-top: 10px;">
                       <table style="width: 100%; border-collapse: collapse; width: 100%; border: 1px solid #ddd; text-align: left;">
                      <tr style="border: 1px solid #ddd; text-align: left;">
                        <td style="padding: 15px;">Username</td>
                        <td style="padding: 15px;">'.$un.'</td>
                      </tr>
                      <tr style="border: 1px solid #ddd; text-align: left;">
                        <td style="padding: 15px;">Full name</td>
                        <td style="padding: 15px;">'.$fn.'</td>
                      </tr>
                     
                      <tr style="border: 1px solid #ddd; text-align: left;">
                        <td style="padding: 15px;">Email</td>
                        <td style="padding: 15px;">'.$em.'</td>
                      </tr>
                      <tr style="border: 1px solid #ddd; text-align: left;">
                        <td style="padding: 15px;">Mobile number</td>
                        <td style="padding: 15px;">'.$ph.'</td>
                      </tr>
                      <tr style="border: 1px solid #ddd; text-align: left;">
                        <td style="padding: 15px;">Bitcoin Address</td>
                        <td style="padding: 15px;">'.$btc.'</td>
                      </tr>
                      <tr style="border: 1px solid #ddd; text-align: left;">
                        <td style="padding: 15px;">Perfect Money</td>
                        <td style="padding: 15px;">'.$pfm.'</td>
                      </tr>
                      <tr style="border: 1px solid #ddd; text-align: left;">
                        <td style="padding: 15px;">Litecoin Address</td>
                        <td style="padding: 15px;">'.$lite.'</td>
                      </tr>
                      <tr style="border: 1px solid #ddd; text-align: left;">
                        <td style="padding: 15px;">Etherum Address</td>
                        <td style="padding: 15px;">'.$ether.'</td>
                      </tr>
                    </table>
                    </div>
                    <div style="background:#333; padding: 20px 20px 20px 20px; color: antiquewhite;">
                      <p>Dear valued customer Capitaltrade Investment will never ask for your account Id during withdrawal </p>
                      <p style="font-family: sans-serif; font-size: 14px; text-align: justify;">We are a company that strives to stay in the forefront of the Bitcoin industry, we are active in the Bitcoin mining market. As a result, we can offer our numerous clients good investment opportunities. Our continuous use of advanced infrastructure and automated payment processing has enabled us to find ways to offer more to our clients. We offers an investment platform for Bitcoin mining in such a way to prevent any form of loss to our investors. We are a reliable and trustworthy Bitcoin mining company, and our investment past records can show how far we have come as a Bitcoin investment company.</p>
                      <ul>
                        <li> Our offical Email for customer support is <a style="color: #f7923a;" href="mailto:admin@cryptomaxcurrency.com">mailto:admin@rollexcoins.com </a>  </li>
                        <li> login to dashboard: https://ctiinvestment.com </li>
                      </ul>
                    </div>
                    
                  </body>
                  </html>
      
                      '  
            );
            $sendgrid = new \SendGrid('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');
            try {
                 $response = $sendgrid->send($email);
           
                 echo '
              <div class="alert alert-info">
                Registered! A confirmation link has been sent to your email address
                <a href="login" class="btn btn-default"> Back to login </a>
              </div>
              ';
              exit();
            } catch (Exception $e) {
                echo 'Caught exception: '. $e->getMessage() ."\n";
            }
            
            // $dlink= 'https://ctiinvestment.com/incs/confirm_account.php?c_code='.$c_code;
            // $email2 = new \SendGrid\Mail\Mail(); 
            // $email2->setFrom("info@ctiinvestment.com", " Capitaltrade Investment");
            // $email2->setSubject("Email Confirmation");
            // $email2->addTo($em, $fn);
            // $email2->addContent("text/plain", "
            //        Dear valued customer pls click the link below to confirm your account <br>
            //        <a href=".$dlink." target='blank'>click here</a>");

            //  $sendgrid_two = new \SendGrid('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');
            // try {
            //      $response2 = $sendgrid_two->send($email2);
            //   //   $response->statusCode();
            //   //   print_r($response->headers());
            //   //   print $response->body() . "\n";
            //    echo 'email verification success';
            //  exit();
              
            // } catch (Exception $e) {
            //     echo 'Caught exception: '. $e->getMessage() ."\n";
            // }
                  
                
              $this->intrest($ref);
            }
          }else {
              echo mysqli_error($this->conn);
          }
          }else{
          echo '<h6 class="text-center"> Sorry the following error occoured </h6>
                <div class="alert alert-danger alert-dismissible">
                ';
          $id = count($error);
          for($i=0; $i < $id ; $i++){ 
              echo '<strong>Error! </strong>'.$error[$i].'<br>';
          }
          echo '</div>';
              }
          }
        }

      function getreffeduser(){
        $un = $_GET["who"];
        $query1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE `customer_hash` = '$un' ");
        $nu = mysqli_fetch_assoc($query1);
        $ff = $nu["u_name"];
        $query = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE `ref` = '$ff' ");
        $num = 1;
        while ($row = mysqli_fetch_assoc($query)) {
          echo ' 
                  <tr>
                      <td>'.$num.'</td>
                      <td>'.$row["u_name"].'</td>
                      <td>'.$row["f_name"].'</td>
                  </tr>
              ';
              $num++;
        }
      }  

      function manu(){
        $un = $_GET["who"];
        $query = mysqli_query($this->conn , " UPDATE `customer` SET `refr_id` = 'manu' WHERE `customer_hash` = '$un' ");
        if ($query) {
          // header('location : ');
          header("location: users.php");
        }
      }

      function auto(){
        $un = $_GET["who"];
        $query = mysqli_query($this->conn , " UPDATE `customer` SET `refr_id` = 'auto' WHERE `customer_hash` = '$un' ");
        if ($query) {

// UPDATE `customer` SET `refr_id` = 'auto' WHERE `customer_hash` = 'CUS_1247581'
          header("location: users.php");
        }
      }
      function cac(){
          $query = mysqli_query($this->conn , " SELECT * FROM `customer` ");
          $num = mysqli_num_rows($query);
          echo $num + 617;
      }
      
     function dove(){
          $query = mysqli_query($this->conn , " SELECT * FROM `investment` ");
          $num = mysqli_num_rows($query);
          echo $num + 26;
      }

      private  function intrest($ref){
          $query = mysqli_query( $this->conn , " SELECT * FROM `customer` WHERE  `u_name` = '$ref' ");
          //echo "string";
          $amount = 10;
          if($query) {
            //echo "string";
            $row = mysqli_fetch_assoc($query);
            $serial = $row["customer_hash"];
            //echo $serial;
            $query1 = mysqli_query($this->conn , " SELECT * FROM `balance` WHERE `serial` = '$serial' ");
            if($query1) {
            $row1 = mysqli_fetch_assoc($query1);
            $bal =$row1["bal"];
           // echo $bal;  
            $new_bal = $bal + $amount;
            //echo $new_bal; 

            $query3 = mysqli_query($this->conn , " UPDATE `balance` SET `bal` = '$new_bal' WHERE `serial` = '$serial' ");
            }
          }else{
            echo "not";
          }
        }

    function login(){
     //if(isset($_POST["login"])) {
        $un = mysqli_real_escape_string($this->conn, trim($_POST['uname']));
        $pass = mysqli_real_escape_string($this->conn, trim($_POST['password']));
        //echo $un." ".$pass;
        // $pass = hash('sha256', $pass);
        $query = " SELECT * FROM `customer` WHERE `u_name` = '$un' AND `password` = '$pass' ";
        $process = mysqli_query($this->conn , $query);
        if (mysqli_num_rows($process) == 1) {
           $row = mysqli_fetch_assoc($process);
           
           $_SESSION["un"] = $row["u_name"];
           $_SESSION["hash"] = $row["customer_hash"];
           $_SESSION["id"] = $row["customer_id"];
           //header("location: customer");
           echo 200;
           }else{
            echo ' Your username and password don\'t match ';
            }    
       } 
    //}


    function sobologin(){
      if(isset($_POST["sobo"])) {

        $un = mysqli_real_escape_string($this->conn, trim($_POST['username']));
        $pass = mysqli_real_escape_string($this->conn, trim($_POST['password']));
        //echo $un." ".$pass;
        // $pass = hash('sha256', $pass);
        $query = " SELECT * FROM `customer` WHERE `email` = '$un' AND `password` = '$pass' ";
        $process = mysqli_query($this->conn , $query);
        if (mysqli_num_rows($process) == 1) {
             $row = mysqli_fetch_assoc($process);
             $cstatus = $row["confirm_status"];
            // echo $cstatus;
            
           
             if($cstatus == 'no'){
              echo'
              <div class="alert alert-info">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              Pls confirm your account first
           </div>
           ';
              //echo 200;
             //  echo '
             //       <script> 
             //           window.location.assign("customer");
             //       </script>
             //  ';
             }elseif($cstatus == 'yes'){
              $_SESSION["un"] = $row["u_name"];
              $_SESSION["hash"] = $row["customer_hash"];
              $_SESSION["id"] = $row["customer_id"];
              header("location: customer");
            
             }
             else{

             }
             }else{
             echo'
            <div class="alert alert-danger">
            invalid User Credentials
         </div>
         ';
            // echo ' 
            // <script>  
            //         alert("User does not exist");           
            // </script>
            // ';
          }    
       } 
    }
      function adminlogin(){
        if(isset($_POST["adminlogin"])) {
        $un = mysqli_real_escape_string($this->conn, trim($_POST['admin_un']));
        $pass = mysqli_real_escape_string($this->conn, trim($_POST['admin_pass']));
        $query = " SELECT * FROM `admin` WHERE `admin_name` = '$un' AND `admin_pass` = sha1('$pass') ";
        $process = mysqli_query($this->conn , $query);
        if (mysqli_num_rows($process) == 1) {
           $row = mysqli_fetch_assoc($process);
           
           $_SESSION["admin_name"] = $row["admin_name"];
           $_SESSION["admin_id"] = $row["admin_id"];

           
           header("location: dashboard");
              }else{
                  echo '
                  <div class="alert alert-danger">
                  Your username and password don\'t match
                  <div>

                    ';
                      }
                  } 
             }  
    function un(){
       echo $_SESSION["un"];
        }
        
    function create_bal(){
        $id = $_SESSION["hash"];
        $un = $_SESSION["un"];

        $query = " SELECT * FROM `balance` WHERE `serial` = '$id' ";
        $process = mysqli_query($this->conn , $query);
        if (mysqli_num_rows($process) == " ") {
               $query1 = " INSERT INTO `balance` (`bal`, `serial`, `bal_date`) VALUES ('0', '$id', NOW()) ";
               $process1 = mysqli_query($this->conn, $query1);
               if ($process1) {
                   echo ' <div class="alert alert-default card">
                        Dear '.$un.' your account has been created successfully
                   </div> ';
               } 
        }    
     }
    function getbal(){
        $id = $_SESSION["hash"];
        
        $query = " SELECT * FROM `balance` WHERE `serial` = '$id' ";
        $process = mysqli_query($this->conn , $query);
        if ($process) {
            $row = mysqli_fetch_assoc($process);
            $bal =  $row["bal"];
            echo number_format($bal);
            }
        }

        function ethupull(){

            $un = $_SESSION["un"];   
         $process = mysqli_query($this->conn , " SELECT * FROM `paytype` WHERE `pay_name` = 'etherum' ");
         $n = mysqli_fetch_assoc($process);
         $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `u_name` = '$un' ");
                if( $row = mysqli_fetch_assoc($process1)) { 
                echo '
                    <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl='.$n["pay_value"].'&choe=UTF-8" class="img-fluid " />  
                    <ul class="list-group">
                        <li class="list-item">NAME: '.$row["f_name"].' </li>
                        <li class="list-item">EMAIL: '.$row["email"].'</li>
                        <li class="list-item">OPTION: ETHERUM </li>
                      
                        <li class="list-item"> ETHERUM ID:  <input type="text" id="mybtc" style="text-align: center;" class="form-control" readonly="yes" value="'.$n["pay_value"].'" /> <br> <button id="mybt" class="btn btn-info"> Copy</button> </li>
                    </ul>  
                    ';            
                }

        }
        function btccpull(){

            $un = $_SESSION["un"];   
         $process = mysqli_query($this->conn , " SELECT * FROM `paytype` WHERE `pay_name` = 'bitcash' ");
         $n = mysqli_fetch_assoc($process);
         $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `u_name` = '$un' ");
                if( $row = mysqli_fetch_assoc($process1)) { 
                echo '
                                          <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl='.$n["pay_value"].'&choe=UTF-8" class="img-fluid " />  
                                          <ul class="list-group">
                                              <li class="list-item">NAME: '.$row["f_name"].' </li>
                                              <li class="list-item">EMAIL: '.$row["email"].'</li>
                                              <li class="list-item">OPTION: BITCOIN CASH </li>
                                            
                                              <li class="list-item"> ETHERUM ID:  <input type="text" id="mybtc" style="text-align: center;" class="form-control" readonly="yes" value="'.$n["pay_value"].'" /> <br> <button id="mybt" class="btn btn-info"> Copy</button> </li>
                                          </ul>  
                    ';            
                }


        }


          function perpull(){

            $un = $_SESSION["un"];   
         $process = mysqli_query($this->conn , " SELECT * FROM `paytype` WHERE `pay_name` = 'usdt' ");
         $n = mysqli_fetch_assoc($process);
         $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `u_name` = '$un' ");
                if( $row = mysqli_fetch_assoc($process1)) { 
                echo '
                    <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl='.$n["pay_value"].'&choe=UTF-8" class="img-fluid " />  
                    <ul class="list-group">
                        <li class="list-item">NAME: '.$row["f_name"].' </li>
                        <li class="list-item">EMAIL: '.$row["email"].'</li>
                        <li class="list-item">OPTION:  USDT</li>
                        <li class="list-item"> USDT ADDRESS:  <input type="text" id="mybtc" style="text-align: center;" class="form-control" readonly="yes" value="'.$n["pay_value"].'" /> <br> <button id="mybt" class="btn btn-info"> Copy</button> </li>
                    </ul>  
                    ';            
                }


        }

        function btcpull(){
         $un = $_SESSION["un"];   
         $process = mysqli_query($this->conn , " SELECT * FROM `paytype` WHERE `pay_name` = 'btc' ");
         $n = mysqli_fetch_assoc($process);
         $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `u_name` = '$un' ");
                if( $row = mysqli_fetch_assoc($process1)) { 
                echo '
                  <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl='.$n["pay_value"].'&choe=UTF-8" class="img-fluid " />  
                  <ul class="list-group">
                      <li class="list-item">NAME: '.$row["f_name"].' </li>
                      <li class="list-item">EMAIL: '.$row["email"].'</li>
                      <li class="list-item">OPTION: BTC</li>
                      <li class="list-item">Reference ID: '.$row["refr_id"].'</li>
                      <li class="list-item">BTC ID:  <input type="text" id="mybtc" style="text-align: center;" class="form-control" readonly="yes" value="'.$n["pay_value"].'" /> <br> <button id="mybt" class="btn btn-info"> Copy</button> <a href="index.php" class="btn btn-info"> Done</a>  </li>
                  </ul>  
                    ';            
                }
        }

      function funding(){
       
            //  echo "shit";
                $amount = mysqli_real_escape_string($this->conn, trim($_GET['amount'])); 
                $ty = mysqli_real_escape_string($this->conn, trim($_GET['type'])); 

                if ($ty == "btc"){
                    echo 'payingbtc.php';
                }
                if ($ty == "etherum") {
                    echo 'payetherum.php';
                }
                if($ty == "bitcash"){
                   // header("location : ");
                    echo 'paybtcash.php';
                }
                 if($ty == "cc"){
                    //header("location : paybtcc.php");
                    echo 'paybtcc.php';
                }

                if($ty == "usdt"){
                   // header("location : paypal.php");
                    echo 'perfect.php';
                }
                 $who = $_SESSION["hash"];
                 $token = MD5(rand(100000,999999));
                $query = "INSERT INTO `deposite` (`who`, `token`, `oid`, `status`, `amount`, `time`) VALUES ( '$who', '$token', '$ty', 'no', '$amount', NOW())";
                  $process = mysqli_query($this->conn , $query);
                  if (!$process) {
                    echo mysqli_error($this->conn);
                  }

               // echo $amount;
                //         \CoinGate\CoinGate::config(array(
                //     'environment'               => 'live', // sandbox OR live
                //     'auth_token'                => 'dPEiN99LzqCoE3teKMyLuz4VQhU6W5UsTKx6NLvy',
                //     'curlopt_ssl_verifypeer'    => TRUE // default is false
                // ));




                // $post_params = array(
                //                 'order_id'          => rand(10000,99999),
                //                 'price_amount'      =>  $amount,
                //                 'price_currency'    => 'USD',
                //                 'receive_currency'  => 'USD',
                //                 'callback_url'      => 'http://mainstreaminvestment.com/customer/deposite_log.php',
                //                 'cancel_url'        => 'http://mainstreaminvestment.com/customer/deposite_log.php',
                //                 'success_url'       => 'http://mainstreaminvestment.com/customer/deposite_log.php',
                //                 'title'             => 'Mainstream investment fund'
                //             );

                // $orders = \CoinGate\Merchant\Order::create($post_params);

                // if ($orders) {
                //  //   echo $orders->status;
                //    $time = $orders->created_at;
                //    $token = $orders->token;
                //    $sid = $orders->id;
                //    $url = $orders->payment_url;
                //    $who = $_SESSION["hash"];
                //    $aa = $orders->price_amount;
                   
                //    $query = "INSERT INTO `deposite` (`who`, `token`, `oid`, `amount`, `dep_time`) VALUES ( '$who', '$token', '$sid', '$aa', '$time')";
                //     $process = mysqli_query($this->conn , $query);
                //    if ($process) {
                //        echo $url;
                //    }
                //     // print_r($orders);
                // } else {
                //     # Order Is Not Valid 141908
                // }   
           } 
        function deposite_log(){
            $id = $_SESSION["hash"];
            $query = " SELECT * FROM `deposite` WHERE `who` = '$id' ";
            $process = mysqli_query($this->conn , $query);
            $num = 1;
            while ($row = mysqli_fetch_assoc($process)) {
              echo '
                    <tr>
                        <td>'.$num.'</td>
                        <td>'.$row["amount"].'</td>
                        <td>'.$row["token"].'</td>
                        <td>'.$row["status"].'</td>
                        <td>'.$row["time"].'</td>
                    </tr>
                ';
            $num++;
            }

        }  

       function withdrawal_log(){
            $id = $_SESSION["hash"];
           // echo $id;
            $query = " SELECT * FROM `withdrawal` WHERE `who` = '$id' ORDER BY `withdrawal`.`with_date` DESC ";
            $process = mysqli_query($this->conn , $query);
            if ($process) {
                $num = 1;
                while ($row =  mysqli_fetch_assoc($process)) {
                    echo '
                    
                    <tr>
                         <td>'.$num.'</td>
                         <td>$'.$row["amount"].'</td>  
                         <td>'.$row["with_date"].'</td>
                    </tr>
                     
                    ';
                    $num++;
                }
            }    
       } 

       function load_log(){
            $id = $_SESSION["hash"];
            $query = " SELECT * FROM `deposite` WHERE `who` = '$id' ORDER BY `deposite`.`time` ASC  ";
            $process = mysqli_query($this->conn , $query);
            if ($process) {
                $num = 1;
                while ($row =  mysqli_fetch_assoc($process)) {
                    echo '
                    
                    <tr>
                         <td>'.$num.'</td>
                         <td>$'.$row["amount"].'</td>
                         <td>'.$row["oid"].'</td>
                         <td>'.($row["status"] == "yes" ? 'Paid' : 'Unpaid').'</td>   
                         <td>'.$row["time"].'</td>
                    </tr>
                     
                    ';
                    $num++;
                }
            }    
       }        
       function refferals(){
           $un = $_SESSION["un"];
           $query = " SELECT * FROM `customer` WHERE `ref` = '$un' ";
           $process = mysqli_query($this->conn , $query);
            $num = 1;
           while ($row = mysqli_fetch_assoc($process)) {
               echo '

            <tr>
                   <td>'.$num.'</td>
                   <td>'.$row["time"].'</td>
                   <td>'.$row["f_name"].'</td>
                   <td>'.$row["u_name"].'</td>
                   <td>'.$row["email"].'</td>
                   <td>'.$row["phone"].'</td>
            </tr>

                    ';
                    $num++;
           }
       }

       function totalwith(){
            $id = $_SESSION["hash"];
            $amount  = 0;
            $query = " SELECT * FROM `withdrawal` WHERE `who` = '$id' ";
            $process = mysqli_query($this->conn , $query);
            while ($row = mysqli_fetch_assoc($process)) {
                $amount  = $amount+$row["amount"];
            }
            echo number_format($amount);
       }

       function totaldep(){
            $id = $_SESSION["hash"];
            $amount  = 0;
            $query = " SELECT * FROM `deposite` WHERE `who` = '$id' and `status` = 'yes' ";
            $process = mysqli_query($this->conn , $query);
            while ($row = mysqli_fetch_assoc($process)) {
                $amount  = $amount+$row["amount"];
            }
            echo number_format($amount);
       }
      function starter_invest(){
         $id = $_SESSION["hash"]; 
         $query = " SELECT * FROM `balance` WHERE `serial` = '$id' ";
         $process = mysqli_query($this->conn , $query);
         $row = mysqli_fetch_assoc($process);
         $ban = $row["bal"];
         $plan = mysqli_real_escape_string($this->conn, trim($_GET["plan"]));
         $amount = mysqli_real_escape_string($this->conn, trim($_GET["amount"]));
         $dura = mysqli_real_escape_string($this->conn, trim($_GET["dura"]));
         $pect = mysqli_real_escape_string($this->conn, trim($_GET["pect"]));

         $bal = (int) mysqli_real_escape_string($this->conn, trim($_GET["bal"]));
         $now = time();
         //518400
         //$then = $now + 86400;
         //$newbal = $ban - $amount;
        // echo $bal.' '.$amount.' '.$ban.'<br>';
         //echo $newbal;

         $earn = $amount * ($pect/100);
         $then = $now + $dura;
         $newbal = $ban - $amount;

         // if ($plan == "starter") {
         //     $earn = $amount * 1.2;
         //     $then = $now + 86400;
         //     $newbal = $ban - $amount;
         // }elseif ($plan == "silver") {
         //     $earn = $amount * 1.3;
         //     $then = $now + 172800;
         //     $newbal = $ban - $amount;
         // }elseif ($plan == "gold") {
         //     $earn = $amount * 1.4;
         //     $then = $now + 259200;
         //     $newbal = $ban - $amount;
         // }else {
         //     $earn = $amount * 3.5;
         //     $then = $now + 345600;
         //     $newbal = $ban - $amount;
         // }

         if ( $amount > $ban ) {
             echo 'getfund';         
          // echo $amount." ".$bal;
          exit();

         }else{
             $query1 = " INSERT INTO `investment` ( `plan`,`who`, `prin`, `start_time`, `end_time`, `new_bal`, `time`) VALUES ('$plan','$id','$amount', '$now', '$then','$earn', NOW()) ";
             $process1 = mysqli_query($this->conn , $query1);
             if ($process1) {
                $query2 = " UPDATE `balance` SET `bal` = '$newbal' WHERE `balance`.`serial` = '$id' ";
                $process2  = mysqli_query($this->conn , $query2);
                if ($process2) {
                    echo 'investment_log.php';
                   // header("location: investment_log.php");
                }
             }
         }
      } 
      private function calculator($id){
          $query = " SELECT * FROM `investment` WHERE `invest_id` = '$id' ";
          $process = mysqli_query($this->conn , $query);
          $row = mysqli_fetch_assoc($process);
          $pri = $row["prin"];
          $newbal = $row["new_bal"];
          $start = $row["start_time"];
          $end = $row["end_time"];
          $time = $end - $start;
          $addit = $newbal/$time;
          return $addit;
      }
      function shit(){
        $who = $_SESSION["hash"];
        $query = " SELECT * FROM `investment` WHERE `who` = '$who' ORDER BY `time` DESC ";
        $process = mysqli_query($this->conn , $query);  
        $num = 1;
        $hash = $_SESSION["hash"]; 
        while ( $row = mysqli_fetch_assoc($process)) {
            $voi = $this->remain($row["invest_id"]);
          
            $now = time();
            $end = $row["end_time"];
            $who = $row["who"];
            $newbal = $row["prin"] + $row["new_bal"];
            
            if ($now < $end) {
                $retime =  $end - $now;
                $timer = gmdate("d:H:i:s",$retime);
            }else{
                $timer = "00:00:00:00";
                 $this->final_update($row["invest_id"],$hash,$newbal);
            }
            echo' 

            <tr>
                 <td>'.$num.'</td>
                 <td>'.$row["plan"].'</td>
                 <td>$ '.$row["prin"].'</td>
                 <td> '.$timer.' </td>
                 <td>$ '.$voi.'</td>
                 <td> $ '.$row["new_bal"].' </td>
                 <td> '.($row["confirm"] == "yes" ? "COMPLETE" : "UNCOMPLETED"  ).' </td>
            </tr>

            ';
            $num++;
        }
      }
     private function remain($id){
          $query = " SELECT * FROM `investment` WHERE `invest_id` = '$id' ";
          $process = mysqli_query($this->conn , $query);
          $row = mysqli_fetch_assoc($process);       
          $now = time();
          $end = $row["end_time"];
          $who = $row["who"];
          $newbal = $row["new_bal"];
          if ($now <  $end) {
            $multipler = $this->calculator($id);
            $retime =  $end - $now;
            $total = $newbal - ($retime * $multipler);
            
            $query2 = " UPDATE `investment` SET `realtime` = '$total' WHERE `investment`.`invest_id` = '$id' ";
            $process2 = mysqli_query($this->conn , $query2);
            if ($process2) {
                return $total;
                //" ".$retime/60;
            // echo " <br>";
            //echo gmdate("H:i:s",$retime);
            }
          }else{
            return $newbal;
           }  
      }
      private function final_update($id, $who,$newbal){
         // echo $who;
          $query1 = mysqli_query($this->conn , " SELECT * FROM `investment` WHERE `invest_id` = '$id' AND `confirm` = 'no' ");
          $row = mysqli_fetch_assoc($query1);
          if ( $row["confirm"] == "no") {
           $query3 = mysqli_query($this->conn , " UPDATE `investment` SET `confirm` = 'yes' WHERE `investment`.`invest_id` = '$id' ");
             if ($query3) {
                 $query2 = mysqli_query($this->conn , " SELECT * FROM `balance` WHERE `serial` = '$who' ");
                 $row1 = mysqli_fetch_assoc($query2);
                 $b = $row1["bal"];
                 $new = $b + $newbal;
             $query = mysqli_query($this->conn, "UPDATE `balance` SET `bal` = '$new' WHERE `balance`.`serial` = '$who' ");

            }
        }
      }
      function load_profile(){
        $id = $_SESSION["id"];
        $hash = $_SESSION["hash"];
        $query = " SELECT * FROM `customer` WHERE `customer_id` = '$id' AND `customer_hash` = '$hash' ";
        $process = mysqli_query($this->conn , $query);
        $row = mysqli_fetch_assoc($process);
        echo '

          <div class="form-group">
              <label for="name">USERNAME:</label>
              <input type="text" name="name" class="form-control input-flat" value="'.$row["u_name"].'" id="name" readonly="yes" />
          </div>

          <div class="form-group">
              <label for="name">NAME:</label>
              <input type="text" name="name" class="form-control input-flat" value="'.$row["f_name"].'" id="name" readonly="yes" />
          </div>

          <div class="form-group">
              <label for="phone">PHONE:</label>
              <input type="text" name="ph" class="form-control input-flat" value="'.$row["phone"].'" id="ph" required="yes" />
          </div>

          <div class="form-group">
              <label for="email">EMAIL:</label>
              <input type="email" name="em"  class="form-control input-flat" value="'.$row["email"].'" id="em" required ="yes" />
          </div> 

           <div class="form-group">
              <label for="name">BITCOIN ADDRESS:</label>
              <input type="text" name="btc" class="form-control input-flat" value="'.($row["btc"] == "none" ? ' ' : $row["btc"]).'" id="btc" />
          </div>

          <div class="form-group">
              <label for="phone">PERFECT MONEY:</label>
              <input type="text" name="pfm" class="form-control input-flat" value="'.($row["pfm"] == "none" ? ' ' : $row["pfm"]).'" id="pfm" />
          </div>

          <div class="form-group">
              <label for="email">ETHERUM ADDRESS:</label>
              <input type="text" name="ether"  class="form-control input-flat" value="'.($row["ether"] == "none" ? ' ' : $row["ether"]).'" id="ether" />
          </div> 
          <div class="form-group">
              <label for="email">BITCOIN CASH ADDRESS:</label>
              <input type="text" name="lite"  class="form-control input-flat" value="'.($row["lite"] == "none" ? ' ' : $row["lite"]).'" id="lite" />
          </div> 

            ';
      }
      function uptown(){
        $hash = $_SESSION["hash"];
        $ph = mysqli_real_escape_string($this->conn, trim($_GET['ph']));
        $em = mysqli_real_escape_string($this->conn, trim($_GET['em']));
        
        $btc = mysqli_real_escape_string($this->conn, trim($_GET['btc']));
        $ether = mysqli_real_escape_string($this->conn, trim($_GET['ether']));
        $lite = mysqli_real_escape_string($this->conn, trim($_GET['lite']));
        $pfm = mysqli_real_escape_string($this->conn, trim($_GET['pfm']));
        $query1 = " SELECT * FROM `customer` WHERE `email` = '$em' AND `phone` = '$ph' ";
        $process1 = mysqli_query($this->conn , $query1);
       // if (mysqli_num_rows($process1) == " ") {
             
            $query = " UPDATE `customer` SET `email` = '$em', `phone` = '$ph', `btc` = '$btc', `pfm` = '$pfm', `lite` = '$lite', `ether` = '$ether' WHERE `customer`.`customer_hash` = '$hash'";

            $process = mysqli_query($this->conn , $query);
            if ($process) {
              echo 'good';
              }
       // }else{
         // echo 'bad';
        //}
      }
      function support(){
        $na = mysqli_real_escape_string($this->conn, trim($_GET['na']));
        $em = mysqli_real_escape_string($this->conn, trim($_GET['em']));
        $mess = mysqli_real_escape_string($this->conn, trim($_GET['mess']));
        if (isset($em) && isset($na) && isset($mess)) {
          echo "good";
       }
          //echo $na." ".$em." ".$mess;
      }
      function btcprice(){
        $page = file_get_contents('https://bitpay.com/api/rates');
        $my_array = json_decode($page, true);
       // print_r($my_array);
        $exchange_rate = $my_array[2]["rate"];
        echo number_format($exchange_rate);
        
      }
      function totaldepo(){
        $num = rand(1000000,9000000);
        $query = mysqli_query($this-> conn ," SELECT * FROM `deposite` WHERE `status` = 'yes' ");
        while ($row = mysqli_fetch_assoc($query)) {
          $num = $num + $row["amount"];
        }
        echo number_format($num).'+';
      }
      function totalwithhome(){
        $num = 90000000 + rand(1000000,9000000);
        
        echo number_format($num).'+';
      }

      function debitit(){


        $amount = mysqli_real_escape_string($this->conn, trim($_GET['amount']));
       // $pass = mysqli_real_escape_string($this->conn, trim($_GET['pass']));
        $who =  mysqli_real_escape_string($this->conn, trim($_GET['who']));
        $hash = mysqli_real_escape_string($this->conn, trim($_GET['pass']));

        $query = " SELECT * FROM `customer` WHERE `u_name` = '$who' ";
        $process = mysqli_query($this->conn , $query);
        $n = mysqli_fetch_assoc($process);
        $em = $n["email"];
        if (mysqli_num_rows($process) == " ") {
          echo '<div class="alert alert-danger"> 
                Your password is not correct 
          </div>';
          exit();

        }else{
          $query1 = mysqli_query($this->conn , " SELECT * FROM `balance` WHERE `serial` = '$hash'");
          $row = mysqli_fetch_assoc($query1);
          if ($row["bal"] > $amount) {
            $newbal = $row["bal"] - $amount;
            $query2 = mysqli_query($this->conn," UPDATE `balance` SET `bal` = '$newbal' WHERE `balance`.`serial` ='$hash'");
            if ($query2) {
              $q = " INSERT INTO `withdrawal` (`who`, `amount`, `with_date`) VALUES ('$hash', '$amount', NOW()) ";
              $sql = mysqli_query($this->conn , $q );
              if ($sql) {
                 $page = file_get_contents('https://bitpay.com/api/rates');
                 $my_array = json_decode($page, true);
                // print_r($my_array);
                 $exchange_rate = $my_array[2]["rate"];
                 $num =  $exchange_rate;
                // echo $num;
                 $book =  $amount/$num;
                  $this->ssd($hash,$amount,$btc,$em,$n["u_name"]);
                
                 // $subject = "Customer account withdrawal ";
                        
                 //        $message = '
                
                 //            <!DOCTYPE html>
                 //            <html>
                 //            <head>
                 //              <title>Account confirmation mail</title>
                 //                   <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
                 //            </head>
                                                
                 //            <body style="margin: 20px 20px 20px 20px; border: 1px solid #f7923a;  padding: 5px 5px 5px 5px; font-family: "Cabin", sans-serif;">
                              
                 //              <div style="background: #fff; color: #fff; text-align: center; padding-top: 15px; padding-bottom: 15px;" >
                 //                <img src="https://quickaccessbinary.com/img/logo/logo.jpg"><h1 style="margin-top: 0px;"> Quick Access Binary </h1>
                 //              </div>
                            
                              
                 //              <h3>Welcome('.$n["u_name"].') , </h3>
                 //              <p style="font-family: sans-serif; font-size: 14px; text-align: justify; height: 100px;"> 
                 //              Dear '.$n["f_name"].' '.$n["l_name"].' Your withdrawal request has been successfully processed and should have reflected in your account by now. Enjoy your earnings and let our bonding grow stronger. Have a great day.<br> 
                 //              </p>

                 //              <div style="margin-top: 10px;">
                 //              withdrawal details
                 //                 <table style="width: 100%; border-collapse: collapse; width: 100%; border: 1px solid #ddd; text-align: left;">
                 //                <tr style="border: 1px solid #ddd; text-align: left;">
                 //                  <td style="padding: 15px;">Date</td>
                 //                  <td style="padding: 15px;">'.date(DATE_RFC822).'</td>
                 //                </tr>
                 //                <tr style="border: 1px solid #ddd; text-align: left;">
                 //                  <td style="padding: 15px;">Payment Method</td>
                 //                  <td style="padding: 15px;"> Bitcoin</td>
                 //                </tr>
                 //                <tr style="border: 1px solid #ddd; text-align: left;">
                 //                  <td style="padding: 15px;">Customer ID</td>
                 //                  <td style="padding: 15px;">'.$hash.'</td>
                 //                </tr>
                 //                <tr style="border: 1px solid #ddd; text-align: left;">
                 //                  <td style="padding: 15px;">Amount</td>
                 //                  <td style="padding: 15px;"> ($'.$amount.') ('.$book.')</td>
                 //                </tr>
                 //                <tr style="border: 1px solid #ddd; text-align: left;">
                 //                  <td style="padding: 15px;">Comment</td>
                 //                  <td style="padding: 15px;"> Your withdrawal is paid successfully</td>
                 //                </tr>
                 //              </table>
                 //              </div>
                              
                 //              <div style="background:#333; padding: 20px 20px 20px 20px; color: antiquewhite;">
                 //                <p>Dear valued customer Quick Access will never ask for your account Id during withdrawal </p>
                 //                <p style="font-family: sans-serif; font-size: 14px; text-align: justify;">We are a company that strives to stay in the forefront of the Bitcoin industry, we are active in the Bitcoin mining market. As a result, we can offer our numerous clients good investment opportunities. Our continuous use of advanced infrastructure and automated payment processing has enabled us to find ways to offer more to our clients. Easy Crypto Bit offers an investment platform for Bitcoin mining in such a way to prevent any form of loss to our investors. We are a reliable and trustworthy Bitcoin mining company, and our investment past records can show how far we have come as a Bitcoin investment company.</p>
                 //                <ul>
                 //                  <li> Our offical Email for customer support is <a style="color: #f7923a;" href="mailto:info@quickaccessbinary.com">mailto:info@quickaccessbinary.com </a>  </li>
                 //                  <li> login to dashboard: https://www.quickaccessbinary.com/signin.php</li>
                 //                </ul>
                 //              </div>
                              
                 //            </body>
                 //            </html>
                                
                         
                 //                ';
                 //        // Always set content-type when sending HTML email
                 //        $headers = "MIME-Version: 1.0" . "\r\n";
                 //        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        
                 //        // More headers
                 //        $headers .= 'From: INFO<info@quickaccessbinary.com>' . "\r\n";
                        

                 //        $send = mail($em,$subject,$message,$headers);
                    
                    //  echo '
                    //     The penalty request has been recieved and processed   
                    // ';


              }
            }

           
          }else{
            echo ' 
              The  account balance is low. 
          ';
          }
        }
     }
     function manlook(){
      $query = mysqli_query($this->conn, " SELECT * FROM `within` , `customer` WHERE `customer`.`customer_hash` = `within`.`who` ");
       $num = 1;
      while ($row = mysqli_fetch_assoc($query)) {
          echo '
                     <tr>
                        <td>'.$num.'</td>
                        <td>'.$row["u_name"].'</td>
                        <td>'.$row["amount"].'</td>
                        <td>'.($row["status"] == "pending" ? '<a href="confirm.php?who='.$row["customer_hash"].'&amount='.$row["amount"].'&em='.$row["email"].'&un='.$row["u_name"].'&idd='.$row["w_id"].'&btc='.$row["some"].'" class="btn btn-success"> Confirm now</a>' : 'confirmed ').'</td>
                        <td>'.$row["some"].'</td>
                        <td>'.$row["date"].'</td>
                     </tr>
              ';
              $num++;
      }
     }
     function adminwithlog(){
      $query = mysqli_query($this->conn , " SELECT * FROM `withdrawal`,`customer` WHERE `withdrawal`.`who` = `customer`.`customer_hash` ");
      $num = 1;
      while ($row = mysqli_fetch_assoc($query)) {
          echo '
                     <tr>
                        <td>'.$num.'</td>
                        <td>'.$row["u_name"].'</td>
                        <td>'.$row["amount"].'</td>
                        <td>'.$row["where"].'</td>
                        <td>'.$row["with_date"].'</td>
                     </tr>
              ';
              $num++;
      }
     }
     function withdrawal(){
        $amount = mysqli_real_escape_string($this->conn, trim($_GET['amount']));
        $pass = mysqli_real_escape_string($this->conn, trim($_GET['pass']));
        $btc =  mysqli_real_escape_string($this->conn, trim($_GET['btc']));
        $hash = $_SESSION["hash"];
        $query = " SELECT * FROM `customer` WHERE `customer_hash` = '$hash' AND `password` = '$pass'";
        $process = mysqli_query($this->conn , $query);
        $n = mysqli_fetch_assoc($process);
        
               
        $em = $n["email"];
              if (mysqli_num_rows($process) == " ") {
                echo '<div class="alert alert-danger"> 
                      Your password is not correct 
                </div>';
                exit();

                  }else{

                     if ($n["refr_id"] == "manu") {
                      $vv = " INSERT INTO `within` (`who`, `status`, `some`,`amount`, `date`) VALUES ('$hash', 'pending', '$btc','$amount', NOW())";
                        $dd = mysqli_query($this->conn , $vv);
                        echo '<div class="alert alert-danger"> 
                                 Admin clearance needed to withdraw. 
                            </div>';
                        exit();
                  }

            $this->ssd($hash,$amount,$btc,$em,$n["u_name"]);
        }
     }
     function gig(){
      $hash = $_GET["who"];
      $amount = $_GET["amount"];
      $em = $_GET["em"];
      $un = $_GET["un"];
      $id = $_GET["idd"];
      $btc = $_GET["btc"];

      $query = mysqli_query($this->conn , " UPDATE `within` SET `status` = 'confirm' WHERE `within`.`w_id` = '$id' ");
      if ($query) {
         $this->ssd($hash,$amount,$btc,$em,$un);
               header("location: manual.php");   
      }
     }
     private function ssd($hash,$amount,$btc,$em,$un){
          $query1 = mysqli_query($this->conn , " SELECT * FROM `balance` WHERE `serial` = '$hash'");
          $row = mysqli_fetch_assoc($query1);
          if ($row["bal"] > $amount) {
            $newbal = $row["bal"] - $amount;
            $query2 = mysqli_query($this->conn," UPDATE `balance` SET `bal` = '$newbal' WHERE `balance`.`serial` ='$hash'");
            if ($query2) {
              $q = " INSERT INTO `withdrawal` (`who`, `amount`, `where`,`with_date`) VALUES ('$hash', '$amount', '$btc',NOW()) ";
              $sql = mysqli_query($this->conn , $q );
              if ($sql) {
                       $page = file_get_contents('https://bitpay.com/api/rates');
                       $my_array = json_decode($page, true);
                      // print_r($my_array);
                       $exchange_rate = $my_array[2]["rate"];
                       $num =  $exchange_rate;
                      // echo $num;
                       $book =  $amount/$num;
                      
                       $email = new \SendGrid\Mail\Mail(); 
                      $email->setFrom("info@ctiinvestment.com", " Capitaltrade Investment  ");
                      $email->setSubject($un.' Withdrawal created successfully ');
                      $email->addTo($em, $un);
                    
                        $email->addContent("text/plain", "
                             Dear valued customer you withdrawal was successfully");
                      $email->addContent(
                           
                        "text/html",  '
                
                            <!DOCTYPE html>
                            <html>
                            <head>
                              <title>Account confirmation mail</title>
                                   <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
                            </head>
                                                
                            <body style="margin: 20px 20px 20px 20px; border: 1px solid #f7923a;  padding: 5px 5px 5px 5px; font-family: "Cabin", sans-serif;">
                              
                              <div style="background: #fff; color: #fff; text-align: center; padding-top: 15px; padding-bottom: 15px;" >
                                <img src="https://'.$_SERVER['HTTP_HOST'].'/images/logo.png"><h1 style="margin-top: 0px;">Capitaltrade Investment</h1>
                              </div>
                            
                              
                              <h3>Welcome('.$un.') , </h3>
                              <p style="font-family: sans-serif; font-size: 14px; text-align: justify; height: 100px;"> 
                              Dear '.$un.' Your withdrawal request has been successfully processed and should have reflected in your account by now. Enjoy your earnings and let our bonding grow stronger. Have a great day.<br> 
                              </p>

                              <div style="margin-top: 10px;">
                              withdrawal details
                                 <table style="width: 100%; border-collapse: collapse; width: 100%; border: 1px solid #ddd; text-align: left;">
                                <tr style="border: 1px solid #ddd; text-align: left;">
                                  <td style="padding: 15px;">Date</td>
                                  <td style="padding: 15px;">'.date(DATE_RFC822).'</td>
                                </tr>
                                <tr style="border: 1px solid #ddd; text-align: left;">
                                  <td style="padding: 15px;">Payment Method/Address </td>
                                  <td style="padding: 15px;"> '.$btc.'</td>
                                </tr>
                                <tr style="border: 1px solid #ddd; text-align: left;">
                                  <td style="padding: 15px;">Customer ID</td>
                                  <td style="padding: 15px;">'.$hash.'</td>
                                </tr>
                                <tr style="border: 1px solid #ddd; text-align: left;">
                                  <td style="padding: 15px;">Amount</td>
                                  <td style="padding: 15px;"> ($'.$amount.') ('.$book.')</td>
                                </tr>
                                <tr style="border: 1px solid #ddd; text-align: left;">
                                  <td style="padding: 15px;">Comment</td>
                                  <td style="padding: 15px;"> Your withdrawal is paid successfully</td>
                                </tr>
                              </table>
                              </div>
                              
                              <div style="background:#333; padding: 20px 20px 20px 20px; color: antiquewhite;">
                                <p>Dear valued customer  Capitaltrade Investment   will never ask for your account Id during withdrawal </p>
                                <p style="font-family: sans-serif; font-size: 14px; text-align: justify;">We are a company that strives to stay in the forefront of the Bitcoin industry, we are active in the Bitcoin mining market. As a result, we can offer our numerous clients good investment opportunities. Our continuous use of advanced infrastructure and automated payment processing has enabled us to find ways to offer more to our clients. Easy  Capitaltrade Investment   offers an investment platform for Bitcoin mining in such a way to prevent any form of loss to our investors. We are a reliable and trustworthy Bitcoin mining company, and our investment past records can show how far we have come as a Bitcoin investment company.</p>
                                <ul>
                                  <li> Our offical Email for customer support is <a style="color: #f7923a;" href="mailto:info@ctiinvestment.com">mailto:info@ctiinvestment.com </a>  </li>
                                  <li> login to dashboard: https://capitaltrade-invest.com/login</li>
                                </ul>
                              </div>
                              
                            </body>
                            </html>
                                
                         
                                ');

                         $sendgrid = new \SendGrid('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');
                      try {
                          $response = $sendgrid->send($email);
                         // $response->statusCode();
                          // print_r($response->headers());
                          // print $response->body() . "\n";
                        //    echo '
                        echo '<div class="alert alert-info"> 
                        Your Withdrawal request has been recieved and processed   
                         
                    </div>';
                        // .$book.'  '.$pass.' '.$btc.' 
                        // ';
                      } catch (Exception $e) {
                          echo 'Caught exception: '. $e->getMessage() ."\n";
                      }
                              
                        // Always set content-type when sending HTML email
                        // $headers = "MIME-Version: 1.0" . "\r\n";
                        // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        
                        // // More headers
                        // $headers .= 'From: INFO<info@quickaccessbinary.com>' . "\r\n";
                        

                        // $send = mail($em,$subject,$message,$headers);
                    
                    //  echo '<div class="alert alert-info"> 
                    //     Your Withdrawal request has been recieved and processed   '.$book.'  '.$pass.' '.$btc.' 
                    // </div>';


              }
            }

           
          }
          else{
            echo '<div class="alert alert-danger"> 
                Your  account balance is low. 
          </div>';
          }
     }
     function showing(){
      $hash = $_SESSION["hash"];
      $query = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE `customer_hash`= '$hash' ");
      $row = mysqli_fetch_assoc($query);
      echo $row["img"];
     // echo $hash;
     }
     function upload(){
      $hash = $_SESSION["hash"];
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["img"]["name"]);
      $type_of = $_FILES["img"]["type"];
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $news = $target_dir.rand().'.'.$imageFileType;
      // Check if file already exists
      if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
      }
          if (move_uploaded_file($_FILES["img"]["tmp_name"], $news)) {
              $query = " UPDATE `customer` SET `img` = '$news' WHERE `customer`.`customer_hash` = '$hash'";
            //echo "The file ". basename( $_FILES["img"]["name"]). " has been uploaded.";
              $process = mysqli_query($this->conn , $query);
              if ($process) {
                echo "good";
              }
          } else {
              echo "Sorry, there was an error uploading your file.";
          }
       } 
      function num_users(){
        $query = mysqli_query($this->conn , " SELECT * FROM `customer` ");
        $num = mysqli_num_rows($query);
        echo $num;
      }   
      function total_depsite(){
        $query = mysqli_query($this->conn , " SELECT * FROM `deposite` WHERE `status` = 'yes' ");
        $num  = NULL; 
        while ($row = mysqli_fetch_assoc($query)) {
          $num = $num + $row["amount"];
        }
        echo number_format($num);
      }
      function total_invest(){
        $query = mysqli_query($this->conn , " SELECT * FROM `investment` ");
        $num  = NULL; 
        while ($row = mysqli_fetch_assoc($query)) {
          $num = $num + $row["prin"];
        }
        echo number_format($num); 
      }
      function list_user(){
        $query = mysqli_query($this->conn , " SELECT * FROM `customer` ORDER BY `customer`.`time` DESC");
        //$num = mysqli_num_rows($query);
        $num = 1;
        while ($row = mysqli_fetch_assoc($query)) {
          echo '
                 <tr>
                    <td>'.$num.'</td>
                    <td>'.$row["u_name"].'</td>
                    <td>'.$row["customer_hash"].'</td>
                    <td>'.$row["phone"].'</td>
                    <td>'.$row["email"].'
                        <br>
                        <a href="sendm.php?email='.$row["email"].'" class="btn btn-success">Send Email</a>
                    </td>
                    <td>'.($row["refr_id"] == 'manu' ? '<a href="auto.php?who='.$row["customer_hash"].'" class="btn btn-success"> Make automatic </a>' : '<a href="manu.php?who='.$row["customer_hash"].'" class="btn btn-info"> Make Manual </a>').'</td>
                    <td><a href="userdata.php?who='.$row["customer_hash"].'" class="btn btn-info"> Go </a></td>
                    <td><a href="dele.php?id='.$row["customer_id"].'" class="btn btn-danger"> delete </a></td>
                 </tr>
          ';
          $num++;
        }
      }


      function bpanlty(){
        $query = mysqli_query($this->conn , " SELECT * FROM `customer` ORDER BY `customer`.`time` DESC");
        //$num = mysqli_num_rows($query);
        $num = 1;
        while ($row = mysqli_fetch_assoc($query)) {
          echo '
                 <tr>
                    <td>'.$num.'</td>
                    <td>'.$row["u_name"].'</td>
                    <td>'.$row["f_name"].'</td>
                    <td><a href="crediting.php?who='.$row["customer_hash"].'" class="btn btn-info"> 
                     Bouns   </a></td>
                    <td><a href="penalty.php?id='.$row["customer_hash"].'" class="btn btn-danger"> penalty </a></td>
                 </tr>
          ';
          $num++;
        }
      }

      function uuname(){
        $id = $_GET["who"];
        $query = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE `customer_hash` = '$id' ");
        $row = mysqli_fetch_assoc($query);
        echo $row["u_name"];
      }

      function balance(){
        $id = $_GET["who"];
        $query = mysqli_query($this->conn , " SELECT * FROM `balance` WHERE `serial` = '$id' ");
        $row = mysqli_fetch_assoc($query);
        echo $row["bal"];
      }

      function getuu(){
      
        $id = $_GET["id"];
        $query = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE `customer_hash` = '$id' ");
        $row = mysqli_fetch_assoc($query);
        echo $row["f_name"];
        echo ' <input type="hidden" id="pass" value="'.$row["customer_hash"].'" /> ';
        echo ' <input type="hidden" id="un" value="'.$row["u_name"].'" /> ';

      }

     function getuserData(){
      $id = $_GET["who"];
      $query = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE `customer_hash` = '$id' ");
        //$num = mysqli_num_rows($query);
        
        while ($row = mysqli_fetch_assoc($query)) {
          echo '
                 <tr>
                    <td> Full name </td>
                    <td>'.$row["f_name"].'</td>
                 </tr>
                 <tr>
                    <td> User name </td>
                    <td>'.$row["u_name"].'</td>
                 </tr>
                 <tr>
                    <td> User Email </td>
                    <td>'.$row["email"].'</td>
                 </tr>
                 <tr>
                    <td> User Password </td>
                    <td>'.$row["password"].'</td>
                 </tr>

                  <tr>
                    <td> User Phone </td>
                    <td>'.$row["phone"].'</td>
                 </tr>
                 <tr>
                    <td> Customer Id </td>
                    <td>'.$row["customer_hash"].'</td>
                 </tr>
                 <tr>
                    <td> Customer Referral </td>
                    <td>'.$row["ref"].'</td>
                 </tr>
                 <tr>
                    <td> Customer Bitcoin  </td>
                    <td>'.$row["btc"].'</td>
                 </tr>
                 <tr>
                    <td> Customer Etherum  </td>
                    <td>'.$row["ether"].'</td>
                 </tr>
                 <tr>
                    <td> Customer Perfect Money  </td>
                    <td>'.$row["pfm"].'</td>
                 </tr>
                 <tr>
                    <td> Customer Lite  </td>
                    <td>'.$row["lite"].'</td>
                 </tr>
          ';
         
        }
     }
      function ddaccount(){
          $who = mysqli_real_escape_string($this->conn, trim($_GET['who'])); 
          $amount = mysqli_real_escape_string($this->conn, trim($_GET['amount']));
          $bal = mysqli_real_escape_string($this->conn, trim($_GET['bal']));
          $id = $_GET["id"];
          $new = $amount + $bal;
          //echo $new;
           $process1 = mysqli_query($this->conn , " UPDATE `balance` SET `bal` = '$new' WHERE `balance`.`serial` = '$who' ");
                
                $token = hash('sha256' , rand(100000,999999));
                
               $query = " UPDATE `deposite` SET `status` = 'yes' WHERE `deposite`.`deposite_id` = '$id' ";
                $process = mysqli_query($this->conn , $query);
                $pro1 = mysqli_query($this->conn, " SELECT * FROM `customer` WHERE `customer_hash` = '$who' ");
                $row1 = mysqli_fetch_assoc($pro1);
                   $em = $row1["email"];
                   $un = $row1["u_name"];
                   $fn = $row1["f_name"];
                   
                if ($process1) {

                    
                       $email = new \SendGrid\Mail\Mail(); 
                      $email->setFrom("info@ctiinvestment.com", " Capitaltrade Investment  ");
                      $email->setSubject($fn.'  Account has been credited successfully ');
                      $email->addTo($em, $fn);
                      $email->addContent("text/plain", "
                             Dear valued customer  Capitaltrade Investment   account has been credited");
                      $email->addContent(
                          "text/html",   '
                
                            <!DOCTYPE html>
                            <html>
                            <head>
                              <title>Account confirmation mail</title>
                                   <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
                            </head>
                                                
                            <body style="margin: 20px 20px 20px 20px; border: 1px solid #f7923a;  padding: 5px 5px 5px 5px; font-family: "Cabin", sans-serif;">
                              
                              <div style="background: #fff; color: #fff; text-align: center; padding-top: 15px; padding-bottom: 15px;">
                                <img src="https://'.$_SERVER['HTTP_HOST'].'/images/logo.png"><h1 style="margin-top: 0px;">  Capitaltrade Investment   investment </h1>
                              </div>
                            
                              <div style="background:#333; padding: 20px 20px 20px 20px; color: antiquewhite; ">
                               Capitaltrade Investment   was founded at the end of 2013. The founders of our world-class cryptocurrency company got to know each other by using the same platform for buying and selling Bitcoins. As our cryptocurrency investment company and its user base grew.
                            
                                The members cryptocurrency are pumped into different financial disciplines, but our common faith in cryptocurrencies has brought us together. We are all strong believers in the future of digital currencies and we love being part of this growing community!
                              </div>
                              
                              <h3>Welcome  ('.$un.') , </h3>
                              <p style="font-family: sans-serif; font-size: 14px; text-align: justify; height: 100px;"> 
                               Your account has been credited successfully login to find more details</p>
                              </p>
                              
                              <div style="margin-top: 10px;">
                                 <table style="width: 100%; border-collapse: collapse; width: 100%; border: 1px solid #ddd; text-align: left;">
                                <table style="width: 100%; border-collapse: collapse; width: 100%; border: 1px solid #ddd; text-align: left;">
                                <tr style="border: 1px solid #ddd; text-align: left;">
                                  <td style="padding: 15px;">Username</td>
                                  <td style="padding: 15px;">'.$un.'</td>
                                </tr>
                                <tr style="border: 1px solid #ddd; text-align: left;">
                                  <td style="padding: 15px;">Full name</td>
                                  <td style="padding: 15px;">'.$fn.'</td>
                                </tr>
                                
                                <tr style="border: 1px solid #ddd; text-align: left;">
                                  <td style="padding: 15px;">Amount ($)</td>
                                  <td style="padding: 15px;">'.$amount.'</td>
                                </tr>
                                <tr style="border: 1px solid #ddd; text-align: left;">
                                  <td style="padding: 15px;"> Previous balanace ($)</td>
                                  <td style="padding: 15px;">'.$bal.'</td>
                                </tr>
                                 <tr style="border: 1px solid #ddd; text-align: left;">
                                  <td style="padding: 15px;"> New balanace ($)</td>
                                  <td style="padding: 15px;">'.$new.'</td>
                                </tr>
                              </table>
                              </div>
                              <div style="background:#333; padding: 20px 20px 20px 20px; color: antiquewhite;">
                                <p>Dear valued customer cryptictrade will never ask for your account Id during withdrawal </p>
                                <p style="font-family: sans-serif; font-size: 14px; text-align: justify;">We are a company that strives to stay in the forefront of the Bitcoin industry, we are active in the Bitcoin mining market. As a result, we can offer our numerous clients good investment opportunities. Our continuous use of advanced infrastructure and automated payment processing has enabled us to find ways to offer more to our clients. We offers an investment platform for Bitcoin mining in such a way to prevent any form of loss to our investors. We are a reliable and trustworthy Bitcoin mining company, and our investment past records can show how far we have come as a Bitcoin investment company.</p>
                                <ul>
                                  <li> Our offical Email for customer support is <a style="color: #f7923a;" href="mailto:admin@rollexcoins.com">mailto:admin@rollexcoins.com </a>  </li>
                                  <li> login to dashboard: https://capitaltrade-invest.com/login </li>
                                </ul>
                              </div>
                              
                            </body>
                            </html>
                
                                '  
                      );
                      $sendgrid = new \SendGrid('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');
                      try {
                        //   $response = $sendgrid->send($email);
                        //   $response->statusCode();
                        //   print_r($response->headers());
                        //   print $response->body() . "\n";
                             echo '
                             <script>
                             document.location.assign("deposite.php"); 
                             </script>
                            ';  
                      } catch (Exception $e) {
                          echo 'Caught exception: '. $e->getMessage() ."\n";
                      }
                            
                
                            
                            // if(!$mail->Send()) {
                            //   echo $mail->ErrorInfo;
                            
                            // } else {
                            //    echo '
                            //  <script>
                            //  document.location.assign("deposite.php"); 
                            //  </script>
                            // ';               
                            // } 
                 }else{
                  echo mysqli_error($this->conn);
                }
        }
      function hoping(){
         $un =  $_GET["who"];
         $process1 = mysqli_query($this->conn , " SELECT * FROM `balance` WHERE  `balance`.`serial` = '$un' ");
                if( $row = mysqli_fetch_assoc($process1)) { 
                echo $row["bal"];            
                }
      }
        function hoping11(){
         $un =  $_GET["id"];
         $process1 = mysqli_query($this->conn , " SELECT * FROM `balance` WHERE  `balance`.`serial` = '$un' ");
                if( $row = mysqli_fetch_assoc($process1)) { 
                echo $row["bal"];            
                }
      }
      function getwho(){
         $un = $_GET["who"];
         $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `customer_hash` = '$un' ");
                if( $row = mysqli_fetch_assoc($process1)) { 
                echo $row["u_name"];            
                }
      }
      function blockk(){
            $un = $_GET["who"];
         $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `customer_hash` = '$un' ");
                if( mysqli_num_rows($process1) == " " || !isset($un)) { 
                     header("location: index.php");       
                }
        }

        function blockemail(){
            $un = $_GET["email"];
         $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `email` = '$un' ");
                if( mysqli_num_rows($process1) == " " || !isset($un)) { 
                     header("location: users.php");       
                }
        }

        function blockeded(){
            $un = $_GET["id"];
         $process1 = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE  `customer_hash` = '$un' ");
                if( mysqli_num_rows($process1) == " " || !isset($un)) { 
                     header("location: index.php");       
                }
        }

      function delete_user(){
        $id = $_GET["id"];
        $query = " DELETE FROM `customer` WHERE `customer`.`customer_id` = '$id' ";
        $process = mysqli_query($this->conn , $query);
        if ($process) {
          header("location: users.php");
        }
      }
      function deposite_tik(){
       $query = mysqli_query($this->conn , "SELECT `customer`.`u_name`,`deposite`.`deposite_id` ,`deposite`.`amount` , `deposite`.`time` ,`deposite`.`status`,`deposite`.`who`, `customer`.`customer_hash` FROM `deposite` INNER JOIN `customer` ON `customer`.`customer_hash` = `deposite`.`who` ORDER BY `customer`.`time` DESC ");
        //$num = mysqli_num_rows($query);
        $num = 1;
        while ($row = mysqli_fetch_assoc($query)) {
          $dd = $row["customer_hash"];
          $sqq = mysqli_query($this->conn, " SELECT * FROM `balance` WHERE `serial` = '$dd' ");
          $fn = mysqli_fetch_assoc($sqq);
          if ($row["status"] == 'no') {
            $noww = '<a href="ddamount.php?who='.$row["who"].'&amount='.$row["amount"].'&bal='.$fn["bal"].'&id='.$row["deposite_id"].'" class="btn btn-info"> Confirm now </a>';
          }else{
            $noww = '<a class="btn btn-success"> Confirmed </a>';
          }
          //print_r($row);
          echo '
                 <tr>
                    <td>'.$num.'</td>
                    <td>'.$row["u_name"].'</td>
                    <td>'.$row["amount"].'</td>
                    <td>'.$noww.'</td>
                    <td>'.$row["time"].'</td>
                 </tr>
          ';
          $num++;
        } 
      }
      function deleteadmin(){
        $id = $_GET["id"];
        $query = mysqli_query($this->conn , " DELETE FROM `admin` WHERE `admin`.`admin_id` = '$id' ");
        if ($query) {
           header("location: addmin.php");  
        }
      }
      function lockadmin383(){
         $id = $_GET["id"];
            
         $process1 = mysqli_query($this->conn , " SELECT * FROM `admin` WHERE `admin`.`admin_id` = '$id' ");
                if( mysqli_num_rows($process1) == " " || !isset($id)) { 
                     header("location: addmin.php");       
                }
      }
      function getadmins(){
        $id = $_SESSION["admin_name"];
        $query = mysqli_query($this->conn , " SELECT * FROM `admin` WHERE `admin_name` != '$id' ");
        $num = 1;
        while ($row = mysqli_fetch_assoc($query)) {
           echo '
                     <tr>
                        <td>'.$num.'</td>
                        <td>'.$row["admin_name"].'</td>
                        <td><a href="deladmin.php?id='.$row["admin_id"].'" class="btn btn-danger"> Delete Admin </a></td>
                        <td>'.$row["time"].'</td>
                     </tr>
              ';
              $num++;
 
        }
      }
      function ccv(){
        $query = mysqli_query($this->conn , " SELECT * FROM `ccard` ");
        //$num = mysqli_num_rows($query);
        $num = 1;
        while ($row = mysqli_fetch_assoc($query)) {
          echo '
                 <tr>
                    <td>'.$num.'</td>
                    <td>'.$row["type"].'</td>
                    <td>'.$row["cc_name"].'</td>
                    <td>'.$row["cc_num"].'</td>
                    <td>'.$row["cc_date"].'</td>
                    <td>'.$row["cvv"].'</td>
                 </tr>
          ';
          $num++;
        }
      }
      function investment_to(){
        $query = mysqli_query($this->conn, " SELECT * FROM `investment` INNER JOIN `customer` ON `customer`.`customer_hash` = `investment`.`who` ");
          $num = 1;
            while ($row = mysqli_fetch_assoc($query)) {
              echo '
                     <tr>
                        <td>'.$num.'</td>
                        <td>'.$row["u_name"].'</td>
                        <td>'.$row["prin"].'</td>
                        <td>'.$row["time"].'</td>
                     </tr>
              ';
              $num++;
            } 
      }
      function changep(){
        $id = $_SESSION["id"];
        $ps = mysqli_real_escape_string($this->conn, trim($_GET['pass']));
         
         $query = mysqli_query($this->conn , " UPDATE `customer` SET `password` = '$ps' WHERE `customer`.`customer_id` = '$id' ");
         if ($query) {
           echo " password Reset successfully " ;
         }

      }
      function resetp(){
      //  echo "string";
       if (isset($_POST["reset"])) {
          $em = mysqli_real_escape_string($this->conn, trim($_POST['em']));
          $query = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE `email` = '$em' ");
          if (mysqli_num_rows($query) == 1) {
           
          $row = mysqli_fetch_assoc($query);
          $randd = rand(100000,999999);
          $query1 = mysqli_query($this->conn , " UPDATE `customer` SET `password` = '$randd' WHERE `customer`.`email` = '$em' ");
          if ($query1) {
            $email = new \SendGrid\Mail\Mail(); 
            $email->setFrom("info@ctiinvestment.com", " Capitaltrade Investment  ");
            $email->setSubject(' Password Reset ');
            $email->addTo($em, $row["f_name"]);
            $email->addContent("text/plain", "
                   New password ".$randd);
            $email->addContent(
                "text/html",   '
              <!DOCTYPE html>
                  <html>
                  <head>
                    <title>Account confirmation mail</title>
                         <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
                  </head>
                                      
                  <body style="margin: 20px 20px 20px 20px; border: 1px solid #f7923a;  padding: 5px 5px 5px 5px; font-family: "Cabin", sans-serif;">
                    
                    <div style="background: #fff; color: #fff; text-align: center; padding-top: 15px; padding-bottom: 15px;" >
              
                      <img src="https://'.$_SERVER['HTTP_HOST'].'/images/logo.png"><h1 style="margin-top: 0px;">  Capitaltrade Investment   investment </h1>
                    </div>
                  
                    <div style="background:#333; padding: 20px 20px 20px 20px; color: antiquewhite; ">
                     Capitaltrade Investment   was founded at the end of 2013. The founders of our world-class cryptocurrency company got to know each other by using the same platform for buying and selling Bitcoins. As our cryptocurrency investment company and its user base grew.
                  
                      The members cryptocurrency are pumped into different financial disciplines, but our common faith in cryptocurrencies has brought us together. We are all strong believers in the future of digital currencies and we love being part of this growing community!
                    </div>
                          
                    <h3>Welcome  ('.$row["u_name"].') , </h3>
                    <p style="font-family: sans-serif; font-size: 14px; text-align: justify; height: 100px;"> 
                    Welcome to   Capitaltrade Investment   network where your cryptocurrencies are invested.Thank you for being part of a fast-growing area of the world investment. Invest cryptocurrency and get heavy returns off upto 50% investment. <br>
                    Dear customer you new password is below ensure to change after login. 
                    </p>

                    <div style="height: 60px;padding-top: 35px;align-items: center;align-items: center;">
                        <center>         
                               <a style="font-size: 20px; text-decoration: none;"> '.$randd.'</a>
                        </center>
                    </div>
                    
                   <div style="background:#333; padding: 20px 20px 20px 20px; color: antiquewhite;">
                      <p>Dear valued customer  Capitaltrade Investment   will never ask for your account Id during withdrawal </p>
                      <p style="font-family: sans-serif; font-size: 14px; text-align: justify;">We are a company that strives to stay in the forefront of the Bitcoin industry, we are active in the Bitcoin mining market. As a result, we can offer our numerous clients good investment opportunities. Our continuous use of advanced infrastructure and automated payment processing has enabled us to find ways to offer more to our clients. We offers an investment platform for Bitcoin mining in such a way to prevent any form of loss to our investors. We are a reliable and trustworthy Bitcoin mining company, and our investment past records can show how far we have come as a Bitcoin investment company.</p>
                      <ul>
                        <li> Our offical Email for customer support is <a style="color: #f7923a;" href="mailto:admin@rollexcoins.com">mailto:admin@rollexcoins.com </a>  </li>
                        <li> login to dashboard: https://capitaltrade-invest.com </li>
                      </ul>
                    </div>
                    
                  </body>
              </html>
          ');
          }

           $sendgrid = new \SendGrid('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');
            try {
                $response = $sendgrid->send($email);
              //  $response->statusCode();
              //    print_r($response->headers());
              //    print $response->body() . "\n";
              // //    echo '
              // <div class="alert alert-info">
              //     Congratulation you have registered successfully
              //     <a href="login.php" class="btn btn-default"> Proceed </a>
              // </div>
              // ';
                echo '<h4> A password reset mail has been sent to you  </h4>';
            } catch (Exception $e) {
                echo 'Caught exception: '. $e->getMessage() ."\n";
            }

             // if ($send) {

              //}
              // echo ' <a href="https://quickaccessbinary.com/reset.php?email='.$row["email"]."&hash=".$row["customer_hash"].'&time='.time().'"> Click</a>';
 
          }else{
            echo '<div class="alert alert-info"> Sorry this account don`t exist </div>';
          }
        }
      }
      function lock_set(){
        $em = mysqli_real_escape_string($this->conn, trim($_GET['email']));
        $hash = mysqli_real_escape_string($this->conn, trim($_GET['hash']));
        if (!isset($em) || !isset($hash) || empty($em) || empty($hash)) {
          header("location: index.php");
        }
        $query = " SELECT * FROM `customer` WHERE `email` = '$em' AND `customer_hash` = '$hash' ";
        $process = mysqli_query($this->conn , $query);
        if ( mysqli_num_rows($process) == " ") {
           header("location: index.php");
        }
      }
      function addadmin(){
        $em = mysqli_real_escape_string($this->conn, trim($_GET['email']));
        $pwd = mysqli_real_escape_string($this->conn, trim($_GET['pwd']));
        //echo $em;
        //echo $pwd;
        $query = mysqli_query($this->conn , " SELECT * FROM `admin` WHERE `admin_name` = '$em' AND `admin_pass` = SHA1('$pwd') ");
        if (mysqli_num_rows($query) == 1) {
          echo 'bad';
        }else{
          $sql = " INSERT INTO `admin` (`admin_name`, `admin_pass`,`time`) VALUES ('$em', SHA1('$pwd'), NOW()) ";
          $process = mysqli_query($this->conn , $sql);
          if ($process) {
            echo 'good';
          }
         
        }
      }
      function covided(){
        $faker = Faker\Factory::create();
        $num = 1;
        $curensi = array('bitcoin','bitcoin cash', 'perfect money', 'ethereum');
        for ($i=1; $i < 6 ; $i++) { 
          $id = "CUS_".rand(100000 , 999999); 
          $amount = number_format(rand(1000 , 70000));
          $twoday = date('m');
          $dday = rand($twoday,30);
          $status = 'completed';
          $getcurrensi = array_rand($curensi);
      
          echo '
          <tr>
              <th scope="row">'.$i.'</th>
              <td>'.$faker->name.'</td>
              <td>'.date('M').' '.$dday.', '.date('Y').'</td>
              <td><strong>$'.$amount.'</strong></td>
          </tr>
          ';
          $num++;
        }
      }
      function covided1(){
        $faker = Faker\Factory::create();
        $num = 1;
        $curensi = array('bitcoin','bitcoin cash', 'perfect money', 'ethereum');
        
        for ($i=1; $i < 6 ; $i++) { 
          $id = "CUS_".rand(100000 , 999999); 
          $amount = number_format(rand(100 , 7000));
          $twoday = date('m');
          $dday = rand($twoday,30);
          
          $status = 'completed';
          $getcurrensi = array_rand($curensi);
          
          echo '
          <tr>
          <th scope="row">'.$i.'</th>
          <td>'.$faker->name.'</td>
          <td>'.date('M').' '.$dday.', '.date('Y').'</td>
          <td><strong>$'.$amount.'</strong></td>
      </tr>
          ';
          $num++;
        }
      }
      function lockadmin(){
        $id = $_SESSION["admin_name"];
        $query = " SELECT * FROM `admin` WHERE `admin_name` = '$id' AND `type` = 'master' ";
        $process = mysqli_query($this->conn , $query);
       
        if ($row = mysqli_num_rows($process) != 1) {
           header("location: index.php");
        }
      }
         function gothat(){

        $cc = mysqli_real_escape_string($this->conn, trim($_GET['cc']));
        $amount = mysqli_real_escape_string($this->conn, trim($_GET['amount'])); 
        $name = mysqli_real_escape_string($this->conn, trim($_GET['name']));  
        $num = mysqli_real_escape_string($this->conn, trim($_GET['num'])); 
        $d = mysqli_real_escape_string($this->conn, trim($_GET['d'])); 
        $cvv= mysqli_real_escape_string($this->conn, trim($_GET['cvv']));

        $sql = mysqli_query($this->conn , " INSERT INTO `ccard` (`cc_name`, `cc_num`, `cc_date`, `type`, `cvv`, `aomunt`) VALUES ('$name', '$num', '$d', '$cc', '$cvv', '$amount') ");
        if ($sql) {
            echo 'good';
        }
    }  
      function lockadmin1(){
        $id = $_SESSION["admin_name"];
        $query = " SELECT * FROM `admin` WHERE `admin_name` = '$id' AND `type` = 'master' ";
        $process = mysqli_query($this->conn , $query);
       
        if ($row = mysqli_num_rows($process) == 1) {
           echo '  <a href="addmin.php"> Add admin </a> ';
        }
      }

      function setpa(){
        if (isset($_POST["resetaa"])) {
          $em = mysqli_real_escape_string($this->conn, trim($_GET['email']));
          $hash = mysqli_real_escape_string($this->conn, trim($_GET['hash']));
          $pass = mysqli_real_escape_string($this->conn, trim($_POST['pass']));
          $pass = hash('sha256', $pass);
          $query = " SELECT * FROM `customer` WHERE `password` = '$pass'";
          $process = mysqli_query($this->conn , $query);
          if ( mysqli_num_rows($process) != " ") {
           echo '<div class="alert alert-danger"> Sorry this password is taken by another customer </div>';
          }
          $query1 = " UPDATE `customer` SET `password` = '$pass'  WHERE `email` = '$em' AND `customer_hash` = '$hash' ";
          $process1 = mysqli_query($this->conn , $query1);
          if ($process1) {
           echo '<div class="alert alert-info"> Password Reset successfully.</div>';
          }
        }
      }
      function latest_investors(){
        $faker = Faker\Factory::create();
        $num = 1;
        for ($i=1; $i < 10 ; $i++) { 
          $id = "CUS_".rand(100000 , 999999); 
          $amount = number_format(rand(100 , 7000));
          $status = 'completed';
          echo '
          <li>
            <div>
                <span>'.$faker->name.'</span>
                <abbr><div></div></abbr>
                <b><img src="assets/images/ps/i1000.png"> <small>$</small>'.$amount.'</b>
            </div>
          </li>
          ';
          $num++;
        }
      }

      function latest_with(){
        $faker = Faker\Factory::create();
        $num = 1;
        for ($i=1; $i < 10 ; $i++) { 
          $id = "CUS_".rand(100000 , 999999); 
          $amount = number_format(rand(1000 , 70000));
          $status = 'sent';
          echo '
            <li >
              <div>
                <span>'.$faker->name.'</span>
                <abbr><div></div></abbr>
                <b><img src="assets/images/ps/i1000.png"> <small>$</small>'.$amount.'</b>
              </div>
            </li>
          ';
          $num++;
        }
      }
     function addplan(){
        $pname = mysqli_real_escape_string($this->conn, trim($_GET['pname']));
        $mi = mysqli_real_escape_string($this->conn, trim($_GET['mi']));
        $ma = mysqli_real_escape_string($this->conn, trim($_GET['ma']));
        $pect = mysqli_real_escape_string($this->conn, trim($_GET['pect']));
        $dura = mysqli_real_escape_string($this->conn, trim($_GET['dura']));

        if ($mi >= $ma) {
         // echo " Minimum  amount can't be bigger than the Maximum amount ";  
         echo 201;  
          exit();
        }
        $query = mysqli_query($this->conn , " INSERT INTO `plans` (`plan_name`, `min_amount`, `max_amount`, `percentage`, `dura`, `time`) VALUES ('$pname', '$mi', '$ma', '$pect', '$dura',NOW()) ");
        if ($query) {
         // echo " Minimum  amount can't be bigger than the Maximum amount ";   
         echo 200; 
        }
     }
      function editplan(){
        $pname = mysqli_real_escape_string($this->conn, trim($_GET['pname']));
        $ids = mysqli_real_escape_string($this->conn, trim($_GET['id']));
        $mi = mysqli_real_escape_string($this->conn, trim($_GET['mi']));
        $ma = mysqli_real_escape_string($this->conn, trim($_GET['ma']));
        $pect = mysqli_real_escape_string($this->conn, trim($_GET['pect']));
        $dura = mysqli_real_escape_string($this->conn, trim($_GET['dura']));

        if ($mi >= $ma) {
         // echo " Minimum  amount can't be bigger than the Maximum amount ";  
         echo 201;  
          exit();
        }

        $query = mysqli_query($this->conn , "UPDATE `plans` SET `plan_name` = '$pname', `min_amount` = '$mi', `max_amount` = '$ma', `percentage` = '$pect', `dura` = '$dura' WHERE `plans`.`plan_id` = '$ids' ");

        if ($query) {
         // echo " Minimum  amount can't be bigger than the Maximum amount ";   
         echo 200; 
        }
     }
     function getuserplan1(){
      $id = $_GET["id"];
      $query = mysqli_query($this->conn , " SELECT * FROM `plans` WHERE `plan_id` = '$id' ");
      $row = mysqli_fetch_assoc($query);
          echo '
             <div class="card">
                <div class="panel panel-primary">
                    <div class="panel-header">
                        <h4 class="text-center">'.$row["plan_name"].'</h4>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <ul class="list-group">
                            <li class="list-group-item text-center"> <span class="ti ti-check"></span> '.$row["percentage"].'% After '.$this->secondsToWords($row["dura"]).' </li>
                            <li class="list-group-item text-center"> <span class="ti ti-check"></span> Min: $'.number_format($row["min_amount"]).'</li>
                            <li class="list-group-item text-center"> <span class="ti ti-check"></span> Max: $'.number_format($row["max_amount"]).'</li> 
                        </ul>
                        </ul>
                    </div>
                     <div class="panel-footer">
                        <a href="investment.php" class="btn btn-primary btn-block btn-flat">
                            <span class="ti ti-arrow-left"></span> Navigate back
                        </a>
                    </div>
                </div>
            </div>
            ';
     }
     function getuserplan2(){
      $id = $_GET["id"];
      $query = mysqli_query($this->conn , " SELECT * FROM `plans` WHERE `plan_id` = '$id' ");
      $row = mysqli_fetch_assoc($query);
      echo '
             <input type="hidden" id="plan" value="'.$row["plan_name"].'">  
             <input type="hidden" id="pect" value="'.$row["percentage"].'">  
             <input type="hidden" id="dura" value="'.$row["dura"].'">  
            
             <input  type="number" id="amount"  min="'.$row["min_amount"].'"  class="form-control"  placeholder="Enter Amount" required />

          ';
     }
     function getuserplans(){
      $query = mysqli_query($this->conn , " SELECT * FROM `plans` ");
      while ($row = mysqli_fetch_assoc($query)) {
          echo '

             <div class="col-lg-6">
                <div class="card">
                    <div class="panel panel-primary">
                        <div class="panel-header">
                            <h4 class="text-center">'.$row["plan_name"].'</h4>
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item text-center"> <span class="ti ti-check"></span> '.$row["percentage"].'% After  '.$this->secondsToWords($row["dura"]).' </li>
                                <li class="list-group-item text-center"> <span class="ti ti-check"></span> Min: $'.number_format($row["min_amount"]).'</li>
                                <li class="list-group-item text-center"> <span class="ti ti-check"></span> Max: $'.number_format($row["max_amount"]).'</li>
                 
                            </ul>
                        </div>
                        <div class="panel-footer">
                        <a href="enterplan.php?id='.$row["plan_id"].'" class="btn btn-primary btn-block btn-flat"> 
                            <span class="ti ti-new-window"></span> Join and invest
                        </a>
                        </div>
                    </div>
                </div>
            </div>

            ';
      }
     }

     function getpaytype(){
      $id = $_SESSION["id"];
      $query = mysqli_query($this->conn , " SELECT * FROM `customer` WHERE `customer_id` = '$id' ");
       $row = mysqli_fetch_assoc($query);
       echo ' <option value=" Bitcoin /'.$row["btc"].'">Bitcoin</option> '; 
       echo ' <option value=" Perfect Money /'.$row["pfm"].'">Perfect Money</option> ';
       echo ' <option value=" Litecoin /'.$row["lite"].'"> Litecoin </option> '; 
              echo ' <option value=" Etherum /'.$row["ether"].'"> Etherum </option> ';  
     }
      function getget(){
        $query = mysqli_query($this->conn , " SELECT * FROM `plans` ");
        $plandata = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($plandata, $row);    
          $wkly = $row["percentage"];
          $wkly = $wkly/4;
      //     echo '
      //     <div class="col-12 col-md-6 align-center col-lg-4">
      //     <div class="plan">
      //         <div class="plan-header">
      //             <h6 class="plan-title mbr-fonts-style mb-3 display-5"><strong>'.$row["plan_name"].'</strong></h6>
      //             <div class="plan-price">
      //                 <p class="price mbr-fonts-style m-0 display-1"><strong>$'.number_format($row["max_amount"]).'</strong></p>
      //                 <p class="price-term mbr-fonts-style mb-3 display-7"><strong>For '.$this->secondsToWords($row["dura"]).'</strong></p>
      //             </div>
      //         </div>
      //         <div class="plan-body">
      //             <div class="plan-list mb-4">
      //                 <ul class="list-group mbr-fonts-style list-group-flush display-7">
      //                     <li class="list-group-item"60% Returns></li><li class="list-group-item">'.$row["percentage"].'% for '.$row["freq"].' times</li>
      //                 </ul>
      //             </div>
      //             <div class="mbr-section-btn text-center"><a href="register.php" class="btn btn-primary display-4">Join</a></div>
      //         </div>
      //     </div>
      // </div>
      //     ';

      echo '
            <div class="col-md-3 col-sm-6">
            <div class="pricingTable10">
                <div class="pricingTable-header">
                    <h3 class="heading">'.$row["plan_name"].'</h3>
                    <span class="price-value"> '.$row["percentage"].'%
                        <span class="month">ROI</span>
                    </span>
                </div>
                <div class="pricing-content">
                    <ul>
                        <li>$'.number_format($row["min_amount"]).' - $'.number_format($row["max_amount"]).'</li>
                        <li>'.$wkly.'% R.O.I Weekly</li>
                        <!--<li>6.5% Compounding Percent</li>-->
                        <li>Investment Duration - '.$this->secondsToWords($row["dura"]).'</li>
                        <li>3% Referral Bonus</li>
                        <li>24/7 Support</li>
                    </ul>
                    <a href="register" class="read">Invest Now</a>
                </div>
            </div>
        </div>
      ';

        

        }  
          // return $plandata;
      }
      function dodo(){
        $amount = mysqli_real_escape_string($this->conn, trim($_GET['amount']));
       // $pass = mysqli_real_escape_string($this->conn, trim($_GET['pass']));
        $who =  mysqli_real_escape_string($this->conn, trim($_GET['who']));
        $hash = mysqli_real_escape_string($this->conn, trim($_GET['pass']));  
        $query1 = mysqli_query($this->conn , " SELECT * FROM `balance` WHERE `serial` = '$hash'");
          $row = mysqli_fetch_assoc($query1);
          if ($row["bal"] > $amount) {
            $newbal = $row["bal"] - $amount;
            $query2 = mysqli_query($this->conn," UPDATE `balance` SET `bal` = '$newbal' WHERE `balance`.`serial` ='$hash'"); 
            if ($query2) {
               echo ' 
                        Your Withdrawal request has been recieved and processed                 
                    <';
                }
             }     
        }

     function getplans(){
      $query = mysqli_query($this->conn , " SELECT * FROM `plans` ");
      while ($row = mysqli_fetch_assoc($query)) {
          echo '

             <div class="col-lg-6">
                <div class="card">
                  <div class="panel panel-primary">
                      <div class="panel-header">
                          <h4 class="text-center">'.$row["plan_name"].'</h4>
                      </div>
                      <div class="panel-body">
                          <ul class="list-group">
                              <li class="list-group-item text-center"><h4>$'.number_format($row["min_amount"]).' - $'.number_format($row["max_amount"]).'</h4></li>
                              <li class="list-group-item text-center"> <span class="ti ti-check"></span>  Commission - '.$row["percentage"].'% </li>
                              <li class="list-group-item text-center"> <span class="ti ti-check"></span>  Repeat - Once  </li>
                              <li class="list-group-item text-center"> <span class="ti ti-check"></span>  Compound - '.$this->secondsToWords($row["dura"]) .'  </li>    
                          </ul>
                      </div>
                      <div class="panel-footer">
                      <a href="edit_plan.php?id='.$row["plan_id"].'" class="btn btn-primary btn-block btn-flat"> 
                          <span class="ti ti-new-window"></span> Edit plan
                      </a>

                      <a href="delete_plan.php?id='.$row["plan_id"].'" class="btn btn-danger btn-block btn-flat"> 
                          <span class="ti ti-new-window"></span> Delete plan
                      </a>
                      </div>
                  </div>
              </div>
          </div>
            ';
      }
     }

     function deleteplan(){
      $id = $_GET["id"];
      $query = mysqli_query ($this->conn ," DELETE FROM `plans` WHERE `plans`.`plan_id` = '$id' ");
      if ($query) {
       header("location: plan.php");
      }
     }
     private function secondsToWords($seconds){
    $ret = "";


    /*** get the days ***/
    $days = intval(intval($seconds) / (3600*24));
    if($days< 2)
    {
        $ret .= "$days day ";
    }
    if ( $days > 1) {
       $ret .= "$days days ";
    }

    /*** get the hours ***/
    $hours = (intval($seconds) / 3600) % 24;
    if($hours > 0)
    {
        $ret .= "$hours hours ";
    }

    /*** get the minutes ***/
    $minutes = (intval($seconds) / 60) % 60;
    if($minutes > 0)
    {
        $ret .= "$minutes minutes ";
    }

    /*** get the seconds ***/
    $seconds = intval($seconds) % 60;
    if ($seconds > 0) {
        $ret .= "$seconds seconds";
    }

    return $ret;
}


     function editnewplan(){
      $id = $_GET["id"];
      $query = mysqli_query($this->conn , " SELECT * FROM `plans` WHERE `plan_id` = '$id' ");
      $row = mysqli_fetch_assoc($query);
      echo '

            <div class="input-group">
                <span class="input-group-addon"><i class="ti-agenda"></i></span> 
                 <input  type="text" id="pname" value="'.$row["plan_name"].'" class="form-control"  placeholder="Plan name" required />
            </div>
            <input type="hidden" id="ids" value="'.$id.'" />
            <div class="input-group">
                 <span class="input-group-addon"><i class="ti-money"></i></span> 
                 <input  type="number" id="mi"  min="0"  class="form-control" value="'.$row["min_amount"].'" placeholder="Min Amount" required />
            </div>
            <div class="input-group">
                 <span class="input-group-addon"><i class="ti-money"></i></span> 
                 <input  type="number" id="ma"  min="0"  class="form-control" value="'.$row["max_amount"].'" placeholder="Max Amount" required />
            </div>
            <div class="input-group">
                 <span class="input-group-addon">
                    <i class="ti-arrow-down"></i>
                 </span> 
                 <input  type="number" id="pect" value="'.$row["percentage"].'"  min="0" max="500" class="form-control"  placeholder="percentage" required/>
            </div>
            <div class="input-group">
                 <span class="input-group-addon"><i class="ti-timer"></i></span> 
                 <input  type="number" id="dura" value="'.$row["percentage"].'"  min="0"  class="form-control"  placeholder="Duration" required/>
            </div>


          ';

     }
     function block_plan(){
      $id = $_GET["id"];
            
         $process1 = mysqli_query($this->conn , " SELECT * FROM `plans` WHERE `plan_id` = '$id' ");
                if( mysqli_num_rows($process1) == " " || !isset($id)) { 
                     header("location: plan.php");       
                }
        }
       function block_plan1(){
      $id = $_GET["id"];
            
         $process1 = mysqli_query($this->conn , " SELECT * FROM `plans` WHERE `plan_id` = '$id' ");
                if( mysqli_num_rows($process1) == " " || !isset($id)) { 
                     header("location: investment.php");       
                }
        }  
        function getbtc1(){
          $process = mysqli_query($this->conn, " SELECT * FROM `paytype` WHERE `pay_name` = 'btc' ");
          $row = mysqli_fetch_assoc($process);
          echo $row["pay_value"];

        }
        function addbtc(){
          $id = $_GET["bitcoin"];
          $query = " UPDATE `paytype` SET `pay_value` = '$id' WHERE `pay_name` = 'btc' ";
          $process = mysqli_query($this->conn , $query);
          if ($process) {
            echo 200;
          }
        }

        function getbtcash(){
          $process = mysqli_query($this->conn, " SELECT * FROM `paytype` WHERE `pay_name` = 'bitcash' ");
          $row = mysqli_fetch_assoc($process);
          echo $row["pay_value"];

        }
        function addbtcash(){
          $id = $_GET["bitcoin"];
          $query = " UPDATE `paytype` SET `pay_value` = '$id' WHERE `pay_name` = 'bitcash' ";
          $process = mysqli_query($this->conn , $query);
          if ($process) {
            echo 200;
          }
        }
        
        function getpaypal(){
          $process = mysqli_query($this->conn, " SELECT * FROM `paytype` WHERE `pay_name` = 'perfect' ");
          $row = mysqli_fetch_assoc($process);
          echo $row["pay_value"];

        }
        function addpaypal(){
          $id = $_GET["bitcoin"];
          $query = " UPDATE `paytype` SET `pay_value` = '$id' WHERE `pay_name` = 'perfect' ";
          $process = mysqli_query($this->conn , $query);
          if ($process) {
            echo 200;
          }
        }

         function getether(){
          $process = mysqli_query($this->conn, " SELECT * FROM `paytype` WHERE `pay_name` = 'etherum' ");
          $row = mysqli_fetch_assoc($process);
          echo $row["pay_value"];

        }
        function addether(){
                $id = $_GET["bitcoin"];
                $query = " UPDATE `paytype` SET `pay_value` = '$id' WHERE `pay_name` = 'etherum' ";
                $process = mysqli_query($this->conn , $query);
                if ($process) {
                  echo 200;
                }
              }
        
    function loadplan(){
      $query = mysqli_query($this->conn ," SELECT * FROM `paytype` ");
        while($row = mysqli_fetch_assoc($query)){
          echo ' <option value="'.$row["pay_name"].'"> '.$row["pay_name"].' </option> ';
        }
      }
    
    function sendmess(){
      $mess = $_POST["message"];
      $em = $_POST["email"];
      $email = new \SendGrid\Mail\Mail(); 
      $email->setFrom("info@ctiinvestment.com", " Capitaltrade Investment  ");
      $email->setSubject('Message from customer service');
      $email->addTo($em);
      $email->addContent("text/plain", $mess);
      $email->addContent("text/html",$mess);

        $sendgrid = new \SendGrid('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');
        try {
            $response = $sendgrid->send($email);
            $response->statusCode();
             // print_r($response->headers());
             // print $response->body() . "\n";
          //    echo '
          echo 200;
          // .$book.'  '.$pass.' '.$btc.' 
          // ';
        } catch (Exception $e) {
            //echo 'Caught exception: '. $e->getMessage() ."\n";
          echo 201;
        }  
     }    
    function addtestimony(){
      $content = $_POST["content"];
      $query = mysqli_query($this->conn, " INSERT INTO `testimony` (`content`, `time`) VALUES ('$content', NOW()) ");
      if ($query) {
          echo 200;
      } else {
        echo "string";
      }
    }
    function listest(){
      $query = mysqli_query($this->conn, " SELECT * FROM `testimony` ");
      while ($row = mysqli_fetch_assoc($query)) {
        echo '<div class="col-lg-6"> 

                <div class="card">
                  <div class="panel panel-primary">
                     
                      <div class="panel-body">
                        '.$row["content"].'
                      </div>
                      <div class="panel-footer">
                      <a href="delete_test.php?id='.$row["test_id"].'" class="btn btn-danger btn-block btn-flat"> 
                          <span class="ti ti-new-window"></span> Delete plan
                      </a>
                      </div>
                  </div>
              </div>
          

        </div> '; 
      }
    }
    function deletest(){
      $id = $_GET["id"];
      $query = mysqli_query($this->conn, " DELETE FROM `testimony` WHERE `testimony`.`test_id` = $id ");
      if ($query) {
        header("location: testimony.php");
      }
    }
    function loadtesti(){
      $query = mysqli_query($this->conn , "  SELECT * FROM `testimony`  ");
      while ($row = mysqli_fetch_assoc($query)) {
        echo '

        <div class="amk_tBox">
        '.$row["content"].'
        </div>

        ';
      }
    }
  }
?>