import { apiUrl, baseUrl } from "../modules/config.js";
const addItemModal = new bootstrap.Modal(
  document.getElementById("addItemModal"),
  {}
);
$(document).ready(async function () {
  const response = await searchMenuItem("spag");
  $("#addItemBtn").on("click", function (e) {
    e.preventDefault();
    addItemModal.show();
  });

  $.validator.addMethod(
    "positiveNumber",
    function (value, element) {
      return Number(value) > 0;
    },
    "Please enter a positive number."
  );

  $("#addItemForm").validate({
    rules: {
      itemName: {
        required: true,
      },
      itemDescription: {
        required: true,
      },
      itemPrice: {
        required: true,
        positiveNumber: true,
      },
    },
    messages: {
      itemName: "Please enter menu item name",
      itemDescription: {
        required: "Please enter the item description.",
      },
      itemPrice: {
        required: "Please enter the item price.",
        positiveNumber: "Please enter a positive number for the price.",
      },
    },
    submitHandler: submitEventHandler,
  });
});

async function searchMenuItem(data) {
  try {
    const result = await axios.get(`${apiUrl}/menu-item?search=${data}`);
    return result;
  } catch (error) {
    return error;
  }
}

async function createMenuItem(data) {
  try {
    const convertedObj = data.reduce((obj, item) => {
      obj[item.name] = item.value;
      return obj;
    }, {});
    const result = await axios.post(`${apiUrl}/menu-item`, {
      data: convertedObj,
    });
    return result;
  } catch (error) {
    return error;
  }
}

async function getMenuItem($id) {
  try {
    const result = await axios.get(`${apiUrl}/menu-item?item=${$id}`);
    return result;
  } catch (error) {
    return error;
  }
}

function submitEventHandler(form, event) {
  event.preventDefault();
  const formData = $(form).serializeArray();
  //create Menu Item
  createMenuItem(formData).then((response) => {
    const data = response.data;
    if (data > 0) {
      Swal.fire({
        icon: "success",
        title: "Success!",
        html: `
            <div class="alert alert-success" role="alert">
              Menu items added to menu. <a href="${baseUrl}/menu">Menu</a>
            </div>
            `,
        showCancelButton: false,
        showConfirmButton: true,
        confirmButtonText: "OK",
      }).then(async (result) => {
        if (result.isConfirmed) {
          const response = await getMenuItem(data);
          if (response) {
            const newItem = response.data;
            appendNewRow(newItem);
            addItemModal.hide();
          }
        }
      });
    }
  });
}

function appendNewRow(newItem) {
  // Create a new table row (tr) element
  const newRow = document.createElement("tr");

  // Populate the new row with data
  newRow.innerHTML = `
      <td>${
        document.getElementById("menuItemsList").getElementsByTagName("tr")
          .length + 1
      }</td>
      <td>${newItem.Name}</td>
      <td>${newItem.Description}</td>
      <td>${newItem.Price}</td>
      <td>
          <button type="button" class="btn btn-primary btn-sm edit-btn" data-item-id="${
            newItem.MenuItemId
          }">Edit</button>
          <button type="button" class="btn btn-danger btn-sm delete-btn" data-item-id="${
            newItem.MenuItemId
          }">Delete</button>
      </td>
  `;

  // Append the new row to the table body
  document.getElementById("menuItemsList").appendChild(newRow);
}
