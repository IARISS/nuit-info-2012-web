<article>
  <header>
    <h1>Edition - <?php echo $entity; ?></h1>
  </header>
  <form action="" method="POST">
    <div class="control-group">
      <label class="control-label">Description :</label>
      <div class="controls">
        <textarea name="description" class="span12" rows="15"><?php echo utf8_encode(htmlspecialchars($entity->getDescription())); ?></textarea>
      </div>
    </div>

    <div class="form-actions">
      <input type="submit" class="btn btn-primary pull-right" value="Editer" />
    </div>
  </form>
</article>