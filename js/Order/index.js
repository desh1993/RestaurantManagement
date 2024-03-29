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
        $(this).val(item.label);
        const hasMenuItemHidden =
          $(this).siblings(".menu-item-hidden").length > 0;
        if (hasMenuItemHidden) {
          const hiddenMenuItem = $(this).siblings(".menu-item-hidden");
          hiddenMenuItem.val(parseInt(item.id));
        }
      },
    })
    .bind("focus", function () {
      $(this).autocomplete("search");
    });

  menuItemSelects.autocomplete("option", "appendTo", "#addItemForm"); //so that dropdown appears inside the modal
}

function searchCustomerAutoComplete() {
  const customerSelects = $("#itemCustomer");
  customerSelects
    .autocomplete({
      source: function (request, response) {
        //   loadingIcon.show();
        $.ajax({
          dataType: "json",
          url: `${apiUrl}/customers?search=${request.term}`,
          type: "GET",
          success: function (data) {
            //   loadingIcon.hide();
            if (data === null || data.length <= 0) {
              return response([
                {
                  label: "No Customers",
                  value: "no_customer_item",
                },
              ]);
            }
            response(
              $.map(data, function (item) {
                // your operation on data
                // return item.name;
                return {
                  label: item.username,
                  value: item.username,
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
        $(this).val(item.label);
        const hiddenCustomerField =
          $(this).siblings(".itemCustomerHidden").length > 0;
        if (hiddenCustomerField) {
          const hiddenCustomerItem = $(this).siblings(".itemCustomerHidden");
          hiddenCustomerItem.val(parseInt(item.id));
        }
      },
    })
    .bind("focus", function () {
      $(this).autocomplete("search");
    });

  customerSelects.autocomplete("option", "appendTo", "#addItemForm"); //so that dropdown appears inside the modal
}

function addItemsBinding() {
  addMenuBtn.on("click", function (e) {
    e.preventDefault();
    itemCount++;
    const newItemHtml = `
                  <div class="mb-3">
                      <label for="item-${itemCount}" class="form-label">Choose Menu ${itemCount}</label>
                      <div>
                      <div class="menu-item-input">
                      <input type="text" class="menu-item form-control ui-autocomplete-input" id="item-${itemCount}"  name="item_${itemCount}">
                      <input type="hidden" name="item_${itemCount}_hidden" class="menu-item-hidden" value="">
                      </div>
                      <div class="quantity-input mt-3 d-flex justify-content-end">
                          <!-- Quantity -->
                          <div class="input-group mb-3 quantityDiv" style="max-width: 150px;" data-id="item_${itemCount}">
                              <button class="btn btn-outline-primary decrease-quantity" type="button" onclick="this.nextElementSibling.stepDown()">
                                  <i class="fas fa-minus"></i>
                              </button>

                              <input id="form1" min="1" name="item_${itemCount}_quantity" value="1" type="number" class="form-control quantity-btn text-center" aria-label="Quantity" aria-describedby="quantity-label">

                              <button class="btn btn-outline-primary increase-quantity" type="button" data-id="item_${itemCount}" onclick="this.previousElementSibling.stepUp()">
                                  <i class="fas fa-plus"></i>
                              </button>
                          </div>
                          <!-- Quantity -->
                      </div>
                  </div>
                  </div>
              `;
    const result = $("#menuItemsContainer").append(newItemHtml);
    menuItemAutoComplete();
  });
}

function transformMenuItems(data, orderId) {
  const transformedArray = [];

  // Loop through the keys of the data object
  for (const key in data) {
    if (key.startsWith("item_") && key.endsWith("_quantity")) {
      const itemNumber = key.split("_")[1]; // Extract the item number from the key
      const itemId = data[`item_${itemNumber}_hidden`];
      const itemName = data[`item_${itemNumber}`];
      const itemQuantity = parseInt(data[key]);
      if (itemId) {
        transformedArray.push({
          name: itemName,
          id: parseInt(itemId),
          quantity: itemQuantity,
          orderId,
        });
      }
    }
  }
  return transformedArray;
}

async function submitEventHandler(form, event) {
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
  const data = {
    tableId: parseInt(formData.itemTable),
    customerId: parseInt(formData.itemCustomerHidden),
  };
  //this returns orderId
  const orderId = await addToOrder(data);
  if (orderId) {
    const orderItems = transformMenuItems(formData, orderId);
    const response = await addOrderItems(orderItems);
    if (response === true) {
      Swal.fire({
        title: "success",
        text: "Order created",
        timer: 3000,
        icon: "success",
        showConfirmButton: false,
        timerProgressBar: true, // Display a progress bar for the timer
      });
      setTimeout(function () {
        location.reload(); // Reload the current page
      }, 3000);
    }
  }
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
  addItemModal.show();
  $("#addItemBtn").on("click", async function (e) {
    e.preventDefault();
    addItemModal.show();
  });
}

async function addToOrder(data) {
  try {
    const response = await axios.post(`${apiUrl}/order`, data);
    return response.data;
  } catch (error) {
    return error;
  }
}

async function addOrderItems(data) {
  try {
    const response = await axios.post(`${apiUrl}/order-items`, data);
    return response.data;
  } catch (error) {
    return error;
  }
}
$(document).ready(function () {
  openModalBinding(); //show Modal
  addItemsBinding();
  tableItemsAutoComplete();
  menuItemAutoComplete();
  searchCustomerAutoComplete();
  validateForm();
});
