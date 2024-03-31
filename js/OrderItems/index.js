import { apiUrl, baseUrl } from "../modules/config.js";

let items = null; //to use to calculate Total
let itemCount = 1;
const order_id_hidden = parseInt($(".order_id_hidden").val());

const addItemModal = new bootstrap.Modal(
  document.getElementById("addItemModal"),
  {}
);
const addMenuBtn = $("#addMenuBtn");
const addItemForm = $("#addItemForm");

function validateForm() {
  addItemForm.validate({
    rules: {
      item_1: {
        required: true,
      },
    },
    messages: {
      item_1: {
        required: "At least one item needs to be selected",
      },
    },
    submitHandler: submitEventHandler,
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
      const itemPrice = parseFloat(data[`item_${itemNumber}_price_hidden`]);
      if (itemId) {
        transformedArray.push({
          name: itemName,
          id: parseInt(itemId),
          quantity: itemQuantity,
          orderId,
          price_per_item: itemPrice,
          total_price: parseFloat((itemQuantity * itemPrice).toFixed(2)),
        });
      }
    }
  }
  return transformedArray;
}

async function addOrderItems(data) {
  try {
    const response = await axios.post(`${apiUrl}/order-items`, data);
    return response.data;
  } catch (error) {
    return error;
  }
}

async function submitEventHandler(form, event) {
  event.preventDefault();
  Swal.fire({
    icon: "warning",
    title: "Warning!",
    text: "This will add to Order",
    confirmButtonColor: "#3085d6",
    confirmButtonText: "OK",
  }).then(async (result) => {
    // Check if the user clicked the "OK" button
    if (result.isConfirmed) {
      const formData = {};
      $(form)
        .find(":input")
        .each(function () {
          const name = $(this).attr("name");
          const value = $(this).val();
          formData[name] = value;
        });
      const orderItems = transformMenuItems(formData, order_id_hidden);
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
  });
}

async function getOrderItems(orderId) {
  try {
    const url = `${apiUrl}/order-items?orderId=${orderId}`;
    const response = await axios.get(url);
    return response.data;
  } catch (error) {
    return error;
  }
}

function updateQuantityAndTotalPrice(id, newQuantity) {
  const itemIndex = items.findIndex((item) => item.id === id); // Find the index of the item with the given ID
  if (itemIndex !== -1) {
    // If the item is found in the array
    const item = items[itemIndex];
    const oldQuantity = item.Quantity;
    item.Quantity = newQuantity; // Update the quantity

    const pricePerItem = parseFloat(item.PricePerItem);
    const totalPrice = pricePerItem * newQuantity; // Calculate the new total price

    item.TotalPrice = totalPrice.toFixed(2); // Update the total price in the item object with 2 decimal places
    return totalPrice;
  }
}

//update subtotalRow
function updateSubTotal(dataId, subTotal) {
  const row = $(`.${dataId}_row`);
  const subtotalTd = row.find(".subtotal");
  subtotalTd.text(subTotal.toFixed(2));
  return true;
}

function updateTotal() {
  if (items.length <= 0) {
    return false;
  }
  const totalPrice = items.reduce((accumulator, currentItem) => {
    return accumulator + parseFloat(currentItem.TotalPrice);
  }, 0);
  $(".total-amount").text(totalPrice.toFixed(2));
}

function openModalBinding() {
  // addItemModal.show();
  $("#addItemBtn").on("click", async function (e) {
    e.preventDefault();
    addItemModal.show();
  });
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
                  price: parseFloat(item.Price),
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
        const hasMenuPriceHidden =
          $(this).siblings(".menu-price-hidden").length > 0;
        if (hasMenuItemHidden) {
          const hiddenMenuItem = $(this).siblings(".menu-item-hidden");
          hiddenMenuItem.val(parseInt(item.id));
        }
        if (hasMenuPriceHidden) {
          const hiddenPriceItem = $(this).siblings(".menu-price-hidden");
          hiddenPriceItem.val(parseFloat(item.price));
        }
      },
    })
    .bind("focus", function () {
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
                      <div>
                      <div class="menu-item-input">
                        <input type="text" class="menu-item form-control ui-autocomplete-input" id="item-${itemCount}"  name="item_${itemCount}">
                        <input type="hidden" name="item_${itemCount}_hidden" class="menu-item-hidden" value="">
                        <input type="hidden" name="item_${itemCount}_price_hidden" class="item_${itemCount}_price_hidden menu-price-hidden">
                      </div>
                      <div class="quantity-input mt-3 d-flex justify-content-end">
                          <!-- Quantity -->
                          <div class="input-group mb-3 quantityDiv" style="max-width: 150px;" data-id="item_${itemCount}">
                              <button class="btn btn-outline-primary update-decrease-quantity" type="button" onclick="this.nextElementSibling.stepDown()">
                                  <i class="fas fa-minus"></i>
                              </button>

                              <input id="form1" min="1" name="item_${itemCount}_quantity" value="1" type="number" class="form-control quantity-btn text-center" aria-label="Quantity" aria-describedby="quantity-label">

                              <button class="btn btn-outline-primary update-increase-quantity" type="button" data-id="item_${itemCount}" onclick="this.previousElementSibling.stepUp()">
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

$(document).ready(async function () {
  openModalBinding();
  addItemsBinding();
  menuItemAutoComplete();
  validateForm();
  const total = $(".total-amount").text();

  const response = await getOrderItems(order_id_hidden);
  items = response;

  $(".increase-quantity").on("click", function () {
    const inputElement = $(this).parent().find(".quantity-btn");
    inputElement.val(parseInt(inputElement.val()) + 1);
    const dataId = $(this).data("id");
    const newQuantity = parseInt(inputElement.val());
    const subTotal = updateQuantityAndTotalPrice(dataId, newQuantity);
    updateSubTotal(dataId, subTotal);
    updateTotal();
  });

  $(".decrease-quantity").on("click", function () {
    const inputElement = $(this).parent().find(".quantity-btn");
    const currentValue = parseInt(inputElement.val());
    if (currentValue > 1) {
      inputElement.val(currentValue - 1);
    }
    const dataId = $(this).data("id");
    const newQuantity = parseInt(inputElement.val());
    const subTotal = updateQuantityAndTotalPrice(dataId, newQuantity);
    updateSubTotal(dataId, subTotal);
    updateTotal();
  });

  $(".update-btn").on("click", function (e) {
    e.preventDefault();
    const dataId = $(this).attr("data-item-id");
    Swal.fire({
      icon: "warning",
      title: "Warning!",
      text: "Do you want to update this order ?",
      showCancelButton: true, // Show the Cancel button
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "OK",
      cancelButtonText: "Cancel",
    }).then((result) => {
      // Check which button the user clicked
      if (result.isConfirmed) {
        // User clicked "OK" button
        console.log(items);
        // Add your code here to proceed with the action
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        // User clicked "Cancel" button or closed the alert
        console.log("User clicked Cancel or closed the alert.");
        // Add code for handling cancellation or closing of the alert
      }
    });
  });
});
