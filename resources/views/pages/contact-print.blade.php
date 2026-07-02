<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Abu Haneefah Islamic Academy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: #1f2937; background: #fff; }
        .container { max-width: 900px; margin: 0 auto; padding: 40px; }

        /* Header */
        .header { background: #14532d; color: #fff; padding: 40px; border-radius: 16px; margin-bottom: 40px; text-align: center; }
        .header h1 { font-size: 32px; font-weight: 800; margin-bottom: 10px; }
        .header p { font-size: 16px; color: #bbf7d0; }

        /* School Name */
        .school-name { text-align: center; margin-bottom: 32px; }
        .school-name h2 { font-size: 20px; color: #14532d; font-weight: 700; }

        /* Section */
        .section { margin-bottom: 32px; }
        .section-title { font-size: 20px; font-weight: 700; color: #14532d; margin-bottom: 16px; padding-bottom: 8px; border-bottom: 2px solid #dcfce7; }

        /* Contact Info Grid */
        .contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 32px; }
        .contact-card { border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px; }
        .contact-card h3 { font-size: 14px; font-weight: 700; color: #14532d; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
        .contact-card p, .contact-card a { font-size: 14px; color: #4b5563; text-decoration: none; word-break: break-all; }

        /* Form Details */
        .form-details { border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; margin-bottom: 32px; }
        .form-details h3 { font-size: 18px; font-weight: 700; color: #1f2937; margin-bottom: 12px; }
        .form-details p { font-size: 14px; color: #6b7280; margin-bottom: 16px; }
        .form-fields { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .form-field { border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px 16px; }
        .form-field label { font-size: 12px; font-weight: 600; color: #6b7280; display: block; margin-bottom: 4px; }
        .form-field .field-value { font-size: 14px; color: #9ca3af; font-style: italic; }
        .form-field.full { grid-column: 1 / -1; }

        /* Map */
        .map-section { margin-bottom: 32px; }
        .map-section img { width: 100%; border-radius: 12px; border: 1px solid #e5e7eb; }
        .map-info { margin-top: 12px; padding: 16px; background: #f0fdf4; border-radius: 8px; }
        .map-info h3 { font-size: 14px; font-weight: 700; color: #14532d; margin-bottom: 4px; }
        .map-info p { font-size: 14px; color: #4b5563; line-height: 1.5; }

        /* Social */
        .social-section { margin-bottom: 16px; }
        .social-section h3 { font-size: 14px; font-weight: 700; color: #14532d; margin-bottom: 8px; }
        .social-links { display: flex; gap: 12px; }
        .social-link { font-size: 14px; color: #14532d; text-decoration: none; border: 1px solid #dcfce7; border-radius: 8px; padding: 8px 16px; }

        /* Footer */
        .footer { text-align: center; padding: 24px; border-top: 1px solid #e5e7eb; margin-top: 32px; }
        .footer p { font-size: 13px; color: #9ca3af; }
    </style>
</head>
<body>
<div class="container">

    <!-- School Name -->
    <div class="school-name">
        <h2>Abu Haneefah Islamic Academy</h2>
    </div>

    <!-- Header -->
    <div class="header">
        <h1>Contact Us</h1>
        <p>We'd love to hear from you. Reach out with any questions or to schedule a visit.</p>
    </div>

    <!-- Contact Information -->
    <div class="section">
        <div class="section-title">Contact Information</div>
        <div class="contact-grid">
            <div class="contact-card">
                <h3>Email</h3>
                <a href="mailto:abuaneefah330@gmail.com">abuaneefah330@gmail.com</a>
            </div>
            <div class="contact-card">
                <h3>Phone</h3>
                <a href="tel:+2348056501115">+234 805 650 1115</a>
            </div>
            <div class="contact-card" style="grid-column: 1 / -1;">
                <h3>Address</h3>
                <p>Wisdom street, along agbara lusada road, onigbongbo atan, Ogun State, Nigeria</p>
            </div>
        </div>
    </div>

    <!-- Social -->
    <div class="section social-section">
        <div class="section-title">Social Media</div>
        <div class="social-links">
            <span class="social-link">Facebook</span>
            <span class="social-link">Twitter</span>
            <span class="social-link">Instagram</span>
            <span class="social-link">WhatsApp: +234 805 650 1115</span>
        </div>
    </div>

    <!-- Contact Form Fields -->
    <div class="section">
        <div class="section-title">Contact Form</div>
        <div class="form-details">
            <h3>Send Us a Message</h3>
            <p>Fill out the form below and we'll get back to you as soon as possible, Insha'Allah.</p>
            <div class="form-fields">
                <div class="form-field">
                    <label>Full Name *</label>
                    <div class="field-value">Enter your full name</div>
                </div>
                <div class="form-field">
                    <label>Email Address *</label>
                    <div class="field-value">you@example.com</div>
                </div>
                <div class="form-field">
                    <label>Phone Number *</label>
                    <div class="field-value">+234 ...</div>
                </div>
                <div class="form-field">
                    <label>Subject *</label>
                    <div class="field-value">What is this about?</div>
                </div>
                <div class="form-field full">
                    <label>Message *</label>
                    <div class="field-value">Write your message here...</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map -->
    <div class="section map-section">
        <div class="section-title">Our Location</div>
        <img src="https://maps.googleapis.com/maps/api/staticmap?center=Agbara+Lusada+Road+Onigbongbo+Atan+Ogun+State+Nigeria&zoom=14&size=900x400&key=AIzaSyDummyKey" alt="Map of Abu Haneefah Islamic Academy location" onerror="this.style.display='none'">
        <div class="map-info">
            <h3>Address</h3>
            <p>Wisdom street, along agbara lusada road, onigbongbo atan, Ogun State, Nigeria</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; {{ date('Y') }} Abu Haneefah Islamic Academy. All rights reserved.</p>
    </div>

</div>
</body>
</html>
