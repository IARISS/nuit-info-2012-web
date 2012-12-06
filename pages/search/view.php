<form id="search-search" class="form-search" method="GET" action="./search">
  <div>
    Recherche : <input type="text" name="search" value="<?php echo $get_search; ?>" class="input-xxlarg span5" placeholder="Entrez votre recherche (ex: Musée, Alsace, Etoffes, ...)" />
  </div>
</form>

<div class="row">
  <div id="search-column" class="span2 dblock">
    <div>
      <h1>Related Tags</h1>
      <ul>
        <?php foreach( $entitiesTags as $tag ): ?>
        <li><a href="./search?tags=<php echo $tag; ?>"><?php echo $tag; ?></a></li>
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
            </figure>
          </div>
          <div class="span9">
            <h1><a href="./view-0">Title</a></h1>
            <ul class="tags">
              <?php foreach( array('tag', 'tag2', 'tag3') as $tag ): ?>
              <li><a href="./search?tags=<php echo $tag; ?>"><?php echo $tag; ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="span1 more">
            <i class="icon-chevron-right"></i>
          </div>
        </div>
      </article>
    </div>
  </div>
</div>