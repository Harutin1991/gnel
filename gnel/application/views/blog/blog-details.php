<div id="content">
    <div class="breadcrumb"> <a href="<?php echo base_url(); ?>">Home</a> » <a href="<?php echo base_url().'blog/'; ?>">Blog</a> » <span><?php echo $news->title; ?></span></div>
<!--    <h1><span class="h1-top">Things for Cuties - the Blog</span></h1>-->
    <div class="information_content">

        <?php if(!empty($news)) : ?>

            <div class="row row-image">
                <div class="img-container">
                    <div class="image" style="background-image: url(<?php echo base_url().'images/blognews/'.$news->image; ?>)"></div>
                </div>
                <div class="img-container-bg"></div>
                <div class="text-container">
                    <a href="<?php echo base_url().'blog/'; ?>" class="href"><span class="glyphicon glyphicon-arrow-left"></span>Обратно в блог</a>
                    <h1><?php echo $news->title; ?></h1>
<!--                    <p><a href="javascript:void(0)" class="date">16&nbsp;Апрель&nbsp;2017</a><span class="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>1</span></p>-->
                </div>
            </div>

            <div class="row row-max">
                <div class="text">
                    <?php echo $news->content; ?>
                </div>
            </div>



        <?php endif; ?>
    </div>
</div>
<script  type="text/javascript">


    jQuery(document).ready(function() {

        $("#button-review").click(function () {
            var txt = $.trim($('textarea[name=comment]').val());
            if (!txt) {
                $('.notify-empty').text('<?php echo $this->lang->line('Please fill all fields'); ?>');
                return false;
            }

        });

        $(".pagination a").click(function() {
            var new_page = parseInt($(this).text());
            var page_number = parseInt($('.pagination a.active').text());
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
       /* $(document).on("click", ".pagination a", function() {
            var new_page = parseInt($(this).text());
           var page_number = parseInt($('.pagination a.active').text());
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
        });*/


        function ajax_filter(pagenum) {
            var blognews_id = $('.post_item').attr('blognews-id');
            //console.log(blognews_id+','+pagenum);
            $('.ajax_loader').show();
            $.ajax({
                url: site_url + "ajax",
                dataType: 'html',
                type: 'post',
                data: {
                    action: 'blognews_comment_filter',
                    blognews_id: blognews_id,
                    pagenum: pagenum
                },
                success: function(data) {
                    $('#review').html(data);
                    $('.ajax_loader').hide();
                }
            });
        }

    });
</script>