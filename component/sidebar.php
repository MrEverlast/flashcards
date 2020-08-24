<div class="ui left vertical inverted sidebar labeled icon menu visible" style="width: 92px !important;">
  <a href="/flashcards" class="item">
    <i class="home icon"></i>
    Home
  </a>  
  <?php 
    if (isset($_SESSION['username'])) {
      include_once "sidebar/item.php";
      ?>
      <a id="add_deck_button" class="item">
        <i class="plus icon"></i>
        Deck
      </a>
      <?php include_once "component/modal/deck.php";
    }
    ?>
</div>