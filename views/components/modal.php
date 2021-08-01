<!-- <a href="#modal" class="open">Abrir modal</a> -->

<div class="modal" id="Modal">
  <a href="#" class="modal-bg"></a>
  <div class="modal-content">
    <a href="#" class="modal-exit">x</a>
    <h3 class="modal-title"><?php echo $title ?></h3>
    <!-- <div> -->
    <?php echo $mapi ?>
    <!-- </div> -->
    <p class="modal-text">
      <?php echo $description ?>
    </p>

    <div>
      <form action="<?php echo $action ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
        <input class="button s-mb-2" type="submit" value="Aceptar">
      </form>
      <!-- <a class="button" href="#">Aceptar</a> -->
      <?php
      if ($cancelButton == true) {
        echo '<a class="button red s-mb-2" href="#">Cancelar</a>';
      }
      ?>
    </div>
  </div>
</div>