<?php
/*
Plugin Name: Talk Business – Get In Touch Modal
Plugin URI: https://github.com/yourusername/talk-business
Description: Premium animated contact modal with branded UI. AJAX email submission. Developed by Abdul Sattar.
Version: 1.0
Author: Abdul Sattar
Author URI: https://www.linkedin.com/in/abdulsattar752/
License: GPL2
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
        <input type="text" name="phone" placeholder="+1 (201) 555-0123" required>

        <label>Region*</label>
        <select name="region" required>
          <option value="">Select your region</option>
          <option value="Middle East & North Africa">Middle East & North Africa</option>
          <option value="USA">USA</option>
          <option value="Canada">Canada</option>
          <option value="Kingdom of Saudi Arabia">Kingdom of Saudi Arabia</option>
          <option value="Australia & New Zealand">Australia & New Zealand</option>
          <option value="Asia">Asia</option>
          <option value="Europe">Europe</option>
          <option value="Rest of World">Rest of World</option>
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

/* ================= ENQUEUE CSS & JS ================= */
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('tb-css', plugin_dir_url(__FILE__) . 'assets/css/talk-business.css');
  wp_enqueue_script('tb-js', plugin_dir_url(__FILE__) . 'assets/js/talk-business.js', ['jquery'], false, true);
});

/* ================= EMAIL HANDLER ================= */
add_action("wp_ajax_tb_mail", "tb_mail");
add_action("wp_ajax_nopriv_tb_mail", "tb_mail");

function tb_mail()
{
  $name = sanitize_text_field($_POST['name']);
  $email = sanitize_email($_POST['email']);
  $phone = sanitize_text_field($_POST['phone']);
  $region = sanitize_text_field($_POST['region']);
  $project = sanitize_textarea_field($_POST['project']);

  $message = "Name: $name\nEmail: $email\nPhone: $phone\nRegion: $region\n\nMessage:\n$project";

  wp_mail("info.abdulsattardeveloper@gmail.com", "New Get In Touch Lead", $message);
  wp_die();
}
