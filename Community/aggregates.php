<?php
/*********************************************************************
* Author: Benard Koech
* Email: benardkkoech@gmail.com.
* Gender Base violence Information system
***********************************************************************/
//users_accounts.php
  $page_title = "Health indicators| GBV";
    $current_page = "Health indicators";
	
require_once 'includes/global.inc.php';

// Same as error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);

 //check to see if they're logged in
if(isset($_SESSION['logged_in'])) {

//get the user object from the session
$user = unserialize($_SESSION['user']);

//initialize php variables used in the form
$indicator_name = "";
$country= "";
$county= "";
$sub_county= "";
$sector = "";
$aggregate= "";
$error = ""; 

//check to see that the form has been submitted


	
include "includes/header.php"; 
include_once('../includes/connection.php');
include_once('includes/functions.php');

?>

	    <div id="sidebar">
	  <center><h3 style="text-size:18px; font-family: TStar-Bol"></h3></center>
<div class="sidebar-nav">
	<?php
	  include "includes/sidebar.php"; 
	  ?>
	</div> 
	  </div> 
	  <div id="main-content">
	    <div id="bread-crumbs">
	      <!--breadcrumbs-->
	    </div>
        <div id="content-body">
		
        <div class="" align="left"> 
        
        
              
		<section class="" style="width:85%;">
	       <form action="#">
          <input type="text" name="search" value="" id="id_search" placeholder="Filter records here" autofocus />
           <a class="link-btn" href="add_aggregates.php">New Aggregates</a>
          <a class="link-btn" href="export_aggregatesCsv.php">Export to csv</a>
           <a class="link-btn" href="export_aggregatesExcel.php">Export to excel</a>
            
        </form>
		</section>
		 <hr size="1" color="#CCCCCC">
        <div class="profile-data" align="left">
            <table width="100%" border="0" align="center" cellspacing="1" class="table-hover">
            <thead>
                          <th align="left" width="25px"><b>ID</b></th>
			  <th align="left"><b>Indicator</b></th>
			  <th align="left"><b>County</b></th>
			  <th align="left"><b>Survey Period</b></th>
			    <th align="left"><b>Agregates</b></th>
			     <th align="left"><b>Date</b></th>
                          <th align="left"><b>View</b></th>
                          <th align="left"><b>Edit</b></th>
			  <th align="left"><b>Delete</b></th>
            </thead>
            <?php

     $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
            if ($page <= 0) $page = 1;
 
          $per_page = 12; // Set how many records do you want to display per page.
 
          $startpoint = ($page * $per_page) - $per_page;
 
       $statement = "`health_aggregates` ORDER BY `id` ASC"; // Change `records` according to your table name.
  
       $results = mysqli_query($conDB,"SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}");
        
        if (mysqli_num_rows($results)!= 0) {
     
       // displaying records.
        while ($row = mysqli_fetch_array($results)) {
        
        $id= $row['id'];
        $indicator = $row['indicator_id'];
        $county =$row['county_id'];
        $survey =$row['survey_id'];
        $aggregate=$row['aggregate'];
        $date =$row['date'];
        
    ?>
              <tr bgcolor="#FFFFFF" style="border-bottom: 1px solid #B4B5B0;">
                                 <td><?php echo $id; ?></td>
                                  <?php  
				 $indicator_results = $db->selectData("indicators"," indicator_id = $indicator");

                                 foreach ($indicator_results as $urows) 
                                  {
  
                                   $indicator = $urows['indicator_id'];
                                   $indicator_name = $urows['indicator'];
                                   }
                                   ?>
				 <td><?php echo $indicator_name; ?></td>
				  <?php  
				 $county_results = $db->selectData("counties"," county_id = $county");

                                 foreach ($county_results as $urows) 
                                  {
  
                                   $county = $urows['county_id'];
                                   $county_name = $urows['county_name'];
                                   }
                                   ?>
				   <td><?php echo $county_name; ?></td>
				    <?php  
				 $survey_results = $db->selectData("surveys"," survey_id = $survey");

                                 foreach ($survey_results as $urows) 
                                  {
  
                                   $survey_id = $urows['survey_id'];
                                   $survey_period = $urows['survey_period'];
                                   }
                                   ?>
				   <td><?php echo $survey_period; ?></td>
				   <td><?php echo $aggregate; ?></td>
				<td><?php echo $date; ?></td>
                 <td align="center"><a href=''><img src="images/icons/view2.png" height="20px"/><a></td>
		<td align="center"><a href='javascript:void(0)' onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"><img src="images/icons/edit2.png" height="20px" /></a></td>
                <td align="center"><a href='javascript:void(0)" onclick='show_confirm(<?php echo $id; ?>);'><img src="images/icons/delete.png" height="20px"/></a></td>
              </tr>
            <?php
            }
            } 
            else
            {
            ?>
            <tr>
          <td colspan="8"><?php echo "No records are found.";?></td>
          </tr>
              <?php }
            
 // displaying paginaiton.
        ?>
       <tr>
          <td colspan="8"><?php echo pagination($statement,$per_page,$page,$url='?');?></td>
          </tr>
          </table>
      <br clear="all"><br clear="all"><br clear="all">
      </div><br clear="all">
	  </div>
   
		</div>		
	  </div> 
      </div>
	  <br clear="all">
	    </div> 		
	  </div> 
	  <!--Pop up starts here -->
	  
	<div id="light" class="white_content"><div class="popup-area"><div class="popup-top-menu"><section style="float:left;"></section><section style="float:right;"><a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a></section></div>
	<div class="popup-Content">This is the lightbox content.
	

	
	</div> 
	</div>
	</div>	
      <!--Pop up ends here -->
      
      
<!--filter includes-->
    <script type="text/javascript" src="css/filter-as-you-type/jquery.min.js"></script>
    <script type="text/javascript" src="css/filter-as-you-type/jquery.quicksearch.js"></script>
    <script type="text/javascript">
                $(function() {
                  $('input#id_search').quicksearch('table tbody tr');
                });
    </script>
    <script>
      function show_confirm(id) {
        if (confirm("Are you Sure you want to delete?")) {
          location.replace('users_accounts.php?id=' + id);
        } else {
          return false;
        }
      }
    </script>
	<script type="text/javascript" >
	


	
<?php
 include "includes/footer.php";
	
	}

else
{
	//Redirect user back to login page if there is no valid session created
	header("location: ../login.php");
}
?>
