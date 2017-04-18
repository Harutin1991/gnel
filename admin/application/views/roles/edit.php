<?php $checked_permission = unserialize($edit_role['url']); //var_dump($checked_permission);exit;         ?>

<div class="row-fluid sortable"> 
    <div class="box span10">
        <div class="box-header well" data-original-title>
            <h2><?php echo $this->lang->line('Edit'); ?></h2>
        </div>
        <div class="box-content">
            <table class="table table-bordered table-striped">
                <form method="POST" action="" >
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <label class="control-label required" for="role"><?php echo $this->lang->line('Name'); ?></label>
                                <input name="role" value="<?php echo $edit_role['rol_name']; ?>" class="form-control" id="role" type="text">
                                <div class="error"><?php echo form_error('role'); ?></div>
                            </td>  
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label class="required"><?php echo $this->lang->line('Permission'); ?></label>
                                <div class="error"><?php echo form_error('permission'); ?></div>  
                            </td>
                        </tr>
                        <?php
                        $array_except = array('ajax.php', '.', '..', 'welcome.php', 'login.php', 'logout.php', 'index.html', 'dashboard.php');
                        foreach ($controller_files as $index => $element) {
                            if (in_array($element, $array_except)) {
                                continue;
                            }
                            $element = rtrim($element, '.php');
                            if ($element == 'custom' || $element == 'customposttype') {
                                ?>
                                <tr>
                                    <td>
                            <nobr>
                                <input name="permission[<?php echo $element; ?>]" value="<?php
                                echo $element . '/';
                                if ($element == 'custom')
                                    echo 'index';
                                ?>" id="permission[<?php echo $element; ?>]" type="checkbox" 
                                       <?php
                                       if (!empty($checked_permission)) {
                                           if ($element == 'custom') {
                                               $el = $element . '/index';
                                           } else {
                                               $el = $element . '/';
                                           }
                                           if (in_array($el, $checked_permission))
                                               echo 'checked';
                                       }
                                       ?> />                                                                        
                                <label for="permission[<?php echo $element; ?>]" ><?php echo $element; ?> </label>
                            </nobr>
                            </td>
                            <td>
                                <div></div> 
                            </td>
                            </tr>
                            <?php
                        } else if ($element == 'menu') {
                            ?>
                            <tr>
                                <td>                          
                            <nobr>
                                <input class="role_page" name="permission[<?php echo $element; ?>]" value="<?php echo $element; ?>/" id="permission[<?php echo $element; ?>]" type="checkbox" 
                                <?php
                                if (!empty($checked_permission)) {
                                    if (in_array($element . '/', $checked_permission))
                                        echo 'checked';
                                }
                                ?> />                                                                        
                                <label for="permission[<?php echo $element; ?>]" ><?php echo $element; ?> </label>
                            </nobr>                                                                        
                            </td>
                            <td>
                                <div>
                                    <nobr>                                            
                                        <label for="permission[<?php echo $element . '_add'; ?>]" >Add</label>
                                        <input style="float:none" class="<?php echo $element; ?>" name="permission[<?php echo $element . '_add'; ?>]" value="<?php echo $element; ?>/add" id="permission[<?php echo $element . '_add'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/add', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?> /> 
                                        <label for="permission[<?php echo $element . '_edit'; ?>]" >Edit</label>
                                        <input style="float:none" class="<?php echo $element; ?>" name="permission[<?php echo $element . '_edit'; ?>]" value="<?php echo $element; ?>/edit" id="permission[<?php echo $element . '_edit'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/edit', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?>/> 
                                        <label for="permission[<?php echo $element . '_delete'; ?>]" >Delete</label>
                                        <input style="float:none" class="<?php echo $element; ?>" name="permission[<?php echo $element . '_delete'; ?>]" value="<?php echo $element; ?>/delete" id="permission[<?php echo $element . '_delete'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/delete', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?>/>                                         
                                        <label for="permission[<?php echo $element . '_addItem'; ?>]" >AddItem</label>
                                        <input style="float:none" class="<?php echo $element; ?>" name="permission[<?php echo $element . '_addItem'; ?>]" value="<?php echo $element; ?>/addItem" id="permission[<?php echo $element . '_addItem'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/addItem', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?>/> 
                                        <label for="permission[<?php echo $element . '_editItem'; ?>]" >EditItem</label>
                                        <input style="float:none" class="<?php echo $element; ?>" name="permission[<?php echo $element . '_editItem'; ?>]" value="<?php echo $element; ?>/editItem" id="permission[<?php echo $element . '_editItem'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/editItem', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?>/> 
                                    </nobr>
                                </div> 
                            </td>
                            </tr>
    <?php } else if ($element == 'product') { ?>
                            <tr>
                                <td>                          
                            <nobr>
                                <input class="role_page" name="permission[<?php echo $element; ?>]" value="<?php echo $element; ?>/" id="permission[<?php echo $element; ?>]" type="checkbox" 
                                <?php
                                if (!empty($checked_permission)) {
                                    if (in_array($element . '/', $checked_permission))
                                        echo 'checked';
                                }
                                ?> />                                                                        
                                <label for="permission[<?php echo $element; ?>]" ><?php echo $element; ?> </label>
                            </nobr>                                                                        
                            </td>
                            <td>
                                <div>
                                    <nobr>                                            
                                        <label for="permission[<?php echo $element . '_add'; ?>]" >Add</label>
                                        <input style="float:none" class="<?php echo $element; ?>" name="permission[<?php echo $element . '_add'; ?>]" value="<?php echo $element; ?>/add" id="permission[<?php echo $element . '_add'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/add', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?> /> 
                                        <label for="permission[<?php echo $element . '_edit'; ?>]" >Edit</label>
                                        <input style="float:none" class="<?php echo $element; ?>" name="permission[<?php echo $element . '_edit'; ?>]" value="<?php echo $element; ?>/edit" id="permission[<?php echo $element . '_edit'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/edit', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?>/> 
                                        <label for="permission[<?php echo $element . '_delete'; ?>]" >Delete</label>
                                        <input style="float:none" class="<?php echo $element; ?>" name="permission[<?php echo $element . '_delete'; ?>]" value="<?php echo $element; ?>/delete" id="permission[<?php echo $element . '_delete'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/delete', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?>/>                                         
                                        <label for="permission[<?php echo $element . '_option'; ?>]" >Option</label>
                                        <input style="float:none" class="<?php echo $element; ?>" name="permission[<?php echo $element . '_options'; ?>]" value="<?php echo $element; ?>/options" id="permission[<?php echo $element . '_options'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/options', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?>/> 
                                        <label for="permission[<?php echo $element . '_addImages'; ?>]" >AddImages</label>
                                        <input style="float:none" class="<?php echo $element; ?>" name="permission[<?php echo $element . '_addImages'; ?>]" value="<?php echo $element; ?>/addImages" id="permission[<?php echo $element . '_addImages'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/addImages', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?>/> 
                                        <label for="permission[<?php echo $element . '_comments'; ?>]" >Comments</label>
                                        <input style="float:none" class="<?php echo $element; ?>" name="permission[<?php echo $element . '_comments'; ?>]" value="<?php echo $element; ?>/comments" id="permission[<?php echo $element . '_comments'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/comments', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?>/> 
                                    </nobr>
                                </div> 
                            </td>
                            </tr>

    <?php } else if ($element == 'users') { ?>
                            <tr>
                                <td>                          
                            <nobr>
                                <input class="role_page" name="permission[<?php echo $element; ?>]" value="<?php echo $element; ?>/" id="permission[<?php echo $element; ?>]" type="checkbox" 
                                <?php
                                if (!empty($checked_permission)) {
                                    if (in_array($element . '/', $checked_permission))
                                        echo 'checked';
                                }
                                ?> />                                                                        
                                <label for="permission[<?php echo $element; ?>]" ><?php echo $element; ?> </label>
                            </nobr>                                                                        
                            </td>
                            <td>
                                <div>
                                    <nobr>                                            
                                        <label for="permission[<?php echo $element . '_add'; ?>]" >Add</label>
                                        <input style="float:none" class="<?php echo $element; ?>" name="permission[<?php echo $element . '_add'; ?>]" value="<?php echo $element; ?>/add" id="permission[<?php echo $element . '_add'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/add', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?> /> 
                                        <label for="permission[<?php echo $element . '_edit'; ?>]" >Edit</label>
                                        <input style="float:none" class="<?php echo $element; ?>" name="permission[<?php echo $element . '_edit'; ?>]" value="<?php echo $element; ?>/edit" id="permission[<?php echo $element . '_edit'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/edit', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?>/> 
                                        <label for="permission[<?php echo $element . '_delete'; ?>]" >Delete</label>
                                        <input style="float:none" class="<?php echo $element; ?>" name="permission[<?php echo $element . '_delete'; ?>]" value="<?php echo $element; ?>/delete" id="permission[<?php echo $element . '_delete'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/delete', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?>/>                                         
                                        <label for="permission[<?php echo $element . '_personal'; ?>]" >Personal</label>
                                        <input style="float:none" class="<?php echo $element; ?>" name="permission[<?php echo $element . '_personal'; ?>]" value="<?php echo $element; ?>/personal" id="permission[<?php echo $element . '_personal'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/personal', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?>/> 
                                    </nobr>
                                </div> 
                            </td>
                            </tr>


    <?php } else { ?>
                            <tr>
                                <td>                          
                            <nobr>
                                <input class="role_page" name="permission[<?php echo $element; ?>]" value="<?php echo $element; ?>/" id="permission[<?php echo $element; ?>]" type="checkbox"
                                <?php
                                if (!empty($checked_permission)) {
                                    if (in_array($element . '/', $checked_permission))
                                        echo 'checked';
                                }
                                ?> />                                                                        
                                <label for="permission[<?php echo $element; ?>]" ><?php echo $element; ?> </label>
                            </nobr>                                                                        
                            </td>
                            <td>
                                <div>
                                    <nobr>                                            
                                        <label for="permission[<?php echo $element . '_add'; ?>]" >Add</label>
                                        <input class="<?php echo $element; ?>" name="permission[<?php echo $element . '_add'; ?>]" value="<?php echo $element; ?>/add" id="permission[<?php echo $element . '_add'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/add', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?>/> 
                                        <label for="permission[<?php echo $element . '_edit'; ?>]" >Edit</label>
                                        <input class="<?php echo $element; ?>" name="permission[<?php echo $element . '_edit'; ?>]" value="<?php echo $element; ?>/edit" id="permission[<?php echo $element . '_edit'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/edit', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?>/> 
                                        <label for="permission[<?php echo $element . '_delete'; ?>]" >Delete</label>
                                        <input class="<?php echo $element; ?>" name="permission[<?php echo $element . '_delete'; ?>]" value="<?php echo $element; ?>/delete" id="permission[<?php echo $element . '_delete'; ?>]" type="checkbox"
                                        <?php
                                        if (!empty($checked_permission)) {
                                            if (in_array($element . '/delete', $checked_permission))
                                                echo 'checked';
                                        }
                                        ?>/>                                         
                                    </nobr>
                                </div> 
                            </td>
                            </tr>
                            <?php
                        }
                    }
                    ?> 
                    <tr>
                        <td colspan="2">
                            <input class="btn btn-primary" value="<?php echo $this->lang->line('Edit'); ?>" type="submit" name="submit">   
                        </td>
                    </tr>

                  <!--  <tr>
                        <td>
                            <label class="control-label required" for="role"><?php echo $this->lang->line('Name'); ?></label>
                            <input name="role" value="<?php echo $edit_role['rol_name']; ?>" class="form-control" id="role" type="text">
                            <div class="error"><?php echo form_error('role'); ?></div>
                        </td>
                        <td>
                            <fieldset>
                                <legend class="required"><?php echo $this->lang->line('Permission'); ?></legend>
                                <div class="error"><?php echo form_error('permission'); ?></div>
                    <?php foreach ($permission as $index => $element) { ?>                                           
                                                <input name="permission[<?php echo $index; ?>]" value="<?php echo $element; ?>" id="permission[<?php echo $index; ?>]" type="checkbox"
                        <?php
                        if (!empty($checked_permission)) {
                            if (in_array($element, $checked_permission))
                                echo 'checked';
                        }
                        ?> />
                                                <label  for="permission[<?php echo $index; ?>]"><?php echo $element; ?></label> </br>
<?php } ?>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="btn btn-primary" value="<?php echo $this->lang->line('Edit'); ?>" type="submit" name="submit">
                        </td>
                    </tr> -->
                    </tbody>
                </form>
            </table>

        </div>
    </div>
</div>