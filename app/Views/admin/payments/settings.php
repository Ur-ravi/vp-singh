<div class="space-y-6 max-w-2xl">

    <!-- Consultation Fee -->
    <form method="POST" action="/admin/payments/settings/save" class="bg-white rounded-lg shadow p-6">
        <?= csrf_field() ?>
        <h3 class="font-semibold text-charcoal mb-4">Consultation Fee</h3>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Fee (₹)</label>
            <input type="number" name="consultation_fee" value="<?= \App\Libraries\Settings::get('consultation_fee', '2100') ?>"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
        </div>
        <p class="text-xs text-gray-400 mt-2">This amount is displayed everywhere on the website. Change it anytime.</p>
        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-charcoal text-white px-8 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800 transition">Save</button>
        </div>
    </form>

    <!-- Razorpay Settings -->
    <form method="POST" action="/admin/payments/settings/razorpay/save" class="bg-white rounded-lg shadow p-6">
        <?= csrf_field() ?>

        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="font-semibold text-charcoal">Razorpay Online Payment</h3>
                <p class="text-xs text-gray-400 mt-1">Accept UPI, Cards, Netbanking &amp; Wallets via Razorpay</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="razorpay_enabled" value="1"
                       <?= \App\Libraries\Settings::get('razorpay_enabled', '0') === '1' ? 'checked' : '' ?>
                       class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-bronze"></div>
            </label>
        </div>

        <div id="razorpayFields" style="<?= \App\Libraries\Settings::get('razorpay_enabled', '0') === '1' ? '' : 'display:none' ?>">
            <div class="space-y-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Razorpay Key ID <span class="text-red-500">*</span></label>
                    <input type="text" name="razorpay_key_id" placeholder="rzp_test_XXXXXXXXXXXX"
                           value="<?= esc(\App\Libraries\Settings::get('razorpay_key_id', '')) ?>"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none font-mono">
                    <p class="text-xs text-gray-400 mt-1">Found in your Razorpay Dashboard → Settings → API Keys</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Razorpay Key Secret <span class="text-red-500">*</span></label>
                    <input type="password" name="razorpay_key_secret" placeholder="Enter your Key Secret"
                           value="<?= esc(\App\Libraries\Settings::get('razorpay_key_secret', '')) ?>"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none font-mono">
                    <p class="text-xs text-gray-400 mt-1">Only visible once in Razorpay Dashboard. Save it securely.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Razorpay Button Label</label>
                    <input type="text" name="razorpay_button_label" placeholder="Pay with Razorpay"
                           value="<?= esc(\App\Libraries\Settings::get('razorpay_button_label', 'Pay Online Now')) ?>"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-bronze outline-none">
                </div>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-4">
                <div class="flex gap-2">
                    <i class="ri-information-line text-blue-500 mt-0.5"></i>
                    <div class="text-xs text-blue-700 space-y-1">
                        <p><strong>How to set up Razorpay:</strong></p>
                        <ol class="list-decimal ml-4 space-y-1">
                            <li>Create an account at <a href="https://dashboard.razorpay.com/" target="_blank" class="underline">dashboard.razorpay.com</a></li>
                            <li>Go to <strong>Settings → API Keys</strong> and generate keys</li>
                            <li>Paste the <strong>Key ID</strong> and <strong>Key Secret</strong> above</li>
                            <li>Toggle the switch ON and save</li>
                        </ol>
                        <p class="mt-2">⚠️ Use <strong>Test keys</strong> during development. Switch to <strong>Live keys</strong> before going live.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-charcoal text-white px-8 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-800 transition">Save Razorpay Settings</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var toggle = document.querySelector('input[name="razorpay_enabled"]');
    var fields = document.getElementById('razorpayFields');
    if (toggle && fields) {
        toggle.addEventListener('change', function() {
            fields.style.display = this.checked ? '' : 'none';
        });
    }
});
</script>
