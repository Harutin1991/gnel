<div class="row-fluid sortable"> 
    <div class="box span10">
        <a class="btn btn-primary" href="<?php echo base_url('customposttype/add'); ?>">Add custom post type</a>  
        <br/><br/>
        <div class="box-header well" data-original-title>
            <h2>Custom post type</h2>
        </div>
        <div class="box-content">

            <table class="table table-bordered table-striped">
                <tbody>
                    <?php foreach ($customposttype as $index => $element) { ?>
                    
                        <tr class="<?php echo $element; ?>">
                            <td class="center"><?php echo ltrim($element,'custom_'); ?></td>
                            <td class="center">                                
                                <a class="btn btn-primary" href="<?php echo base_url('customposttype/edit/'.ltrim($element,'custom_')); ?>"><?php echo $this->lang->line('Edit'); ?></a>                                
                                <a  post_id="<?php echo $element; ?>" class="btn btn-danger delete_theme delete_customposttype" href=""><?php echo $this->lang->line('Delete'); ?></a>                                                   
                    </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>  

        </div>
    </div>
</div>