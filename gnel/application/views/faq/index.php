
<div id="faq">
    <div class="container-fluid">
        <div class="row row-max">
            <h1 class="text-center">Հաճախ տրվող հարցեր</h1>
            <div id="accordion">
                <?php if(!empty($faqs)) { ?>
                    <?php foreach($faqs as $item) { ?>

                        <h3><?php echo $this->lang->line('question'); ?>: <?php echo $item['question']; ?></h3>
                        <div>
                            <p><?php echo $this->lang->line('answer'); ?>:</p>
                            <p><?php echo $item['answer']; ?></p>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<script>
    $( function() {
        var icons = {
            header: "ui-icon-circle-arrow-e",
            activeHeader: "ui-icon-circle-arrow-s"
        };
        $( "#accordion" ).accordion({
            collapsible: true,
            icons: icons
        });

    } );
</script>