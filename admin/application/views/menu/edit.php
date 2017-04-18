<?php if ($this->session->flashdata('message') == 'edit_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Menu has edited successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
            <i class="glyphicon glyphicon-bell icon-white"></i> Top Center (fade)
        </button>
    </div>
<?php endif; ?>

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
                <table class="span5">
                    <tbody>
                        <form method="POST" >
                            <tr>
                                <td>
                                    <label class="control-label required" for="Menu[name]"><?php echo $this->lang->line('Name'); ?></label>
                                    <input name="Menu[name]" value="<?php echo set_value('Menu[name]', $menu['name']); ?>" type="text" class="form-control" id="name">
                                    <div class="error"><?php echo form_error('Menu[name]'); ?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('Edit'); ?>" />
                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function () {
		setTimeout(function () {
			$('.noty').trigger('click');
		}, 1000);
	});
</script>