<?php
//echo json_encode('e dey reach here');
include 'conn.php';
$response = array();
class sendPwdReset extends connection{
    private $email;
    public function getEmail($EM){
        global $response;
        $this->email = $EM;
        //check if email exists in the users table
        $sql = "SELECT email FROM customer WHERE email = ?";
        $smt = $this->connect()->prepare($sql);
        $send = $smt->execute([$this->email]);
        if($send){
            $exists = $smt->rowCount();
            if($exists == 1){
                $selector = bin2hex(random_bytes(8));
                $token = random_bytes(32);
                $validator = bin2hex($token);
                $url = "https://capitaltrade-invest.com/new_pass/$selector/".bin2hex($token);
                $t_expiry = date("U") + 1800;
                //check if there is any thing in the token table stored for this user and delete it
                $query = "DELETE FROM resetpwd WHERE pwdEmail = ?";
                $stmt = $this->connect()->prepare($query);
                $stmt->execute([$this->email]);
                //insert the validators into the database hashed
                $token = password_hash($token, PASSWORD_DEFAULT);
                $sqlz = "INSERT INTO resetpwd(pwdEmail,selector,validator,pwdExpires) VALUES(?,?,?,?)";
                $stm = $this->connect()->prepare($sqlz);
                $exec = $stm->execute([$this->email,$selector,$token,$t_expiry]);
                if($exec){
                    $to = $this->email;
                    $subject = "Reset your Password for Capitaltrade-Invest";
                    $body = "<p>We Recieved a password reset request, if you did not make
                    this request pls ignore this message<p>";
                    $body.="<p>Below is your password reset link:</p>";
                    $body.='<p><a href="'.$url.'">'.$url.'</a></p>';
                    $headers = "MIME-Version: 1.0" . "\r\n"; 
                    $headers = "From: Capitaltrade <no-reply@capitaltrade-invest.com>\r\n";
                    $headers.= "Content-type: text/html\r\n";
                    // if(mail($to,$subject,$body,$headers)){
                    //     $response['error'] = false;
                    //     $response['message'] = 'reset_link_sent';
                    // }else{
                    //     $response['error'] = true;
                    //     $response['err-code'] = 2;
                    //     $response['message'] = 'email sending failed';
                    // }
                    $response['selector'] = $selector;
                    $response['validator'] = $validator;
                    $response['error'] = false;
                    $response['message'] = 'reset_link_sent';
                    $response['err_code'] = 0;
                }
            }else{
                $response['error'] = true;
                $response['err_code'] = 1;
                $response['message'] = 'you are not a registered user';
            }
        }
    }
}
if(isset($_POST['email'])){
    if(!empty($_POST['email'])){
        $email = $_POST['email'];
        $try = new sendPwdReset;
        $try->getEmail($email);

    }else{
        $response['error'] = true;
        $response['err_code'] = 3;
        $response['message'] = 'your email cannot be empty';
    }
    
}else{
    header('location: ../index.php');
}
echo json_encode($response);