<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Passwords | CipherShield</title>
    <link rel="stylesheet" href="./css/view_passwords.css"/>
</head>
<body>
    <header>
        <div class="logo"></div>
        <div class="view_password_title">
            <h1>View Passwords - CipherShield</h1>
        </div>
        <div class="logout"><a href="logout.php">Logout</a></div>
    </header>
    <div class="main">
        <table>
            <thead>
                <tr>
                    <th class="application_name">Application Name</th>
                    <th class="user_id">UserID</th>
                    <th class="password_heading">Password</th>
                    <th class="category">Category</th>
                    <th class="sec_qna">Security QN/A</th>
                    <th class="twofa">2FA Info</th>
                    <th class="actions_heading">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="name_row">Facebook</td>
                    <td>miss.programmerr</td>
                    <td>apnabanale123@#$</td>
                    <td>Social</td>
                    <td>None</td>
                    <td>Samsung device approval or Pin code number</td>
                    <td><button class="edit_btn" type="button" onclick="redirectTo('edit')">Edit</button><button class="delete_btn" type="button" onclick="redirectTo('delete')">Delete</button></td>
                </tr>
                <tr>
                    <td class="name_row">Facebook</td>
                    <td>miss.programmerr</td>
                    <td>apnabanale123@#$</td>
                    <td>Social</td>
                    <td>None</td>
                    <td>Samsung device approval or Pin code number</td>
                    <td><button class="edit_btn" type="button" onclick="redirectTo('edit')">Edit</button><button class="delete_btn" type="button" onclick="redirectTo('delete')">Delete</button></td>
                </tr>
                <tr>
                    <td class="name_row">Facebook</td>
                    <td>miss.programmerr</td>
                    <td>apnabanale123@#$</td>
                    <td>Social</td>
                    <td>None</td>
                    <td>Samsung device approval or Pin code number</td>
                    <td><button class="edit_btn" type="button" onclick="redirectTo('edit')">Edit</button><button class="delete_btn" type="button" onclick="redirectTo('delete')">Delete</button></td>
                </tr>
                <tr>
                    <td class="name_row">Facebook</td>
                    <td>miss.programmerr</td>
                    <td>apnabanale123@#$</td>
                    <td>Social</td>
                    <td>None</td>
                    <td>Samsung device approval or Pin code number</td>
                    <td><button class="edit_btn" type="button" onclick="redirectTo('edit')">Edit</button><button class="delete_btn" type="button" onclick="redirectTo('delete')">Delete</button></td>
                </tr>
                <tr>
                    <td class="name_row">Facebook</td>
                    <td>miss.programmerr</td>
                    <td>apnabanale123@#$</td>
                    <td>Social</td>
                    <td>None</td>
                    <td>Samsung device approval or Pin code number</td>
                    <td><button class="edit_btn" type="button" onclick="redirectTo('edit')">Edit</button><button class="delete_btn" type="button" onclick="redirectTo('delete')">Delete</button></td>
                </tr>
                <tr>
                    <td class="name_row">Facebook</td>
                    <td>miss.programmerr</td>
                    <td>apnabanale123@#$</td>
                    <td>Social</td>
                    <td>None</td>
                    <td>Samsung device approval or Pin code number</td>
                    <td><button class="edit_btn" type="button" onclick="redirectTo('edit')">Edit</button><button class="delete_btn" type="button" onclick="redirectTo('delete')">Delete</button></td>
                </tr>
                
            </tbody>
        </table>
    </div>
    <script>
        function redirectTo(page){
            if(page === 'edit'){
                window.location.href = "edit_password.php";
            }else{
                window.location.href = "delete_password.php";
            }
        }
    </script>
</body>
</html>