<form id="home-search" class="form-search" method="GET" action="./search">
  <div class="input-append">
    <input type="text" name="search" value="" class="input-xxlarg span6" placeholder="Entrez votre recherche (ex: Musée, Alsace, Etoffes, ...)" />
    <button class="btn" type="submit">Rechercher !</button>
  </div>
</form>

<ul id="home-cloudtags">
  <?php foreach( $entitiesTopTags as $tag ): ?>
  <li><a href="./search?tags=<?php echo $tag; ?>"><?php echo $tag; ?></a></li>
  <?php endforeach; ?>
</ul>