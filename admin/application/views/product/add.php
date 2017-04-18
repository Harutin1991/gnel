<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2>
                    <i class="glyphicon glyphicon-list-alt"></i> 
                    <?php echo $this->lang->line('Add'); ?>
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
                                    <?php echo form_dropdown('Product[brand_id]', $brands, set_value('Product[brand_id]'), 'id="product_brand_id", class="form-control"'); ?>
                                    <div class="error"><?php echo form_error('Product[brand_id]'); ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label required" for="Product[code]" >Code</label>
                                    <input name="Product[code]" value="<?php echo set_value('Product[code]'); ?>" type="text" class="form-control" id="code" required="required">
                                    <div class="error"><?php echo form_error('Product[code]'); ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label" for="Product[wholesale_price]" ><?php echo $this->lang->line('Wholesale price'); ?></label>
                                    <input name="Product[wholesale_price]" value="<?php echo set_value('Product[wholesale_price]'); ?>" type="text" class="form-control" id="price">
                                    <div class="error"><?php echo form_error('Product[wholesale_price]'); ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label " for="Product[price]" ><?php echo $this->lang->line('Price'); ?></label>
                                    <input name="Product[price]" value="<?php echo set_value('Product[price]'); ?>" type="text" class="form-control" id="price">
                                    <div class="error"><?php echo form_error('Product[price]'); ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="upload_image_wrapper">
                                    <label class="control-label" for="Product[percent_off]"><?php echo $this->lang->line('Sale'); ?> %</label>
                                    <input name="Product[percent_off]" value="<?php echo set_value('Product[percent_off]'); ?>" type="text" class="form-control" id="percent_off">
                                    <div class="error"><?php echo form_error('Product[percent_off]'); ?></div>

                                    <br />
                                    <label class="control-label" for="Product[amount_off]"><?php echo $this->lang->line('Sale'); ?> $</label>
                                    <input name="Product[amount_off]" value="<?php echo set_value('Product[amount_off]'); ?>" type="text" class="form-control" id="amount_off">
                                    <div class="error"><?php echo form_error('Product[amount_off]'); ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label" for="Product[youtube_link]" >Youtube link</label>
                                    <input name="Product[youtube_link]" value="<?php echo set_value('Product[youtube_link]'); ?>" type="text" class="form-control" id="youtube_link">
                                    <div class="error"><?php echo form_error('Product[youtube_link]'); ?></div>
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
                                        <?php foreach ($languages as $language): ?>
                                            <?php if ($language->code == $default_language): ?>
                                                <div class="tab-pane active" id="<?php echo $language->code; ?>">
                                                    <br />
                                                    <label class="control-label required" for="Product[name_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Name'); ?></label>
                                                    <input name="Product[name_<?php echo $default_language; ?>]" value="<?php echo set_value('Product[name_' . $language->code . ']'); ?>" type="text" class="form-control" id="name" required="required"/>
                                                    <div class="error"><?php echo form_error('Product[name_' . $language->code . ']'); ?></div>

                                                    <br />
                                                    <label class="control-label" for="Product[meta_keywords_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Meta keywords'); ?></label>
                                                    <input name="Product[meta_keywords_<?php echo $language->code; ?>]" value="<?php echo set_value('Product[meta_keywords_' . $language->code . ']'); ?>" type="text" class="form-control" id="meta_keywords">
                                                    <div class="error"><?php echo form_error('Product[meta_keywords_' . $language->code . ']'); ?></div>

                                                    <br />
                                                    <label class="control-label" for="Product[meta_description_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Meta description'); ?></label>
                                                    <!--<input name="Product[meta_description_<?php echo $language->code; ?>]" value="<?php echo set_value('Product[meta_description_' . $language->code . ']'); ?>" type="text" class="form-control" id="meta_description">-->
                                                    <textarea  name="Product[meta_description_<?php echo $language->code; ?>]" class="form-control" id="meta_description" rows="3"><?php echo set_value('Product[meta_description_' . $language->code . ']'); ?></textarea>
                                                    <div class="error"><?php echo form_error('Product[meta_description_' . $language->code . ']'); ?></div>

                                                    <br />
                                                    <label class="control-label" for="Product[description_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Description'); ?></label>
                                                    <?php editor("Product[description_" . $language->code . "]", 'product_text_' . $language->code, set_value('Product[description_' . $language->code . ']')); ?>
                                                    <div class="error"><?php echo form_error('Product[description_' . $language->code . ']'); ?></div>

                                                </div>
                                            <?php else: ?>
                                                <div class="tab-pane" id="<?php echo $language->code; ?>">
                                                    <br />
                                                    <label class="control-label" for="Product[name_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Name'); ?></label>
                                                    <input name="Product[name_<?php echo $language->code; ?>]" value="<?php echo set_value('Product[name_' . $language->code . ']'); ?>" type="text" class="form-control" id="name">
                                                    <div class="error"><?php echo form_error('Product[name_' . $language->code . ']'); ?></div>

                                                    <br />
                                                    <label class="control-label" for="Product[meta_keywords_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Meta keywords'); ?></label>
                                                    <input name="Product[meta_keywords_<?php echo $language->code; ?>]" value="<?php echo set_value('Product[meta_keywords_' . $language->code . ']'); ?>" type="text" class="form-control" id="meta_keywords">
                                                    <div class="error"><?php echo form_error('Product[meta_keywords_' . $language->code . ']'); ?></div>

                                                    <br />
                                                    <label class="control-label" for="Product[meta_description_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Meta description'); ?></label>
                                                    <input name="Product[meta_description_<?php echo $language->code; ?>]" value="<?php echo set_value('Product[meta_description_' . $language->code . ']'); ?>" type="text" class="form-control" id="meta_description">
                                                    <div class="error"><?php echo form_error('Product[meta_description_' . $language->code . ']'); ?></div>

                                                    <br />
                                                    <label class="control-label" for="Product[description_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Description'); ?></label>
                                                    <?php editor("Product[description_" . $language->code . "]", 'product_text_' . $language->code, set_value('Product[description_' . $language->code . ']')); ?>
                                                    <div class="error"><?php echo form_error('Product[description_' . $language->code . ']'); ?></div>

                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="control-label" for="Product[category]" ><?php echo $this->lang->line('Category'); ?></label>
                                    <?php
                                    if (isset($_POST['Product']['category'])) {
                                        $category = $_POST['Product']['category'];
//                                        var_dump($category);
                                    } else {
                                        $category = array();
                                    }
                                    echo form_dropdown('Product[category][]', $categories, set_value('', $category), 'id="product_category", class="form-control"');
                                    ?>
                                    <div class="error"><?php echo form_error('Product[category]'); ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('Add'); ?>" />
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
    $(document).ready(function () {
        $('#percent_off').blur(function () {
            $('#amount_off').val(0);
        });
        $('#amount_off').blur(function () {
            $('#percent_off').val(0);
        });
    })
</script>