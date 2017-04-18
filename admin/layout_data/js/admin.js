$(document).ready(function() {
    $(".delete_post_type").click(function() {
//alert("no");
        var post_type = $(this).attr('post_type');
        var post_id = $(this).attr('post_id');
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: window.base_url + 'ajax',
            data: {action: 'delete_post_type', post_type: post_type, post_id: post_id},
            success: function(response) {
                //var y=response.success;
                //alert(response);
                //alert(d.success); 
                //var page = JSON.parse(d);
                //var page = d.page;
                //alert(page);
                //$('.page').append(page);
            },
            error: function() {
                //alert("no");
            }
        });
        $("." + post_id).hide();
        return false;
    });
    $(".delete_role").click(function() {
//alert("no");     
        var post_id = $(this).attr('post_id');
        $.ajax({
            type: 'post',
            //dataType: 'json',
            url: window.base_url + 'ajax',
            data: {action: 'delete_role', post_id: post_id},
            success: function(response) {
                if (response) {
                    alert('The user uses the role')
                }
                else {
                    $("." + post_id).hide();
                }
            },
            error: function() {

            }
        });
        return false;
    });

    $(".delete_customposttype").click(function() {
        var post_id = $(this).attr('post_id');
        $.ajax({
            type: 'post',
            url: window.base_url + 'ajax',
            data: {action: 'delete_customposttype', post_id: post_id}
        });
        $("." + post_id).hide();
        return false;
    });

    $(".role_page").click(function() {
        var value = $(this).val();
        value = value.replace("/", "");
        if (!$(this).is(":checked")) {
            $('.' + value).prop("checked", false);
        }
    });
    $('.DivLanguagesCode').hide();
    $('.LanguagesCode').click(function() {
//alert(55); 
        var bloc_id = $(this).attr('id');
        //alert(bloc_id);
        $('.DefaultLanguagesCode').hide();
        $('.DivLanguagesCode').hide();
        $('div #' + bloc_id).show();
        return false;
    });
    if ($('.error2').html() == '') {
        $('.change_password').hide();
    }
    else {
        $('.btn_change_password').hide();
        $('.hidden_change_password').val(1);
    }

    $('.btn_change_password').click(function() {
//alert(55);         
        $(this).hide();
        $('.hidden_change_password').val(1);
        $('.change_password').show();
        return false;
    });








    var attr = 0;
    $('.atribut_settings').hide();
    if ($('#tabl_name').val() == "") {
        $('.error_tabl_name').text('Fill in the name post type field');
        $('#create_post_type').attr('disabled', true);
        //return false;
    }
    $('#tabl_name').keyup(function() {
        var tabl_name = $(this).val();
        if (tabl_name == "") {
            $('.error_tabl_name').text('Fill in the name post type field');
            $('#create_post_type').attr('disabled', true);
            return false;
        }
        $.ajax({
            type: 'post',
            url: window.base_url + 'ajax',
            data: {action: 'existTable', tabl_name: tabl_name},
            success: function(response) {
                if (response) {
                    $('.error_tabl_name').text('');
                    $('#create_post_type').attr('disabled', false);
                }
                else {
                    $('.error_tabl_name').text('post type is used to ');
                    $('#create_post_type').attr('disabled', true);
                }
            }
        });
        return false;
    });
    $('#atribut_element_type').click(function() {
        if ($(this).val() == 'textarea') {
            $('#atribut_field_type').html(' <option value="text">text</option>');
            $('.atribut_size').hide();
            $('.atribut_size').attr('hide_show', 'hide');
        }
        if ($(this).val() == 'text') {
            $('#atribut_field_type').html(' <option value="int">int</option><option value="varchar">varchar</option>');
            $('.atribut_size').show();
            $('.atribut_size').attr('hide_show', 'show');
        }
        if ($(this).val() == 'file') {
            $('#atribut_field_type').html(' <option value="varchar">varchar</option>');
            $('.atribut_size').show();
            $('.atribut_size').attr('hide_show', 'show');
        }
        if ($(this).val() == 'checkbox') {
            $('#atribut_field_type').html(' <option value="tinyint">tinyint</option>');
            $('.atribut_size').show();
            $('.atribut_size').attr('hide_show', 'show');
        }
        $('.settings_title').text('Filling ' + $(this).val() + ' elements settings');
        $('.atribut_settings').show();
    });

    $('#atribut_translation').click(function() {
        if ($(this).val() == 0) {
            $(this).val(1);
        }
        else {
            $(this).val(0);
        }
    });
    $('#add_element').click(function() {
        $('.error_name').text('');
        $('.error_size').text('');
        if ($('#atribut_name').val() == '') {
            $('.error_name').text('Fill in the name field');
        }
        else if ($('.atribut_size').attr('hide_show') == 'show' && $('#atribut_size').val() == '') {
            $('.error_size').text('Fill in the size field');
        }
        else {
            attr += 1;
            var name = $('#atribut_name').val();
            var element_type = $('#atribut_element_type').val();
            var field_type = $('#atribut_field_type').val();
            var field_size = $('#atribut_size').val();
            var add_translation = $('#atribut_translation').val();
            var field_array = [name, element_type, field_type, field_size, add_translation];
            $('.atributs').append('<div class="' + attr + '">\n\
            <div class="atribut" name = "' + name + '"  element_type = "' + element_type + '" field_type = "' + field_type + '" field_size = "' + field_size + '" add_translation = "' + add_translation + '">' + name + '<div id="' + attr + '" class="close attr_close">X</div></div>\n\
            <input type = "hidden" name = "hidden_element[' + name + '][' + 'name' + ']" value = "' + name + '" />\n\
            <input type = "hidden" name = "hidden_element[' + name + '][' + 'element_type' + ']" value = "' + element_type + '" />\n\
            <input type = "hidden" name = "hidden_element[' + name + '][' + 'field_type' + ']" value = "' + field_type + '" />\n\
            <input type = "hidden" name = "hidden_element[' + name + '][' + 'field_size' + ']" value = "' + field_size + '" />\n\
            <input type = "hidden" name = "hidden_element[' + name + '][' + 'add_translation' + ']" value = "' + add_translation + '" />\n\
            </br></div>');
            $('#atribut_name').val('');
            $('#atribut_size').val('');
            $('.atribut_settings').hide();
            $('#create_post_type').show();
        }
    });
    $(document).on('click', '.attr_close', function() {
        $("." + $(this).attr('id') + "").remove();
        if ($('.atributs').html() == '') {
            $('#create_post_type').hide();
        }
    });





    $(".img_del").click(function() {
        var id = $(this).attr('id');
        var tab_name = $(this).attr('tab_name');
        var field_name = $(this).attr('field_name');
        var post_id = $(this).attr('post_id');
        var lang_code = $(this).attr('lang_code');
        $.ajax({
            type: 'post',
            url: window.base_url + 'ajax',
            data: {
                action: 'delete_img',
                tab_name: tab_name,
                field_name: field_name,
                post_id: post_id,
                lang_code: lang_code
            }
        });
        var t = window.frontend_url + "images/no-img.jpg";
        //alert(t);
        $('.' + id).attr('src', window.frontend_url + "images/no-img.jpg");
        $(this).hide();
        return false;
    });

    $('#nestable3').nestable();

    setTimeout(function() {
        $('.noty').trigger('click');
    }, 1000);

    $('#myTab a:first').tab('show');

    $('#image').css('display', 'none');
    $('#current-image').click(function() {
        $('#image').click();
    });



});


