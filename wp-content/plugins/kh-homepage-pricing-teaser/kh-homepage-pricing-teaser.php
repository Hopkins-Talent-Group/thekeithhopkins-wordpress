<?php
/**
 * Plugin Name: KH Homepage Pricing Teaser
 * Description: Injects the Pricing Plans teaser on the homepage before the Contact Us section.
 * Version: 1.0.4
 */
if (!defined("ABSPATH")) { exit; }
add_action("wp_footer", function () {
    if (is_admin() || !is_front_page()) { return; }
    ?>
<div id="khpt-source" hidden>
<div class="khpt">
<style>
.khpt{--khpt-accent:#ff5b2e;font-family:inherit;max-width:1200px;margin:0 auto;padding:64px 16px;text-align:center;color:#fff;box-sizing:border-box}
.khpt *{box-sizing:border-box}
.khpt-h{font-size:2rem;font-weight:800;margin:0 0 10px;letter-spacing:-.5px}
.khpt-sub{color:rgba(255,255,255,.7);font-size:1.05rem;margin:0 auto 36px;max-width:640px}
.khpt-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:16px;margin-bottom:36px}
.khpt-card{display:flex;flex-direction:column;align-items:center;gap:4px;padding:24px 16px;border:1px solid rgba(255,255,255,.14);border-radius:14px;background:rgba(255,255,255,.04);text-decoration:none;color:#fff;transition:.2s}
.khpt-card:hover{transform:translateY(-4px);border-color:var(--khpt-accent);background:rgba(255,91,46,.08)}
.khpt-cat{font-size:.95rem;font-weight:600;color:#fff}
.khpt-from{font-size:.72rem;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.55)}
.khpt-price{font-size:1.7rem;font-weight:800;color:var(--khpt-accent)}
.khpt-btn{display:inline-block;padding:15px 34px;border-radius:10px;background:var(--khpt-accent);color:#fff;font-weight:700;text-decoration:none;font-size:1rem;transition:.15s}
.khpt-btn:hover{opacity:.92;transform:translateY(-1px)}
@media(max-width:600px){.khpt-h{font-size:1.6rem}}
</style>
<h2 class="khpt-h">Pricing Plans</h2>
<p class="khpt-sub">Clear, all-inclusive packages across web, design, e-commerce, SEO, social media, and animation — built to fit your goals and budget.</p>
<div class="khpt-grid"><a class="khpt-card" href="/pricing/">
<span class="khpt-cat">Website Development</span>
<span class="khpt-from">from</span>
<span class="khpt-price">$249</span>
</a><a class="khpt-card" href="/pricing/">
<span class="khpt-cat">Logo Design</span>
<span class="khpt-from">from</span>
<span class="khpt-price">$49</span>
</a><a class="khpt-card" href="/pricing/">
<span class="khpt-cat">E-Commerce</span>
<span class="khpt-from">from</span>
<span class="khpt-price">$649</span>
</a><a class="khpt-card" href="/pricing/">
<span class="khpt-cat">SEO</span>
<span class="khpt-from">from</span>
<span class="khpt-price">$4,499</span>
</a><a class="khpt-card" href="/pricing/">
<span class="khpt-cat">Social Media</span>
<span class="khpt-from">from</span>
<span class="khpt-price">$350</span>
</a><a class="khpt-card" href="/pricing/">
<span class="khpt-cat">Animation</span>
<span class="khpt-from">from</span>
<span class="khpt-price">$479</span>
</a></div>
<a class="khpt-btn" href="/#contact">Get Started →</a>
</div>
</div>
<script>
(function () {
  var src = document.getElementById("khpt-source");
  if (!src) return;
  var teaser = src.querySelector(".khpt");
  if (!teaser) return;
  src.parentNode.removeChild(src);
  var contact = document.getElementById("contact") || document.getElementById("Contact");
  if (contact && contact.parentNode) contact.parentNode.insertBefore(teaser, contact);
  else (document.querySelector("main") || document.body).appendChild(teaser);
})();
</script>
    <?php
}, 99);
