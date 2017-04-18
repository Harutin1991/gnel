<?php
echo "<pre>";
    print_r($this->config->item('languages'));
echo "</pre>";
?>
<?php echo $this->config->item('language'); ?>
<h1>This is Home page</h1>

<br />
<br />
<h3><?php echo $this->lang->line('page'); ?></h3>
<br />
<br />

<p>This example doesn't have any template.</p>

<p>This page is rended with the normal view, <a href="<?php echo base_url();?>">go back to home page</a></p>

<h2>Code Behind this page</h2>
