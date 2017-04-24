<!-- left menu starts -->
<div class="col-sm-2 col-lg-2 left_menu">
    <div class="sidebar-nav">
        <div class="nav-canvas">
            <div class="nav-sm nav nav-stacked">

            </div>
            <ul class="nav nav-pills nav-stacked main-menu">
<!--                <li class="nav-header">Main</li>-->
                <li>
                    <a class="ajax-link" href="<?php echo site_url('dashboard'); ?>"><i class="glyphicon glyphicon-home"></i><span><?php echo $this->lang->line('Home'); ?></span></a>
                </li>

				<?php if ($this->session->userdata('admin_id') == 1 || in_array('blognews/', $this->permission)) { ?>
                <li class="accordion">
                    <a href="#"><i class="	glyphicon glyphicon-chevron-down"></i><span> <?php echo $this->lang->line('Blognews'); ?></span></a>
                    <ul class="nav nav-pills nav-stacked">
                        <?php if ($this->session->userdata('admin_id') == 1 || in_array('blognews/add', $this->permission)) { ?>
                        <li><a href="<?php echo base_url('blognews/add'); ?>">+&nbsp<?php echo $this->lang->line('Add blognews'); ?></a></li>
                        <?php } ?>
                        <li><a href="<?php echo base_url('blognews'); ?>"><?php echo $this->lang->line('Blognews'); ?></a></li>
                    </ul>
                </li>
                <?php } ?>



                <?php if ($this->session->userdata('admin_id') == 1 || in_array('page/', $this->permission)) { ?>
                <li class="accordion">
                    <a href="#"><i class="	glyphicon glyphicon-chevron-down"></i><span> <?php echo $this->lang->line('Pages'); ?></span></a>
                    <ul class="nav nav-pills nav-stacked">
                        <?php if ($this->session->userdata('admin_id') == 1 || in_array('page/add', $this->permission)) { ?>
                        <li><a href="<?php echo base_url('page/add'); ?>">+&nbsp<?php echo $this->lang->line('Add page'); ?></a></li>
                        <?php } ?>
                        <li><a href="<?php echo base_url('page'); ?>"><?php echo $this->lang->line('Pages'); ?></a></li>
                        <li><a href="<?php echo base_url('page/contacts'); ?>"><?php echo $this->lang->line('contact'); ?></a></li>
                        <li><a href="<?php echo base_url('page/faq'); ?>"><?php echo $this->lang->line('faq'); ?></a></li>
                    </ul>
                </li>
                <?php } ?>



            </ul>

            <label style="visibility:hidden;" id="for-is-ajax" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label>
        </div>
    </div>
</div>
<!--/span-->
<!-- left menu ends -->