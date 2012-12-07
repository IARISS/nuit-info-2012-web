<form id="search-search" class="form-search" method="GET" action="./search">
  <div class="input-append">
    <input type="text" name="search" value="" class="span6" placeholder="Entrez votre recherche (ex: Musée, Alsace, Etoffes, ...)" />
    <button class="btn" type="submit">Rechercher !</button>
  </div>
</form>

  <div class="dblock" id="search-item">
    <div>
      <article>
        <div class="row-fluid">
          <div class="span3" class="col-img">
            <figure class="img-polaroid">
              <img src="<?php echo $entity->getImg(); ?>" alt="" />
            </figure>
          </div>
          <div class="span9">
            <h1>
              <?php echo $entity->getName(); ?> <a href="./edit-<?php echo $entity->getId(); ?>" class="muted pull-right" style="font-size: .35em; opacity: .5"><i class="icon-edit"></i> Editer la fiche</a>
            </h1>
            <ul class="tags">
              <?php foreach( $entity->getTags() as $tag ): ?>
              <li><a href="./search?search=<?php echo $tag->getname(); ?>"><?php echo $tag->getName(); ?></a></li>
              <?php endforeach; ?>
            </ul>
            <br />
            <div class="description">
              <?php echo $entity->getDescription(); ?>
            </div>
          </div>
        </div>
      </article>
    </div>
  </div>