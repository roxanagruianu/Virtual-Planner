<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/s1.css">
</head>
<body>
  <div class="header">
    <img src="2logo.png">
  </div>
  <div class="container">
    <div class="card">
      <div class="inner-box" id="card">
        <div class="card-front">
            <h2>Login</h2>
            <form action="validare.php" method="post">
              <input type="text" name="user" class="input-box" placeholder="Username" required>
              <input type="password" name="password" class="input-box" placeholder="Password" required>
              <button type="submit" class="submit-btn">Submit</button>
            </form>
            <button type="button" class="btn" onclick="openRegister()">I don't have an account</button>
        </div>
        <div class="card-back">
           <h2>Sign up</h2>
           <form action="inregistrare.php" method="post">
             <input type="text" name="user" class="input-box" placeholder="Username" required>
             <input type="password" name="password" class="input-box" placeholder="Password" required>
             <button type="submit" class="submit-btn">Submit</button>
           </form>
           <button type="button" class="btn" onclick="openLogin()">I have an account</button>
         </div>
      </div>
    </div>
  </div>
  <script>
  var  card = document.getElementById("card");
  function openRegister(){
    card.style.transform = "rotateY(-180deg)";
  }
  function openLogin(){
    card.style.transform = "rotateY(0deg)";
  }
  </script>
</body>
</html>
