function incrementCart(itemId, itemPrice) {
  $.ajax({
    type: "post",
    data: {
      id: itemId,
      price: itemPrice,
      type: "inc",
    },
    success: function (_) {
      window.location.reload();
    },
    error: function (_, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    },
  });
}
function decrementCart(itemId, itemPrice) {
    $.ajax({
      type: "post",
      data: {
        id: itemId,
        price: itemPrice,
        type: "dec",
      },
      success: function (_) {
        window.location.reload();
      },
      error: function (_, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      },
    });
  }