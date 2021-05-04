<?php
session_start();
$server ='localhost';
$userName ='root';
$password = '';
$db = 'practice';
$table = 'person';
$conn = new mysqli($server,$userName,$password,$db);
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Insert post data in to db 

if(isset($_POST['first_name']) && $_POST['id']==''){
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];

    $sql= "INSERT INTO ".$table." (first_name,last_name,email) VALUES('". $fname ."','". $lname ."','". $email ."')";
    $success = $conn->query($sql);
    if($success == 1){
    $_session['success'] = "One Record inserted";
    
    }
    
}

//update record
if(isset($_POST['first_name']) && $_POST['id']!=''){
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $sql= "UPDATE ".$table." SET first_name='".$fname."' 
    ,last_name='".$fname."' 
    ,email='".$email."' WHERE ID=".$_POST['id'];
    $success = $conn->query($sql);
    if($success == 1){
         $_session['success'] = "One Record Updated";
   
    }

    
}

if(isset($_GET['id'])){
    //delete
    if(isset($_GET['delete'])){
    $sql = "DELETE FROM ".$table." WHERE ID = ".$_GET['id'];
    $success = $conn->query($sql);
    if($success == 1){
        $_session['success'] = "One Record Deleted";
        header('Location:dbconnection.php');
    }
        
        
        }
        //edit
        if(isset($_GET['edit'])){
       
            $sql = "SELECT * FROM ".$table." WHERE ID=".$_GET['id'];
            $result = $conn->query($sql);
            $result_row  = $result->fetch_array();
        }
       
}
//listing
$sql = "SELECT * FROM ".$table." ORDER BY first_name";
$result = $conn->query($sql);

?>
<div><?php if(isset($_session['success'])){echo $_session['success']; $_session['success']='';}?></div>
<?php //echo $result->num_rows;?>
<div  class="stylediv">
<table class="stylediv listtable">
<?php
if($result->num_rows>0){?>
    <tr>
        <th>
            First Name
        </th>
        <th>
            Last Name
        </th>
        <th>
            Email
        </th>
        <th>
            Action
        </th>
    </tr>
<?php 
while($row = $result->fetch_array()) {
    
?>
    <tr>
        <td>
        <?php echo $row['first_name'];?>
        </td>
        <td>
        <?php echo  $row['last_name'];?>
        </td>
        <td>
        <?php echo  $row['email'];?>
        </td>
        <td>
        <a href="dbconnection.php?id=<?php echo $row['ID'];?>&delete=delete">delete</a>
        <a href="dbconnection.php?id=<?php echo $row['ID'];?>&edit=edit">Edit</a>
        </td>
    </tr>
    <?php } ?>
</table>
  <?php
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<style>
body {
  background-color: #008068;
}
.stylediv{
    width: 100%;
    padding: 10px;
    text-align: center;
    margin: 0 auto;
    border: 1px solid #f97200;
    color: #fff;
}
.stylediv listtable{
    align:center;
    padding: 100px;
}
.stylediv formtable{
    align:center;
    
}
</style>
<body>
<form action="dbconnection.php"  method="post">
    
    <table class="stylediv formtable">
        <tr>
            <td>
                <label for="firstName">First Name:</label>
            </td>
            <td>
            <input type="hidden" name="id" id="id" value="<?php if(isset($_GET['edit'])){ echo $result_row['ID'];}?>" >
                <input type="text" name="first_name" id="firstName" value="<?php if(isset($_GET['edit'])){ echo $result_row['first_name'];}?>" required>
            </td>
        </tr>
        
        <tr>
            <td>
                <label for="lastName">Last Name:</label>
            </td>
            <td>
                <input type="text" name="last_name" id="lastName" value="<?php if(isset($_GET['edit'])){ echo $result_row['last_name'];}?>" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="email">Email:</label>
            </td>
            <td>
                <input type="text" name="email" id="email" value="<?php if(isset($_GET['edit'])){ echo $result_row['email'];} ?>" required>
            </td>
        </tr>
        <tr>
            <td>
               
            </td>
            <td>
                <input type="submit" name="submit" value="submit">
            </td>
        </tr>
    </table>    
</form>
</div>
</body>
</html>