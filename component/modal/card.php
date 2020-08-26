<div id="add_card_modal" class="ui tiny modal">
  <i class="close icon"></i>
  <div class="header">
    New card
  </div>
  <div class="content">
    <p>Add a new card!</p>
    
    <form id="form_add_card" class="ui form" method="post">
        <div class="required field">
            <label>Front</label>
            <input class="add_card" type="text" name="front" placeholder="Front">
        </div>
        <div class="required field">
            <label>Back</label>
            <input class="add_card" type="text" name="back" placeholder="Back">
        </div>
        <div id="message_add_card_error" class="ui error message"></div>
    </form>
  
  </div>
  <div class="actions">
    <div class="ui black deny button">
      Cancel
    </div>
    <div id="add_card_submit" class="ui primary right labeled icon button" data-deck="<?= $_GET["deck_id"]; ?>">
      Add
      <i class="checkmark icon"></i>
    </div>
  </div>
</div>
<script>
    $('#add_card_modal').modal({
        closable: false
    }).modal('attach events', '#add_card_button', 'show');

    $('#add_card_submit').on('click', (e) => {
      let deck_id = e.target.dataset.deck;
      let front   = $(".add_card[name='front']").first().val();
      let back    = $(".add_card[name='back']").first().val();
      let error   = $("#message_add_card_error");

      if (front.trim() && back.trim() && deck_id.trim()) {
        $.ajax({
            type: "POST",
            url: "component/backend/add/card.php",
            data: { 
                deck_id : deck_id,
                front : front,
                back : back
                },
            success: (data) => {
              if (data === "success") location.reload();
            }
        });
      }

    });
</script>