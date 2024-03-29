const data = {
  itemTable: "2",
  itemCustomer: "",
  item_1: "Grilled Chicken Salad",
  item_1_hidden: "1",
  item_1_quantity: "2",
  item_2: "Vegetable Stir-Fry",
  item_2_hidden: "7",
  item_2_quantity: "3",
  item_3: "Cheeseburger",
  item_3_hidden: "4",
  item_3_quantity: "4",
  item_4: "Margherita Pizza",
  item_4_hidden: "2",
  item_4_quantity: "3",
  "submit-btn": "Add Menu",
};

const transformedArray = [];

// Loop through the keys of the data object
for (const key in data) {
  if (key.startsWith("item_") && key.endsWith("_quantity")) {
    const itemNumber = key.split("_")[1]; // Extract the item number from the key
    const itemId = data[`item_${itemNumber}_hidden`];
    const itemName = data[`item_${itemNumber}`];
    const itemQuantity = parseInt(data[key]);

    transformedArray.push({
      name: itemName,
      id: parseInt(itemId),
      quantity: itemQuantity,
    });
  }
}

console.log(transformedArray);
