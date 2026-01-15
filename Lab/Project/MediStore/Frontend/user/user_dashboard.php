<?php include("../session_check.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <title>MediStore - User Dashboard</title>
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</head>
<body>
<script>
let allProducts = []; // ✅ store all products globally

async function mountMasterAndContent() {
  // Load master template
  const res = await fetch('./user_master_template.php');
  const html = await res.text();
  const parser = new DOMParser();
  const doc = parser.parseFromString(html, 'text/html');

  document.body.innerHTML = doc.body.innerHTML;

  // Update section title
  document.getElementById('sectionTitle').innerText = 'Browse Our Medicines & Health Essentials';

  // Load products
  try {
    const res = await fetch('../../Backend/admin/list_products.php');
    const data = await res.json();
    if (!data.success) throw new Error('Failed to load products');
    allProducts = data.data; // ✅ save all products
    renderProducts(allProducts);
    setupCategoryFilters(); // ✅ setup sidebar filters
  } catch (e) {
    console.error(e);
    document.getElementById('pageContent').innerHTML =
      '<div class="alert alert-danger">❌ Could not load products.</div>';
  }
}

function renderProducts(products) {
  const container = document.getElementById('pageContent');
  container.innerHTML = '';
  if (!products.length) {
    container.innerHTML = '<div class="alert alert-warning mt-3">No products available.</div>';
    return;
  }
  products.forEach(p => {
    const img = p.image
      ? `<img src="../../Backend/admin/uploads/${p.image}" class="img-fluid mb-3 rounded" alt="${p.name}">`
      : `<img src="https://via.placeholder.com/200x150/0d6efd/ffffff?text=${p.category}" class="img-fluid mb-3 rounded" alt="${p.name}">`;

    container.innerHTML += `
      <div class="col-md-4 mb-4 product-card" data-category="${p.category}" data-name="${p.name.toLowerCase()}">
        <div class="custom-card text-center h-100">
          ${img}
          <h5 class="mb-0 fw-bold">${p.name}</h5>
          <p class="text-muted small">${p.description} (${p.category})</p>
          <h6 class="mb-3">Rs: <span id="price-${p.id}">${p.price}</span></h6>
          <div class="d-flex justify-content-center align-items-center mb-3">
            <button class="btn btn-danger btn-sm" onclick="changeQty('${p.id}', -1)">-</button>
            <span id="qty-${p.id}" class="mx-3 fw-bold">1</span>
            <button class="btn btn-success btn-sm" onclick="changeQty('${p.id}', 1)">+</button>
          </div>
          <button class="btn btn-main w-100" onclick="addToCart('${p.name}', ${p.price}, '${p.id}')">
            <i class="fas fa-cart-plus me-1"></i> Add To Cart
          </button>
        </div>
      </div>
    `;
  });
}

function changeQty(id, value) {
  const qtySpan = document.getElementById("qty-" + id);
  if (!qtySpan) return;
  let current = parseInt(qtySpan.innerText);
  current += value;
  if (current < 1) current = 1;
  qtySpan.innerText = current;
}

function addToCart(name, price, id) {
  const qtySpan = document.getElementById("qty-" + id);
  let qty = qtySpan ? parseInt(qtySpan.innerText) : 1;

  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  let found = false;
  for (let i = 0; i < cart.length; i++) {
    if (cart[i].product === name) {
      cart[i].qty += qty;
      cart[i].total = cart[i].qty * cart[i].price;
      found = true;
      break;
    }
  }
  if (!found) {
    cart.push({ id: id, product: name, price: price, qty: qty, total: price * qty });
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  if (qtySpan) qtySpan.innerText = 1;

  updateCartCount();
  const totalItemsSaved = cart.reduce((sum, item) => sum + item.qty, 0);
  alert(`✅ ${name} (${qty} units) added to cart!\nTotal items saved: ${totalItemsSaved}.`);
}

function updateCartCount() {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
  const cartCountEl = document.getElementById('cartCount');
  if (cartCountEl) cartCountEl.innerText = totalItems;
}

// ✅ Category filter setup
function setupCategoryFilters() {
  document.querySelectorAll('.category-link').forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const selectedCategory = e.target.dataset.category;
      let filtered = [];

      if (selectedCategory === 'All') {
        filtered = allProducts;
      } else if (selectedCategory === 'Others') {
        // ✅ Match both "Other" and "Others"
        filtered = allProducts.filter(p => {
          const cat = p.category.toLowerCase();
          return cat === 'other' || cat === 'others';
        });
      } else {
        filtered = allProducts.filter(p => p.category.toLowerCase() === selectedCategory.toLowerCase());
      }

      console.log("Selected:", selectedCategory, "Filtered:", filtered); // ✅ Debug
      renderProducts(filtered);
    });
  });
}




// Run everything
mountMasterAndContent();
</script>
</body>
</html>
