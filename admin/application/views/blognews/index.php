<h3><?php echo $this->lang->line('Blognews'); ?></h3>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2>
                    <i class="glyphicon glyphicon-list-alt"></i> 
                    <?php echo $this->lang->line('Blognews'); ?>
                </h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <?php
            ?>
            <input type="text" class="search form-control" value="<?php //echo $pr_string; ?>" id="pr_string"/>
            <select class="per_page form-control" id="pr_perpage">
                <option <?php //echo $pr_perpage == 15 ? 'selected="selected"' : ''; ?> value="1">1</option>
                <option <?php //echo $pr_perpage == 30 ? 'selected="selected"' : ''; ?> value="30">30</option>
                <option <?php //echo $pr_perpage == 60 ? 'selected="selected"' : ''; ?> value="60">60</option>
            </select>
            <img style="position:absolute;left:30%;top:70px;display:none;" class="ajax_loader" src="img/ajax_loader.gif" />
            <div id="data_table">
				<?php $this->load->view('blognews/datatable.php'); ?>	
            </div>  


        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
		
		var last_pr_string = $("#pr_string").val();
        last_pr_string = last_pr_string.trim();
        $("#pr_string").keyup(function() {
            var pr_string = $(this).val();
            pr_string = pr_string.trim();
            if (pr_string != last_pr_string) {
                $.cookie('bn_string', pr_string, {expires: 1, path: '/'});
                last_pr_string = pr_string;
                ajax_filter(1);
            }
        });
		$("#pr_perpage").change(function() {
            $.cookie('bn_perpage', $(this).val(), {expires: 1, path: '/'});
            ajax_filter(1);
        });
		$(document).on("click", ".pagination a", function() {
            var new_page = parseInt($(this).text());
            var page_number = parseInt($('.pagination li.disabled a').text());

            if ($(this).attr('first-page') !== undefined) {
                var new_page = 1;
            } else if ($(this).attr('last-page') !== undefined) {
                var new_page = parseInt($(this).attr('last-page'));
            } else if ($(this).attr('first') !== undefined) {
                var new_page = page_number > 1 ? page_number - 1 : 1;
              
            } else if ($(this).attr('last') !== undefined) {
                var last_page = parseInt($(this).attr('last'));
                var new_page = page_number == last_page ? page_number : page_number + 1;
            } else {
                var new_page = parseInt($(this).text());
            }
            if (new_page != page_number) {
                ajax_filter(new_page);
            }
            return false;
        });
	
		function ajax_filter(pr_pagenum) {
            var pr_string = $('#pr_string').val();
            var pr_perpage = $('#pr_perpage').val();
            $('.ajax_loader').show();
            $.ajax({
                url: base_url + "ajax",
                dataType: 'json',
                type: 'post',
                data: {
                    action: 'blognews_filter',
                    pr_string: pr_string,
                    pr_perpage: pr_perpage,
                    pr_pagenum: pr_pagenum
                },
                success: function(data) {
                    //console.log(data);
                    $('#data_table').html(data.html);
                    $('.ajax_loader').hide();
                }
            });
        }

        $(document).on('click', 'a.special', function() {
            var $_this = $(this);
            var news_id = $(this).attr('id');
            var special = $(this).attr('special');

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
                data: {'action': 'update_special_blognews', news_id: news_id , special: special},
                success: function(data) {
                    $("#spinner").remove();
                    $_this.show();
                    if(data.success) {
                        if (special == '0') {
                            $('.special').text(0);
                            $('.special').attr('special','0');
                            $($_this).text(1);
                            $($_this).attr('special','1');
                        } else if(special == '1'){
                            $($_this).text(0);
                            $($_this).attr('special','0');
                        }
                    }
                    //location.reload();
                }
            });
        });
        $( document ).on( "click", 'span[status="change"]', function() {
            var action = $(this).attr('action');
            var table = 'blognews';
            var id = $(this).attr('id');
            $.ajax({
                url: base_url + "ajax",
                dataType: 'json',
                type: 'post',
                data: {'action': action, 'table':table, 'id': id, },
                success: function(data) {
                    //location.reload();
					var html = '';
					var this_parnet = $('#'+id+'').parent();
					this_parnet.html('');
					if (action == 'disable') {
						html += '<span class="label-default label label-danger"  action="enable" id="'+id+'" status="change" title="';
							html += '<?php echo $this->lang->line('Press to activate'); ?>'+'"';
							html += 'style="cursor: pointer;">';
							html +=	'<?php echo $this->lang->line('Banned'); ?>';
						html += '</span>';
						this_parnet.html(html);	
					}else{
						html += '<span class="label-success label label-default"  action="disable" id="'+id+'" status="change" title="';
							html += '<?php echo $this->lang->line('Press to ban'); ?>'+'"';
							html += 'style="cursor: pointer;">';
							html +=	'<?php echo $this->lang->line('Active'); ?>';
						html += '</span>';
						this_parnet.html(html);	
					}
                }
            });
        });
		
    });
</script>
