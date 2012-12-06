<form id="home-search" class="form-search" method="GET" action="./search">
  <div>
    <input type="text" name="search" value="" class="input-xxlarg span6" placeholder="Entrez votre recherche (ex: Musée, Alsace, Etoffes, ...)" />
  </div>
</form>

<ul id="home-cloudtags">
  <?php foreach( array('tag', 'tag2', 'tag3') as $tag ): ?>
  <li><a href="./search?tags=<php echo $tag; ?>"><?php echo $tag; ?></a></li>
  <?php endforeach; ?>
</ul>