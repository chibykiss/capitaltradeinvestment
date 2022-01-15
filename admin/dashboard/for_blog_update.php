<?php
include 'db_conn.php';

class fix_update extends connection{
	private $theid;

	public function show($ID){
		$this->theid = $ID;
		$sql = "SELECT * FROM blog WHERE id = '$this->theid';";

		$send = $this->connect()->query($sql);

		while($result = $send->fetch_assoc()){
			$title = $result['title'];
			$by = $result['poster'];
			$cat = $result['category'];
			$content = $result['content'];
			$date = $result['date'];
			$time = $result['time'];
			$pic = $result['pic'];
            $id = $result['id'];
			echo $date.'<br>'.$time.'<br>'.$pic.'<br>'.$cat;

			echo '
			 <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Blog Title</label>
                                                    <input type="text" class="form-control" placeholder="Blog Title" name="btitle" value="'.$title.'">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Poster</label>
                                                    <input type="text" class="form-control" placeholder="By" name="blocation" value="'.$by.'">
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="pstat" class="form-control">
                                                <option value="Investment">Investment</option>
                                                <option value="Community">Community</option>
                                                <option value="corporate">Corporate</option>
                                                <option value="Business">Business</option>
                                                <option value="Banking">Banking</option>
                                                <option value="Deposit">Deposit</option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                             <div style="display:none;" class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label>Previous Image</label>
                                                    <input type="text" name="previmg" class="form-control" value="'.$pic.'">
                                                </div>
                                            </div>

                                          
                                            
                                        
                                        </div>
                                        <div style="display:none;" class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>The id</label>
                                                    <input type="text" class="form-control" placeholder="Location" name="bid" value="'.$id.'">
                                                </div>

                                            </div>
                                            <div class="col-md-4 pr-1">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <input type="text" class="form-control" placeholder="Location" name="cat" value="'.$cat.'">
                                            </div>

                                        </div>

                                        </div>
                                        <div class="row">
                                        <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                     <label>Previous Post Pic</label>
                                                     <div class="card-image">
                                                     <img src="../blog_uploads/'.$pic.'" width="100px"; height="50px"; alt="...">
                                                 </div>
                                                </div>
                                            </div>
                                        <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                     <label>Change Post Pic</label>
                                                   <input type="file" class="form-control-file" name="bpic">
                                                </div>
                                            </div>
                                            <!--<div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Preview</label>
                                                    <textarea rows="4" cols="80" class="form-control" placeholder="Short Description" name="bpreview"></textarea>
                                                </div>
                                            </div>-->
                                        </div>
                                           <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>main content</label>
                                                    <textarea rows="4" cols="80" class="form-control" placeholder="Full Blog Details" name="bcontent" >'.$content.'</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat"> Update Post </button>
                                        <div class="clearfix"></div>
                                  




			';
		}
	}
}

?>