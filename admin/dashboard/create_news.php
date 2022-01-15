<?php
session_start();
// echo $_POST['btitle'].'<br>'.$_POST['bpostby'].'<br>'.$_POST['pstat'].'<br>'.$_POST['editor1'];
// print_r($_FILES['bpic']);


include 'db_conn.php';

class createPost extends connection{
	private $bt;
	private $bl;
	private $bct;
	private $bc;
	private $bpic;
	private $bd;
	private $btime;

	public function addPost($BT,$BL,$BCT,$BC,$BPIC,$BD,$BTIME){
			$this->bt = $BT;
			$this->bl = $BL;
			$this->bct = $BCT;
			$this->bc = $BC;
			$this->bpic = $BPIC;
			$this->bd = $BD;
			$this->btime = $BTIME;

			echo $this->bt.$this->bl.$this->bct.$this->bc.$this->bpic.$this->bd.$this->btime;

			$sql = "INSERT INTO blog(title,poster,category,date,time,content,pic) VALUES('$this->bt','$this->bl','$this->bct','$this->bd','$this->btime','$this->bc', '$this->bpic');";
			$send = $this->connect()->query($sql);

			if($send){
				// echo 'sucess';
				$_SESSION['err'] = 'success';
				header('Location: ./blog.php');
			}else{
				$_SESSION['err'] = 'failed';
				header('Location: ./blog.php');
			}
	}
}


if(isset($_POST['submit'])){
// 	echo $_POST['btitle'].'<br>'.$_POST['bpostby'].'<br>'.$_POST['pstat'].'<br>'.$_POST['editor1'];
// print_r($_FILES['bpic']);

	$title = $_POST['btitle'];
	$location = $_POST['bpostby'];
	$cat = $_POST['pstat'];
	$content = $_POST['editor1'];
	$thepic = $_FILES['bpic'];


	$date = date('d-M-Y');
	$time = date('h:i a');
	//check for empty feilds
	// echo $title.'<br>'.$location.'<br>'.$cat.'<br>'.$content.'<br>';
	// print_r($thepic);
	
	if(empty($title) || empty($location) || empty($cat) || empty($content) || empty($thepic)){
		$_SESSION['err'] = 'empty';
		header('Location: ./blog.php');
	}
	else{

                
                    $imgname = $thepic['name'];
                    $imgsize = $thepic['size'];
                    $imgtmp = $thepic['tmp_name'];
                    $imgtype = $thepic['type'];
                    $imgerror = $thepic['error'];
            
                    $break =explode('.',$imgname);
                
                    $et= end($break);
                    $ext = strtolower($et);
                    $uniqueName = uniqid('', true).".".$ext;
                    $allowed = array('png','jpg','jpeg');
                    
                    if(!in_array($ext,$allowed)){
						$_SESSION['err'] = 'wrong_format';
                        header('Location:./blog.php');
                    }
                    if($imgsize>2000000){
						$_SESSION['err'] = 'too_large';
                        header('Location:./blog.php');
                    }
                    $im = '../blog_uploads/'.$uniqueName;
                    move_uploaded_file($imgtmp,$im);

                    $add_new = new createPost;

                    $title = mysqli_real_escape_string($add_new->connect(), $title);
                    $location = mysqli_real_escape_string($add_new->connect(), $location);
                    $cat = mysqli_real_escape_string($add_new->connect(), $cat);
                    $content = mysqli_real_escape_string($add_new->connect(), $content);
                    $thepicn = mysqli_real_escape_string($add_new->connect(), $uniqueName);
                    $date = mysqli_real_escape_string($add_new->connect(), $date);
                    $time = mysqli_real_escape_string($add_new->connect(), $time);



                    $add_new->addPost($title,$location,$cat,$content,$thepicn,$date,$time);

	}

}

?>