<?php

namespace App\Libraries;

use Config\Email as EmailConfig;

class MailService
{
    // ================================================================
    // CORE EMAIL SENDING
    // ================================================================

    /**
     * Send an HTML email. Returns true on success, false on failure.
     */
    public static function send(string $to, string $subject, string $htmlBody, string $altBody = ''): bool
    {
        $config = self::getEmailConfig();

        $email = \Config\Services::email($config);
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMailType('html');
        $email->setMessage($htmlBody);

        if (!empty($altBody)) {
            $email->setAltMessage($altBody);
        }

        try {
            $sent = $email->send();
            if (!$sent) {
                log_message('error', 'MailService send failed: ' . $email->printDebugger(['headers']));
            }
            return $sent;
        } catch (\Throwable $e) {
            log_message('error', 'MailService send exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Build and return a configured Email instance.
     */
    private static function getEmailConfig(): EmailConfig
    {
        $config = new EmailConfig();

        if (env('email.protocol'))     $config->protocol   = env('email.protocol');
        if (env('email.SMTPHost'))     $config->SMTPHost   = env('email.SMTPHost');
        if (env('email.SMTPUser'))     $config->SMTPUser   = env('email.SMTPUser');
        if (env('email.SMTPPass'))     $config->SMTPPass   = env('email.SMTPPass');
        if (env('email.SMTPPort'))     $config->SMTPPort   = (int) env('email.SMTPPort');
        if (env('email.SMTPCrypto'))   $config->SMTPCrypto = env('email.SMTPCrypto');
        if (env('email.fromEmail'))    $config->fromEmail  = env('email.fromEmail');
        if (env('email.fromName'))     $config->fromName   = env('email.fromName');

        if (empty($config->fromEmail)) $config->fromEmail = Settings::get('email', 'noreply@vynexelectronics.com');
        if (empty($config->fromName))  $config->fromName  = Settings::get('site_name', 'V P Singh Advocate');

        return $config;
    }

    /**
     * Get admin email from settings.
     */
    public static function getAdminEmail(): string
    {
        return Settings::get('email', '');
    }

    // ================================================================
    // EMAIL WRAPPER TEMPLATE
    // ================================================================

    /**
     * Wrap content in a branded email template.
     */
    private static function wrap(string $title, string $bodyHtml, string $siteName): string
    {
        $baseURL = env('app.baseURL', base_url());

        return "
        <!DOCTYPE html>
        <html>
        <head><meta charset='UTF-8'><meta name='viewport' content='width=device-width,initial-scale=1.0'></head>
        <body style='margin:0;padding:0;background:#f4f4f4;font-family:Arial,Helvetica,sans-serif;'>
            <div style='max-width:600px;margin:20px auto;background:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);'>
                <!-- Header -->
                <div style='background:#1a1a1a;color:#ffffff;padding:24px 28px;'>
                    <h1 style='margin:0;font-size:20px;font-weight:600;'>{$title}</h1>
                    <p style='margin:6px 0 0;font-size:12px;color:#aaa;'>{$siteName}</p>
                </div>
                <!-- Body -->
                <div style='padding:28px;'>
                    {$bodyHtml}
                </div>
                <!-- Footer -->
                <div style='background:#f9f9f9;padding:16px 28px;border-top:1px solid #eee;text-align:center;'>
                    <p style='margin:0;font-size:11px;color:#aaa;'>This is an automated notification from {$siteName}.</p>
                    <p style='margin:4px 0 0;font-size:11px;color:#aaa;'>
                        <a href='{$baseURL}' style='color:#a38366;text-decoration:none;'>Visit Website</a>
                    </p>
                </div>
            </div>
        </body>
        </html>";
    }

    /**
     * Reusable info-row HTML snippet.
     */
    private static function row(string $label, string $value): string
    {
        return "<tr>
            <td style='padding:8px 0;color:#888;width:150px;vertical-align:top;'>{$label}</td>
            <td style='padding:8px 0;color:#333;'>{$value}</td>
        </tr>";
    }

    private static function rowBold(string $label, string $value): string
    {
        return "<tr>
            <td style='padding:8px 0;color:#888;width:150px;vertical-align:top;'>{$label}</td>
            <td style='padding:8px 0;color:#333;font-weight:bold;'>{$value}</td>
        </tr>";
    }

    // ================================================================
    // NOTIFICATION: BOOKING CREATED
    // ================================================================

    /**
     * Notify ADMIN about a new booking.
     */
    public static function notifyAdminNewBooking(object $consultation): bool
    {
        $adminEmail = self::getAdminEmail();
        if (empty($adminEmail)) return false;

        $siteName = Settings::get('site_name', 'V P Singh Advocate');
        $baseURL  = env('app.baseURL', base_url());
        $fee      = number_format((float) $consultation->amount);

        $rows = '';
        $rows .= self::rowBold('Booking ID', "<span style='font-family:monospace;'>{$consultation->booking_id}</span>");
        $rows .= self::rowBold('Client Name', esc($consultation->full_name));
        $rows .= self::row('Mobile', esc($consultation->mobile));
        if (!empty($consultation->email))    $rows .= self::row('Email', esc($consultation->email));
        if (!empty($consultation->city))     $rows .= self::row('City', esc($consultation->city));
        $rows .= self::row('Mode', ucfirst($consultation->consultation_mode));
        if (!empty($consultation->preferred_date)) $rows .= self::row('Preferred Date', esc($consultation->preferred_date));
        if (!empty($consultation->preferred_time)) $rows .= self::row('Preferred Time', esc($consultation->preferred_time));
        if (!empty($consultation->legal_matter))   $rows .= self::row('Legal Matter', esc($consultation->legal_matter));
        if (!empty($consultation->description)) {
            $rows .= self::row('Description', nl2br(esc($consultation->description)));
        }
        $rows .= self::rowBold('Amount', "<span style='color:#a38366;font-size:16px;'>₹{$fee}</span>");
        $rows .= self::row('IP Address', esc($consultation->ip_address));

        $body = "
            <table style='width:100%;font-size:14px;border-collapse:collapse;'>{$rows}</table>
            <div style='margin-top:24px;text-align:center;'>
                <a href='{$baseURL}admin/consultations/view/{$consultation->id}'
                   style='display:inline-block;background:#1a1a1a;color:#fff;padding:12px 32px;text-decoration:none;border-radius:4px;font-size:14px;font-weight:bold;'>
                    View Booking →
                </a>
            </div>";

        return self::send($adminEmail, "📋 New Booking – {$consultation->booking_id}", self::wrap("📋 New Consultation Booking", $body, $siteName));
    }

    /**
     * Send booking confirmation to CLIENT.
     */
    public static function sendClientBookingConfirmation(object $consultation): bool
    {
        if (empty($consultation->email)) return false;

        $siteName = Settings::get('site_name', 'V P Singh Advocate');
        $fee      = number_format((float) $consultation->amount);
        $baseURL  = env('app.baseURL', base_url());

        $rows = '';
        $rows .= self::rowBold('Booking ID', "<span style='font-family:monospace;'>{$consultation->booking_id}</span>");
        $rows .= self::row('Mode', ucfirst($consultation->consultation_mode));
        if (!empty($consultation->preferred_date)) $rows .= self::row('Preferred Date', esc($consultation->preferred_date));
        if (!empty($consultation->preferred_time)) $rows .= self::row('Preferred Time', esc($consultation->preferred_time));
        $rows .= self::rowBold('Consultation Fee', "<span style='color:#a38366;'>₹{$fee}</span>");

        $body = "
            <p style='font-size:14px;color:#555;margin:0 0 16px;'>Dear <strong>" . esc($consultation->full_name) . "</strong>,</p>
            <p style='font-size:14px;color:#555;margin:0 0 20px;'>Your consultation has been booked successfully. Please complete the payment to confirm your booking.</p>
            <table style='width:100%;font-size:14px;border-collapse:collapse;'>{$rows}</table>
            <div style='margin-top:24px;text-align:center;'>
                <a href='{$baseURL}payment/{$consultation->booking_id}'
                   style='display:inline-block;background:#a38366;color:#fff;padding:12px 32px;text-decoration:none;border-radius:4px;font-size:14px;font-weight:bold;'>
                    Complete Payment →
                </a>
            </div>
            <p style='font-size:13px;color:#888;margin:20px 0 0;'>If you have any questions, please reply to this email or call us.</p>";

        return self::send($consultation->email, "✅ Booking Confirmed – {$consultation->booking_id}", self::wrap("✅ Booking Confirmation", $body, $siteName));
    }

    // ================================================================
    // NOTIFICATION: PAYMENT CONFIRMED
    // ================================================================

    /**
     * Notify ADMIN about a payment submission.
     */
    public static function notifyAdminPaymentReceived(object $consultation, object $payment): bool
    {
        $adminEmail = self::getAdminEmail();
        if (empty($adminEmail)) return false;

        $siteName = Settings::get('site_name', 'V P Singh Advocate');
        $baseURL  = env('app.baseURL', base_url());
        $fee      = number_format((float) $payment->amount);
        $method   = str_replace('_', ' ', ucfirst($payment->payment_method));

        $rows = '';
        $rows .= self::rowBold('Booking ID', "<span style='font-family:monospace;'>{$consultation->booking_id}</span>");
        $rows .= self::row('Client', esc($payment->client_name));
        $rows .= self::row('Mobile', esc($payment->mobile));
        $rows .= self::row('Amount', "<span style='color:#a38366;font-weight:bold;'>₹{$fee}</span>");
        $rows .= self::row('Method', $method);
        if (!empty($payment->utr_number)) $rows .= self::row('Transaction ID', "<span style='font-family:monospace;'>{$payment->utr_number}</span>");
        $rows .= self::row('Status', ucfirst($payment->status));

        $body = "
            <table style='width:100%;font-size:14px;border-collapse:collapse;'>{$rows}</table>
            <div style='margin-top:24px;text-align:center;'>
                <a href='{$baseURL}admin/payments/view/{$payment->id}'
                   style='display:inline-block;background:#1a1a1a;color:#fff;padding:12px 32px;text-decoration:none;border-radius:4px;font-size:14px;font-weight:bold;'>
                    View Payment →
                </a>
            </div>";

        $statusLabel = $payment->status === 'verified' ? '✅ Verified' : '💰 Payment Received';
        return self::send($adminEmail, "💰 Payment Received – {$consultation->booking_id}", self::wrap("💰 {$statusLabel}", $body, $siteName));
    }

    /**
     * Send payment receipt / confirmation to CLIENT.
     */
    public static function sendClientPaymentReceipt(object $consultation, object $payment): bool
    {
        if (empty($consultation->email)) return false;

        $siteName = Settings::get('site_name', 'V P Singh Advocate');
        $fee      = number_format((float) $payment->amount);
        $baseURL  = env('app.baseURL', base_url());

        $rows = '';
        $rows .= self::rowBold('Booking ID', "<span style='font-family:monospace;'>{$consultation->booking_id}</span>");
        $rows .= self::row('Amount Paid', "<span style='color:#16a34a;font-weight:bold;'>₹{$fee}</span>");
        $rows .= self::row('Payment Method', str_replace('_', ' ', ucfirst($payment->payment_method)));
        if (!empty($payment->utr_number)) $rows .= self::row('Transaction ID', "<span style='font-family:monospace;'>{$payment->utr_number}</span>");
        $rows .= self::row('Status', "<span style='color:#16a34a;font-weight:bold;'>✅ " . ucfirst($payment->status) . "</span>");

        $body = "
            <p style='font-size:14px;color:#555;margin:0 0 16px;'>Dear <strong>" . esc($consultation->full_name) . "</strong>,</p>
            <p style='font-size:14px;color:#555;margin:0 0 20px;'>We have received your payment. Thank you!</p>
            <table style='width:100%;font-size:14px;border-collapse:collapse;'>{$rows}</table>
            <div style='background:#f0fdf4;border:1px solid #bbf7d0;border-radius:6px;padding:16px;margin-top:20px;text-align:center;'>
                <p style='margin:0;font-size:14px;color:#16a34a;font-weight:bold;'>Your consultation is confirmed!</p>
                <p style='margin:6px 0 0;font-size:13px;color:#555;'>We will contact you shortly to schedule the session.</p>
            </div>
            <p style='font-size:13px;color:#888;margin:20px 0 0;'>Questions? Reply to this email or call us.</p>";

        return self::send($consultation->email, "💰 Payment Receipt – {$consultation->booking_id}", self::wrap("💰 Payment Receipt", $body, $siteName));
    }

    // ================================================================
    // NOTIFICATION: BOOKING STATUS UPDATED
    // ================================================================

    /**
     * Notify CLIENT when admin updates their booking status.
     */
    public static function sendClientBookingStatusUpdate(object $consultation, string $oldStatus, string $newStatus): bool
    {
        if (empty($consultation->email)) return false;

        $siteName = Settings::get('site_name', 'V P Singh Advocate');
        $baseURL  = env('app.baseURL', base_url());

        $statusLabels = [
            'confirmed'  => '✅ Your consultation has been confirmed',
            'completed'  => '🎉 Your consultation has been completed',
            'cancelled'  => '❌ Your consultation has been cancelled',
            'pending'    => '⏳ Your booking is pending',
        ];

        $statusMessage = $statusLabels[$newStatus] ?? "Your booking status has been updated to: " . ucfirst($newStatus);
        $statusColor = '#1a1a1a';
        if ($newStatus === 'confirmed')  $statusColor = '#16a34a';
        if ($newStatus === 'cancelled')  $statusColor = '#dc2626';
        if ($newStatus === 'completed')  $statusColor = '#a38366';

        $body = "
            <p style='font-size:14px;color:#555;margin:0 0 16px;'>Dear <strong>" . esc($consultation->full_name) . "</strong>,</p>
            <div style='background:#f9f9f9;border-left:4px solid {$statusColor};padding:16px;margin:0 0 20px;'>
                <p style='margin:0;font-size:15px;color:#333;font-weight:bold;'>{$statusMessage}</p>
            </div>
            <table style='width:100%;font-size:14px;border-collapse:collapse;'>
                " . self::rowBold('Booking ID', "<span style='font-family:monospace;'>{$consultation->booking_id}</span>") . "
                " . self::row('Status', ucfirst($newStatus)) . "
            </table>";

        if (!empty($consultation->notes)) {
            $body .= "
            <div style='margin-top:16px;padding:12px;background:#fffbeb;border:1px solid #fef3c7;border-radius:4px;'>
                <p style='margin:0;font-size:12px;color:#92400e;'><strong>Note from our team:</strong></p>
                <p style='margin:4px 0 0;font-size:13px;color:#78350f;'>" . nl2br(esc($consultation->notes)) . "</p>
            </div>";
        }

        $body .= "
            <p style='font-size:13px;color:#888;margin:20px 0 0;'>Questions? Reply to this email or call us.</p>";

        return self::send($consultation->email, "Booking Update – {$consultation->booking_id}", self::wrap("📋 Booking Status Update", $body, $siteName));
    }

    /**
     * Notify ADMIN when booking status is updated.
     */
    public static function notifyAdminBookingStatusUpdate(object $consultation, string $oldStatus, string $newStatus): bool
    {
        $adminEmail = self::getAdminEmail();
        if (empty($adminEmail)) return false;

        $siteName = Settings::get('site_name', 'V P Singh Advocate');
        $baseURL  = env('app.baseURL', base_url());

        $body = "
            <table style='width:100%;font-size:14px;border-collapse:collapse;'>
                " . self::rowBold('Booking ID', "<span style='font-family:monospace;'>{$consultation->booking_id}</span>") . "
                " . self::row('Client', esc($consultation->full_name)) . "
                " . self::row('Mobile', esc($consultation->mobile)) . "
                " . self::row('Old Status', ucfirst($oldStatus)) . "
                " . self::rowBold('New Status', ucfirst($newStatus)) . "
            </table>
            <div style='margin-top:24px;text-align:center;'>
                <a href='{$baseURL}admin/consultations/view/{$consultation->id}'
                   style='display:inline-block;background:#1a1a1a;color:#fff;padding:12px 32px;text-decoration:none;border-radius:4px;font-size:14px;font-weight:bold;'>
                    View Booking →
                </a>
            </div>";

        return self::send($adminEmail, "📋 Booking Updated – {$consultation->booking_id}", self::wrap("📋 Booking Status Changed", $body, $siteName));
    }

    // ================================================================
    // NOTIFICATION: ENQUIRY
    // ================================================================

    /**
     * Notify ADMIN about a new enquiry.
     */
    public static function notifyAdminNewEnquiry(object $enquiry): bool
    {
        $adminEmail = self::getAdminEmail();
        if (empty($adminEmail)) return false;

        $siteName = Settings::get('site_name', 'V P Singh Advocate');
        $baseURL  = env('app.baseURL', base_url());

        $rows = '';
        $rows .= self::rowBold('Name', esc($enquiry->name));
        if (!empty($enquiry->phone))        $rows .= self::row('Phone', esc($enquiry->phone));
        if (!empty($enquiry->email))        $rows .= self::row('Email', esc($enquiry->email));
        if (!empty($enquiry->city))         $rows .= self::row('City', esc($enquiry->city));
        if (!empty($enquiry->subject))      $rows .= self::row('Subject', esc($enquiry->subject));
        if (!empty($enquiry->legal_matter)) $rows .= self::row('Legal Matter', esc($enquiry->legal_matter));
        $rows .= self::row('Message', nl2br(esc($enquiry->message)));
        $rows .= self::row('Source', esc($enquiry->source_page));

        $body = "
            <table style='width:100%;font-size:14px;border-collapse:collapse;'>{$rows}</table>
            <div style='margin-top:24px;text-align:center;'>
                <a href='{$baseURL}admin/enquiries/view/{$enquiry->id}'
                   style='display:inline-block;background:#1a1a1a;color:#fff;padding:12px 32px;text-decoration:none;border-radius:4px;font-size:14px;font-weight:bold;'>
                    View Enquiry →
                </a>
            </div>";

        return self::send($adminEmail, "✉️ New Enquiry from {$enquiry->name}", self::wrap("✉️ New Enquiry", $body, $siteName));
    }

    /**
     * Send enquiry acknowledgement to CLIENT.
     */
    public static function sendClientEnquiryAcknowledgement(object $enquiry): bool
    {
        if (empty($enquiry->email)) return false;

        $siteName = Settings::get('site_name', 'V P Singh Advocate');
        $baseURL  = env('app.baseURL', base_url());

        $body = "
            <p style='font-size:14px;color:#555;margin:0 0 16px;'>Dear <strong>" . esc($enquiry->name) . "</strong>,</p>
            <p style='font-size:14px;color:#555;margin:0 0 20px;'>Thank you for reaching out to us. We have received your enquiry and our team will get back to you shortly.</p>
            <div style='background:#f9f9f9;border-radius:6px;padding:16px;margin:0 0 20px;'>
                <p style='margin:0 0 8px;font-size:13px;color:#888;'>Your enquiry details:</p>
                <table style='width:100%;font-size:13px;border-collapse:collapse;'>
                    " . (!empty($enquiry->subject) ? self::row('Subject', esc($enquiry->subject)) : '') . "
                    " . self::row('Message', nl2br(esc($enquiry->message))) . "
                </table>
            </div>
            <div style='background:#eff6ff;border:1px solid #bfdbfe;border-radius:6px;padding:16px;margin:0 0 20px;'>
                <p style='margin:0;font-size:13px;color:#1e40af;'>
                    <strong>Need immediate assistance?</strong><br>
                    📞 Call us or 💬 WhatsApp us for a quicker response.
                </p>
            </div>
            <p style='font-size:13px;color:#888;margin:0;'>We look forward to assisting you.</p>";

        return self::send($enquiry->email, "Thank you for your enquiry – {$siteName}", self::wrap("Thank You for Your Enquiry", $body, $siteName));
    }
}
