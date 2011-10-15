<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>
<body class="<?php print $classes; ?>">
  <div id="page-wrapper"><div id="page">
    <div id="header"><div class="section clearfix">
    </div></div><!-- /.section, /#header -->
    <div id="main-wrapper"><div id="main" class="clearfix<?php if ($primary_links || $navigation) { print ' with-navigation'; } ?>">
      <div id="content" class="column"><div class="section">
        <div id="content-area">
          <?php print $content; ?>
        </div>
      </div></div><!-- /.section, /#content -->
    </div></div><!-- /#main, /#main-wrapper -->
  </div></div><!-- /#page, /#page-wrapper -->
  <?php print $page_closure; ?>
  <?php print $closure; ?>
</body>
</html>
