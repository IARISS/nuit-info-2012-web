<article>
  <header>
    <h1>Edition - <?php echo $entity; ?></h1>
  </header>
  <form action="" method="POST">
    <div class="control-group">
      <label class="control-label">Description :</label>
      <div class="controls">
        <textarea name="description" class="span12" rows="15"><?php echo htmlspecialchars($entity->getDescription()); ?></textarea>
      </div>
    </div>

    <div class="form-actions">
      <input type="submit" class="btn btn-primary" value="Editer" />
      <a href="./view-<?php echo $entity->getId(); ?>" class="btn btn-danger">Retour</a>
    </div>
  </form>
</article>