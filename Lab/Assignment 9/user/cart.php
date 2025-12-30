<?php include("../session_check.php"); ?>
<?php include("user_master_template.php"); ?>

<script>
// Update section title
document.getElementById('sectionTitle').innerText = 'Your Shopping Cart';

// Inject cart layout into pageContent
document.getElementById('pageContent').innerHTML = `
  <div class="row">
    <div class="col-md-8">
      <div id="cartItemsContainer">
        <div class="alert alert-info text-center" id="emptyCartMessage" style="display:none;">
          Your cart is empty. Start adding products from the shop page.
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="checkout-summary mb-4 sticky-top" style="top: 20px;">
        <h4 class="mb-3" style="color: #0a58ca;">Order Summary</h4>
        <ul class="list-group list-group-flush mb-3">
          <li class="list-group-item d-flex justify-content-between">Total Items: <span id="summaryTotalQty">0</span></li>
          <li class="list-group-item d-flex justify-content-between">Subtotal: <span>Rs: <span id="summarySubtotal">0</span></span></li>
          <li class="list-group-item d-flex justify-content-between fw-bold bg-light" style="color: #0d6efd;">Grand Total: <span>Rs: <span id="summaryGrandTotal">0</span></span></li>
        </ul>
        <button type="button" class="btn btn-success w-100 mt-3" onclick="proceedToCheckout()">
          <i class="fas fa-truck me-1"></i> Proceed to Checkout
        </button>
      </div>
    </div>
  </div>
`;

// --- Core Functions using Local Storage ---
function getCart() { 
  const cartData = localStorage.getItem("cart");
  try {
    return cartData ? JSON.parse(cartData) : [];
  } catch (e) {
    console.error("Error parsing cart data:", e);
    return [];
  }
}

function saveCart(cart) { 
  localStorage.setItem("cart", JSON.stringify(cart)); 
  loadCart(); 
  updateCartCount();
}

function calculateTotals(cart) {
  let totalQty = 0; 
  let subtotal = 0;
  cart.forEach(item => { 
    if (typeof item.total === 'number') {
      totalQty += item.qty; 
      subtotal += item.total; 
    }
  });
  document.getElementById('summaryTotalQty').innerText = totalQty;
  document.getElementById('summarySubtotal').innerText = subtotal;
  document.getElementById('summaryGrandTotal').innerText = subtotal; 
}

function updateCartCount() {
  const cart = getCart();
  const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
  const cartCountEl = document.getElementById('cartCount');
  if (cartCountEl) cartCountEl.innerText = totalItems;
}

// --- Load Cart Function ---
function loadCart() {
  const cart = getCart(); 
  const container = document.getElementById('cartItemsContainer');
  if (!container) return;

  // Clear old items
  let existingItems = document.querySelectorAll('.cart-item-card');
  existingItems.forEach(item => item.remove());

  // Show/Hide Empty Message
  const emptyMessage = document.getElementById('emptyCartMessage');
  if (emptyMessage) emptyMessage.style.display = cart.length === 0 ? 'block' : 'none';

  if (cart.length === 0) {
    calculateTotals([]); 
    return;
  }

  cart.forEach((item, index) => {
    const itemHTML = `
      <div class="custom-card mb-3 p-3 d-flex justify-content-between align-items-center cart-item-card">
        <div class="d-flex align-items-center">
          <i class="fas fa-prescription-bottle-alt fa-2x me-3" style="color: #0d6efd;"></i>
          <div>
            <h5 class="mb-0 fw-bold" style="color: #0a58ca;">${item.product}</h5>
            <small class="text-muted">Price: Rs ${item.price}</small>
          </div>
        </div>
        <div class="d-flex align-items-center">
          <div class="d-flex align-items-center me-4">
            <button class="btn btn-danger btn-sm" onclick="updateQty(${index}, -1)">-</button>
            <span class="mx-3 fw-bold">${item.qty}</span>
            <button class="btn btn-success btn-sm" onclick="updateQty(${index}, 1)">+</button>
          </div>
          <h6 class="mb-0 me-4">Total: Rs ${item.total}</h6>
          <button class="btn btn-danger btn-sm" onclick="removeFromCart(${index})">
            <i class="fas fa-trash"></i>
          </button>
        </div>
      </div>
    `;
    container.insertAdjacentHTML('beforeend', itemHTML);
  });
  calculateTotals(cart);
  updateCartCount();
}

// --- Cart Modification Logic ---
function updateQty(index, value) {
  const cart = getCart();
  let item = cart[index];
  let newQty = item.qty + value;

  if (newQty < 1) {
    if (confirm(`Remove ${item.product} from cart?`)) {
      removeFromCart(index);
    }
    return;
  }

  item.qty = newQty;
  item.total = item.qty * item.price;
  saveCart(cart);
}

function removeFromCart(index) {
  const cart = getCart();
  cart.splice(index, 1);
  saveCart(cart);
}

function proceedToCheckout() {
  const cart = getCart();
  if (cart.length === 0) {
    alert("Your cart is empty! Add products before proceeding to checkout.");
    return;
  }
  window.location.href = "checkout.php";
}

// Run everything
loadCart();
</script>
