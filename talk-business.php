<?php
/*
Plugin Name: Talk Business
Plugin URI: https://github.com/yourusername/talk-business
Description: Premium animated contact modal with branded UI. AJAX email submission. Developed by Abdul Sattar.
Version: 1.0
Author: Abdul Sattar
Author URI: https://www.linkedin.com/in/abdulsattar752/
*/


if (!defined('ABSPATH')) exit;

/* ================= HTML ================= */
add_action('wp_footer', function () {
?>
  <div id="tb-float-btn">Let’s Talk Business</div>

  <div id="tb-overlay">
    <div id="tb-modal">
      <button id="tb-close">×</button>

      <h2>Get In Touch</h2>

      <form id="tb-form">
        <label>Full Name*</label>
        <input type="text" name="name" required>

        <label>Email*</label>
        <input type="email" name="email" required>

        <label>Phone Number*</label>
        <input type="text" name="phone" required>

        <label>Region*</label>
        <select name="region" required>
          <option value="">Select your region</option>
          <option>Middle East & North Africa</option>
          <option>USA</option>
          <option>Canada</option>
          <option>Kingdom of Saudi Arabia</option>
          <option>Australia & New Zealand</option>
          <option>Asia</option>
          <option>Europe</option>
          <option>Rest of World</option>
        </select>

        <label>Project Details*</label>
        <textarea name="project" rows="4" required></textarea>

        <button type="submit" class="tb-submit">Send Message</button>
        <p class="tb-success">Thank you! We’ll be in touch shortly.</p>
      </form>
    </div>
  </div>
<?php
});

/* ================= ENQUEUE FILES ================= */
add_action('wp_enqueue_scripts', function () {

  wp_enqueue_style(
    'tb-style',
    plugin_dir_url(__FILE__) . 'assets/css/talk-business.css'
  );

  wp_enqueue_script(
    'tb-script',
    plugin_dir_url(__FILE__) . 'assets/js/talk-business.js',
    ['jquery'],
    '1.0',
    true
  );

  // ✅ AJAX URL FIX
  wp_localize_script('tb-script', 'tb_ajax', [
    'ajax_url' => admin_url('admin-ajax.php')
  ]);
});

/* ================= AJAX EMAIL ================= */
add_action('wp_ajax_tb_mail', 'tb_mail');
add_action('wp_ajax_nopriv_tb_mail', 'tb_mail');

function tb_mail()
{

  $name    = sanitize_text_field($_POST['name']);
  $email   = sanitize_email($_POST['email']);
  $phone   = sanitize_text_field($_POST['phone']);
  $region  = sanitize_text_field($_POST['region']);
  $project = sanitize_textarea_field($_POST['project']);

  $message  = "Name: $name\n";
  $message .= "Email: $email\n";
  $message .= "Phone: $phone\n";
  $message .= "Region: $region\n\n";
  $message .= "Project Details:\n$project";

  wp_mail(
    get_option('admin_email'),
    'New Talk Business Lead',
    $message
  );

  wp_die();
}
