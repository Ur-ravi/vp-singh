<?php $razorpayEnabled = \App\Libraries\Settings::get('razorpay_enabled', '0') === '1'; ?>
<?php if ($razorpayEnabled): ?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<?php endif; ?>

<section class="py-20 md:py-28">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 fade-up">
        <div class="text-center mb-12">
            <p class="text-xs tracking-[0.3em] uppercase text-bronze font-semibold mb-3">Payment</p>
            <h1 class="font-heading text-3xl md:text-4xl font-bold text-charcoal">Complete Payment</h1>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="mt-4 p-4 bg-green-50 border border-green-200 text-green-700 text-sm rounded">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="mt-4 p-4 bg-red-50 border border-red-200 text-red-600 text-sm rounded">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Booking Summary -->
        <div class="bg-white border border-charcoal/10 rounded-sm p-6 mb-8">
            <h3 class="font-heading text-lg font-bold text-charcoal mb-4">Booking Summary</h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between"><span class="text-charcoal/50">Booking ID</span><span class="font-mono font-medium"><?= esc($consultation->booking_id) ?></span></div>
                <div class="flex justify-between"><span class="text-charcoal/50">Name</span><span class="font-medium"><?= esc($consultation->full_name) ?></span></div>
                <div class="flex justify-between"><span class="text-charcoal/50">Mode</span><span class="font-medium capitalize"><?= esc($consultation->consultation_mode) ?></span></div>
                <div class="flex justify-between border-t pt-2 mt-2"><span class="text-charcoal/50">Consultation Fee</span><span class="font-bold text-bronze">₹<?= number_format($consultation->amount) ?></span></div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- RAZORPAY ONLINE PAYMENT (if enabled)         -->
        <!-- ============================================ -->
        <?php if ($razorpayEnabled): ?>
        <div id="razorpay-section" class="bg-white border-2 border-bronze/30 rounded-sm p-6 mb-6">
            <h3 class="font-heading text-lg font-bold text-charcoal mb-2 flex items-center gap-2">
                <i class="ri-bank-card-line text-bronze"></i> <?= esc(\App\Libraries\Settings::get('razorpay_button_label', 'Pay Online Now')) ?>
            </h3>
            <p class="text-xs text-charcoal/50 mb-4">Pay securely using UPI, Credit/Debit Card, Netbanking or Wallets</p>

            <div id="razorpay-success" style="display:none" class="bg-green-50 border border-green-200 text-green-700 text-sm rounded p-4 mb-4">
                <div class="flex items-center gap-2">
                    <i class="ri-check-line text-green-500 text-lg"></i>
                    <div>
                        <p class="font-medium">Payment Successful!</p>
                        <p class="text-xs mt-1">Redirecting to confirmation page...</p>
                    </div>
                </div>
            </div>

            <div id="razorpay-error" style="display:none" class="bg-red-50 border border-red-200 text-red-600 text-sm rounded p-4 mb-4"></div>

            <button id="razorpayBtn" onclick="startRazorpay()" type="button"
                    class="w-full bg-bronze text-white py-3.5 rounded-sm text-sm font-medium hover:bg-bronze/90 transition flex items-center justify-center gap-2">
                <i class="ri-secure-payment-line"></i>
                <?= esc(\App\Libraries\Settings::get('razorpay_button_label', 'Pay Online Now')) ?> — ₹<?= number_format($consultation->amount) ?>
            </button>

            <p class="text-xs text-charcoal/40 text-center mt-3">
                <i class="ri-lock-line"></i> Payments are processed securely by Razorpay. We do not store your card details.
            </p>
        </div>

        <!-- OR Divider -->
        <div class="flex items-center gap-4 my-6">
            <hr class="flex-1 border-charcoal/10">
            <span class="text-xs text-charcoal/40 uppercase tracking-wider">or pay manually</span>
            <hr class="flex-1 border-charcoal/10">
        </div>
        <?php endif; ?>

        <!-- ============================================ -->
        <!-- QR CODE PAYMENT                              -->
        <!-- ============================================ -->
        <?php if (!empty($qr_methods)): ?>
            <?php foreach ($qr_methods as $qr): ?>
                <div class="bg-white border border-charcoal/10 rounded-sm p-6 mb-6">
                    <h3 class="font-heading text-lg font-bold text-charcoal mb-4 flex items-center gap-2">
                        <i class="ri-qr-code-line text-bronze"></i> <?= esc($qr->label) ?>
                    </h3>
                    <?php if (!empty($qr->qr_image)): ?>
                        <div class="text-center mb-4">
                            <img src="/<?= esc($qr->qr_image) ?>" alt="QR Code" class="w-48 h-48 mx-auto border border-charcoal/10 rounded">
                            <p class="text-lg font-bold text-bronze mt-3">₹<?= number_format($consultation->amount) ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($qr->upi_id)): ?>
                        <div class="bg-ivory p-3 rounded text-center">
                            <p class="text-xs text-charcoal/50 mb-1">UPI ID</p>
                            <p class="font-mono text-sm font-medium text-charcoal" id="upi-id"><?= esc($qr->upi_id) ?></p>
                            <button onclick="navigator.clipboard.writeText('<?= esc($qr->upi_id) ?>').then(()=>this.textContent='Copied!')" class="text-xs text-bronze mt-1 hover:underline">
                                Copy UPI ID
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- ============================================ -->
        <!-- BANK TRANSFER                               -->
        <!-- ============================================ -->
        <?php if (!empty($bank_methods)): ?>
            <?php foreach ($bank_methods as $bank): ?>
                <div class="bg-white border border-charcoal/10 rounded-sm p-6 mb-6">
                    <h3 class="font-heading text-lg font-bold text-charcoal mb-4 flex items-center gap-2">
                        <i class="ri-bank-line text-bronze"></i> <?= esc($bank->label) ?>
                    </h3>
                    <div class="space-y-2 text-sm">
                        <?php if (!empty($bank->account_holder)): ?>
                            <div class="flex justify-between"><span class="text-charcoal/50">Account Holder</span><span class="font-medium"><?= esc($bank->account_holder) ?></span></div>
                        <?php endif; ?>
                        <?php if (!empty($bank->bank_name)): ?>
                            <div class="flex justify-between"><span class="text-charcoal/50">Bank</span><span class="font-medium"><?= esc($bank->bank_name) ?></span></div>
                        <?php endif; ?>
                        <?php if (!empty($bank->account_number)): ?>
                            <div class="flex justify-between items-center">
                                <span class="text-charcoal/50">Account No.</span>
                                <span class="font-mono font-medium flex items-center gap-2">
                                    <?= esc($bank->account_number) ?>
                                    <button onclick="navigator.clipboard.writeText('<?= esc($bank->account_number) ?>').then(()=>this.textContent='Copied!')" class="text-xs text-bronze hover:underline">Copy</button>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($bank->ifsc)): ?>
                            <div class="flex justify-between items-center">
                                <span class="text-charcoal/50">IFSC</span>
                                <span class="font-mono font-medium flex items-center gap-2">
                                    <?= esc($bank->ifsc) ?>
                                    <button onclick="navigator.clipboard.writeText('<?= esc($bank->ifsc) ?>').then(()=>this.textContent='Copied!')" class="text-xs text-bronze hover:underline">Copy</button>
                                </span>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($bank->branch)): ?>
                            <div class="flex justify-between"><span class="text-charcoal/50">Branch</span><span class="font-medium"><?= esc($bank->branch) ?></span></div>
                        <?php endif; ?>
                        <?php if (!empty($bank->account_type)): ?>
                            <div class="flex justify-between"><span class="text-charcoal/50">Type</span><span class="font-medium"><?= esc($bank->account_type) ?></span></div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (empty($qr_methods) && empty($bank_methods) && !$razorpayEnabled): ?>
            <div class="bg-white border border-charcoal/10 rounded-sm p-6 text-center">
                <p class="text-charcoal/60">Payment details will be shared after booking confirmation.</p>
            </div>
        <?php endif; ?>

        <!-- ============================================ -->
        <!-- MANUAL PAYMENT CONFIRMATION FORM             -->
        <!-- ============================================ -->
        <div class="bg-white border border-charcoal/10 rounded-sm p-6 mt-8">
            <h3 class="font-heading text-lg font-bold text-charcoal mb-2">Confirm Manual Payment</h3>
            <p class="text-xs text-charcoal/50 mb-4">Already paid via QR or Bank Transfer? Submit your payment details below.</p>

            <form method="POST" action="/payment/confirm" enctype="multipart/form-data" id="manualPayForm" class="space-y-4">
                <?= csrf_field() ?>
                <input type="hidden" name="booking_id" value="<?= esc($consultation->booking_id) ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Your Name *</label>
                        <input type="text" name="client_name" required value="<?= esc($consultation->full_name) ?>"
                               class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Mobile *</label>
                        <input type="tel" name="mobile" required value="<?= esc($consultation->mobile) ?>"
                               class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">Payment Method *</label>
                        <select name="payment_method" required class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze outline-none">
                            <option value="upi">UPI / QR Code</option>
                            <option value="bank_transfer">Bank Transfer</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-1">UTR / Transaction ID</label>
                        <input type="text" name="utr_number" placeholder="Enter transaction reference"
                               class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Payment Screenshot</label>
                    <input type="file" name="screenshot" accept="image/*"
                           class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:bg-bronze file:text-white file:text-xs file:font-medium">
                </div>

                <button type="submit" id="payBtn" class="w-full bg-charcoal text-white py-3.5 rounded-sm text-sm font-medium hover:bg-gray-800 transition">
                    Submit Payment Confirmation
                </button>
            </form>

            <script>
            (function(){
                var form = document.getElementById('manualPayForm');
                if(!form) return;
                form.addEventListener('submit', function(){
                    var btn = document.getElementById('payBtn');
                    if(btn){
                        btn.disabled = true;
                        btn.textContent = 'Submitting...';
                        btn.classList.add('opacity-60','cursor-not-allowed');
                    }
                });
            })();
            </script>
        </div>

        <!-- Payment already verified message -->
        <?php if (($consultation->payment_status ?? '') === 'verified'): ?>
            <div class="bg-green-50 border border-green-200 rounded-sm p-6 mt-6 text-center">
                <i class="ri-check-double-line text-green-500 text-3xl mb-2"></i>
                <p class="text-green-700 font-medium">Payment Verified</p>
                <p class="text-xs text-green-600 mt-1">Your payment has been confirmed. You will be contacted shortly.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ============================================ -->
