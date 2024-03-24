import { apiUrl, baseUrl } from "../modules/config.js";
const addItemModal = new bootstrap.Modal(
  document.getElementById("addItemModal"),
  {}
);
const addMenuBtn = $("#addMenuBtn");
const addItemForm = $("#addItemForm");

let itemCount = 3;

function tableItemsAutoComplete() {
  const itemTableSelects = $("#itemTable");
  itemTableSelects
    .autocomplete({
      source: function (request, response) {
        //   loadingIcon.show();
        $.ajax({
          dataType: "json",
          url: `${apiUrl}/table?search=${request.term}`,
          type: "GET",
          success: function (data) {
            console.log(data);
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
                  label: item.id,
                  value: item.id,
                  id: item.id,
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
  itemTableSelects.autocomplete("option", "appendTo", "#addItemForm");
}

function menuItemAutoComplete() {
  const menuItemSelects = $(".menu-item");
  menuItemSelects
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
      console.log("focus fired");
      $(this).autocomplete("search");
    });

  menuItemSelects.autocomplete("option", "appendTo", "#addItemForm"); //so that dropdown appears inside the modal
}

function addItemsBinding() {
  addMenuBtn.on("click", function (e) {
    e.preventDefault();
    itemCount++;
    const newItemHtml = `
                  <div class="mb-3">
                      <label for="item-${itemCount}" class="form-label">Choose Menu ${itemCount}</label>
                      <input type="text" class="menu-item form-control ui-autocomplete-input" id="item-${itemCount}"  name="item_${itemCount}">
                  </div>
              `;
    const result = $("#menuItemsContainer").append(newItemHtml);
    menuItemAutoComplete();
  });
}

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

function validateForm() {
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
}

function openModalBinding() {
  $("#addItemBtn").on("click", async function (e) {
    e.preventDefault();
    addItemModal.show();
  });
}

$(document).ready(function () {
  openModalBinding(); //show Modal
  addItemsBinding();
  tableItemsAutoComplete();
  menuItemAutoComplete();
  validateForm();
});
