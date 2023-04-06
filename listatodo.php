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
    <title>To-Do List</title>
    <link rel="stylesheet" href="s3.css">
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
      <div class="head">
            <div id="date">
              <?php  echo date("l"),",",date("d.m")   ?>
            </div>
        </div>
       <div class="add-section">
          <form action="add.php" method="POST" autocomplete="off">
             <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                <input type="text"
                     name="title"
                     style="border-color: #ff6666"
                     placeholder="This field is required" />
              <button type="submit">Adaugati &nbsp; <span>&#43;</span></button>

             <?php }else{ ?>
              <input type="text"
                     name="title"
                     placeholder="What do you need to do?" />
              <button type="submit">Adaugati &nbsp; <span>&#43;</span></button>
             <?php } ?>
          </form>
       </div>
       <?php
          $todos = $conn->query("SELECT * FROM todos WHERE nume='$nume'");
       ?>
       <div class="show-todo-section">
            <?php if($todos->rowCount() <= 0){ ?>
                <div class="todo-item">
                    <div class="empty">
                    </div>
                </div>
            <?php } ?>

            <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">
                    <span id="<?php echo $todo['id']; ?>"
                          class="remove-to-do">x</span>
                    <?php if($todo['checked']){ ?>
                        <input type="checkbox"
                               class="check-box"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               checked />
                        <h2 class="checked"><?php echo $todo['title'] ?></h2>
                    <?php }else { ?>
                        <input type="checkbox"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               class="check-box" />
                        <h2><?php echo $todo['title'] ?></h2>
                    <?php } ?>
                    <br>
                </div>
            <?php } ?>
       </div>
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');

                $.post("remove.php",
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

            $(".check-box").click(function(e){
                const id = $(this).attr('data-todo-id');

                $.post('check.php',
                      {
                          id: id
                      },
                      (data) => {
                          if(data != 'error'){
                              const h2 = $(this).next();
                              if(data === '1'){
                                  h2.removeClass('checked');
                              }else {
                                  h2.addClass('checked');
                              }
                          }
                      }
                );
            });
        });
    </script>
</body>
</html>