<!-- RAZORPAY JS LOGIC                           -->
<!-- ============================================ -->
<?php if ($razorpayEnabled): ?>
<script>
var razorpayInProgress = false;

function startRazorpay() {
    if (razorpayInProgress) return;
    razorpayInProgress = true;

    var btn = document.getElementById('razorpayBtn');
    var errorDiv = document.getElementById('razorpay-error');
    var successDiv = document.getElementById('razorpay-success');
    errorDiv.style.display = 'none';
    btn.disabled = true;
    btn.innerHTML = '<i class="ri-loader-4-line animate-spin"></i> Creating order...';

    // Step 1: Create order via AJAX
    fetch('/api/razorpay/create-order', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
        },
        body: 'booking_id=<?= esc($consultation->booking_id) ?>&csrf_token=<?= csrf_token() ?>'
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
        if (data.error) {
            throw new Error(data.error);
        }

        // Step 2: Open Razorpay checkout
        var options = {
            key: data.key_id,
            amount: data.amount,
            currency: data.currency,
            name: data.name,
            description: data.description,
            order_id: data.order_id,
            prefill: data.prefill,
            theme: {
                color: '#A38366'
            },
            handler: function(response) {
                // Step 3: Payment successful — verify on server
                verifyPayment(response);
            },
            modal: {
                ondismiss: function() {
                    razorpayInProgress = false;
                    btn.disabled = false;
                    btn.innerHTML = '<i class="ri-secure-payment-line"></i> <?= esc(\App\Libraries\Settings::get('razorpay_button_label', 'Pay Online Now')) ?> — ₹<?= number_format($consultation->amount) ?>';
                }
            }
        };

        var rzp = new Razorpay(options);
        rzp.on('payment.failed', function(response) {
            razorpayInProgress = false;
            btn.disabled = false;
            btn.innerHTML = '<i class="ri-secure-payment-line"></i> <?= esc(\App\Libraries\Settings::get('razorpay_button_label', 'Pay Online Now')) ?> — ₹<?= number_format($consultation->amount) ?>';
            errorDiv.innerHTML = '<div class="flex items-center gap-2"><i class="ri-error-warning-line text-red-500"></i><span>Payment failed: ' + (response.error.description || 'Unknown error') + '</span></div>';
            errorDiv.style.display = 'block';
        });

        rzp.open();
    })
    .catch(function(err) {
        razorpayInProgress = false;
        btn.disabled = false;
        btn.innerHTML = '<i class="ri-secure-payment-line"></i> <?= esc(\App\Libraries\Settings::get('razorpay_button_label', 'Pay Online Now')) ?> — ₹<?= number_format($consultation->amount) ?>';
        errorDiv.innerHTML = '<div class="flex items-center gap-2"><i class="ri-error-warning-line text-red-500"></i><span>' + (err.message || 'Something went wrong. Please try again.') + '</span></div>';
        errorDiv.style.display = 'block';
    });
}

