<section class="py-20 md:py-28">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 fade-up">
        <div class="text-center mb-12">
            <p class="text-xs tracking-[0.3em] uppercase text-bronze font-semibold mb-3">Consultation</p>
            <h1 class="font-heading text-3xl md:text-4xl font-bold text-charcoal">Book a Consultation</h1>
            <p class="mt-3 text-charcoal/60">Consultation Fee: <strong class="text-bronze">₹<?= number_format($consultation_fee ?? 2100) ?></strong></p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-600 text-sm rounded">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/book-consultation" class="bg-white border border-charcoal/10 rounded-sm p-8 space-y-5">
            <?= csrf_field() ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Full Name *</label>
                    <input type="text" name="full_name" required value="<?= old('full_name') ?>"
                           class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Mobile Number *</label>
                    <input type="tel" name="mobile" required value="<?= old('mobile') ?>"
                           class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze focus:border-transparent outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Email</label>
                    <input type="email" name="email" value="<?= old('email') ?>"
                           class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">City</label>
                    <input type="text" name="city" value="<?= old('city') ?>"
                           class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze focus:border-transparent outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-charcoal mb-1">Legal Matter</label>
                <input type="text" name="legal_matter" value="<?= old('legal_matter') ?>" placeholder="Brief description of your legal matter"
                       class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze focus:border-transparent outline-none">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Consultation Mode *</label>
                    <select name="consultation_mode" required class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze focus:border-transparent outline-none">
                        <option value="online" <?= old('consultation_mode') === 'online' ? 'selected' : '' ?>>Online</option>
                        <option value="offline" <?= old('consultation_mode') === 'offline' ? 'selected' : '' ?>>Offline (In-Person)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-charcoal mb-1">Preferred Date</label>
                    <input type="date" name="preferred_date" value="<?= old('preferred_date') ?>"
                           class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze focus:border-transparent outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-charcoal mb-1">Preferred Time</label>
                <input type="text" name="preferred_time" value="<?= old('preferred_time') ?>" placeholder="e.g., 10:00 AM - 12:00 PM"
                       class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze focus:border-transparent outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-charcoal mb-1">Brief Description</label>
                <textarea name="description" rows="4" placeholder="Provide details about your legal matter..."
                          class="w-full px-4 py-2.5 border border-charcoal/20 rounded-sm text-sm focus:ring-2 focus:ring-bronze focus:border-transparent outline-none resize-none"><?= old('description') ?></textarea>
            </div>

            <div class="flex items-start gap-3">
                <input type="checkbox" name="agree_terms" value="1" id="agree_terms" required
                       class="mt-1 rounded border-charcoal/30 text-bronze focus:ring-bronze">
                <label for="agree_terms" class="text-sm text-charcoal/70">
                    I have read and agree to the
                    <a href="/terms-conditions" target="_blank" class="text-bronze hover:underline">Terms &amp; Conditions</a>,
                    <a href="/refund-cancellation-policy" target="_blank" class="text-bronze hover:underline">Refund &amp; Cancellation Policy</a>, and
                    <a href="/privacy-policy" target="_blank" class="text-bronze hover:underline">Privacy Policy</a>.
                    <span class="text-red-500">*</span>
                </label>
            </div>

            <button type="submit" id="submitBtn" class="w-full bg-charcoal text-white py-3.5 rounded-sm text-sm font-medium hover:bg-gray-800 transition">
                Proceed to Payment
            </button>
        </form>
        <script>
        (function(){
            var form = document.querySelector('form[action="/book-consultation"]');
            if(!form) return;
            form.addEventListener('submit', function(){
                var btn = document.getElementById('submitBtn');
                if(btn){
                    btn.disabled = true;
                    btn.textContent = 'Submitting...';
                    btn.classList.add('opacity-60','cursor-not-allowed');
                }
            });
        })();
        </script>
    </div>
</section>
