<!-- Denne siden inneholder registreringsskjema hvor brukeren oppretter en ny konto-->

<!DOCTYPE html>
<html lang="no">
<head>
  <title>Bygda Casino| Registrering</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/registrer.css">
  <link rel="stylesheet" type="text/css" href="css/login.css">
   <meta charset="UTF-8">
</head>
<body>
<?php include('header.php');?>
<!-- Kaster bruker til index hvis allerede logget inn -->
<?php   if (isset($_SESSION['brukernavn'])) {
  echo "<script language='javascript'>window.location.href='index.php';</script>";
  }
?>
  <main class="content">
    <div id="main-reg">
      <form method="post" action="register.php">
        <h1>Registrering</h1>
        <?php include('errors.php'); ?>
        <div class="form-container"><input placeholder="Brukernavn.." class="form-design" type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>"></div>
        <div class="form-container"><input placeholder="Email.." class="form-design" type="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"></div>
        <!-- dato blir ikke validert pga php -->
        <div class="form-container"><input class="form-design" type="date" value="<?php echo isset($_POST['f_dato']) ? $_POST['f_dato'] : '' ?>" name="f_dato"></div>
        <div class="form-container"><input placeholder="Passord.." class="form-design" type="password" name="passord_1"></div>
        <div class="form-container"><input placeholder="Bekreft passord.." class="form-design" type="password" name="passord_2"></div>
        <div class="form-container"><button type="submit" class="btn-form" name="reg_bruker">Registrer</button></div>
        <p>Allerede medlem? <a style="cursor:pointer;" onclick="document.getElementById('id01').style.display='block',slettError()">Logg inn</a> </p>
      </form>
    </div>
  </main>
  <?php include('footer.php') ?>
</body>
</html>
