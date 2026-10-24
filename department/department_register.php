<?php

include("../database/db.php")
;

$message = ""
;

if(isset($_POST['register']))
{
    $name = trim($_POST['name'])
    ;

    $username = trim($_POST['username'])
    ;

    $password = trim($_POST['password'])
    ;

    $department = trim($_POST['department'])
    ;


    // CHECK USERNAME

    $check = "SELECT * FROM departments

              WHERE username='$username'"
    ;


    $result = mysqli_query($conn, $check)
    ;


    if(!$result)
    {
        die("Database Error: "
            . mysqli_error($conn))
        ;
    }


    if(mysqli_num_rows($result) > 0)
    {
        $message = "Username already exists"
        ;
    }

    else
    {

        // INSERT DEPARTMENT USER

        $sql = "INSERT INTO departments

                (department_name,
                 name,
                 username,
                 password)

                VALUES

                ('$department',
                 '$name',
                 '$username',
                 '$password')"
        ;


        if(mysqli_query($conn, $sql))
        {
            echo "<script>

                alert('Registration Successful');

                window.location='department_login.php';

            </script>"
            ;

            exit()
            ;
        }

        else
        {
            $message = "Registration Failed: "
                     . mysqli_error($conn)
            ;
        }
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8"

>

<meta name="viewport"
content="width=device-width,
initial-scale=1.0"

>

<title>
Department Registration - SSCMS
</title>

<style>

*{
    margin:0
    ;

    padding:0
    ;

    box-sizing:border-box
    ;

    font-family:Arial
    ;
}


body{

    min-height:100vh
    ;

    display:flex
    ;

    justify-content:center
    ;

    align-items:center
    ;

    background:linear-gradient(

        135deg,

        #164a41,

        #4caf50

    )
    ;

}


.register-box{

    width:420px
    ;

    max-width:90%
    ;

    background:white
    ;

    padding:35px
    ;

    border-radius:15px
    ;

    text-align:center
    ;

    box-shadow:0 10px 30px

    rgba(0,0,0,.3)
    ;

}


.logo{

    width:70px
    ;

    height:70px
    ;

    object-fit:contain
    ;

    display:block
    ;

    margin:0 auto 15px
    ;

}


h2{

    color:#164a41
    ;

    margin-bottom:20px
    ;

}


input,
select{

    width:100%
    ;

    padding:13px
    ;

    margin:10px 0
    ;

    border:1px solid #ccc
    ;

    border-radius:6px
    ;

    font-size:16px
    ;

}


button{

    width:100%
    ;

    padding:13px
    ;

    margin-top:15px
    ;

    background:#164a41
    ;

    color:white
    ;

    border:none
    ;

    border-radius:6px
    ;

    font-size:17px
    ;

    cursor:pointer
    ;

}


button:hover{

    background:#26796a
    ;

}


.error{

    color:red
    ;

    margin-bottom:15px
    ;

}


a{

    display:block
    ;

    margin-top:20px
    ;

    color:#164a41
    ;

    text-decoration:none
    ;

    font-weight:bold
    ;

}

</style>

</head>

<body>

<div class="register-box">

<img src="../images/college-logo.png"

```
 alt="College Logo"

 class="logo"
```

>

<h2>

📝 Department Registration

</h2>

<?php

if($message != "")
{
    echo "<p class='error'>"
    ;

    echo $message
    ;

    echo "</p>"
    ;
}

?>

<form method="POST">

<input

```
type="text"

name="name"

placeholder="Enter Teacher Name"

required
```

>

<input

```
type="text"

name="username"

placeholder="Create Username"

required
```

>

<input

```
type="password"

name="password"

placeholder="Create Password"

required
```

>

<select

```
name="department"

required
```

>

<option value="">

Select Department

</option>

<option value="CME">

CME

</option>

<option value="ECE">

ECE

</option>

<option value="Mechanical">

Mechanical

</option>

</select>

<button

```
type="submit"

name="register"
```

>

📝 Register

</button>

</form>

<a href="department_login.php">

🔐 Already Registered? Login

</a>

<a href="../index.php">

🏠 Back to Home

</a>

</div>

</body>

</html>
