<form id="search-search" class="form-search" method="GET" action="/search">
  <div>
    <input type="text" name="search" value="" class="input-xxlarg span5" placeholder="Entrez votre recherche (ex: Musée, Alsace, Etoffes, ...)" />
  </div>
</form>

<div class="row">
  <div id="search-column" class="span2 dblock">
    <div>
      <h1>Related Tags</h1>
      <ul>
        <?php foreach( array('tag', 'tag2', 'tag3') as $tag ): ?>
        <li><a href="./search?tags=<php echo $tag; ?>"><?php echo $tag; ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <div class="span10 dblock" id="search-items">
    <div>
      <article>
        <form action="" method="POST" class="form-horizontal">
          <div class="row-fluid">
            <div class="span2 align-center">
              <figure class="img-polaroid">
              </figure>
              <a href="#"><i class="icon-plus"></i></a>
            </div>
            <div class="span9">
              <div class="control-group">
                <label class="control-label">Titre :</label>
                <div class="controls">
                  <input type="text" name="title" value="" />
                </div>
              </div>
            </div>
            <div class="span1 more">
              <i class="icon-chevron-right"></i>
            </div>
          </div>
        </form>
      </article>
    </div>
  </div>
</div>