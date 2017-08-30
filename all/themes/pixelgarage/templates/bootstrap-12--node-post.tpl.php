<?php
/**
 * @file
 * Bootstrap 12 template for Display Suite.
 */
//
// shariff button definition
global $base_url;
libraries_load('shariff', 'naked');
$node_url = $base_url . '/node/' . $node->nid;
$mail_subject = t("@title sagt zweimal JA zur AHV-Reform...", array('@title' => $node->title));
$html_body =  $node->field_quote[LANGUAGE_NONE][0]['value'] . l("<p>Hier geht's zum Beitrag</p>", $node_url, array('html' => true));
$mail_descr = drupal_html_to_text($html_body);

$shariff_attrs = array(
  'data-services' => '["facebook","twitter","mail","whatsapp"]',
  'data-orientation' => "horizontal",
  'data-mail-url' => "mailto:",
  'data-mail-subject' => variable_get('shariff_mail_subject', $mail_subject),
  'data-mail-body' => variable_get('shariff_mail_body', $mail_descr),
  'data-lang' => "de",
  'data-url' => $node_url,
);

//
// get logo
$img_path = drupal_get_path('theme', 'pixelgarage') . '/images/';
$icon_path = file_create_url($img_path . 'zweimal-ja_banner.png');

//
// set language dependent heading
$content = $variables['content'];
$post_title = t('Support campaign!');
$post_heading = t('Share this post with your friends and family members!');
$post_claim = null;
?>


<?php if (!$teaser): ?>
<div class="node-post-page-wrapper">
    <div class="node-post-header">
      <div class="post-title">
        <?php print $post_title ?>
      </div>
      <div class="post-heading">
        <?php print $post_heading ?>
      </div>
      <div class="social-buttons">
        <div class="shariff" <?php print drupal_attributes($shariff_attrs); ?>></div>
      </div>
    </div>
    <div class="node-post-wrapper">
<?php endif; ?>

<<?php print $layout_wrapper; print $layout_attributes; ?> class="<?php print $classes; ?>">
  <?php if (isset($title_suffix['contextual_links'])): ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>
  <div class="row">
    <<?php print $central_wrapper; ?> class="col-sm-12 <?php print $central_classes; ?>">
      <?php print render($content['field_image']); ?>
      <div class="logo-wrapper"><img class="icon-2x-ja" src="<?php print $icon_path; ?>"/></div>
      <?php print render($content['field_your_name']); ?>
      <div class="profession-age-wrapper">
        <?php print render($content['field_profession']); ?>
        <?php print render($content['field_age']); ?>
      </div>
      <div class="quote-wrapper">
        <?php print render($content['field_quote']); ?>
      </div>
    </<?php print $central_wrapper; ?>>
  </div>
</<?php print $layout_wrapper ?>>

<?php if (!$teaser): ?>
  <!-- close node wrapper and node-page-wrapper-->
  </div>
</div>
<?php endif; ?>



<!-- Needed to activate display suite support on forms -->
<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
