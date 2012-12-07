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

<?php

$_javascripts[] = '<script>
  if ( window.addEventListener ) {
    var kkeys = [], konami = "38,38,40,40,37,39,37,39,66,65";
    window.addEventListener("keydown", function(e) {
      kkeys.push( e.keyCode );
      if ( kkeys.toString().indexOf( konami ) >= 0 ) {
        alert("....");
      }
    }, true);
  }
</script>';

?>