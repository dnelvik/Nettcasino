<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/spill.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Om oss</title>
  </head>
  <body>
    <?php include('header.php'); ?>
<?php if(isset($_GET['spill'])) : ?>
<div id="id02" class="modal" style="display: block">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      <!-- Modal Content -->
      <div class="modal-content animate">
        <div class="content-main">
          <h1 style="color:red;"><?php echo $_GET['spill'] ?></h1>
          <p>Dette spillet er desverre ikke tilgjenelig..</p>
        </div>

      </div>
    </div>
<?php endif ?>

    <!--Dette er hoved innhold på siden:-->
    <div class="sticky-sort">
      <label class="optionbar sort-header " >Sorter</label>
      <label><input onclick="visSpill(this.value)" name="sort" type="radio" value="mestspilt" ><div class="optionbar">Mest spilt</div>  </label>
      <label><input onclick="visSpill(this.value)" name="sort" checked="checked" type="radio" value="a-z" ><div class="optionbar">A - Z</div></label>
      <label><input onclick="visSpill(this.value)" name="sort" type="radio" value="z-a" ><div class="optionbar">Z - A</div></label>

    </div>
    
    <main id="spill-main" class="wrapper-spill">

    </main>


    <?php include('footer.php'); ?>
    <script>
      var modal = document.getElementById('id02');

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
          if (event.target == modal) {
              modal.style.display = "none";
          }

      }

      function visSpill(sort) {
        search(sort);

      }

      //Kode for realtime søk
      function search(string){
        var sok = "<?php isset($_GET['sok']) ? Print($_GET['sok']) : ''; ?>";
        var spill = "<?php isset($_GET['spill']) ? Print($_GET['spill']) : ''; ?>";

        var xmlhttp;
        if(window.XMLHttpRequest){
          xmlhttp = new XMLHttpRequest();
        }else{
          xmlhttp = new ActiveXObject("XMLHTTP");
        }
        xmlhttp.onreadystatechange = function(){
          if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            if(xmlhttp.responseText == ''){
              window.location.href = 'spill.php?spill=' + sok;
            }
            document.getElementById("spill-main").innerHTML = xmlhttp.responseText;
          }
        }
        xmlhttp.open("GET", "server.php?sortby="+string+"&sok="+sok, true);
        xmlhttp.send(null);
      }

      // Funksjon som kjører når siden blir vist.
      (function() {
            visSpill('a-z');
      })();

    </script>
  </body>
</html>