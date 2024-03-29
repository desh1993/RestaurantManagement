import { apiUrl, baseUrl } from "../modules/config.js";
const addItemModal = new bootstrap.Modal(
  document.getElementById("addItemModal"),
  {}
);
const menuItemSelects = $(".menu-item");
const itemTableSelects = $("#itemTable");
const addMenuBtn = $("#addMenuBtn");
const addItemForm = $("#addItemForm");

let itemCount = 3;

function addItemsBinding() {
  addMenuBtn.on("click", function (e) {
    e.preventDefault();
    itemCount++;
    const newItemHtml = `
                <div class="mb-3">
                    <label for="item-${itemCount}" class="form-label">Choose Menu ${itemCount}</label>
                    <input type="text" class="menu-item form-control" id="item-${itemCount}"  name="item_${itemCount}">
                </div>
            `;
    $("#menuItemsContainer").append(newItemHtml);
  });
}

async function searchTable(searchTerm) {
  try {
    const response = await axios.get(`${apiUrl}/table?search=${searchTerm}`);
    return response.data;
  } catch (error) {
    return error;
  }
}
async function searchMenu(searchTerm) {
  try {
    await axios.get(`${apiUrl}/menu-item?search=${searchTerm}`);
  } catch (error) {}
}
$(document).ready(async function () {
  addItemModal.show();
  addItemsBinding();
  $(".menu-item")
    .autocomplete({
      source: function (request, response) {
        //   loadingIcon.show();
        $.ajax({
          dataType: "json",
          url: `${apiUrl}/menu-item?search=${request.term}`,
          type: "GET",
          success: function (data) {
            //   loadingIcon.hide();
            if (data === null || data.length <= 0) {
              return response([
                {
                  label: "No Menu item",
                  value: "no_menu_item",
                },
              ]);
            }
            response(
              $.map(data, function (item) {
                // your operation on data
                // return item.name;
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
      minLength: 0,
      select: function (event, ui) {
        const { item } = ui;
      },
    })
    .bind("focus", function () {
      $(this).autocomplete("search");
    });

  $(".menu-item").autocomplete("option", "appendTo", "#addItemForm"); //so that dropdown appears inside the modal
  //   $("#itemTable").autocomplete("option", "appendTo", "#addItemForm");

  addItemForm.validate({
    rules: {
      itemTable: {
        required: true,
      },
      item_1: {
        required: true,
      },
    },
    messages: {
      itemTable: {
        required: "Please select a table",
      },
      item_1: {
        required: "At least one item needs to be selected",
      },
    },
    submitHandler: submitEventHandler,
  });
});

function submitEventHandler(form, event) {
  event.preventDefault();
  // const formData = $(form).serializeArray();
  // console.log(formData);
  const formData = {};
  $(form)
    .find(":input")
    .each(function () {
      const name = $(this).attr("name");
      const value = $(this).val();
      formData[name] = value;
    });
  console.log(formData);
}
