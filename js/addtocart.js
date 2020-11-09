function addItem(itemId) {
  $.ajax({
    url: "../services/additem.php",
    type: "get",
    data: {
      id: itemId,
    },
    success: function (response) {
      console.log(response);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    },
  });
}
