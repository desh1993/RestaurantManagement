import { apiUrl, baseUrl } from "../modules/config.js";

$(document).ready(function () {
  const searchMenuInput = $(".searchMenu");
  const loadingIcon = $(".loader-menu-items");

  loadingIcon.hide();
  searchMenuInput.autocomplete({
    source: function (request, response) {
      loadingIcon.show();
      $.ajax({
        dataType: "json",
        url: `${apiUrl}/menu-item?search=${request.term}`,
        type: "GET",
        success: function (data) {
          loadingIcon.hide();
          if (data === null || data.length <= 0) {
            return response([
              {
                label: "No Menu item",
                value: "no_menu_item",
              },
            ]);
          }
          console.log(data);
          response(
            $.map(data, function (item) {
              // your operation on data
              // return item.name;
              console.log(item);
              return {
                label: item.Name,
                value: item.Name,
                id: item.MenuItemId,
              };
            })
          );
        },
      });
    },
    select: function (event, ui) {
      const { item } = ui;
      loadingIcon.hide();
      window.location.href = `${baseUrl}/menu?item-id=${item.id}`;
    },
  });
});
