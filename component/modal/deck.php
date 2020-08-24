<div id="add_deck_modal" class="ui tiny modal">
  <i class="close icon"></i>
  <div class="header">
    New deck
  </div>
  <div class="content">
    <p>This is where you can add you own new deck!</p>
    
    <form id="form_add_deck" class="ui form" method="post">
        <div class="required field">
            <label>Name</label>
            <input class="add_deck" type="text" name="name" placeholder="Deck name">
        </div>
        <div class="field">
            <label>Description</label>
            <textarea class="add_deck" name="description" rows="4" style="resize: none;"></textarea>
        </div>
        <div class="required field">
            <label>New lerning card per day</label>
            <input class="add_deck" type="number" name="new_card_day" placeholder="1-100" min="1" max="100" value="25">
        </div>
        <div id="message_add_deck_error" class="ui error message"></div>
    </form>
  
  </div>
  <div class="actions">
    <div class="ui black deny button">
      Cancel
    </div>
    <div id="add_deck_submit" class="ui primary right labeled icon button">
      Add
      <i class="checkmark icon"></i>
    </div>
  </div>
</div>
<script>
    $('#add_deck_modal').modal({
        closable: false
    }).modal('attach events', '#add_deck_button', 'show');

    $('#add_deck_submit').on('click', () => {
      let name             = $(".add_deck[name='name']").first().val();
      let description      = $(".add_deck[name='description']").first().val();
      let new_card_day     = $(".add_deck[name='new_card_day']").first().val();
      let error            = $("#message_add_deck_error");

      if (name.trim() && new_card_day.trim()) {
        $.ajax({
            type: "POST",
            url: "component/backend/add/deck.php",
            data: { 
                name : name,
                description : description,
                new_card_day : new_card_day
                },
            success: (data) => {
              if (data === "success") location.reload();
            }
        });
      }

    });
</script>