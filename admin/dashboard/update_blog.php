<?php
//echo 'am getting to update';
session_start();
include 'db_conn.php';

class updatePost extends connection{
	private $bt;
	private $bl;
	private $bcat;
	private $bc;
	private $bpic;
	private $bd;
	private $btime;
	private $bid;

	public function UpdateIt($BT,$BL,$BCAT,$BC,$BPIC,$BD,$BTIME,$ID){
			$this->bt = $BT;
			$this->bl = $BL;
			$this->bcat = $BCAT;
			$this->bc = $BC;
			$this->bpic = $BPIC;
			$this->bd = $BD;
			$this->btime = $BTIME;
			$this->bid = $ID;

			//echo $this->btime;

			/*$sql = "INSERT INTO blog_posts(blog_title,location,bdate,btime,preview,content,pic) VALUES('$this->bt','$this->bl','$this->bd','$this->btime','$this->bp','$this->bc', '$this->bpic');";*/


			$sql = "UPDATE blog SET title='$this->bt', poster='$this->bl', date='$this->bd', time='$this->btime', category='$this->bcat', content='$this->bc', pic='$this->bpic' WHERE id = '$this->bid';";



			$send = $this->connect()->query($sql);

			if($send){
                // echo 'sucess';
                $_SESSION['err'] = 'success';
				header("Location: ./manageblog.php");
			}else{
                // echo 'failed';
                $_SESSION['err'] = 'failed';
				header('Location: ./manageblog.php');
			}
	}
}


if(isset($_POST['submit'])){
	$title = $_POST['btitle'];
	$poster = $_POST['blocation'];
	$cat = $_POST['pstat'];
	$content = $_POST['bcontent'];
	$previmg = $_POST['previmg'];
	$id = $_POST['bid'];


	$date = date('d-M-Y');
	$time = date('h:i a');

	//echo $title,$previmg,$location,$content,$preview,$date,$time;
	//check for empty feilds
	
	if(empty($title) || empty($poster) || empty($cat) || empty($content)){
        $_SESSION['err'] = 'empty';
		header('Location: ./manageblog.php');
	}
	else{

            if(file_exists($_FILES['bpic']['tmp_name']) || is_uploaded_file($_FILES['bpic']['tmp_name'])){
              
             
            $image = $_FILES['bpic'];
            $imgname = $image['name'];
            $imgsize = $image['size'];
            $imgtmp = $image['tmp_name'];
            $imgtype = $image['type'];
            $imgerror = $image['error'];
            
       		//this is for the previous image coming from the original post
           $prevex = explode('.',$previmg);
           $pend = end($prevex);
           $prevext = strtolower($pend);

            //this handles the new uploaded image ie the one to be updated
            $break = explode('.',$imgname);
        	$et= end($break);
            $ext = strtolower($et);

            //to check if the image extension of the old image and the new one matches
            if($prevext == $ext){
                $uniqueName = $previmg;
            }else{
            $uniqueName = uniqid('', true).".".$ext;
            $allowed = array('png','jpg','jpeg');
            
            if(!in_array($ext,$allowed)){
                $_SESSION['err'] = 'wrongfileformat';
                header('Location:./manageblog.php');
            }
        
            if($imgsize>2000000){
                $_SESSION['err'] = 'filetoolarge';
                header('Location:./manageblog.php');
            }
        }
            $im = '../blog_uploads/'.$uniqueName;
            move_uploaded_file($imgtmp,$im);
        
        }else{

            $uniqueName = $previmg;
        }
        //echo $uniqueName;

                    $update_new = new updatePost;

                    $title = mysqli_real_escape_string($update_new->connect(), $title);
                    $poster = mysqli_real_escape_string($update_new->connect(), $poster);
                    $cat = mysqli_real_escape_string($update_new->connect(), $cat);
                    $content = mysqli_real_escape_string($update_new->connect(), $content);
                    $thepicn = mysqli_real_escape_string($update_new->connect(), $uniqueName);
                    $date = mysqli_real_escape_string($update_new->connect(), $date);
                    $time = mysqli_real_escape_string($update_new->connect(), $time);
                    $id = mysqli_real_escape_string($update_new->connect(), $id);


                    $update_new->UpdateIt($title,$poster,$cat,$content,$thepicn,$date,$time,$id);

	}

}

?>