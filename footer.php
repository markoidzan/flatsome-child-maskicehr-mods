<?php
/**
 * The template for displaying the footer.
 *
 * @package flatsome
 */

global $flatsome_opt;
?>

</main><!-- #main -->

<!-- Your customer chat code -->
<div class="fb-customerchat"
  page_id="505416389492806"
  theme_color="#D8CB0F"
  logged_in_greeting="Pozdrav! Dobro došli na maskice.hr web stranicu! Kako Vam možemo pomoći?"
  logged_out_greeting="Pozdrav! Dobro došli na maskice.hr web stranicu! Kako Vam možemo pomoći?">
</div>

<footer id="footer" class="footer-wrapper">

	<?php do_action('flatsome_footer'); ?>

</footer><!-- .footer-wrapper -->

</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
