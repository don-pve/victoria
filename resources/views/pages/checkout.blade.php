@extends('layouts.app')
@section('content')
  {{-- @include('components.front-header') --}}
  <!-- resources/views/checkout.blade.php -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-fish me-2"></i>Victoria Fishing License Application</h4>
                </div>
                <div class="card-body">
                  <form id="licenseForm" action="{{ route('checkout.create') }}" method="POST">
                      @csrf
                      
                      <!-- Personal Information -->
                      <h5 class="mb-3 border-bottom pb-2">Personal Details</h5>
                      <div class="row g-3">
                          <div class="col-md-6">
                              <label for="givenName" class="form-label">Given Name*</label>
                              <input type="text" class="form-control" id="givenName" name="given_name" required>
                          </div>
                          <div class="col-md-6">
                              <label for="familyName" class="form-label">Family Name*</label>
                              <input type="text" class="form-control" id="familyName" name="family_name" required>
                          </div>
                          <div class="col-md-6">
                              <label for="dob" class="form-label">Date of Birth*</label>
                              <input type="date" class="form-control" id="dob" name="dob" required>
                          </div>
                          <div class="col-md-6">
                              <label for="phone" class="form-label">Phone*</label>
                              <input type="tel" class="form-control" id="phone" name="phone" required>
                          </div>
                          <div class="col-md-6">
                              <label for="email" class="form-label">Email*</label>
                              <input type="email" class="form-control" id="email" name="email" required>
                          </div>
                          <div class="col-md-6">
                              <label for="confirmEmail" class="form-label">Confirm Email*</label>
                              <input type="email" class="form-control" id="confirmEmail" name="email_confirmation" required>
                          </div>
                      </div>

                      <!-- License Type Selection -->
                      <h5 class="mt-4 mb-3 border-bottom pb-2">License Type</h5>
                      <div class="list-group">
                          <label class="list-group-item d-flex gap-3">
                              <input class="form-check-input flex-shrink-0 mt-1" type="radio" 
                                     name="license_type" value="3-Day" checked
                                     data-variant-id="gid://shopify/ProductVariant/45345660108994">
                              <div class="w-100">
                                  <div class="d-flex justify-content-between">
                                      <strong>3-Day License</strong>
                                      <span class="text-success fw-bold">$60.00</span>
                                  </div>
                                  <small class="text-muted">Valid for 72 hours from purchase</small>
                              </div>
                          </label>
                          
                          <label class="list-group-item d-flex gap-3">
                              <input class="form-check-input flex-shrink-0 mt-1" type="radio" 
                                     name="license_type" value="28-day"
                                     data-variant-id="gid://shopify/ProductVariant/45345942372546">
                              <div class="w-100">
                                  <div class="d-flex justify-content-between">
                                      <strong>28-Day License</strong>
                                      <span class="text-success fw-bold">$74.00</span>
                                  </div>
                                  <small class="text-muted">Valid for 4 weeks</small>
                              </div>
                          </label>
                          
                          <label class="list-group-item d-flex gap-3">
                              <input class="form-check-input flex-shrink-0 mt-1" type="radio" 
                                     name="license_type" value="1-year"
                                     data-variant-id="gid://shopify/ProductVariant/45346275524802">
                              <div class="w-100">
                                  <div class="d-flex justify-content-between">
                                      <strong>1-Year License</strong>
                                      <span class="text-success fw-bold">$90.00</span>
                                  </div>
                                  <small class="text-muted">Valid for 12 months</small>
                              </div>
                          </label>
                          
                          <label class="list-group-item d-flex gap-3">
                              <input class="form-check-input flex-shrink-0 mt-1" type="radio" 
                                     name="license_type" value="3-year"
                                     data-variant-id="gid://shopify/ProductVariant/45346283323586">
                              <div class="w-100">
                                  <div class="d-flex justify-content-between">
                                      <strong>3-Year License</strong>
                                      <span class="text-success fw-bold">$159.00</span>
                                  </div>
                                  <small class="text-muted">Valid for 36 months</small>
                              </div>
                          </label>
                      </div>
                      <input type="hidden" id="selectedVariant" name="variant_id" value="gid://shopify/ProductVariant/45345660108994">

                      <!-- Terms and Submit -->
                      <div class="mt-4 border-top pt-3">
                          <div class="form-check mb-3">
                              <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                              <label class="form-check-label" for="terms">
                                  I agree to the <a href="/terms">terms and conditions</a> and confirm all information is accurate
                              </label>
                          </div>
                          
                          <div class="d-grid">
                              <button type="submit" class="btn btn-primary btn-lg">
                                  <i class="bi bi-credit-card me-2"></i>Proceed to Payment
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('custom-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('licenseForm');
    
    // Set initial variant ID from checked radio
    const initialRadio = form.querySelector('input[name="license_type"]:checked');
    document.getElementById('selectedVariant').value = initialRadio.dataset.variantId;
    
    // Update variant ID when selection changes
    form.querySelectorAll('input[name="license_type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const variantId = this.dataset.variantId;
            document.getElementById('selectedVariant').value = variantId;
            console.log('Variant ID updated to:', variantId);
        });
    });
    
    // Validate form before submission
    form.addEventListener('submit', function(e) {
        // Verify variant ID is set
        const variantId = document.getElementById('selectedVariant').value;
        if (!variantId) {
            e.preventDefault();
            alert('Please select a license type');
            return;
        }
        
        // Verify emails match
        const email = document.getElementById('email');
        const confirmEmail = document.getElementById('confirmEmail');
        if (email.value !== confirmEmail.value) {
            e.preventDefault();
            alert('Email addresses must match');
            return;
        }
        
        // Verify terms are accepted
        if (!document.getElementById('terms').checked) {
            e.preventDefault();
            alert('You must accept the terms and conditions');
            return;
        }
        
        // Show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
            Processing...
        `;
        
        console.log('Submitting form with variant ID:', variantId);
    });
});
</script>
@endsection