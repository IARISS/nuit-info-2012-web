<article>
  <header>
    <h1>Edition - <?php echo $entity; ?></h1>
  </header>
  <form action="?" method="POST">
    <div class="control-group">
      <label class="control-label">Titre :</label>
      <div class="controls">
        <input type="text" name="title" class="span6" value="<?php echo /*utf8_encode*/(htmlspecialchars($entity->getName())); ?>" />
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Description :</label>
      <div class="controls">
        <textarea name="description" class="span12" rows="15"><?php echo /*utf8_encode*/(htmlspecialchars($entity->getDescription())); ?></textarea>
      </div>
    </div>

    <br />

    <div class="control-group">
      <label class="control-label">Image :</label>
      <div class="input-prepend">
        <button class="btn" type="button">http://</button>
        <input type="text" name="img" class="span10" maxlength="255" value="<?php echo preg_replace('`^http:\/\/`si', '', htmlspecialchars($entity->getImg())); ?>" />
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Lattitude (X) :</label>
      <div class="controls">
        <input type="text" name="gpsX" class="span3" value="<?php echo /*utf8_encode*/(htmlspecialchars($entity->getGpsX())); ?>" />
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Longitude (Y) :</label>
      <div class="controls">
        <input type="text" name="gpsY" class="span3" value="<?php echo /*utf8_encode*/(htmlspecialchars($entity->getGpsY())); ?>" />
      </div>
    </div>

    <div class="form-actions">
      <input type="submit" class="btn btn-primary" value="Editer" />
      <a href="./view-<?php echo $entity->getId(); ?>" class="btn btn-danger">Retour</a>
    </div>
  </form>
</article>