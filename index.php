<?php

	require_once('connection/connect.php');
	require_once('includes/header.php');
	include('includes/menu.php');
	include('includes/skeleton.php');
?>
	<!-- main page content -->
	<div class="container">
  	<div class="tab-content">
       <div class="tab-pane active fade in" id="search">
	     <div class="row">
					  <div class="col-sm-6">
					     <div class="panel panel-default">
						    <div class="panel-body">
							<!--search field on home page-->
								<form action="#" name="frequency" method="POST">
										<div class="form-group">
											<input required style="width: 80%; border-radius:0" type="text" name="search" class="form-control">
												<a href="#" name="frequency"></a>
											</input>
										</div>
										<div class="form-group">
											<button class="btn btn-default" type="submit" value="search">Search String</button> 
											<button class="btn btn-default" type="reset">Reset</button>
										</div>
							 
						   		</form>
							</div>
						 </div>
					  </div>
					  <div class="col-sm-6">
					    <div class="panel panel-default">
							<div class="panel-body"> 
								<div class="help">
									Swahili corpus ni mkusanyiko wa maneno ya Kiswahili kutoka kwenye hotuba, ya kufikirika, gazeti, majarida maarufu na bandiko ya kitaaluma. 
								</div>
							</div>
						</div>
					  </div>
				  </div>
	  </div>

	  <div class="tab-pane fade" id="frequency">
	     Mara ukitafuta, matokeo yataonekana hapa.
		 <?php
                $output = NULL;
				echo "<br />";
				echo "<br />";
                if (isset($_POST['search'])){
                        $search = $_POST['search'];            
                        $query = "SELECT content FROM corpus WHERE content LIKE '%$search%'";
                        $results = mysqli_query($connect, $query);

                        if($results->num_rows>0){
                                while($rows = $results->fetch_assoc()){
                                        $searchResults = $rows['content'];
                                }

                        $array = str_split($searchResults);
                        $pos = strpos($searchResults, $search);
						$search_length = strlen($search); 

                        // $lastPos=$_POST[0];
                        
                        while (($lastPos = strpos($searchResults, $search, $lastPos)) !== false) {
                                $occurances[]=$lastPos;
                                echo "....";

                                for($k=$lastPos-70;$k<$lastPos;$k++)
                                echo $array[$k];
                                for($k=$lastPos;$k<($lastPos + 20 + strlen($search)); $k++){
                                        if($k<($lastPos + strlen($search)))
                                        echo "<font color='orange'><b>$array[$k]</b></font>";
                                        else
                                        echo $array[$k];
                                }

                                echo "....";
                                echo "<br />";
                                echo "<br />";
                                
                                

                                $lastPos = $lastPos + strlen($search);
                        }

                        echo "<br />";
                        echo "The frequency of the searched word is: ",count($occurances);
                        echo "<br />";

                        }else{
                                echo "No match found";
                        }

                } ?>
	  </div>

	  <div class="tab-pane fade" id="context">
		  Mara ukitafuta, matokeo yataonekana hapa.
	  </div>
	 <!--The login page-->
	  <div class="tab-pane fade" id="login">
	     <form class="form-horizontal" action="includes/login.php" method="POST" id="login" name="Login_Form">
		 	<div class="form-group">
			 	<label class="control-label col-sm-2" for="username">Username</label>
				 <div class="col-sm-4">
				 	<input required type="text" class="form-control" id="username" name="username" placeholder="Enter username">
				 </div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="password">Password</label>
				<div class="col-sm-4">
					<input required type="password" class="form-control" id="password" name="password" placeholder="Enter password">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-6">
					<input type="submit" class="btn btn-default" id="Login" name="Login" value="Login">
				</div>
			</div>
		 </form>
	  </div>
			   
  </div>


</div>
</div>
	
<?php
	require_once('includes/footer.php');
?>
