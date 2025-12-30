<?php include("../session_check.php"); ?>
<?php include("user_master_template.php"); ?>

<script>
document.getElementById('sectionTitle').innerText = 'My Profile';

// Render editable form instead of static table
document.getElementById('pageContent').innerHTML = `
  <div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0"><i class="fas fa-user-circle me-2"></i> Profile Information</h4>
    </div>
    <div class="card-body">
      <form id="profileForm" class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Full Name</label>
          <input type="text" id="name" name="name" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" id="email" name="email" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Phone</label>
          <input type="text" id="contact" name="contact" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label">Address</label>
          <input type="text" id="address" name="address" class="form-control">
        </div>
        <button type="submit" class="btn btn-success w-100 mt-3">
          <i class="fas fa-save me-2"></i> Update Profile
        </button>
      </form>
    </div>
  </div>
`;

// ✅ Load profile from backend
async function loadProfile() {
  try {
    const res = await fetch('../../Backend/user/get_profile.php');
    const data = await res.json();
    if (data.success) {
      const profile = data.data;
      document.getElementById('name').value = profile.name || '';
      document.getElementById('email').value = profile.email || '';
      document.getElementById('contact').value = profile.contact || '';
      document.getElementById('address').value = profile.address || '';
    }
  } catch (err) {
    console.error("Profile load failed:", err);
  }
}
loadProfile();

// ✅ Update profile on submit
document.getElementById('profileForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  const formData = new FormData(e.target);
  try {
    const res = await fetch('../../Backend/user/update_profile.php', {
      method: 'POST',
      body: formData
    });
    const data = await res.json();
    if (data.success) {
      alert("✅ Profile updated successfully!");
    } else {
      alert("❌ Failed to update profile: " + data.message);
    }
  } catch (err) {
    alert("❌ Network error: " + err);
  }
});
</script>
