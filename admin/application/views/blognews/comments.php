<pre>
    <?php
    $isSuperAdmin = ($this->admin_id == $this->config->item('super_global_admin_id'));

    //    echo $default_language;
    //    echo "<hr/>";
    //    print_r($product);
    //    echo "<hr/>";
    //    print_r($product_comments);
    //    exit;
    ?>
    <div >
        <table>
            <tr>
                <?php $img_url = blogImg($blognews['id'], $blognews['image']); ?>
                <td><img src="<?php echo thumbImg($img_url, 200, 200, 100); ?>"/></td>
                <td>
                    <p><a href="<?php echo blognews_url($blognews['id'], $blognews['title_' . $default_language]); ?>" target="_blank"><?php echo $blognews['title_' . $default_language]; ?></a></p>
                    <p><?php echo  $blognews['short_content_' . $default_language]; ?></p>
<!--                    <p>--><?php //echo $this->lang->line('Price') . " : " . $blognews['price']; ?><!--</p>-->
                </td>
            </tr>
        </table>
    </div>
</pre>
<div class="row comments-wrapper" >
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> <?php echo $this->lang->line('Comments'); ?></h2>
                <div class="box-icon">
                    <!--<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>-->
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="alert alert-info">List of all comments</div>
                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead>
                    <tr class="center">
                        <th><?php echo $this->lang->line('User'); ?></th>
                        <th width="50%"><?php echo $this->lang->line('Comment'); ?></th>
                        <th><?php echo $this->lang->line('Date'); ?></th>
                        <th><?php echo $this->lang->line('Status'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($blognews_comments['comments'])) { ?>
                        <?php foreach ($blognews_comments['comments'] AS $comment) { ?>
                            <?php $date = date_create($comment->comment_date); ?>
                            <tr>
                                <?php $img_url = userImg($comment->user_id, $comment->user_image); ?>
                                <td>
                                    <img src="<?php echo thumbImg($img_url, 50, 50, 100); ?>"/><br>
                                    <?php echo $comment->first_name . " " . $comment->last_name; ?>
                                </td>
                                <td class="simple-comment" com-id="<?php echo $comment->id; ?>">
                                    <span><?php echo $comment->comment; ?></span>
                                    <p class="comment-date"><?php echo date_format($date, 'd-m-Y  H:i:s'); ?></p>
                                </td>
                                <td class="center"><?php echo date_format($date, 'd/m/Y'); ?></td>
                                <td class="center" style="vertical-align: middle;">
                                    <?php if ($comment->status == "1") { ?>
                                        <span class="label-default label label-success" action="disable" id="<?php echo $comment->id; ?>" status="change" title="<?php echo $this->lang->line('Press to ban'); ?>" style="cursor: pointer;"><?php echo $this->lang->line('Active'); ?></span>
                                    <?php } else { ?>
                                        <span class="label-default label label-warning "  action="enable" id="<?php echo $comment->id; ?>" status="change" title="<?php echo $this->lang->line('Press to activate'); ?>" style="cursor: pointer;"><?php echo $this->lang->line('Pending'); ?></span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php if ($isSuperAdmin) { ?>
    <script  type="text/javascript">

        $(document).ready(function() {
            $(document).on('click', 'span[status="change"]', function() {
                var $_this = $(this);
                var action = $(this).attr('action');
                var table = 'blognews_comments';
                var id = $(this).attr('id');
                $.ajax({
                    url: base_url + "ajax",
                    dataType: 'json',
                    type: 'post',
                    beforeSend: function() {
                        $_this.hide();
                        $_this.after($("<img/>").attr({
                            src: base_url + "img/edit_spinner.gif",
                            height: "21px",
                            width: "21px",
                            id: "spinner"
                        }).css("visibility", "visible"));
                    },
                    data: {'action': action, 'table': table, 'id': id, },
                    success: function(data) {
                        $("#spinner").remove();
                        $_this.show();
                        if (action == 'enable') {
                            $_this.removeClass('label-warning');
                            $_this.addClass('label-success');
                            $_this.attr("action", "disable");
                            $_this.text('<?php echo $this->lang->line('Active'); ?>');
                        } else {
                            $_this.removeClass('label-success');
                            $_this.addClass('label-warning');
                            $_this.attr("action", "enable");
                            $_this.text('<?php echo $this->lang->line('Pending'); ?>');
                        }
                        //location.reload();
                    }
                });
            });

            $('.simple-comment').hover(function() {
                if ($(this).find('textarea').length == '0') {
                    var comment_td = $(this);
                    var button = $("<img/>").attr({
                        'type': 'button',
                        'name': 'edit_comment',
                        'comment-id': comment_td.attr('com-id'),
                        'src': '<?php echo base_url('img/edit-icon2.png'); ?>'
                    });
                    comment_td.append(button);
                }
            }, function() {
                $("img[comment-id=" + $(this).attr('com-id') + "]").remove();
            });
            var current_text;
            $(document).on('click', '.simple-comment img', function() {
                var parent = $(this).parent('.simple-comment');
                var comment_id = $(this).attr('comment-id')
                var input = $("<textarea/>").attr({
                    'class': 'form-control',
                    'name': 'edit_comment_text_area',
                    'comment-id': comment_id
                });

                var text = parent.find('span').text()
                input.val(text);
                current_text = text;
                parent.find('span').empty().append(input);
                var new_input = parent.find('textarea');
                new_input.focus();
                parent.find('img').remove();
            });

            $(document).on('blur', 'textarea[name=edit_comment_text_area]', function() {
                var parent = $(this).parent();
                var $_this = $(this);
                var table_name = 'blognews_comments';
                var text = $(this).val();
                var comment_id = $(this).attr('comment-id');
                if (current_text != text) {
                    $.ajax({
                        url: base_url + "ajax",
                        dataType: 'json',
                        type: 'post',
                        beforeSend: function() {
                            parent.empty();
                            $_this.after($("<img/>").attr({
                                src: base_url + "img/edit_spinner.gif",
                                height: "21px",
                                width: "21px",
                                id: "spinner"
                            }).css("visibility", "visible"));
                        },
                        data: {'action': 'update_comment', 'table_name': table_name, 'text': text, 'id': comment_id, },
                        success: function(data) {
                            console.log(data);
                            $("#spinner").remove();
                            if (data.success) {
                                current_text = text;
                            }
                        }
                    });
                }
                parent.text(text);
            });


        });
    </script>
<?php } ?>