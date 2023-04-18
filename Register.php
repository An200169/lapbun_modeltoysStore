<link rel="stylesheet" type="text/css" href="style.css"/>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/responsive.css">
<script src="js/jquery-3.2.0.min.js"/></script>
<script src="js/jquery.dataTables.min.js"/></script>
<script src="js/dataTables.bootstrap.min.js"/></script>

<?php
    include_once("connection.php");
    if(isset($_POST['btnRegister']))
    {   
        
        $us = $_POST["txtUsername"];
        $pa = $_POST["txtPass1"];
        $pa2 = $_POST["txtPass2"];
        $fname= $_POST["txtFullname"];
        $mail = $_POST["txtEmail"];
        $Address = $_POST["txtAddress"];
        $phone= $_POST["txtTel"];
        if(isset($_POST['grpRender'])){
            $sex = $_POST['grpRender'];
        }
        $date = $_POST['slDate'];
        $month = $_POST['slMonth'];
        $year = $_POST['slYear'];

        $err = "";
        // if($us =="" || $pa == "" || $pa2 == "" || $fname == "" || $mail == "" || $Address == "" || !isset($set)){
        //     $err.="<li>Enter feilds with mark (*), please</li>";
        // }
        if(strlen($pa) <=5){
            $err.="<li> password must be greater than 5 chars</li>";
        }
        if($pa != $pa2){
            $err.="<li> password and comfirm password must be same </li>";
        }
        if($_POST['slYear']=="0"){
            $err.="<li> choose your birth, please!";
        }
        if($err!=""){
            echo $err;
        }else
        {
            include_once("connection.php");
            $pass = md5($pa);
            $sq = "SELECT * FROM user WHERE Username='$us' OR email='$mail'";
            $res = pg_query($conn,$sq);
            if(pg_num_rows($res)==0){
                pg_query($conn,"INSERT INTO user (Username, Password, CustName, gender, Address, telephone, email, 
                CusDate, CusMonth, CusYear, SSN, ActiveCode, state) 
                VALUES ('$us', '$pass','$fname','$sex','$Address','$phone','$mail','$date','$month','$year','','',0)") 
                ;
                
                echo "you have registered succesfully";
            }else{
                echo "Username or email already exists";
            }
        }   
    }
?>




<div class="container">
        <h2>Member Registration</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
					<div class="form-group">
						    
                            <label for="txtTen" class="col-sm-2 control-label">Username(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtUsername" id="txtUsername" class="form-control" placeholder="Username" value="<?php if(isset($us)) echo $us; ?>"/>
							</div>
                      </div>  
                      
                       <div class="form-group">   
                            <label for="" class="col-sm-2 control-label">Password(*):  </label>
							<div class="col-sm-10">
							      <input type="password" name="txtPass1" id="txtPass1" class="form-control" placeholder="Password"/>
							</div>
                       </div>     
                       
                       <div class="form-group"> 
                            <label for="" class="col-sm-2 control-label">Confirm Password(*):  </label>
							<div class="col-sm-10">
							      <input type="password" name="txtPass2" id="txtPass2" class="form-control" placeholder="Confirm your Password"/>
							</div>
                       </div>     
                       
                       <div class="form-group">                               
                            <label for="lblFullName" class="col-sm-2 control-label">Full name(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtFullname" id="txtFullname" value="<?php if(isset($fname)) echo $fname; ?>" class="form-control" placeholder="Enter Fullname"/>
							</div>
                       </div> 
                       
                       <div class="form-group">      
                            <label for="lblEmail" class="col-sm-2 control-label">Email(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtEmail" id="txtEmail" value="<?php if(isset($mail)) echo $mail; ?>" class="form-control" placeholder="Email"/>
							</div>
                       </div>  
                       
                        <div class="form-group">   
                             <label for="lblDiaChi" class="col-sm-2 control-label">Address(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtAddress" id="txtAddress" value="<?php if(isset($Address)) echo $Address; ?>" class="form-control" placeholder="Address"/>
							</div>
                        </div>  
                        
                         <div class="form-group">  
                            <label for="lblDienThoai" class="col-sm-2 control-label">Telephone(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtTel" id="txtTel" value="<?php if(isset($phone)) echo $phone; ?>" class="form-control" placeholder="Telephone" />
							</div>
                         </div> 
                         
                          <div class="form-group">  
                            <label for="lblGioiTinh" class="col-sm-2 control-label">Gender(*):  </label>
							<div class="col-sm-10">                              
                                      <label class="radio-inline"><input type="radio" name="grpRender" value="0" id="grpRender"  />
                                      Male</label>
                                    
                                      <label class="radio-inline"><input type="radio" name="grpRender" value="1" id="grpRender" />
                                      
                                      Female</label>

							</div>
                          </div> 
                          
                          <div class="form-group"> 
                            <label for="lblNgaySinh" class="col-sm-2 control-label">Date of Birth(*):  </label>
                            <div class="col-sm-10 input-group">
                                <span class="input-group-btn">
                                  <select name="slDate" id="slDate" class="form-control" >
                						<option value="0">Choose Date</option>
										<?php
                                            for($i=1;$i<=31;$i++)
                                             {                                                
                                                 echo "<option value='".$i."'>".$i."</option>";
                                             }
                                        ?>
                				 </select>
                                </span>
                                <span class="input-group-btn">
                                  <select name="slMonth" id="slMonth" class="form-control">
                					<option value="0">Choose Month</option>
									<?php
                                        for($i=1;$i<=12;$i++)
                                         {
                                             echo "<option value='".$i."'>".$i."</option>";
                                         }
                          
                                    ?>
                				</select>
                                </span>
                                <span class="input-group-btn">
                                  <select name="slYear" id="slYear" class="form-control">
                                    <option value="0">Choose Year</option>
                                    <?php
                                        for($i=1970;$i<=2020;$i++)
                                         {
                                             echo "<option value='".$i."'>".$i."</option>";
                                         }
                                    ?>
                                </select>
                                </span>
                           </div>
                      </div>	
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnRegister" id="btnRegister" value="Register"/>
                              	
						</div>
                     </div>
				</form>
</div>
    

