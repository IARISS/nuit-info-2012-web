<form id="search-search" class="form-search" method="GET" action="./search">
  <div class="input-append">
    <input type="text" name="search" value="<?php echo $get_search; ?>" class="span6" placeholder="Entrez votre recherche (ex: Musée, Alsace, Etoffes, ...)" />
    <button class="btn" type="submit">Rechercher !</button>
  </div>
</form>

<div class="row">
  <div id="search-column" class="span2 dblock">
    <div>
      <h1>Tags</h1>
      <ul>
        <?php foreach( (array) $entitiesTags as $tag ): ?>
        <li><a href="./search?search=<?php echo $tag; ?>"><?php echo $tag; ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <div class="span10 dblock" id="search-items">
    <div>
      <?php foreach( $entities as $entity ): ?>
      <article>
        <div class="row-fluid">
          <div class="span2">
            <figure class="img-polaroid">
              <img src="<?php echo $img; ?>" alt="" />
            </figure>
          </div>
          <div class="span10">
            <h1><a href="./view-<?php echo $entity->getId(); ?>"><?php echo $entity; ?></a></h1>
            <ul class="tags">
              <?php foreach( $entity->getTags() as $tag ): ?>
              <li><a href="./search?search=<?php echo $tag; ?>"><?php echo $tag; ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
      <?php if( !$entities ): ?>
      <p class="align-center">Aucun résultat trouvé ...</p>
      <?php endif; ?>
    </div>
  </div>
</div>