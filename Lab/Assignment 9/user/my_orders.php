<?php include("../session_check.php"); ?>
<?php include("user_master_template.php"); ?>

<script>
document.getElementById('sectionTitle').innerText = 'My Orders';

async function loadOrders() {
  try {
    const res = await fetch('../../Backend/user/get_orders.php');   // ✅ correct path
    const data = await res.json();

    const container = document.getElementById('pageContent');
    container.innerHTML = '';

    if (!data.success || !data.orders.length) {
      container.innerHTML = '<div class="alert alert-warning">No orders found.</div>';
      return;
    }

    data.orders.forEach(order => {
      // Build items table
      let itemsHTML = `
        <table class="table table-sm table-striped mt-2">
          <thead class="table-light">
            <tr>
              <th>Product</th>
              <th>Qty</th>
              <th>Price</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
      `;
      order.items.forEach(item => {
        itemsHTML += `
          <tr>
            <td>${item.name}</td>
            <td>${item.quantity}</td>
            <td>Rs ${item.price}</td>
            <td>Rs ${item.quantity * item.price}</td>
          </tr>
        `;
      });
      itemsHTML += `</tbody></table>`;

      container.innerHTML += `
        <div class="custom-card mb-4 p-3 shadow-sm">
          <h5 class="fw-bold text-primary">Order #${order.id}</h5>
          <p>Status: <span class="badge bg-info">${order.status}</span></p>
          <p><small>Placed on: ${order.created_at}</small></p>
          ${itemsHTML}
          <h6 class="text-end text-success">Grand Total: Rs ${order.total}</h6>
        </div>
      `;
    });
  } catch (err) {
    document.getElementById('pageContent').innerHTML =
      '<div class="alert alert-danger">❌ Failed to load orders.</div>';
    console.error(err);
  }
}

loadOrders();
</script>
