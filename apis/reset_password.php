<?php
include 'conn.php';
$response = array();
class resetpass extends connection{
    private $pass;
    private $sel;
    private $tkn;
    public function resetpassword($PWD,$SELT,$VALT){
        global $response;
        $this->pass = $PWD;
        $this->sel = $SELT;
        $this->tkn = $VALT;
        $current_date = date("U");
        $sql = "SELECT * FROM resetpwd WHERE selector='$this->sel'";
        $smt = $this->connect()->prepare($sql);
        $send = $smt->execute();
        if($send){
            $exists = $smt->rowCount();
            if($exists == 1){
                $result = $smt->fetch();
                $expirydate = $result['pwdExpires'];
                $dbtoken = $result['validator'];
                $user = $result['pwdEmail'];
                if($expirydate >= $current_date){
                    //convert our validator in hexadecimal back to binary digit, inorder to match with the binary digit in our db
                    $token = hex2bin($this->tkn);
                    //verify the token hash with db
                    $check_token = password_verify($token, $dbtoken);
                    if($check_token == true){
                        $query = "UPDATE customer SET password = ? WHERE email = '$user'";
                        $stmt = $this->connect()->prepare($query);
                        $exec = $stmt->execute([$this->pass]);
                        if($exec){
                            $sqlm ="DELETE FROM resetpwd WHERE selector=?";
                            $stt = $this->connect()->prepare($sqlm);
                            $final = $stt->execute([$this->sel]);
                            if($final){
                                $response['error'] = false;
                                $response['message'] = 'password_reseted';
                            }else{
                                $response['error'] = true;
                                $response['message'] = 'internal db error on delete';
                            }
                        }else{
                            $response['error'] = true;
                            $response['message'] = 'internal db error on update'; 
                        }
                    }else{
                        $response['error'] = true;
                        $response['message'] = 'token wrong';
                        $response['errcode'] = 3;
                    }
                }else{
                    $response['error'] = true;
                    $response['message'] = 'this reset link has expired, pls request for a new link';
                    $response['errcode'] = 2;
                }
            }else{
                $response['error'] = true;
                $message['message'] = 'you did not request for password reset';
                $response['errcode'] = 1;
            }
            
        }else{
            $response['error'] = true;
            $response['message'] = 'internal db error on selector';
        }
    }
}
// $try = new resetpass;
// $try->resetpassword('wet','93c62d5754b05840','7011d959157e2ee03197e2ad6192f5b0029a46e793fdae5ca2816aee6b903ceb');
if(isset($_POST['pwd']) && isset($_POST['select']) && isset($_POST['validate'])){
    if(!empty($_POST['pwd']) || !empty($_POST['rpwd'])){
        $pwd = $_POST['pwd'];
        $rpwd = $_POST['rpwd'];
        if($pwd === $rpwd){
            $selt = $_POST['select'];
            $valt = $_POST['validate'];
            $try = new resetpass;
            $try->resetpassword($pwd,$selt,$valt);
        }else{
            $response['error'] = true;
            $response['message'] = "pwd_no_match";
            $response['errcode'] = 4;
        }
    }else{
        $response['error'] = true;
        $response['message'] = "fill in the empty feilds"; 
        $response['errcode'] = 5;
    }
    
}else{
    $response['error'] = true;
    $response['message'] = "not_set";
    $response['errcode'] = 6;
}
echo json_encode($response);