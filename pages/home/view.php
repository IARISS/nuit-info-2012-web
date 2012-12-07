<form id="home-search" class="form-search" method="GET" action="./search">
  <div class="input-append">
    <input id="search-input" type="text" name="search" value="" class="input-xxlarg span6" placeholder="Entrez votre recherche (ex: Musée, Alsace, Etoffes, ...)" />
    <button id="search-go" class="btn" type="submit">Rechercher !</button>
  </div>
</form>

<div id="caribou"></div>

<ul id="home-cloudtags">
  <?php foreach( $entitiesTopTags as $tag ): ?>
  <li><a href="./search?tags=<?php echo $tag; ?>"><?php echo $tag; ?></a></li>
  <?php endforeach; ?>
</ul>

<?php

$_javascripts[] = '<script>
(function () {
  if ( window.addEventListener ) {
    var state = 0,
    JeSuisUnCaribou = [74,69,32,83,85,73,83,32,85,78,32,67,65,82,73,66,79,85];

    window.addEventListener("keydown", function(e) {
     if ( e.keyCode == JeSuisUnCaribou[state] )
      state++;
    else
      state = 0;

    if ( state == 18 )
    {
      $("#caribou").html("<img src=\"theme/caribou/img/caribou.png\" alt=\"Coucou le Caribou\" />");
      $("#search-go").html("En avant Tabernacle !");
      $("#search-input").attr("placeholder", "Entre ton caribou alsacien (ex: Märikhàll, Màtros) ");

      state=0;
    }
  }, true);
  }
}());
</script>';

?>