function verifyPayment(response) {
    var btn = document.getElementById('razorpayBtn');
    var errorDiv = document.getElementById('razorpay-error');
    var successDiv = document.getElementById('razorpay-success');

    btn.innerHTML = '<i class="ri-loader-4-line animate-spin"></i> Verifying payment...';

    var params = new URLSearchParams({
        razorpay_order_id: response.razorpay_order_id,
        razorpay_payment_id: response.razorpay_payment_id,
        razorpay_signature: response.razorpay_signature,
        booking_id: '<?= esc($consultation->booking_id) ?>',
        client_name: '<?= esc($consultation->full_name) ?>',
        mobile: '<?= esc($consultation->mobile) ?>'
    });

    fetch('/api/razorpay/verify', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
        },
        body: params.toString() + '&csrf_token=<?= csrf_token() ?>'
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
        if (data.success) {
            successDiv.style.display = 'block';
            errorDiv.style.display = 'none';
            btn.style.display = 'none';
            // Hide manual form
            var manualForm = document.getElementById('manualPayForm');
            if (manualForm) manualForm.closest('.bg-white').style.display = 'none';
            // Redirect after 2 seconds
            setTimeout(function() {
                window.location.href = data.redirect;
            }, 2000);
        } else {
            throw new Error(data.error || 'Verification failed');
        }
    })
    .catch(function(err) {
        razorpayInProgress = false;
        btn.disabled = false;
        btn.innerHTML = '<i class="ri-secure-payment-line"></i> <?= esc(\App\Libraries\Settings::get('razorpay_button_label', 'Pay Online Now')) ?> — ₹<?= number_format($consultation->amount) ?>';
        errorDiv.innerHTML = '<div class="flex items-center gap-2"><i class="ri-error-warning-line text-red-500"></i><span>' + (err.message || 'Verification failed. Please contact support.') + '</span></div>';
        errorDiv.style.display = 'block';
    });
}
</script>
<?php endif; ?>
