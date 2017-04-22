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
<!--                --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('languages/', $this->permission)) { ?><!--      -->
<!--                    <li class="accordion">-->
<!--                        <a href="#"><span> --><?php //echo $this->lang->line('Languages'); ?><!--</span><i class="glyphicon glyphicon-chevron-down"></i></a>-->
<!---->
<!--                        <ul class="nav nav-pills nav-stacked">-->
<!--                            --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('languages/add', $this->permission)) { ?>
<!--                                <li><a href="--><?php //echo base_url('languages/add'); ?><!--">--><?php //echo $this->lang->line('Add language'); ?><!--</a></li>-->
<!--                            --><?php //} ?><!--                         -->
<!--                            <li><a href="--><?php //echo base_url('languages'); ?><!--">--><?php //echo $this->lang->line('Languages'); ?><!--</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                --><?php //} ?><!-- -->

                <?php if ($this->session->userdata('admin_id') == 1 || in_array('menu/', $this->permission)) { ?>
                    <li class="accordion">
                        <a href="#"><i class="	glyphicon glyphicon-chevron-down"></i><span> <?php echo $this->lang->line('Menus'); ?></span></a>
                        <ul class="nav nav-pills nav-stacked">
                            <?php if ($this->session->userdata('admin_id') == 1 || in_array('menu/add', $this->permission)) { ?>
                                <li><a href="<?php echo base_url('menu/add'); ?>"><?php echo $this->lang->line('Add menu'); ?></a></li>
                            <?php } ?>
                            <li><a href="<?php echo base_url('menu'); ?>"><?php echo $this->lang->line('Menus'); ?></a></li>
                        </ul>
                    </li>
                <?php } ?>

<!--                --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('custom/index', $this->permission)) { ?>
<!--                    --><?php //foreach ($this->post_type as $table) { ?>
<!--                        <li class="accordion">-->
<!--                            <a href="#"><i class="	glyphicon glyphicon-chevron-down"></i><span>--><?php //echo ltrim($table, 'custom_'); ?><!--</span></a>-->
<!--                            <ul class="nav nav-pills nav-stacked">-->
<!--                                <li><a href="--><?php //echo base_url('custom/index/' . $table); ?><!--">--><?php //echo ltrim($table, 'custom_'); ?><!--</a></li>-->
<!--                                <li><a href="--><?php //echo base_url('custom/index/' . $table . '/add'); ?><!--">--><?php //echo "Add " . ltrim($table, 'custom_'); ?><!--</a></li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                    --><?php //} ?><!-- -->
<!--                --><?php //} ?><!--   -->
<!---->
<!--                --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('roles/', $this->permission)) { ?><!--    -->
<!--                    <li class="accordion">-->
<!--                        <a href="#"><i class="	glyphicon glyphicon-chevron-down"></i><span>Roles</span></a>-->
<!--                        <ul class="nav nav-pills nav-stacked">-->
<!--                            <li><a href="--><?php //echo base_url('roles'); ?><!--">Roles</a></li>-->
<!--                            --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('roles/add', $this->permission)) { ?>
<!--                                <li><a href="--><?php //echo base_url('roles/add'); ?><!--">Add Role</a></li>-->
<!--                            --><?php //} ?><!--                        -->
<!--                        </ul>-->
<!--                    </li>-->
<!--                --><?php //} ?><!-- -->
<!---->
<!--                --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('users/', $this->permission)) { ?>
<!--                    <li class="accordion">-->
<!--                        <a href="#"><i class="	glyphicon glyphicon-chevron-down"></i><span>Users</span></a>-->
<!--                        <ul class="nav nav-pills nav-stacked">-->
<!--                            <li><a href="--><?php //echo base_url('users'); ?><!--">Users</a></li>-->
<!--                            --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('users/add', $this->permission)) { ?>
<!--                                <li><a href="--><?php //echo base_url('users/add'); ?><!--">Add User</a></li>-->
<!--                            --><?php //} ?>
<!--                        </ul>-->
<!--                    </li>-->
<!--                --><?php //} ?>

				<?php if ($this->session->userdata('admin_id') == 1 || in_array('blognews/', $this->permission)) { ?>
                <li class="accordion">
                    <a href="#"><i class="	glyphicon glyphicon-chevron-down"></i><span> <?php echo $this->lang->line('Blognews'); ?></span></a>
                    <ul class="nav nav-pills nav-stacked">
                        <?php if ($this->session->userdata('admin_id') == 1 || in_array('blognews/add', $this->permission)) { ?>
                        <li><a href="<?php echo base_url('blognews/add'); ?>"><?php echo $this->lang->line('Add blognews'); ?></a></li>
                        <?php } ?>
                        <li><a href="<?php echo base_url('blognews'); ?>"><?php echo $this->lang->line('Blognews'); ?></a></li>
                    </ul>
                </li>
                <?php } ?>

<!--				--><?php //if ($this->session->userdata('admin_id') == 1 || in_array('blognews/', $this->permission)) { ?>
<!--                <li class="accordion">-->
<!--                    <a href="#"><i class="	glyphicon glyphicon-chevron-down"></i><span> --><?php //echo $this->lang->line('Blognews categories'); ?><!--</span></a>-->
<!--                    <ul class="nav nav-pills nav-stacked">-->
<!--                        --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('blognews/add', $this->permission)) { ?>
<!--                        <li><a href="--><?php //echo base_url('blogcategories/add'); ?><!--">--><?php //echo $this->lang->line('Add blognews categories'); ?><!--</a></li>-->
<!--                        --><?php //} ?>
<!--                        <li><a href="--><?php //echo base_url('blogcategories'); ?><!--">--><?php //echo $this->lang->line('Blognews categories'); ?><!--</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                --><?php //} ?>

                <?php if ($this->session->userdata('admin_id') == 1 || in_array('page/', $this->permission)) { ?>
                <li class="accordion">
                    <a href="#"><i class="	glyphicon glyphicon-chevron-down"></i><span> <?php echo $this->lang->line('Pages'); ?></span></a>
                    <ul class="nav nav-pills nav-stacked">
                        <?php if ($this->session->userdata('admin_id') == 1 || in_array('page/add', $this->permission)) { ?>
                        <li><a href="<?php echo base_url('page/add'); ?>"><?php echo $this->lang->line('Add page'); ?></a></li>
                        <?php } ?>
                        <li><a href="<?php echo base_url('page'); ?>"><?php echo $this->lang->line('Pages'); ?></a></li>
                        <li><a href="<?php echo base_url('page/contact'); ?>"><?php echo $this->lang->line('contact'); ?></a></li>
                        <li><a href="<?php echo base_url('page/faq'); ?>"><?php echo $this->lang->line('faq'); ?></a></li>
                    </ul>
                </li>
                <?php } ?>

<!--                --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('partner/', $this->permission)) { ?>
<!--                <li class="accordion">-->
<!--                    <a href="#"><i class="	glyphicon glyphicon-chevron-down"></i><span> --><?php //echo $this->lang->line('Partners'); ?><!--</span></a>-->
<!--                    <ul class="nav nav-pills nav-stacked">-->
<!--                        --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('partner/add', $this->permission)) { ?>
<!--                            <li><a href="--><?php //echo base_url('partner/add'); ?><!--">--><?php //echo $this->lang->line('Add partner'); ?><!--</a></li>-->
<!--                        --><?php //} ?>
<!--                        <li><a href="--><?php //echo base_url('partner'); ?><!--">--><?php //echo $this->lang->line('Partner'); ?><!--</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                --><?php //} ?>
<!--                --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('category/', $this->permission)) { ?>
<!--                <li class="accordion">-->
<!--                    <a href="#"><i class="	glyphicon glyphicon-chevron-down"></i><span> --><?php //echo $this->lang->line('Categories'); ?><!--</span></a>-->
<!--                    <ul class="nav nav-pills nav-stacked">-->
<!--                        --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('category/add', $this->permission)) { ?>
<!--                        <li><a href="--><?php //echo base_url('category/add'); ?><!--">--><?php //echo $this->lang->line('Add category'); ?><!--</a></li>-->
<!--                        --><?php //} ?>
<!--                        <li><a href="--><?php //echo base_url('category'); ?><!--">--><?php //echo $this->lang->line('Categories'); ?><!--</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                --><?php //} ?>
<!--                --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('brand/', $this->permission)) { ?>
<!--                <li class="accordion">-->
<!--                    <a href="#"><i class="	glyphicon glyphicon-chevron-down"></i><span> --><?php //echo $this->lang->line('Brands'); ?><!--</span></a>-->
<!--                    <ul class="nav nav-pills nav-stacked">-->
<!--                        --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('brand/add', $this->permission)) { ?>
<!--                            <li><a href="--><?php //echo base_url('brand/add'); ?><!--">--><?php //echo $this->lang->line('Add brand'); ?><!--</a></li>-->
<!--                        --><?php //} ?>
<!--                        <li><a href="--><?php //echo base_url('brand'); ?><!--">--><?php //echo $this->lang->line('Brands'); ?><!--</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                --><?php //} ?>
<!--                --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('product/', $this->permission)) { ?>
<!--                <li class="accordion">-->
<!--                    <a href="#"><i class="	glyphicon glyphicon-chevron-down"></i><span> --><?php //echo $this->lang->line('Products'); ?><!--</span></a>-->
<!--                    <ul class="nav nav-pills nav-stacked">-->
<!--                        --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('product/add', $this->permission)) { ?>
<!--                            <li><a href="--><?php //echo base_url('product/add'); ?><!--">--><?php //echo $this->lang->line('Add product'); ?><!--</a></li>-->
<!--                        --><?php //} ?>
<!--                        <li><a href="--><?php //echo base_url('product'); ?><!--">--><?php //echo $this->lang->line('Products'); ?><!--</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                --><?php //} ?>
<!--                --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('option/', $this->permission)) { ?>
<!--                <li class="accordion">-->
<!--                    <a href="#"><i class="	glyphicon glyphicon-chevron-down"></i><span> --><?php //echo $this->lang->line('Options'); ?><!--</span></a>-->
<!--                    <ul class="nav nav-pills nav-stacked">-->
<!--                        --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('option/add', $this->permission)) { ?>
<!--                            <li><a href="--><?php //echo base_url('option/add'); ?><!--">--><?php //echo $this->lang->line('Add option'); ?><!--</a></li>-->
<!--                        --><?php //} ?>
<!--                        <li><a href="--><?php //echo base_url('option'); ?><!--">--><?php //echo $this->lang->line('Options'); ?><!--</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                --><?php //} ?>
<!--                --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('product_comments/', $this->permission) || in_array('blognews_comments/', $this->permission)) { ?>
<!--                <li class="accordion">-->
<!--                    <a href="#"><i class="	glyphicon glyphicon-chevron-down"></i><span> --><?php //echo $this->lang->line('Comments'); ?><!--</span></a>-->
<!--                    <ul class="nav nav-pills nav-stacked">-->
<!--                        --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('product_comments/', $this->permission)) { ?>
<!--                            <li><a href="--><?php //echo base_url('product_comments'); ?><!--">--><?php //echo $this->lang->line('Product_comments'); ?><!--</a></li>-->
<!--                        --><?php //} ?>
<!--                        --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('blognews_comments/', $this->permission)) { ?>
<!--                            <li><a href="--><?php //echo base_url('blognews_comments'); ?><!--">--><?php //echo $this->lang->line('Blognews_comments'); ?><!--</a></li>-->
<!--                        --><?php //} ?>
<!--                    </ul>-->
<!--                </li>-->
<!--                --><?php //} ?>
<!--                --><?php //if ($this->session->userdata('admin_id') == 1 || in_array('order/', $this->permission)) { ?>
<!--                <li class="accordion">-->
<!--                    <a href="#"><i class="	glyphicon glyphicon-chevron-down"></i><span> --><?php //echo $this->lang->line('Orders'); ?><!--</span></a>-->
<!--                    <ul class="nav nav-pills nav-stacked">-->
<!--                        <li><a href="--><?php //echo base_url('order'); ?><!--">--><?php //echo $this->lang->line('Orders'); ?><!--</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                --><?php //} ?>

            </ul>

            <label style="visibility:hidden;" id="for-is-ajax" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label>
        </div>
    </div>
</div>
<!--/span-->
<!-- left menu ends -->