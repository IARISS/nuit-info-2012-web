<article>
  <header>
    <h1>Ajouter</h1>
  </header>

  <?php print_error($errors); ?>

  <form action="" method="POST">
    <div class="control-group">
      <label class="control-label">Titre :</label>
      <div class="controls">
        <input type="text" name="title" class="span6" value="<?php echo $post_title; ?>" />
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Description :</label>
      <div class="controls">
        <textarea name="description" class="span12" rows="15"><?php echo $post_description; ?></textarea>
      </div>
    </div>

    <div class="form-actions">
      <input type="submit" class="btn btn-primary" value="Ajouter" />
    </div>
  </form>
</article>