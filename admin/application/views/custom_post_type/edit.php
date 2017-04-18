<div class=""> 
    <div class="">
        <div class="box-header well" data-original-title>
            <h2>Edit custom post type</h2>
        </div>
        <div class="box-content">
            <table>
                <tbody>
                    <tr>
                        <td class="span5">
                            <form id="create_table" action='' method='post' >
                                <label class="control-label required" for="tabl_name" >Name post type</label>                                
                                <input id="tabl_name" class="form-control" type='text' name='tabl_name' value="<?php echo $customposttype; ?>" />
                                <br/>
                                <div style="color: red;" class="error_tabl_name"></div>                                           
                                <br />                               
                                <div class="atributs">
                                    <?php
                                    $attr = 0;
                                    foreach ($custom_field as $index => $element) {
                                    $attr+=1;
                                    ?>
                                    <div class="<?php echo $attr; ?>">
                                        <div class="atribut" name = "<?php echo $index; ?>"  element_type = "<?php echo $element; ?>" field_type = "" field_size = "" add_translation = "0">
                                            <?php echo $index; ?>
                                            <div id="<?php echo $attr; ?>" class="close attr_close">
                                                X
                                            </div>
                                        </div>
                                        <input type = "hidden" name = "hidden_element['<?php echo $index; ?>']['name']" value = "<?php echo $index; ?>" />
                                        <input type = "hidden" name = "hidden_element['<?php echo $index; ?>']['element_type']" value = "<?php echo $element; ?>" />
                                        <input type = "hidden" name = "hidden_element['<?php echo $index; ?>']['field_type']" value = "" />
                                        <input type = "hidden" name = "hidden_element['<?php echo $index; ?>']['field_size']" value = "" />
                                        <input type = "hidden" name = "hidden_element['<?php echo $index; ?>']['add_translation']" value = "0" />
                                        </br></div>
                                    <?php } 
                                    foreach ($custom_field_t as $index => $element) { 
                                    $attr+=1;
                                    ?>
                                    <div class="<?php echo $attr; ?>">
                                        <div class="atribut" name = "<?php echo $index; ?>"  element_type = "<?php echo $element; ?>" field_type = "" field_size = "" add_translation = "1">
                                            <?php echo $index; ?>
                                            <div id="<?php echo $attr; ?>" class="close attr_close">
                                                X
                                            </div>
                                        </div>
                                        <input type = "hidden" name = "hidden_element['<?php echo $index; ?>']['name']" value = "<?php echo $index; ?>" />
                                        <input type = "hidden" name = "hidden_element['<?php echo $index; ?>']['element_type']" value = "<?php echo $element; ?>" />
                                        <input type = "hidden" name = "hidden_element['<?php echo $index; ?>']['field_type']" value = "" />
                                        <input type = "hidden" name = "hidden_element['<?php echo $index; ?>']['field_size']" value = "" />
                                        <input type = "hidden" name = "hidden_element['<?php echo $index; ?>']['add_translation']" value = "1" />
                                        </br></div>
                                    <?php } ?>
                                </div> 
                                <br />
                                <input  id="create_post_type" class="btn btn-primary" type='submit' name='edit_custom_post_type' value='Edit custom post type'/>

                            </form>                            
                        </td>
                        <td class="span5">
                            <form id="create_atributs" action='' method='post' enctype='multipart/form-data'>
                                <div class="add-element">
                                    <label class="control-label" for="atribut_element_type">Select element</label>
                                    <select class="form-control" name="atribut_element_type" id="atribut_element_type">
                                        <option value="text">Text</option>
                                        <option  value="textarea">Text area</option>
                                        <option value="file">File</option>
                                        <option value="checkbox">Checkbox</option>
                                    </select>                                
                                </div>                                                                
                            </form>
                            <div class="atribut_settings">
                                <h3 class="settings_title"></h3>
                                <label for="atribut_name" class="control-label required">Name</label>
                                <input name="atribut_name" class="form-control" id="atribut_name" type="text" />

                                <div style="color: red;" class="error_name"></div>
                                <br />

                                <label for="atribut_field_type">Field type</label>
                                <select name="atribut_field_type" class="form-control" id="atribut_field_type">                                    
                                </select>
                                <br />
                                <div class="atribut_size" hide_show="show">
                                    <label for="atribut_size" class="control-label required">size</label>
                                    <input name="atribut_size" class="form-control" id="atribut_size" type="text" />

                                    <div style="color: red;" class="error_size"></div>
                                </div>
                                <br />
                                <input name="atribut_translation" id="atribut_translation" type="checkbox" value="0" />
                                <label for="atribut_translation">Add translation</label>
                                <br /><br />
                                <input name="add_element" class="btn btn-primary" id="add_element" type="button" value="Add element" />
                            </div>
                        </td>                        
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



