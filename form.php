<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
<form action="dbconnection.php"  method="post">
    
    <table>
        <tr>
            <td>
                <label for="firstName">First Name:</label>
            </td>
            <td>
                <input type="text" name="first_name" id="firstName" required>
            </td>
        </tr>
        
        <tr>
            <td>
                <label for="lastName">Last Name:</label>
            </td>
            <td>
                <input type="text" name="last_name" id="lastName" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="email">Email:</label>
            </td>
            <td>
                <input type="text" name="email" id="email" required>
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
   
</body>
</html>