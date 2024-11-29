<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="../Css/style.css">
</head>
<body>
     <form action="signup-check.php" method="post">
     	<h2>SIGN UP</h2>
     	
     	<!-- Display error messages if any -->
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

        <!-- Display success messages if any -->
        <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

               <!-- User ID Field -->
        <label>User ID</label>
        <?php if (isset($_GET['user_id'])) { ?>
               <input type="text" 
                      name="user_id" 
                      placeholder="User ID"
                      value="<?php echo $_GET['user_id']; ?>"><br>
        <?php } else { ?>
               <input type="text" 
                      name="user_id" 
                      placeholder="User ID"><br>
        <?php } ?>
        <!-- Name Field -->
        <label>Name</label>
        <?php if (isset($_GET['name'])) { ?>
               <input type="text" 
                      name="name" 
                      placeholder="Name"
                      value="<?php echo $_GET['name']; ?>"><br>
        <?php } else { ?>
               <input type="text" 
                      name="name" 
                      placeholder="Name"><br>
        <?php } ?>

        <!-- Username Field -->
        <label>Username</label>
        <?php if (isset($_GET['username'])) { ?>
               <input type="text" 
                      name="username" 
                      placeholder="Username"
                      value="<?php echo $_GET['username']; ?>"><br>
        <?php } else { ?>
               <input type="text" 
                      name="username" 
                      placeholder="Username"><br>
        <?php } ?>

     	<!-- Password Field -->
     	<label>Password</label>
     	<input type="password" 
                 name="password" 
                 placeholder="Password"><br>

        <!-- Re-enter Password Field -->
        <label>Re-enter Password</label>
        <input type="password" 
                 name="re_password" 
                 placeholder="Re-enter Password"><br>

        <!-- Email Field -->
        <label>Email</label>
        <?php if (isset($_GET['email'])) { ?>
               <input type="email" 
                      name="email" 
                      placeholder="Email"
                      value="<?php echo $_GET['email']; ?>"><br>
        <?php } else { ?>
               <input type="email" 
                      name="email" 
                      placeholder="Email"><br>
        <?php } ?>

        <!-- Login Type Selection -->
        <label>Login Type</label>
        <select name="login_type">
            <option value="User" <?php if(isset($_GET['login_type']) && $_GET['login_type'] == 'User') echo 'selected'; ?>>User</option>
            <option value="Admin" <?php if(isset($_GET['login_type']) && $_GET['login_type'] == 'Admin') echo 'selected'; ?>>Admin</option>
        </select><br>

     	<!-- Submit Button -->
     	<button type="submit">Sign Up</button>

        <!-- Link to Login Page -->
        <a href="adminindex.php" class="ca">Already have an account?</a>
     </form>
</body>
</html>
