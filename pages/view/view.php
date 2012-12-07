<form id="search-search" class="form-search" method="GET" action="./search">
  <div>
    <input type="text" name="search" value="" class="input-xxlarg span5" placeholder="Entrez votre recherche (ex: Musée, Alsace, Etoffes, ...)" />
  </div>
</form>

<div class="row">
  <div id="search-column" class="span2 dblock">
    <div>
      <h1>Related Tags</h1>
      <ul>
        <?php foreach( (array) $otherTags as $tag ): ?>
        <li><a href="./search?search=<?php echo $tag; ?>"><?php echo $tag; ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <div class="span10 dblock" id="search-items">
    <div>
      <article>
        <div class="row-fluid">
          <div class="span2">
            <figure class="img-polaroid">
              <img src="<?php echo $entity->getImg(); ?>" alt="" />
            </figure>
          </div>
          <div class="span10">
            <h1><?php echo $entity->getName(); ?></h1>
            <ul class="tags">
              <?php foreach( $entity->getTags() as $tag ): ?>
              <li><a href="./search?search=<?php echo $tag->getname(); ?>"><?php echo $tag->getName(); ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <br />
        <div class="row-fluid">
          <div class="offset2 description">
            <a href="#" class="pull-right"><i class="icon-*edit"></i> Editer la fiche</a>
            <?php echo $entity->getDescription(); ?>
          </div>
        </div>
      </article>
    </div>
  </div>
</div>