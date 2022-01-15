<?php
session_start();
include 'db_conn.php';

class Delete extends connection{
	private $id;

	public function deleteIt($ID){
		$this->id = $ID;

		$ssql = "SELECT pic FROM blog WHERE id = '$this->id';";

        $res = $this->connect()->query($ssql);

        while($row = $res->fetch_assoc()){
            $dimage = $row['pic'];
            
           
        }

		$sql = "DELETE FROM blog WHERE id = '$this->id';";

		$send = $this->connect()->query($sql);

		unlink('../blog_uploads/'.$dimage);

		if($send){
            //echo 'sucess';
            $_SESSION['err'] = 'delsuccess';
			header("Location: ./manageblog.php");
			
		}else{
            //echo 'failed';
            $_SESSION['err'] = 'delfailed';
			header("Location: ./manageblog.php");
			
		}
	}
}

$theid = $_GET['id'];

$deleteme = new Delete;

$theid = mysqli_real_escape_string($deleteme->connect(), $theid);

$deleteme->deleteIt($theid);
?>