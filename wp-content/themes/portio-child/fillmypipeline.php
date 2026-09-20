<?php
/**
 * Template Name: Fill My Pipeline
 */
get_header();
?>

<div class="page-content">
    <div class="container" style="padding: 60px 15px 80px;">

        <!-- HERO -->
        <div class="row text-center" style="margin-bottom: 60px;">
            <div class="col-lg-8 offset-lg-2">
                <h1 style="font-size: 2.8rem; font-weight: 700; margin-bottom: 20px; line-height: 1.2;">
                    Stop Chasing Leads.<br>Let AI Fill Your Pipeline.
                </h1>
                <p style="font-size: 1.2rem; color: #666; margin-bottom: 30px;">
                    Done-for-you AI acquisition systems that find, qualify, and follow up with your ideal customers — automatically.
                </p>
                <a href="#lead-form" class="btn btn-primary" style="padding: 16px 36px; font-size: 1.05rem; font-weight: 700;">
                    Get My Free AI Audit →
                </a>
            </div>
        </div>

        <!-- BENEFITS -->
        <div class="row" style="margin-bottom: 60px;">
            <div class="col-md-4" style="margin-bottom: 30px;">
                <div style="background: #f8f9fa; padding: 40px 25px; border-radius: 12px; height: 100%;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 15px;">🔍 AI Lead Finding</h3>
                    <p style="color: #666; margin: 0;">We scrape, research, and rank high-intent prospects in your market — automatically.</p>
                </div>
            </div>
            <div class="col-md-4" style="margin-bottom: 30px;">
                <div style="background: #f8f9fa; padding: 40px 25px; border-radius: 12px; height: 100%;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 15px;">⚡ AI Outreach</h3>
                    <p style="color: #666; margin: 0;">Personalized emails and SMS drafted by AI, approved by you, sent on autopilot.</p>
                </div>
            </div>
            <div class="col-md-4" style="margin-bottom: 30px;">
                <div style="background: #f8f9fa; padding: 40px 25px; border-radius: 12px; height: 100%;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 15px;">📅 Auto Follow-Up</h3>
                    <p style="color: #666; margin: 0;">Never lose a lead again. The system follows up until they book, buy, or say no.</p>
                </div>
            </div>
        </div>

        <!-- LEAD FORM -->
        <div class="row" id="lead-form">
            <div class="col-lg-7 offset-lg-2" style="margin-bottom: 20px;">
                <h2 style="margin-bottom: 10px;">Book Your Free AI Audit</h2>
                <p style="color: #666; margin-bottom: 30px;">Fill this out and we'll show you how many leaves you're leaving on the table.</p>

                <?php if ( isset( $_GET['submitted'] ) && $_GET['submitted'] == '1' ) : ?>
                    <div style="background: #d4edda; color: #155724; padding: 20px; border-radius: 8px; margin-bottom: 30px; font-weight: 600;">
                        ✅ Thanks! We got your info. We'll reach out within 24 hours.
                    </div>
                <?php elseif ( isset( $_GET['submitted'] ) && $_GET['submitted'] == 'error' ) : ?>
                    <div style="background: #f8d7da; color: #721c24; padding: 20px; border-radius: 8px; margin-bottom: 30px; font-weight: 600;">
                        ❌ Something went wrong. Please try again.
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="background: #fff; border: 1px solid #e9ecef; padding: 40px; border-radius: 12px; box-shadow: 0 8px 30px rgba(0,0,0,0.06);">
                    <input type="hidden" name="action" value="fmp_submit_lead">
                    <?php wp_nonce_field( 'fmp_lead_form', 'fmp_nonce' ); ?>

                    <div style="margin-bottom: 20px;">
                        <label for="fmp-name" style="display:block; font-weight:600; margin-bottom:8px;">Full Name *</label>
                        <input type="text" id="fmp-name" name="fmp_name" required style="width:100%; padding:14px; border:1px solid #ddd; border-radius:8px; font-size:1rem;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="fmp-email" style="display:block; font-weight:600; margin-bottom:8px;">Email *</label>
                        <input type="email" id="fmp-email" name="fmp_email" required style="width:100%; padding:14px; border:1px solid #ddd; border-radius:8px; font-size:1rem;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="fmp-phone" style="display:block; font-weight:600; margin-bottom:8px;">Phone</label>
                        <input type="tel" id="fmp-phone" name="fmp_phone" style="width:100%; padding:14px; border:1px solid #ddd; border-radius:8px; font-size:1rem;">
                    </div>

                    <div style="margin-bottom: 25px;">
                        <label for="fmp-business" style="display:block; font-weight:600; margin-bottom:8px;">Business Type</label>
                        <select id="fmp-business" name="fmp_business" style="width:100%; padding:14px; border:1px solid #ddd; border-radius:8px; font-size:1rem; background:#fff;">
                            <option value="">— Select —</option>
                            <option>Roofing</option>
                            <option>Tree Service</option>
                            <option>Concrete / Construction</option>
                            <option>Staging / Events</option>
                            <option>Energy / Utilities</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 25px;">
                        <label for="fmp-message" style="display:block; font-weight:600; margin-bottom:8px;">Tell us about your business</label>
                        <textarea id="fmp-message" name="fmp_message" rows="4" style="width:100%; padding:14px; border:1px solid #ddd; border-radius:8px; font-size:1rem; resize:vertical;"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width:100%; padding:16px; font-size:1.1rem; font-weight:700;">
                        Submit — Get My Free Audit
                    </button>
                </form>
            </div>
        </div>

        <!-- SOCIAL PROOF -->
        <div class="row text-center" style="margin-top: 70px;">
            <div class="col-lg-8 offset-lg-2">
                <p style="font-size: 0.85rem; color: #999; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px;">
                    Trusted by businesses across Texas & beyond
                </p>
                <div style="display:flex; justify-content:center; gap:40px; flex-wrap:wrap; opacity:0.5; font-weight:700; font-size:1.1rem;">
                    <span>Roofing</span>
                    <span>Staging</span>
                    <span>Energy</span>
                    <span>Events</span>
                </div>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>