<div class="row-fluid sortable"> 
    <div class="box span10">
        <div class="box-header well" data-original-title>
            <h2><?php echo $this->lang->line('Add'); ?></h2>
        </div>
        <div class="box-content">

            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#<?php echo $default_language['value']; ?>"><?php echo $default_language['value']; ?></a></li>
                <?php
                foreach ($languages as $element) {
                    if ($element->code == $default_language['value']) {
                        continue;
                    }
                    echo "<li><a href='#" . $element->code . "'>" . $element->code . "</a></li>";
                }
                ?>
            </ul>
            <form action='' method='post' enctype='multipart/form-data'> 
                <table class="span5">                
                    <tbody>
                        <tr>
                            <td>
                                <div class="tab-content">        
                                    <?php
                                    foreach ($languages as $element) {
                                        if ($element->code == $default_language['value']) {
                                            ?>        
                                            <div class="tab-pane active" id="<?php echo $default_language['value']; ?>">
                                                <h3><?php echo $element->name; ?></h3>
                                                <?php
                                                foreach ($custom_field_t as $index => $value) {
                                                    if ($index < 3) {
                                                        continue;
                                                    }
                                                    $pos = strripos($value, '_');
                                                    $field_name = substr($value, 0, $pos);
                                                    $field_type = substr($value, $pos + 1);
                                                    if ($field_type == 'text') {
                                                        ?>                                        
                                                        <label class="control-label" for="<?php echo $element->code . '_' . $field_name; ?>" > <?php echo $field_name; ?></label>
                                                        <input id="<?php echo $element->code . '_' . $field_name; ?>" class="form-control" type='text' name='<?php echo $element->code . '_' . $field_name; ?>' />
                                                        <br/>
                                                        <?php
                                                    }
                                                    if ($field_type == 'textarea') {
                                                        ?>  
                                                        <label class="control-label" for="<?php echo $element->code . '_' . $field_name; ?>" > <?php echo $field_name; ?> </label>
                                                        <textarea id="<?php echo $element->code . '_' . $field_name; ?>" class="mceEditor form-control" name="<?php echo $element->code . '_' . $field_name; ?>" >                
                                                        </textarea>
                                                        <br/>
                                                        <?php
                                                    }
                                                    if ($field_type == 'file') {
                                                        ?>    
                                                        <input class="btn btn-default btn-file" type="file" name="<?php echo $element->code . '_' . $field_name; ?>"  />
                                                        <br/>
                                                        <?php
                                                    }
                                                    if ($field_type == 'checkbox') {
                                                        ?>                                        
                                                        <label class="control-label" for="<?php echo $element->code . '_' . $field_name; ?>" > <?php echo $field_name; ?></label>
                                                        <input id="<?php echo $element->code . '_' . $field_name; ?>" class="" type='checkbox' name='<?php echo $element->code . '_' . $field_name; ?>' value="1" />
                                                        <br/>
                                                        <?php
                                                    }
                                                }
                                                ?>                                                
                                            </div>
                                            <?php
                                        } else {
                                            ?>        
                                            <div class="tab-pane " id="<?php echo $element->code; ?>">
                                                <h3><?php echo $element->name; ?></h3>
                                                <?php
                                                foreach ($custom_field_t as $index => $value) {
                                                    if ($index < 3) {
                                                        continue;
                                                    }
                                                    $pos = strripos($value, '_');
                                                    $field_name = substr($value, 0, $pos);
                                                    $field_type = substr($value, $pos + 1);
                                                    if ($field_type == 'text') {
                                                        ?>                                        
                                                        <label class="control-label" for="<?php echo $element->code . '_' . $field_name; ?>" > <?php echo $field_name; ?></label>
                                                        <input id="<?php echo $element->code . '_' . $field_name; ?>" class="form-control" type='text' name='<?php echo $element->code . '_' . $field_name; ?>' />
                                                        <br/>
                                                        <?php
                                                    }
                                                    if ($field_type == 'textarea') {
                                                        ?>  
                                                        <label class="control-label" for="<?php echo $element->code . '_' . $field_name; ?>" > <?php echo $field_name; ?> </label>
                                                        <textarea id="<?php echo $element->code . '_' . $field_name; ?>" class="mceEditor form-control" name="<?php echo $element->code . '_' . $field_name; ?>" >                
                                                        </textarea>
                                                        <br/>
                                                        <?php
                                                    }
                                                    if ($field_type == 'file') {
                                                        ?>    
                                                        <input class="btn btn-default btn-file" type="file" name="<?php echo $element->code . '_' . $field_name; ?>"  />
                                                        <br/>
                                                        <?php
                                                    }
                                                    if ($field_type == 'checkbox') {
                                                        ?>                                        
                                                        <label class="control-label" for="<?php echo $element->code . '_' . $field_name; ?>" > <?php echo $field_name; ?></label>
                                                        <input id="<?php echo $element->code . '_' . $field_name; ?>" class="" type='checkbox' name='<?php echo $element->code . '_' . $field_name; ?>' value="1" />
                                                        <br/>
                                                        <?php
                                                    }
                                                }
                                                ?>                                                                  
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>                             
                                <div class="non-translatable"> 
                                    <br>
                                    <?php
                                    foreach ($custom_field as $index => $element) {
                                        if ($index < 2) {
                                            continue;
                                        }
                                        $pos = strripos($element, '_');
                                        $field_name = substr($element, 0, $pos);
                                        $field_type = substr($element, $pos + 1);
                                        if ($field_type == 'text') {
                                            ?>                                        
                                            <label class="control-label" for="<?php echo $field_name; ?>" > <?php echo $field_name; ?></label>
                                            <input id="<?php echo $field_name; ?>" class="form-control" type='text' name='<?php echo $field_name; ?>' />
                                            <br/>
                                            <?php
                                        }
                                        if ($field_type == 'textarea') {
                                            ?>  
                                            <label class="control-label" for="<?php echo $field_name; ?>" > <?php echo $field_name; ?> </label>
                                            <textarea id="<?php echo $field_name; ?>" class="mceEditor form-control" name="<?php echo $field_name; ?>" >                
                                            </textarea>
                                            <br/>
                                            <?php
                                        }
                                        if ($field_type == 'file') {
                                            ?>    
                                            <input class="btn btn-default btn-file" type="file" name="<?php echo $field_name; ?>"  />
                                            <br/>
                                            <?php
                                        }
                                        if ($field_type == 'checkbox') {
                                            ?>    
                                            <label class="control-label" for="<?php echo $field_name; ?>" > <?php echo $field_name; ?></label>
                                            <input id="<?php echo $field_name; ?>" class="" type='checkbox' name='<?php echo $field_name; ?>' value="1" />
                                            <br/>
                                            <?php
                                        }
                                    }
                                    ?>
                                     <nobr>       
                                    <label class="control-label" for="achievable" >active / not active</label>
                                    <input id="achievable" class="" type='checkbox' name='achievable' value="1" />
                                     </nobr>
                                    <br/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>                                
                                <input class="btn btn-primary" type='submit' name='submit' value='<?php echo $this->lang->line('Add'); ?>'/>                           
                            </td>
                        </tr>
                    </tbody>

                </table>
            </form>
        </div>
    </div>
</div>


