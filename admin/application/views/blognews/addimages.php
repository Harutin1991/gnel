<div class="row">
    <div>
        <a href="<?php echo base_url('blognews/edit/' . $blognews['id']); ?>"><< Խմբագրել</a>  -
<!--        <a href="--><?php //echo base_url('blognews/options/' . $blognews['id']); ?><!--">Տարբերակներ >></a>-->
        <div>

            <div class="box col-md-12">

                <div class="box-inner">

                    <div class="box-header well" data-original-title="">
                        <h2>
                            <i class="glyphicon glyphicon-list-alt"></i> 
                            <?php echo $this->lang->line('Add images'); ?>
                            <sub style="font-weight: normal;">(Ցանկալի է նկարի չափսերը լինեն 400x400px և ավելի, իսկ նկարը` jpg կամ png)</sub>
                        </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form id="upload-form" method="POST" enctype="multipart/form-data" action="/ajax">
                            <table>
                                <tbody>
                                    <tr>    
                                        <td>
                                            <div class="image-box">
                                                <label class="control-label" for="image" ><?php echo $this->lang->line('Images'); ?></label> <span class="upload_percent"></span>
                                                <input name="images[]" multiple value="<?php echo set_value('image'); ?>" type="file" class="form-control" id="image-input">
                                                <div class="error"><?php echo form_error('image'); ?></div>
                                                <div id="images-box">
                                                    <ul id="images">
                                                        <?php foreach ($blognews['images'] as $image): ?>
                                                            <li id="<?php echo $image->id; ?>">
                                                                <img src="<?php echo $this->config->item('frontend_url') . 'images/blognews/' . $blognews['id'] . '/' . $image->image; ?>" class="img-blognews img-thumbnail" id="img<?php echo $image->id; ?>" />
                                                                <img src="<?php echo base_url('img/delete.png'); ?>" class="img-delete" alt="<?php echo $image->id; ?>" title="<?php echo $this->lang->line('Delete image'); ?>" />
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                    <input type="hidden" id="blognews_id" value="<?php echo $blognews['id']; ?>">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                            <a href="" id="order" class="btn btn-primary"><?php echo $this->lang->line('Save order'); ?></a>
                                            <a id="next_opt" href="<?php echo site_url('blognews/options') . '/' . $blognews['id']; ?>" class="btn btn-primary"><?php echo $this->lang->line('Next'); ?></a>
                                        </td>
                                    </tr>
                                </tbody>
                                <input type="hidden" name="action" value="doMultiUpload" />
                                <input type="hidden" name="id" value="<?php echo $blognews['id']; ?>" />
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('layout_data/js/jquery-ui.js'); ?>"></script>

<script>
    $("ul#images").sortable({
        revert: true,
    });

    $(document).ready(function() {
        $('#upload-form').ajaxForm({
            dataType: 'json',
            beforeSend: function() {
                $('.upload_percent').css({'border': '1px', 'width': '100%'});
            },
            uploadProgress: function(event, position, total, percentComplete) {
                console.log(percentComplete);
                $('.upload_percent').text('Բեռնվում է ... ' + percentComplete + '%');
                $('.upload_percent').css({'background-image': 'linear-gradient(90deg, #54b4eb ' + percentComplete + '%, #ccc 40%)'});
                if (percentComplete == 100) {
                    $('.upload_percent').text(percentComplete + '%');
                }
            },
            success: function(data) {
                setTimeout(function() {
                    $('.upload_percent').css({'border': '0px', 'background': 'none'});
                    $('.upload_percent').text('');
                }, 3000);
                console.log(data);
                for (var key in data) {
                    img = '<img id="img' + data[key]['id'] + '" class="img-blognews img-thumbnail" src="<?php echo $this->config->item('frontend_url'); ?>' + 'images/blognews/' + data[key]['blognews_id'] + '/' + data[key]['image'] + '" />'
                    img_delete = '<img class="img-delete" src="<?php echo base_url('img/delete.png'); ?>" alt=' + data[key]['id'] + ' title="<?php echo $this->lang->line('Delete image'); ?>" />'
                    $('ul#images').append('<li id="' + data[key]['id'] + '">' + img + img_delete + '</li>');
                    console.log(data[key]['image']);
                }
                orderImages();
            }
        });

        $('#image-input').bind("change", function(e) {
            var file_ = $(this).val();
            var ext = file_.split(/[\s\.]+/).pop();
            ext = ext.toLowerCase();

            var allowed_files = ["jpg", "jpeg", "png"];
            var allow = allowed_files.indexOf(ext);
            if(allow !== -1) {
                $('#upload-form').submit();
            }
            $(this).val('');
            //  readURL(this);
        });

        $(document).on('click', '.img-delete', function() {
            var id = $(this).attr('alt');
            var blognews_id = $('#blognews_id').val();

            $.msgBox({
                title: '<?php echo $this->lang->line('Delete'); ?>',
                content: '<?php echo $this->lang->line('Are you sure you want to delete image?'); ?>',
                type: "error",
                buttons: [
                    {value: '<?php echo $this->lang->line('Yes'); ?>'},
                    {value: '<?php echo $this->lang->line('No'); ?>'}
                ],
                success: function(result) {
                    console.log(result)
                    if (result == '<?php echo $this->lang->line('Yes'); ?>') {
                        $.ajax({
                            url: base_url + "ajax",
                            dataType: 'json',
                            type: 'post',
                            data: {
                                'action': 'delete_blognews_image',
                                'id': id,
                                'blognews_id': blognews_id,
                            },
                            success: function(data) {
                                if (data.success == true) {
                                    $('li#' + id).fadeOut(1000, function() {
                                        $(this).remove();
                                    });

                                    orderImages();
                                }
                            }
                        });
                    }
                    else if (result == '<?php echo $this->lang->line('No'); ?>') {

                    }
                }
            });
        });

        $('#order').click(function() {
            orderImages();
        });

        function orderImages() {
            var blognews_id = $('#blognews_id').val();
            var images = [];

            $('ul#images li').each(function() {
                var li_id = $(this).attr('id');
                var li_index = $(this).index();

                images.push({'id': li_id, 'order': li_index});
            });

            //  console.log(images);
            var $_this = $('#next_opt');
            $.ajax({
                url: base_url + "ajax",
                dataType: 'json',
                type: 'post',
                beforeSend: function() {
                    $_this.hide();
                    $_this.after($("<img/>").attr({
                        src: base_url + "img/edit_spinner.gif",
                        height: "50px",
                        width: "50px",
                        id: "spinner"
                    }).css({"visibility": "visible", "positon": "absolute"}));
                },
                data: {
                    'action': 'order_blognews_images',
                    'blognews_id': blognews_id,
                    'images': images,
                },
                success: function(data) {
                    $("#spinner").remove();
                    $_this.show();
                    if (data.success == true) {
                        console.log("order_success");

                    }
                }
            });
        }


        function readURL(input) {
            if (input.files && input.files[0]) {
                for (var key in input.files) {
                    console.log(input.files)
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var img = $('<img/>').attr('src', e.target.result).width(100);
                        $('#images-box').html(img);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        }

    });

</script>