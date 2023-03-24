// Define a 'bids' array to store bid objects
let bids = [];

// Get DOM elements
const bidTable = document.getElementById("bid-table-body");

// Function to render bid table
function renderBids() {
  // Clear existing rows from the table body
  while (bidTable.lastChild) {
    bidTable.removeChild(bidTable.lastChild);
  }
  
  // Loop through each bid and add a row to the table
  for (let i = 0; i < bids.length; i++) {
    const bid = bids[i];
    const row = document.createElement("tr");
    const itemCell = document.createElement("td");
    const bidderCell = document.createElement("td");
    const amountCell = document.createElement("td");
    const actionsCell = document.createElement("td");
    const deleteButton = document.createElement("button");
    deleteButton.innerText = "Delete";
    deleteButton.addEventListener("click", () => deleteBid(i));
    itemCell.innerText = bid.itemName;
    bidderCell.innerText = bid.bidderName;
    amountCell.innerText = bid.amount;
    actionsCell.appendChild(deleteButton);
    row.appendChild(itemCell);
    row.appendChild(bidderCell);
    row.appendChild(amountCell);
    row.appendChild(actionsCell);
    bidTable.appendChild(row);
  }
}

// Function to add a new bid
function addBid(itemName, bidderName, amount) {
  const bid = { itemName, bidderName, amount };
  bids.push(bid);
  renderBids();
}

// Function to delete a bid
function deleteBid(index) {
  bids.splice(index, 1);
  renderBids();
}

// Example usage
addBid("RX78-2", "John", 500);
addBid("Exia","Sarah", 750);
