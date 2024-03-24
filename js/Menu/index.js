import { apiUrl, baseUrl } from "../modules/config.js";
const addItemModal = new bootstrap.Modal(
  document.getElementById("addItemModal"),
  {}
);
const editItemModal = new bootstrap.Modal(
  document.getElementById("editItemModal"),
  {}
);

//add binding for delete button
function deleteItemBinding() {
  $(".delete-btn").on("click", async function (e) {
    e.preventDefault();
    let $this = $(this);
    const item_id = $this.data("item-id");
    Swal.fire({
      title: "Are you sure?",
      text: "Do you want to remove this item from menu?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, delete it!",
    }).then(async (result) => {
      if (result.isConfirmed) {
        const response = await deleteMenuItem(item_id);
        if (response) {
          const data = response.data;
          if (data === true) {
            // Find the parent <tr> element and remove it
            $(this).closest("tr").remove();
            swal.fire({
              icon: "success",
              title: "Menu item successfully deleted!",
            });
          }
        }
      }
    });
  });
}

//add binding for edit button
function editItemBinding() {
  $(".edit-btn").on("click", async function () {
    let $this = $(this);
    let itemId = $this.data("item-id");
    let response = await getMenuItem(itemId);
    if (response) {
      const item = response.data;
      const { Name, Description, Price, MenuItemId } = item;
      console.log(item);
      $("#editItemName").val(Name);
      $("#editItemDescription").val(Description);
      $("#editItemPrice").val(Price);
      $("#editItemId").val(MenuItemId);
      // Show the edit modal
      editItemModal.show();
    }

    // Populate edit modal with item details
  });
}

$(document).ready(async function () {
  $("#addItemBtn").on("click", function (e) {
    e.preventDefault();
    addItemModal.show();
  });

  //add binding for delete button
  deleteItemBinding();

  //add binding for edit button
  editItemBinding();

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

  $("#editItemForm").validate({
    rules: {
      editItemName: {
        required: true,
      },
      editItemDescription: {
        required: true,
      },
      editItemPrice: {
        required: true,
        positiveNumber: true,
      },
    },
    messages: {
      editItemName: "Please enter menu item name",
      editItemDescription: {
        required: "Please enter the item description.",
      },
      editItemPrice: {
        required: "Please enter the item price.",
        positiveNumber: "Please enter a positive number for the price.",
      },
    },
    submitHandler: editEventHandler,
  });
});

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

async function updateMenuItem(menuId, data) {
  try {
    const result = await axios.put(`${apiUrl}/menu-item`, {
      data,
      menuId,
    });
    return result;
  } catch (error) {
    console.log(error);
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

async function deleteMenuItem($id) {
  try {
    const result = await axios.delete(`${apiUrl}/menu-item?item=${$id}`);
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

async function editEventHandler(form, event) {
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
  if (formData) {
    const { editItemName, editItemDescription, editItemPrice, editItemId } =
      formData;
    const data = {
      name: editItemName,
      description: editItemDescription,
      price: parseFloat(editItemPrice),
    };
    const menuId = parseInt(editItemId);
    const response = await updateMenuItem(menuId, data);
    if (response) {
      const isUpdated = response.data;
      if (isUpdated) {
        Swal.fire({
          title: "Success",
          text: "Menu item updated successfully",
          icon: "success",
        }).then(() => {
          editItemModal.hide();
          location.reload(); // Refresh the page
        });
      }
    }
  }
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

  deleteItemBinding();
  editItemBinding();
}
