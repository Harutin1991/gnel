<div class="row-fluid sortable"> 
    <div class="box span10">
        <div class="box-header well" data-original-title>
            <h2><?php echo ltrim($selected_table_name, 'custom_'); ?></h2>
        </div>
        <div class="box-content">            
                <table class="table table-bordered table-striped">
                    <tbody>
                        <?php                         
                        foreach ($post_field_data as $element) {
                            //echo $element->name.'<br>';
                            $pos = strripos($element->name, '_');                            
                            $field_type = substr($element->name, $pos + 1);
                            if($field_type=='text' && $element->type == 'varchar' ){
                                $index = $element->name;
                                break;
                            }                            
                        }                                       
                        foreach ($all_post as $code => $val) {                            
                            $color="#000";
                            //$background="";
                            if($val['status']==0){
                                $color="red";
                                //$background="#707070";
                            }
                        ?>
                        <tr style="background:<?php //if(!empty($background)) echo $background; ?>;" class="<?php echo $val['id']; ?>">
                            <td style="color:<?php echo $color; ?>;" class="center">
                                <?php echo $val['id']; ?>
                            </td>
                                <td style="color:<?php echo $color; ?>;" class="center">
                                    <?php 
                                    if(isset($val[$index])){
                                        echo $val[$index];
                                    }
                                    else{
                                      echo $all_post_default_leng[$code][$index];  
                                    }                                     
                                    ?>
                                </td>
                                <td class="center">
                                    <a class="btn btn-primary" href="<?php echo base_url('custom/index/'.$selected_table_name.'/edit/'.$val['id']); ?>"><?php echo $this->lang->line('Edit'); ?></a>
                                    <a post_type="<?php echo $selected_table_name; ?>" post_id="<?php echo $val['id']; ?>" class="btn btn-danger delete_theme delete_post_type" href=""><?php echo $this->lang->line('Delete'); ?></a>
                                </td>
                            </tr>
                        <?php                         
                            }                 
                        ?>
                            
                    </tbody>
                </table>           
        </div>
    </div>
</div>


