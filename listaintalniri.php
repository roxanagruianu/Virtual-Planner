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
    <title>Intalniri</title>
    <link rel="stylesheet" href="css/s5.css">
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

  <div id="container">
    <div id="clock"></div>
    <script>
    function timp(){
      var date = new Date();
      var h = date.getHours();
      var m =date.getMinutes();
      if(m<10){var time = h+ ":0" + m;}
      else{var time = h + ":" + m;}
      document.getElementById('clock').innerText=time;
      document.getElementById('clock').textContent = time;
      setTimeout(showTime, 1000);
    }
    timp();
    </script>
      <div id="header">
        <div id="monthDisplay"></div>
        <div>
          <button id="backButton">Inapoi</button>
          <button id="nextButton">Inainte</button>
        </div>
      </div>
      <div id="weekdays">
        <div>Duminica</div>
        <div>Luni</div>
        <div>Marti</div>
        <div>Miercuri</div>
        <div>Joi</div>
        <div>Vineri</div>
        <div>Sambata</div>
      </div>
      <div id="calendar">
      </div>
    </div>
    <div class="main-section">
       <div class="add-section">
          <form action="add2.php" method="POST" autocomplete="off">
             <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
               <input type="date"
                      name="zi"
                      style="border-color: #ff6666"
                      placeholder="Data" />
               <input type="time"
                      name="ora"
                      style="border-color: #ff6666"
                      placeholder="Ora" />
                <input type="text"
                       name="locatie"
                       style="border-color: #ff6666"
                       placeholder="Locatie" />
               <input type="text"
                      name="descriere"
                      style="border-color: #ff6666"
                      placeholder="Descriere" />
              <button type="submit">Adaugati</button>
             <?php }else{ ?>
               <input type="date"
                      name="zi"
                      placeholder="Data" />
               <input type="time"
                      name="ora"
                      placeholder="Ora" />
                <input type="text"
                       name="locatie"
                       placeholder="Locatie" />
               <input type="text"
                      name="descriere"
                      placeholder="Descriere" />
              <button type="submit">Adaugati</button>
             <?php } ?>
          </form>
       </div>
       <?php
          $intalniri = $conn->query("SELECT * FROM intalniri WHERE nume='$nume' ORDER BY zi ASC,ora");
       ?>

       <div class="show-intalniri">
            <?php if($intalniri->rowCount() <= 0){ ?>
                <div class="intalniri-item">
                    <div class="empty">
                    </div>
                </div>
            <?php } ?>

            <?php while($intalnire = $intalniri->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="intalniri-item">
                    <span id="<?php echo $intalnire['id']; ?>"
                          class="remove-intalniri">x</span>
                    <?php ?>
                    <h2><?php
                    echo "Data - ";
                    $data= date("d/m",strtotime($intalnire['zi']));
                    echo $data," Ora - ";
                    $ora= date("H:i",strtotime($intalnire['ora']));
                    echo $ora;
                    echo " Loc - ",$intalnire['locatie']," - ",$intalnire['descriere'];
                    ?></h2>
                    <br>
                </div>
            <?php } ?>
       </div>
    </div>
    <script src="js/script.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.remove-intalniri').click(function(){
                const id = $(this).attr('id');

                $.post("remove2.php",
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
