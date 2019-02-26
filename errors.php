
<!--Errrors.php behander alle feilmeldinger og suksessmeldinger. 
	feilmeldinger og suksessmeldinger blir lagt inn i 2 forkjellige tabeller som man enkelt kan printe ut til bruker.
-->

<!-- Feilmelinger -->
<?php  if (count($errors) > 0) : ?>
  <div id="error">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>


<!-- Suksess-->
<?php  if ( count($errors) == 0 && count($success) > 0) : ?>
  <div id="success">
  	<?php foreach ($success as $s) : ?>
  	  <p><?php echo $s ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>
