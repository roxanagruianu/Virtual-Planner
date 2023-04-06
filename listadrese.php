<?php
require 'db_conn.php';
session_start();
$nume= $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Date de contact</title>
    <link rel="stylesheet" href="css/s4.css">
</head>
<body>
  <div class="header">
    <img src="2logo.png">
    <div class="log">
      <button type="button" id="myButton">Deconectati-va</button>
      <script type="text/javascript">
      document.getElementById("myButton").onclick = function () {
        location.href = "logout.php";
      };
      </script>
    </div>
    <div class="dropdown">
      <button class="dropbtn">Meniu</button>
        <div class="dropdown-content">
          <a href="listatodo.php">Agenda</a>
          <a href="listadrese.php">Date de contact</a>
          <a href="listaintalniri.php">Intalniri</a>
        </div>
      </div>
  </div>
    <div class="main-section">
       <div class="add-section">
          <form action="add1.php" method="POST" autocomplete="off">
             <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
               <input type="text"
                    name="title"
                    style="border-color: #ff6666"
                    placeholder="Numele persoanei/companiei" />
               <input type="text"
                    name="oras"
                    style="border-color: #ff6666"
                    placeholder="Oras" />
               <input type="text"
                    name="strada"
                    style="border-color: #ff6666"
                    placeholder="Strada" />
              <input type="text"
                    name="telefon"
                    style="border-color: #ff6666"
                    placeholder="Telefon" />
              <input type="text"
                    name="email"
                    style="border-color: #ff6666"
                    placeholder="Email" />
              <button type="submit">Adaugati</button>

             <?php }else{ ?>
              <input type="text"
                     name="title"
                     placeholder="Numele persoanei/companiei" />
               <input type="text"
                      name="oras"
                      placeholder="Oras" />
              <input type="text"
                     name="strada"
                     placeholder="Strada" />
              <input type="text"
                     name="telefon"
                     placeholder="Telefon" />
              <input type="text"
                     name="email"
                     placeholder="Email" />
              <button type="submit">Adaugati</button>
             <?php } ?>
          </form>
       </div>
       <?php
          $adrese = $conn->query("SELECT * FROM adrese WHERE nume='$nume'");
       ?>
       <div class="show-adrese">
            <?php if($adrese->rowCount() <= 0){ ?>
                <div class="adresa-item">
                    <div class="empty">
                    </div>
                </div>
            <?php } ?>

            <?php while($adresa = $adrese->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="adresa-item">
                    <span id="<?php echo $adresa['id']; ?>"
                          class="remove-adresa">x</span>
                    <?php ?>
                        <h2><?php
                        echo $adresa['name'];
                        if(empty($adresa['oras'])===false){echo " - Oras: ",$adresa['oras']; }
                        if(empty($adresa['strada'])===false){echo " - Strada: ",$adresa['strada']; }
                        if(empty($adresa['telefon'])===false){echo " - Telefon: ",$adresa['telefon']; }
                        if(empty($adresa['email'])===false){echo " - Email: ",$adresa['email']; }
                        ?></h2>
                    <br>
                </div>
            <?php } ?>
       </div>
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.remove-adresa').click(function(){
                const id = $(this).attr('id');

                $.post("remove1.php",
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                             $(this).parent().hide(600);
                         }
                      }
                );
            });
        });
    </script>
</body>
</html>
