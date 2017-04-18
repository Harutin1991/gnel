<?php
//echo '<pre>';
//var_dump($roles);exit;
?>
<div class="row-fluid sortable"> 
    <div class="box span10">
        <div class="box-header well" data-original-title>
            <h2><?php echo $this->lang->line('Users'); ?>Users</h2>
        </div>
        <div class="box-content">
            
                <table class="table table-bordered table-striped">
                    <tbody>
                        <?php foreach ($users as $index => $element) { ?>
                        <tr class="<?php echo $element['id']; ?>">
                                <td class="center"><?php echo $element['username']; ?></td>
                                <td class="center">
                                    <?php if ($this->session->userdata('admin_id') == 1 || in_array('users/edit', $this->permission)) { ?>
                                    <a class="btn btn-primary" href="<?php echo base_url('users/edit/'.$element['id']); ?>"><?php echo $this->lang->line('Edit'); ?></a>
                                    <?php } ?>
                                    <?php if ( $element['id'] <> 1 && ($this->session->userdata('admin_id') == 1 || in_array('users/delete', $this->permission) ) ) { ?>
                                    <a  post_id="<?php echo $element['id']; ?>" class="btn btn-danger delete_theme delete_user" href=""><?php echo $this->lang->line('Delete'); ?></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>  
         
        </div>
    </div>
</div>