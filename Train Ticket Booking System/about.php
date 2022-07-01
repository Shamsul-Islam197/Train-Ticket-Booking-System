<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/about.css" />
    <title>BD Railway</title>
  </head>
  <body>
    <div class="container">
      <div class="nav">
        <div class="logo">
          <img src="./images/logo.png" alt="logo" width="60px" height="60px" />
          <a class="logo-text">Bangladesh Railway</a>
        </div>
        <div class="menu">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="log.php"><?php if(isset($_SESSION['user_id'])){
              echo "Logout";
        }else{
            echo "Login";
        } ?></a></li>
            <li><a href="reg.php">Register</a></li>
            <li><a href="verify.php">Verify Ticket</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li class="active"><a href="about.php">About Us</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="team-section">
      <h1>Our Team</h1>
      <span class="border"></span>
      <div class="ps">
        <a href="#boy1"><img src="images/boy1.jpg" alt="" /></a>
        <a href="#girl"><img src="images/girl.jpg" alt="" /></a>
        <a href="#boy2"><img src="images/boy2.jpg" alt="" /></a>
        <a href="#girl2"><img src="images/girl2.jpg" alt="" /></a>
      </div>

      <div class="section" id="boy1">
        <span class="name">Shamsul Islam</span>
        <span class="border"></span>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
          eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
          minim veniam, quis nostrud exercitation ullamco laboris nisi ut
          aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
          pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
          culpa qui officia deserunt mollit anim id est laborum.
        </p>
      </div>

      <div class="section" id="girl">
        <span class="name">Mohima Rahman Sinthy</span>
        <span class="border"></span>
        <p>
          Sed ut perspiciatis unde omnis iste natus error sit voluptatem
          accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae
          ab illo inventore veritatis et quasi architecto beatae vitae dicta
          sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit
          aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos
          qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui
          dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed
          quia non numquam eius modi tempora incidunt ut labore et dolore magnam
          aliquam quaerat voluptatem.
        </p>
      </div>

      <div class="section" id="boy2">
        <span class="name">Jibon Islam</span>
        <span class="border"></span>
        <p>
          At vero eos et accusamus et iusto odio dignissimos ducimus qui
          blanditiis praesentium voluptatum deleniti atque corrupti quos dolores
          et quas molestias excepturi sint occaecati cupiditate non provident,
          similique sunt in culpa qui officia deserunt mollitia animi, id est
          laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita
          distinctio. Nam libero tempore, cum soluta nobis est eligendi optio
          cumque nihil impedit quo minus id quod maxime placeat facere possimus,
          omnis voluptas assumenda est, omnis dolor repellendus.
        </p>
      </div>

      <div class="section" id="girl2">
        <span class="name">Monowara Sidique</span>
        <span class="border"></span>
        <p>
          Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil
          impedit quo minus id quod maxime placeat facere possimus, omnis
          voluptas assumenda est, omnis dolor repellendus. Temporibus autem
          quibusdam et aut officiis debitis aut rerum necessitatibus saepe
          eveniet ut et voluptates repudiandae sint et molestiae non recusandae.
          Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis
          voluptatibus maiores alias consequatur aut perferendis doloribus
          asperiores repellat.
        </p>
      </div>
    </div>

    <div class="footer"></div>
  </body>
</html>
