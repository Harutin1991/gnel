<?php if ($this->session->flashdata('message') == 'edit_success') { ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Product edited successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
        </button>
    </div>
<?php } ?>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2>
                    <i class="glyphicon glyphicon-list-alt"></i> 
                    <?php echo $this->lang->line('Edit'); ?>
                </h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table>
                    <form method="POST" enctype="multipart/form-data">
                        <tbody>
                            <tr>
                                <td>
                                    <label class="control-label" for="Product[brand_id]" ><?php echo $this->lang->line('Brand'); ?></label>
                                    <?php echo form_dropdown('Product[brand_id]', $brands, set_value('Product[brand_id]', $product['brand_id']), 'id="product_brand_id", class="form-control"'); ?>
                                    <div class="error"><?php echo form_error('Product[brand_id]'); ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label required" for="Product[code]" >Code</label>
                                    <input name="Product[code]" value="<?php echo set_value('Product[code]', $product['code']); ?>" type="text" class="form-control" id="code">
                                    <div class="error"><?php echo form_error('Product[code]'); ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label" for="Product[wholesale_price]" ><?php echo $this->lang->line('Wholesale price'); ?></label>
                                    <input name="Product[wholesale_price]" value="<?php echo set_value('Product[wholesale_price]', $product['wholesale_price']); ?>" type="text" class="form-control" id="price">
                                    <div class="error"><?php echo form_error('Product[wholesale_price]'); ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label" for="Product[price]" ><?php echo $this->lang->line('Price'); ?></label>
                                    <input name="Product[price]" value="<?php echo set_value('Product[price]', $product['price']); ?>" type="text" class="form-control" id="price">
                                    <div class="error"><?php echo form_error('Product[price]'); ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php if (count($languages) > 1) { ?>
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php foreach ($languages as $language): ?>
                                                <?php if ($language->code == $default_language): ?>
                                                    <li class="active">
                                                        <a href="#<?php echo $language->code; ?>"><?php echo $language->name; ?></a>
                                                    </li>
                                                <?php else: ?>
                                                    <li>
                                                        <a href="#<?php echo $language->code; ?>"><?php echo $language->name; ?></a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php } ?>
                                    <div class="tab-content">
                                        <?php foreach ($languages as $language) { ?>
                                            <?php $is_default = $language->code == $default_language; ?>
                                            <div class="tab-pane <?php echo $is_default ? "active" : ""; ?>" id="<?php echo $language->code; ?>">
                                                <br />
                                                <label class="control-label <?php echo $is_default ? "required" : ""; ?>" for="Product[name_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Title'); ?></label>
                                                <input name="Product[name_<?php echo $language->code; ?>]" value="<?php echo set_value('Product[name_' . $language->code . ']', $product['name_' . $language->code]); ?>" type="text" class="form-control" id="title">
                                                <div class="error"><?php echo form_error('Product[name_' . $language->code . ']'); ?></div>

                                                <br />
                                                <label class="control-label" for="Product[meta_keywords_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Meta keywords'); ?></label>
                                                <input name="Product[meta_keywords_<?php echo $language->code; ?>]" value="<?php echo set_value('Product[meta_keywords_' . $language->code . ']', $product['meta_keywords_' . $language->code]); ?>" type="text" class="form-control" id="meta_keywords">
                                                <div class="error"><?php echo form_error('Product[meta_keywords_' . $language->code . ']'); ?></div>

                                                <br />
                                                <label class="control-label" for="Product[meta_description_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Meta description'); ?></label>
                                                <input name="Product[meta_description_<?php echo $language->code; ?>]" value="<?php echo set_value('Product[meta_description_' . $language->code . ']', $product['meta_description_' . $language->code]); ?>" type="text" class="form-control" id="meta_description">
                                                <div class="error"><?php echo form_error('Product[meta_description_' . $language->code . ']'); ?></div>

                                                <br />
                                                <label class="control-label" for="Product[description_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Text'); ?></label>
                                                <?php editor("Product[description_" . $language->code . "]", 'product_text_' . $language->code, set_value('Product[description_' . $language->code . ']', $product['description_' . $language->code])); ?>
                                                <div class="error"><?php echo form_error('Product[description_' . $language->code . ']'); ?></div>

                                            </div>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label" ><?php echo $this->lang->line('Edit images'); ?> <a href="<?php echo base_url('product/addImages/' . $product['id']); ?>"><?php echo $this->lang->line('here'); ?></a></label>
                                    <div class="image-box">
                                        <div>
                                            <?php //echo "<pre>";print_r($product); echo "</pre>"; ?>
                                            <?php $img_url = isset($product['image']) && $product['image'] != '' ? $this->config->item('frontend_url') . 'images/product/' . $product['id'] . '/' . $product['image'] : base_url('img/upload-icon.png'); ?>  
                                            <a href="<?php echo base_url('product/addImages/' . $product['id']); ?>"><img id="current-image" src="<?php echo $img_url; ?>" width="100" title="<?php echo $this->lang->line('Change image'); ?>" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label" for="Product[category]" ><?php echo $this->lang->line('Category'); ?>
                                        <a href="<?php echo base_url('product/options/' . $product['id']); ?>" ><?php echo $this->lang->line('Edit Options'); ?></a>
                                    </label>
                                    <?php
                                    if (isset($_POST['Product']['category']))
                                        $category = $_POST['Product']['category'];
                                    else
                                        $category = $selected_categories;
                                    echo form_dropdown('Product[category][]', $categories, set_value('', $category), 'id="product_category", class="form-control"');
                                    ?>
                                    <div class="error"><?php echo form_error('Product[category]'); ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('Edit'); ?>" />
                                </td>
                            </tr>
                        </tbody>
                    </form>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.noty').trigger('click');
        }, 1000);

        $('#image').css('display', 'none');
        $('#current-image').click(function() {
            $('#image').click();
        });

    });

    $(function() {
        $('#myTab a:first').tab('show');
    });
</script>