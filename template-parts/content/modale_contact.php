<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close"></span>
    <div class="modal-header">
      <img src="<?php echo get_template_directory_uri() . '/img/contact-header.png'; ?>" alt="formulaire de contact">
    </div>
    <div class="modal-form">
    <?php
    // On insère le formulaire de demandes de contact
    echo do_shortcode('[contact-form-7 id="8080fc4" title="Formulaire de contact"]');
    ?>
    </div>
  </div>

</div>