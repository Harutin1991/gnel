<?php if ($this->session->flashdata('message') == 'add_item_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Menu item has added successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
            <i class="glyphicon glyphicon-bell icon-white"></i> Top Center (fade)
        </button>
    </div>
<?php elseif ($this->session->flashdata('message') == 'edit_item_success'): ?>
    <div style="display: none">
        <button  class="btn btn-primary noty" data-noty-options="{&quot;text&quot;:&quot;<?php echo $this->lang->line('Menu item has edited successfully'); ?>&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;success&quot;}">
            <i class="glyphicon glyphicon-bell icon-white"></i> Top Center (fade)
        </button>
    </div>
<?php endif; ?>

<div class="menu-block">
    <h3 id="menu_title"><?php echo $this->lang->line('Add menu items'); ?></h3>
    <table>
        <form id="MenuItem" action="/menu/addItem/<?php echo $parent['id']; ?>" method="POST" >
            <tbody>
                <tr>
                    <td>
                        <div>
                            <label class="control-label required" for="MenuItem[url]">URL</label>
                            <input name="MenuItem[url]" value="<?php echo set_value('MenuItem[url]'); ?>" type="text" class="form-control" id="url">
                            <div class="error"><?php echo form_error('MenuItem[url]'); ?></div>
                        </div>
                    </td>
                    <td>
                        <label class="control-label" for="page"><?php echo $this->lang->line('Page'); ?></label>
                        <select name="page" id="page" class="deal_type form-control">
                            <option value=""><?php echo $this->lang->line('Select ...'); ?></option>
                            <?php foreach ($pages as $page): ?>
                            <option value="<?php echo $page->url; ?>"><?php echo $page->title ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
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
                        <div class="tab-content">
                            <?php foreach ($languages as $language): ?>
                                <?php if ($language->code == $default_language): ?>
                                    <div class="tab-pane active" id="<?php echo $language->code; ?>">
                                        <br />
                                        <label class="control-label required" for="MenuItem[name_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Name'); ?></label>
                                        <input name="MenuItem[name_<?php echo $language->code; ?>]" value="<?php echo set_value('MenuItem[name_' . $language->code . ']'); ?>" type="text" class="form-control" id="name">
                                        <div class="error"><?php echo form_error('MenuItem[name_' . $language->code . ']'); ?></div>
                                    </div>
                                <?php else: ?>
                                    <div class="tab-pane" id="<?php echo $language->code; ?>">
                                        <br />
                                        <label class="control-label" for="MenuItem[name_<?php echo $language->code; ?>]"><?php echo $this->lang->line('Name'); ?></label>
                                        <input name="MenuItem[name_<?php echo $language->code; ?>]" value="<?php echo set_value('MenuItem[name_' . $language->code . ']'); ?>" type="text" class="form-control" id="name">
                                        <div class="error"><?php echo form_error('MenuItem[name_' . $language->code . ']'); ?></div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <input name="MenuItem[menu_item_id]" value="<?php echo set_value('MenuItem[id]'); ?>" type="hidden" id="menu_item_id">
                        </div> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <input id="submit" class="btn btn-primary" type="submit" value="<?php echo $this->lang->line('Add'); ?>" />
                        <span id='cancel' class='btn btn-danger' style="visibility: hidden;"><i class='icon-edit icon-white'></i>Cancel</span>
                    </td>
                </tr>
            </tbody>
        </form>
    </table>
</div>

<div class="menu-block">
    <h4><?php echo $this->lang->line('Menu items'); ?></h4>
    <?php
    echo get_menu_html($menuItems, array('class' => 'dd', 'id' => 'nestable3'));
    ?>
    <br />
    <span id="save" class="btn btn-primary"><?php echo $this->lang->line('Save order'); ?></span>
</div>

<script>
$(document).ready(function () {
    setTimeout(function () {
        $('.noty').trigger('click');
    }, 1000);

    $('#save').click(function () {
        menu_items = $('#nestable3').nestable('toArray');
        console.log(JSON.stringify(menu_items))
        menu_id = <?php echo $menu_id; ?>

        $.ajax({
            url: base_url + "ajax",
            dataType: 'json',
            type: 'post',
            data: {
                action: 'save_menu_items',
                menu_items: JSON.stringify(menu_items),
                menu_id: menu_id
            },
            success: function (data) {
                //  alert(data);
            }
        });
    });

    $('#myTab a:first').tab('show');

    $('.delete').click(function () {
        var id = $(this).attr('item_id');

        $.msgBox({
            title: '<?php echo $this->lang->line('Delete'); ?>',
            content: '<?php echo $this->lang->line('Are you sure you want to delete menu item?'); ?>',
            type: "error",
            buttons: [{value: '<?php echo $this->lang->line('Yes'); ?>'}, {value: '<?php echo $this->lang->line('No'); ?>'}],
            success: function (result) {
                if (result == '<?php echo $this->lang->line('Yes'); ?>') {
                    $.ajax({
                        url: base_url + "ajax",
                        dataType: 'json',
                        type: 'post',
                        data: {'action': 'delete_menu_item', 'id': id},
                        success: function (data) {
                            if (data.success == true)
                                $('#' + id).fadeOut(2000, function () {
                                    $(this).remove();
                                });
                        }
                    });
                }
                else if (result == '<?php echo $this->lang->line('No'); ?>') {

                }
            }
        });
    });

    $('.edit').click(function () {
        var id = $(this).attr('item_id');
        var languages = <?php echo json_encode($languages); ?>;
        var parent = <?php echo json_encode($parent); ?>;

        $.ajax({
            url: base_url + "ajax",
            dataType: 'json',
            type: 'post',
            data: { 'action': 'get_menu_item', 'id': id },
            success: function (data) {
                if (data.success == true) {
                    $('input[name="MenuItem[url]"]').val(data.menu_item['url']);
                    $('#page').val(data.menu_item['url']);
                    for (var key in languages) {
                        var code = languages[key].code;
                        var name = 'name_' + code;
                        $('input[name="MenuItem[' + name + ']"]').val(data.menu_item[name]);
                    }
                    $('form').attr('action', '/menu/editItem/' + parent['id']);
                    $('input[name="MenuItem[menu_item_id]"]').val(id);
                    $('#submit').val('<?php echo $this->lang->line('Edit'); ?>');
                    $('#cancel').css('visibility', 'visible');
                    $('#menu_title').html('<?php echo $this->lang->line('Edit menu item'); ?>');

                    $('html, body').animate({
                        scrollTop: $("#menu_title").offset().top - 20
                    }, 500);
                }
            }
        });
    });
    
    $('#cancel').click(function(){
        var languages = <?php echo json_encode($languages); ?>;
        
        $('input[name="MenuItem[url]"]').val('');
        $('#page').val('');
        
        for (var key in languages) {
            var code = languages[key].code;
            var name = 'name_' + code;
            $('input[name="MenuItem[' + name + ']"]').val('');
        }
        $('form').attr('action', '/menu/addItem');
        $('input[name="MenuItem[menu_item_id]"]').val('');
        $('#submit').val('<?php echo $this->lang->line('Add'); ?>');
        $('#menu_title').html('<?php echo $this->lang->line('Add menu items'); ?>');
        $(this).css('visibility', 'hidden');
    });
    
    $('#page').change(function () {
        var url = $(this).val();
        $('#url').val(url);
    });
});
</script>
