<div class="row-fluid sortable"> 
    <div class="box span10">
        <div class="box-header well" data-original-title>
            <h2><?php echo $this->lang->line('Roles'); ?></h2>
        </div>
        <div class="box-content">

            <table class="table table-bordered table-striped">
                <tbody>
                    <?php foreach ($roles as $index => $element) { ?>
                        <tr class="<?php echo $element['rol_id']; ?>">
                            <td class="center"><?php echo $element['rol_name']; ?></td>
                            <td class="center">
                                <?php if ($this->session->userdata('admin_id') == 1 || in_array('roles/edit', $this->permission)) { ?>
                                <a class="btn btn-primary" href="<?php echo base_url('roles/edit/' . $element['rol_id']); ?>"><?php echo $this->lang->line('Edit'); ?></a>
                                <?php } ?>                                
                                <?php if ($this->session->userdata('admin_id') == 1 || in_array('roles/delete', $this->permission)) { ?>
                                <a  post_id="<?php echo $element['rol_id']; ?>" class="btn btn-danger delete_theme delete_role" href=""><?php echo $this->lang->line('Delete'); ?></a>
                                <?php } ?>                    
							</td>
						</tr>
					<?php } ?>
                </tbody>
            </table>  

        </div>
    </div>
</div>