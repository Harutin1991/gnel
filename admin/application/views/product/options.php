<?php if ($this->session->flashdata('message') == 'edit_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Product options updated successfully.'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
        </button>
    </div>
<?php elseif ($this->session->flashdata('message') == 'add_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Product options added successfully.'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
        </button>
    </div>
<?php endif; ?>
<?php $any_option = false; ?>
<div class="row">
	<div>
		<a href="<?php echo base_url('product/edit/'.$product['id']); ?>"><< Խմբագրել</a> -  
		<a href="<?php echo base_url('product/addImages/'.$product['id']); ?>"> << Նկարներ</a>
	<div>
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
                <form method="POST" enctype="multipart/form-data" name="product_options">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <?php if(count($languages) > 1 ) { ?>
                                    <ul class="nav nav-tabs" id="myTab">
                                        <?php foreach ($languages as $language) { ?>
                                            <?php if ($language->code == $default_language) { ?>
                                                <li class="active">
                                                    <a href="#<?php echo $language->code; ?>"><?php echo $language->name; ?></a>
                                                </li>
                                            <?php } else { ?>
                                                <li>
                                                    <a href="#<?php echo $language->code; ?>"><?php echo $language->name; ?></a>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                    <?php } ?>
                                    <div class="tab-content">
                                        <?php foreach ($languages as $language) { ?>
                                            <?php $is_default = $language->code == $default_language; ?>
                                            <div class="tab-pane <?php echo $is_default ? "active" : ""; ?>" id="<?php echo $language->code; ?>">
												
												<?php if(isset($lang_options[$language->code]) && count($lang_options[$language->code])>0) { ?>
													<?php $any_option = true; ?>
													<?php foreach ($lang_options[$language->code] AS $option_id => $options) { ?>
														<div class="option_wrapper">
															<label class="control-label option_label" for="pr_option[<?php echo $option_id . "_" . $language->code; ?>]"> <?php echo $options['opt_name']; ?> <span class="small">(<?php echo $this->lang->line('Category'); ?>: <a href="<?php echo base_url('category/edit/' . $options["category_id"]) ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line('To add new category option.') ?>"><?php echo $options['cat_name']; ?></a>)</span> </label>

															<select multiple class="form-control product_option" name="pr_option[<?php echo $options["category_id"] . "_" . $option_id . "_" . $language->code; ?>][]" option_id="<?php echo $option_id; ?>">
																<?php $values = $options["values"]; ?>
																<?php $opt_vals = $options['options']; ?>
																<?php foreach ($opt_vals AS $val_id => $option) { ?>
																	<?php
																	$is_selected = array_search($option, $values);
																	if ($is_selected !== FALSE) {
																		unset($values[$is_selected]);
																	}
																	?>
																	<option value="<?php echo $option; ?>" <?php echo $is_selected !== FALSE ? "selected='selected'" : ""; ?> ><?php echo $option; ?></option>
																<?php } ?>
															</select>
													  
														</div>
													<?php } ?>
												<?php } ?>

                                            </div>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
									<?php if($any_option) { ?>
										<input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('Edit'); ?>" />
									<?php } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        $(".product_option").change(function() {
            var sel_opt = [], i = 0;
            $(this).children('option').each(function(i, opt) {
                sel_opt[i++] = opt.selected ? 1 : 0;
            });
            var opt_id = $(this).attr("option_id");
            $("select[option_id='" + opt_id + "']").each(function() {
                i = 0;
                $(this).children('option').each(function(i, opt) {
                    if (parseInt(sel_opt[i++])) {
                        $(opt).attr('selected', 'selected');
                    } else {
                        $(opt).removeAttr('selected');
                    }
                });
            });
        });
    });
</script>