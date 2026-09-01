<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PagesSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $pages = [
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => '<p>This Privacy Policy describes how V P Singh Advocate ("we", "our", or "us") collects, uses, stores, and protects your personal information when you visit our website or use our services. By accessing or using our website, you agree to the practices described in this policy.</p>

<h3>1. Information We Collect</h3>
<p>We may collect the following types of personal information:</p>
<ul>
<li><strong>Personal Identification Information:</strong> Name, email address, phone number, city, and other contact details you provide when submitting a contact form, booking a consultation, or communicating with us.</li>
<li><strong>Legal Matter Details:</strong> Information about your legal situation, case type, and related details you voluntarily share during consultations or enquiries.</li>
<li><strong>Payment Information:</strong> Transaction details such as UTR numbers and payment confirmation screenshots when you make a payment for consultation services.</li>
<li><strong>Technical Information:</strong> IP address, browser type, operating system, referring URLs, and pages visited, collected automatically through server logs and cookies.</li>
</ul>

<h3>2. How We Use Your Information</h3>
<p>We use the collected information for the following purposes:</p>
<ul>
<li>To provide legal consultation services and respond to your enquiries.</li>
<li>To process and manage your consultation bookings and payments.</li>
<li>To communicate regarding your legal matters, appointments, and service updates.</li>
<li>To improve our website, services, and user experience.</li>
<li>To comply with legal obligations and professional regulatory requirements.</li>
</ul>

<h3>3. Confidentiality</h3>
<p>All communications and information shared with V P Singh Advocate are treated as strictly confidential in accordance with the Advocates Act, 1961 and the Bar Council of India Rules. We do not disclose your personal information or case details to any third party without your explicit consent, except as required by law or court order.</p>

<h3>4. Data Security</h3>
<p>We implement appropriate technical and organisational security measures to protect your personal information against unauthorised access, alteration, disclosure, or destruction. However, no method of transmission over the internet or electronic storage is completely secure, and we cannot guarantee absolute security.</p>

<h3>5. Data Retention</h3>
<p>We retain your personal information only for as long as necessary to fulfil the purposes for which it was collected, or as required by applicable law and professional regulations. Consultation records may be retained for a period as mandated by the Bar Council of India.</p>

<h3>6. Third-Party Services</h3>
<p>Our website may use third-party services such as payment gateways (Razorpay) for processing transactions. These third parties have their own privacy policies governing the use of your information. We encourage you to review their privacy policies.</p>

<h3>7. Your Rights</h3>
<p>You have the right to:</p>
<ul>
<li>Access the personal information we hold about you.</li>
<li>Request correction of inaccurate or incomplete information.</li>
<li>Request deletion of your personal information, subject to legal and professional retention requirements.</li>
<li>Withdraw consent for data processing at any time.</li>
</ul>

<h3>8. Cookies</h3>
<p>Our website uses cookies to enhance your browsing experience and maintain session functionality. For detailed information, please refer to our <a href="/cookie-policy" class="text-bronze hover:underline">Cookie Policy</a>.</p>

<h3>9. Changes to This Policy</h3>
<p>We may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated effective date. We encourage you to review this policy periodically.</p>

<h3>10. Contact Us</h3>
<p>If you have any questions about this Privacy Policy or wish to exercise your data rights, please contact us at:</p>
<p>V P Singh Advocate<br>Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, India<br>Email: <a href="mailto:info@vpsinghadvocate.com" class="text-bronze hover:underline">info@vpsinghadvocate.com</a></p>

<p><em>Effective Date: January 2026</em></p>',
                'template' => 'default',
                'is_published' => 1,
                'sort_order' => 10,
                'seo_title' => 'Privacy Policy | V P Singh Advocate',
                'seo_description' => 'Privacy policy of V P Singh Advocate. Learn how we collect, use, and protect your personal information.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-conditions',
                'content' => '<p>By accessing and using the V P Singh Advocate website ("Website"), you agree to be bound by the following Terms and Conditions. If you do not agree with any part of these terms, please do not use this Website.</p>

<h3>1. About Us</h3>
<p>V P Singh Advocate is a legal practice based in Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, India, providing legal consultation and representation across multiple areas of law.</p>

<h3>2. Website Usage</h3>
<ul>
<li>The content on this Website is for general informational purposes only. It does not constitute legal advice.</li>
<li>You may not use this Website for any unlawful or unauthorised purpose.</li>
<li>You may not attempt to gain unauthorised access to any part of this Website, its servers, or any connected databases or systems.</li>
<li>We reserve the right to restrict access to certain areas of this Website at our discretion.</li>
</ul>

<h3>3. Intellectual Property</h3>
<p>All content on this Website, including text, graphics, logos, images, and layout, is the property of V P Singh Advocate and is protected under applicable intellectual property laws. You may not reproduce, distribute, modify, or create derivative works from any content without prior written consent.</p>

<h3>4. Consultation Services</h3>
<ul>
<li>Booking a consultation through this Website does not guarantee any specific outcome for your legal matter.</li>
<li>Legal matters are subject to various factors beyond the control of any legal practitioner.</li>
<li>An advocate-client relationship is established only upon formal engagement through a signed engagement letter or written agreement, not merely by visiting this Website or submitting a consultation form.</li>
<li>Information shared during consultations is treated as confidential in accordance with professional legal standards.</li>
</ul>

<h3>5. Payments</h3>
<ul>
<li>Consultation fees must be paid as per the published rates at the time of booking.</li>
<li>Payment does not guarantee a specific outcome of the legal matter.</li>
<li>Refunds are subject to our Refund and Cancellation Policy.</li>
<li>All payments are processed through secure payment gateways. We do not store your banking or card details.</li>
</ul>

<h3>6. Limitation of Liability</h3>
<p>To the maximum extent permitted by law:</p>
<ul>
<li>V P Singh Advocate shall not be liable for any indirect, incidental, special, or consequential damages arising from your use of this Website.</li>
<li>We do not warrant that this Website will be available at all times, error-free, or free from viruses or other harmful components.</li>
<li>Any reliance you place on information from this Website is strictly at your own risk.</li>
</ul>

<h3>7. External Links</h3>
<p>This Website may contain links to third-party websites. We are not responsible for the content, privacy practices, or accuracy of any third-party websites.</p>

<h3>8. Governing Law</h3>
<p>These Terms and Conditions are governed by and construed in accordance with the laws of India. Any disputes shall be subject to the exclusive jurisdiction of the courts in Lakhimpur Kheri, Uttar Pradesh.</p>

<h3>9. Changes to These Terms</h3>
<p>We reserve the right to modify these Terms and Conditions at any time. Changes will be effective immediately upon posting on this page. Your continued use of this Website after any changes constitutes acceptance of the revised terms.</p>

<h3>10. Contact</h3>
<p>For questions regarding these Terms and Conditions, please contact:</p>
<p>V P Singh Advocate<br>Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, India<br>Email: <a href="mailto:info@vpsinghadvocate.com" class="text-bronze hover:underline">info@vpsinghadvocate.com</a></p>

<p><em>Effective Date: January 2026</em></p>',
                'template' => 'default',
                'is_published' => 1,
                'sort_order' => 11,
                'seo_title' => 'Terms & Conditions | V P Singh Advocate',
                'seo_description' => 'Terms and conditions for using the V P Singh Advocate website and consultation services.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Legal Disclaimer',
                'slug' => 'legal-disclaimer',
                'content' => '<p><strong>Important Notice — Please Read Carefully</strong></p>

<h3>1. No Legal Advice</h3>
<p>The information provided on this Website is for general informational and educational purposes only. It should not be treated as, or relied upon as, legal advice. No advocate-client relationship is created by viewing this Website, reading its content, or contacting us through this Website.</p>

<h3>2. No Advocate-Client Relationship</h3>
<p>Use of this Website, including the submission of contact forms, enquiry forms, or consultation booking forms, does not establish an advocate-client relationship. An advocate-client relationship is established only through a formal written engagement agreement signed by both parties.</p>
<p>Do not send confidential or sensitive information through contact forms or email until a formal advocate-client relationship has been established.</p>

<h3>3. Accuracy of Information</h3>
<p>While we make reasonable efforts to ensure that the information on this Website is accurate and up to date, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, or availability of the information, services, or related graphics contained on this Website.</p>

<h3>4. Legal Developments</h3>
<p>The information on this Website may not reflect the most current legal developments, judgments, verdicts, settlements, or legislation. Laws and legal interpretations are subject to change, and the information presented may become outdated.</p>

<h3>5. No Guarantee of Outcomes</h3>
<p>Any descriptions of past results, case studies, or practice area information on this Website do not guarantee or predict similar outcomes in future cases. Every legal matter is unique and depends on its specific facts and circumstances.</p>

<h3>6. Jurisdictional Limitations</h3>
<p>The legal information provided on this Website is primarily relevant to the jurisdiction of India, and specifically Uttar Pradesh. Laws vary by jurisdiction, and the information may not be applicable to your particular situation or location.</p>

<h3>7. Professional Standards</h3>
<p>V P Singh Advocate is registered with the Bar Council of India and adheres to the Advocates Act, 1961 and the Bar Council of India Rules of Professional Conduct and Etiquette.</p>

<h3>8. External Links</h3>
<p>This Website may contain links to external websites for reference purposes. We do not endorse, and are not responsible for, the content of any linked websites.</p>

<h3>9. Limitation of Liability</h3>
<p>V P Singh Advocate shall not be liable for any loss or damage, including without limitation, indirect or consequential loss or damage, arising from the use of this Website or reliance on any information provided herein.</p>

<h3>10. Contact for Legal Advice</h3>
<p>For specific legal advice regarding your situation, please schedule a consultation with V P Singh Advocate:</p>
<p>V P Singh Advocate<br>Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, India<br>Email: <a href="mailto:info@vpsinghadvocate.com" class="text-bronze hover:underline">info@vpsinghadvocate.com</a></p>

<p><em>Effective Date: January 2026</em></p>',
                'template' => 'default',
                'is_published' => 1,
                'sort_order' => 12,
                'seo_title' => 'Legal Disclaimer | V P Singh Advocate',
                'seo_description' => 'Legal disclaimer for V P Singh Advocate website. No legal advice, no advocate-client relationship.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Refund & Cancellation Policy',
                'slug' => 'refund-cancellation-policy',
                'content' => '<p>This Refund and Cancellation Policy outlines the terms governing refunds and cancellations for consultation services provided by V P Singh Advocate.</p>

<h3>1. Consultation Booking</h3>
<p>When you book a consultation through our Website, you are required to pay the consultation fee as displayed at the time of booking. Payment confirms your consultation booking and secures your scheduled time slot.</p>

<h3>2. Cancellation by Client</h3>
<ul>
<li><strong>More than 24 hours before the scheduled consultation:</strong> You may request a cancellation by contacting us at least 24 hours before your scheduled consultation time. A full refund will be processed within 5-7 business days.</li>
<li><strong>Less than 24 hours before the scheduled consultation:</strong> Cancellations made less than 24 hours before the scheduled time may be subject to a cancellation fee of 50% of the consultation fee.</li>
<li><strong>No-show:</strong> If you fail to attend the scheduled consultation without prior notice, the consultation fee will not be refunded.</li>
</ul>

<h3>3. Rescheduling</h3>
<p>You may request to reschedule your consultation at no additional cost if the request is made at least 12 hours before the scheduled time. Rescheduling is subject to availability.</p>

<h3>4. Cancellation by V P Singh Advocate</h3>
<p>In the event that V P Singh Advocate needs to cancel or reschedule a consultation due to unforeseen circumstances, you will be offered a full refund or the option to reschedule at your convenience, at no additional cost.</p>

<h3>5. Refund Process</h3>
<ul>
<li>Refund requests should be submitted via email to <a href="mailto:info@vpsinghadvocate.com" class="text-bronze hover:underline">info@vpsinghadvocate.com</a> with your booking ID and reason for the refund request.</li>
<li>Refunds will be processed within 5-7 business days from the date of approval.</li>
<li>Refunds will be made to the original payment method. In case of UPI or bank transfer payments, refunds will be processed to the same account.</li>
</ul>

<h3>6. Non-Refundable Situations</h3>
<p>The following are not eligible for refunds:</p>
<ul>
<li>Consultation fees after the consultation has been completed.</li>
<li>Fees for additional follow-up consultations unless cancelled in accordance with this policy.</li>
<li>Fees for representation in court or any other legal proceedings (governed by separate engagement terms).</li>
</ul>

<h3>7. Disputes</h3>
<p>If you have any concerns about a charge or refund, please contact us within 7 days of the transaction. We will review your case and respond within 3 business days.</p>

<h3>8. Changes to This Policy</h3>
<p>We reserve the right to update this Refund and Cancellation Policy at any time. Changes will be posted on this page with an updated effective date.</p>

<h3>9. Contact</h3>
<p>For refund or cancellation requests, please contact:</p>
<p>V P Singh Advocate<br>Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, India<br>Email: <a href="mailto:info@vpsinghadvocate.com" class="text-bronze hover:underline">info@vpsinghadvocate.com</a></p>

<p><em>Effective Date: January 2026</em></p>',
                'template' => 'default',
                'is_published' => 1,
                'sort_order' => 13,
                'seo_title' => 'Refund & Cancellation Policy | V P Singh Advocate',
                'seo_description' => 'Refund and cancellation policy for V P Singh Advocate consultation services.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Cookie Policy',
                'slug' => 'cookie-policy',
                'content' => '<p>This Cookie Policy explains how V P Singh Advocate ("we", "our", or "us") uses cookies and similar technologies when you visit our website. This policy helps you understand what cookies are, how we use them, and how you can manage your cookie preferences.</p>

<h3>1. What Are Cookies?</h3>
<p>Cookies are small text files that are placed on your computer or mobile device when you visit a website. They are widely used to make websites work efficiently, provide a better user experience, and supply information to the website owners.</p>

<h3>2. How We Use Cookies</h3>
<p>We use cookies for the following purposes:</p>
<ul>
<li><strong>Essential Cookies:</strong> These are necessary for the Website to function properly. They enable core features such as session management, security (CSRF protection), and form submissions. Without these cookies, the Website cannot function correctly.</li>
<li><strong>Session Cookies:</strong> These temporary cookies exist only while you browse the Website. They are used to maintain your session state and are automatically deleted when you close your browser.</li>
<li><strong>Functional Cookies:</strong> These cookies remember your preferences and settings to provide a personalised experience.</li>
</ul>

<h3>3. Specific Cookies We Use</h3>
<p>We use the following cookies on our website:</p>
<ul>
<li><strong>ci_session</strong> — Maintains your session state across page requests. Duration: Session only.</li>
<li><strong>csrf_cookie_name</strong> — Protects against Cross-Site Request Forgery (CSRF) attacks. Duration: 2 hours.</li>
</ul>

<h3>4. Third-Party Cookies</h3>
<p>We may use third-party services that set their own cookies:</p>
<ul>
<li><strong>Google Fonts:</strong> Used to load custom fonts. Google may set cookies to serve fonts efficiently.</li>
<li><strong>Razorpay:</strong> If you make a payment, Razorpay may set cookies for payment processing and fraud prevention.</li>
</ul>
<p>We do not control third-party cookies. Please refer to the respective third-party privacy policies for more information.</p>

<h3>5. Managing Cookies</h3>
<p>You can control and manage cookies through your browser settings. Most browsers allow you to:</p>
<ul>
<li>View what cookies are set and delete them individually.</li>
<li>Block third-party cookies.</li>
<li>Block all cookies (this may affect Website functionality).</li>
<li>Delete all cookies when you close your browser.</li>
</ul>

<h3>6. Impact of Disabling Cookies</h3>
<p>If you disable or reject cookies, some parts of this Website may not function properly. Specifically:</p>
<ul>
<li>You may not be able to log in to the admin panel.</li>
<li>Form submissions may not work correctly.</li>
<li>Your session may not persist across pages.</li>
</ul>

<h3>7. Changes to This Policy</h3>
<p>We may update this Cookie Policy from time to time. Any changes will be posted on this page with an updated effective date.</p>

<h3>8. Contact</h3>
<p>If you have questions about our use of cookies, please contact:</p>
<p>V P Singh Advocate<br>Mohammadi Kheri, Lakhimpur Kheri, Uttar Pradesh, India<br>Email: <a href="mailto:info@vpsinghadvocate.com" class="text-bronze hover:underline">info@vpsinghadvocate.com</a></p>

<p><em>Effective Date: January 2026</em></p>',
                'template' => 'default',
                'is_published' => 1,
                'sort_order' => 14,
                'seo_title' => 'Cookie Policy | V P Singh Advocate',
                'seo_description' => 'Cookie policy for V P Singh Advocate website. Learn about cookies we use and how to manage them.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $this->db->table('pages')->insertBatch($pages);
    }
}
