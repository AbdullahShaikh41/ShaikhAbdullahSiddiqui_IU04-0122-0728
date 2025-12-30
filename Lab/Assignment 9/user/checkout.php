<?php include("../session_check.php"); ?>
<?php include("user_master_template.php"); ?>

<script>
const cart = JSON.parse(localStorage.getItem("cart")) || [];

document.getElementById('sectionTitle').innerText = 'Checkout';

document.getElementById('pageContent').innerHTML = `
  <div class="card shadow-lg border-0 mb-4">
    <div class="card-header bg-success text-white">
      <h4 class="mb-0"><i class="fas fa-shopping-cart me-2"></i> Order Summary</h4>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <thead class="table-primary">
          <tr><th>Product</th><th>Qty</th><th>Price</th><th>Total</th></tr>
        </thead>
        <tbody>
          ${cart.map(item => `
            <tr>
              <td>${item.product}</td>
              <td>${item.qty}</td>
              <td>Rs ${item.price}</td>
              <td>Rs ${item.total}</td>
            </tr>
          `).join('')}
        </tbody>
      </table>
      <h5 class="text-end text-primary">
        Grand Total: Rs ${cart.reduce((sum, i) => sum + i.total, 0)}
      </h5>
    </div>
  </div>

  <div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0"><i class="fas fa-truck me-2"></i> Delivery Information</h4>
    </div>
    <div class="card-body">
      <form id="checkoutForm" class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Full Name</label>
          <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Contact</label>
          <input type="text" id="contact" name="contact" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Address</label>
          <input type="text" id="address" name="address" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success w-100 mt-3">
          <i class="fas fa-check-circle me-2"></i> Place Order
        </button>
      </form>
    </div>
  </div>
`;

// ✅ Autofill profile data
async function loadProfile() {
  try {
    const res = await fetch('../../Backend/user/get_profile.php');
    const data = await res.json();
    if (data.success) {
      const profile = data.data;
      if (profile.name) document.getElementById('name').value = profile.name;
      if (profile.email) document.getElementById('email').value = profile.email;
      if (profile.contact) document.getElementById('contact').value = profile.contact;
      if (profile.address) document.getElementById('address').value = profile.address;
    }
  } catch (err) {
    console.error("Profile load failed:", err);
  }
}
loadProfile();

document.getElementById('checkoutForm').addEventListener('submit', async function(e) {
  e.preventDefault();

  // ✅ Validate required fields
  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const contact = document.getElementById('contact').value.trim();
  const address = document.getElementById('address').value.trim();

  // ❌ Stop if any field empty
  if (!name || !email || !contact || !address) {
    alert("❌ Please fill in all delivery information fields before placing the order.");
    return;
  }

  // ❌ Stop if address is still "Not Updated"
  if (address.toLowerCase() === "not updated") {
    alert("❌ Please enter a valid delivery address before placing the order.");
    return;
  }

  // ✅ First update profile with delivery info
  const formData = new FormData(e.target);
  const profileRes = await fetch('../../Backend/user/update_profile.php', {
    method: 'POST',
    body: formData
  });
  const profileData = await profileRes.json();
  if (!profileData.success) {
    alert("❌ Failed to update profile: " + profileData.message);
    return;
  }

  // ✅ Then place order (existing logic unchanged)
  const orderData = {
    items: cart,
    total: cart.reduce((sum, i) => sum + i.total, 0)
  };

  try {
    const res = await fetch('../../Backend/user/place_order.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(orderData)
    });

    const data = await res.json();

    if (data.success) {
      alert("✅ Order placed successfully!");
      localStorage.removeItem("cart");
      window.location.href = "my_orders.php";
    } else {
      alert("❌ Failed to place order: " + data.message);
    }
  } catch (err) {
    alert("❌ Network error: " + err);
  }
});


</script>
