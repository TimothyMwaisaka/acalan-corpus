<?php
require_once('includes/header.php');
include('connection/connect.php');

?>
<div class="container">
        <div class="row">

        <?php
                $output = NULL;

                if (isset($_POST['search'])){
                        $search = $_POST['search'];            
                        $query = "SELECT content FROM corpus WHERE content LIKE '%$search%'";
                        $results = mysqli_query($connect, $query);

                        if($results->num_rows>0){
                                while($rows = $results->fetch_assoc()){
                                        $searchResults = $rows['content'];

                                        // $output = "The search Results are: <br />$searchResults <br />";
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
                                        echo "<font color='red'><b>$array[$k]</b></font>";
                                        else
                                        echo $array[$k];
                                }

                                // for($k=$lastPos;$k<($lastPos+70+strlen($search));$k++)
                                // echo $array[$k];

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
                </div>




<div class="container">
        <?php
                require_once('includes/footer.php');
        ?>
</div>