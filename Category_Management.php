    <!-- Bootstrap --> 
    <link rel="stylesheet" type="text/css" href="style.css"/>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <form name="frm" method="post" action="">
    <h1>Product Category</h1>
    <a href="?page=addcategory"><p>
    <img src="images/add.png" alt="Add new" width="16" height="16" border="0" />  Add </p></a>
        
    <script>
        function deleteConfirm(){
            if(confirm("Are you sure to delete!")){
                return true;
            }else{
                return false;
            }
        }
    </script>

    <?php
        include_once ("connection.php");
        if(isset($_GET["function"])=="del"){
            if(isset($_GET["id"])){
                $id = $_GET["id"];
                pg_query($conn, "DELETE FROM category WHERE Cat_ID = '$id'");
            }
        }
    ?>

        <table id="tablecategory" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Category Name</strong></th>
                     <th><strong>Desscription</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
                include_once ("connection.php");
                $No = 1;
                $result = pg_query($conn,"SELECT * FROM category");
                while($row = pg_fetch_array($result)) 
                {
            ?>
			<tr>
              <td class="cotCheckBox"><?php echo $No; ?></td>
              <td><?php echo $row["Cat_Name"];?></td>
              <td><?php echo $row["Cat_Des"];?></td>

              <td style='text-align:center'><a href="?page=editcategory&&id=<?php echo $row["Cat_ID"]; ?>"><img src='images/edit.png' border='0'/></a></td>
              <td style='text-align:center'><a href="?page=category&&function=del&&id=<?php echo $row["Cat_ID"]; ?>" onclick="return deleteConfirm()" ><img src='images/delete.png' border='0' /></a></td>
            </tr>
            <?php
                $No++;
                }
            ?>
			</tbody>
        </table>  
        
        
        
        <div class="row" style="background-color:#FFF">
            <div class="col-md-12">
            	
            </div>
        </div>
 </form>
   