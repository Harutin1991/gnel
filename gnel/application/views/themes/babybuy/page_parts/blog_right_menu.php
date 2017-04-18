 <div id="column-right">
    <div class="box">
      <div class="box-heading"><?php echo $this->lang->line('Categories'); ?></div>
      <div class="box-content">
        <ul>
            <?php $language = $default_language == $this->config->item('language') ? '' : $this->config->item('language').'/'; ?>
		<?php if(!empty($blog_ccategories)) { ?>
			<?php foreach($blog_ccategories as $category){ ?>
				<li><a href="<?php echo   base_url().$language.'blog/category/'.$category->id.'?page=1'; ?>" class="blog_filter " <?php echo isset($old_id) && $category->id == $old_id ? 'style="cursor: default; color: #000000;"' : ''; ?> id="<?php echo $category->id; ?>"><?php echo $category->title ?></a></li>
			<?php } ?>
		<?php } ?>
        </ul>
      </div>
    </div>

    <div class="box">
      <div>
        <h1 class="title_module"><span><?php echo $this->lang->line('Popular'); ?></span></h1>
        <div class="box-content popular">
            <?php if(!empty($popular)) { ?>
                <?php foreach($popular as $news){ ?>
                  <div class="box-product"> <a class="image" href="<?php echo blognews_url($news->id, $news->title); ?>" title="View more"> <img src="<?php echo base_url().'images/blognews/'.$news->image; ?>" alt=""> </a>
                    <h3 class="name"><a href="<?php echo blognews_url($news->id, $news->title); ?>" title=""><?php echo $news->title; ?></a></h3>
                    <p class="wrap_price"> <span><?php echo date('d-m-Y', strtotime($news->date_created))  ?></span> </p>
                    <div class="viewed_block">
                      <img class="view_icon" src="<?php echo base_url().'images/icons/view-icon.png' ?>"  >
                      <span  ><?php echo $news->total_viewed; ?></span>
                    </div>
                  </div>
                <?php } ?>
            <?php  } ?>

        </div>
      </div>
    </div>
     <div class="box">
         <div class="box-heading"><?php echo $this->lang->line('Archive'); ?></div>
         <div class="box-content archive">
             <ul>
                 <?php if(!empty($archives)) { ?>
                     <?php foreach($archives as $archive) { ?>
                         <li> <a href="<?php echo base_url().$language.'blog/archive/'.date('Y-m-d', strtotime($archive->date_created)).'?page=1'; ?>" class="blog_filter" <?php echo isset($old_id) && date('m', strtotime($archive->date_created)) == $old_id ? 'style="cursor: default; color: #000000;"' : ''; ?> date="<?php echo $archive->date_created; ?>" ><?php echo  $this->lang->line(date('F', strtotime($archive->date_created))); ?> <span> ( <?php echo $archive->count_b; ?> )</span> </a> </li>
                     <?php  } ?>
                 <?php  } ?>
             </ul>
         </div>
     </div>
     <?php if(isset($news_this_categoreis)) { ?>
         <div class="box">
             <div>
                 <h1 class="title_module"><span><?php echo $this->lang->line('Popular'); ?></span></h1>
                 <div class="box-content popular">
                     <?php if(!empty($news_this_categoreis)) { ?>
                         <?php foreach($news_this_categoreis as $news){ ?>
                             <div class="box-product"> <a class="image" href="<?php echo blognews_url($news->id, $news->title); ?>" title="View more"> <img src="<?php echo base_url().'images/blognews/'.$news->image; ?>" alt=""> </a>
                                 <h3 class="name"><a href="<?php echo blognews_url($news->id, $news->title); ?>" title=""><?php echo $news->title; ?></a></h3>
                                 <p class="wrap_price"> <span><?php echo date('d-m-Y', strtotime($news->date_created))  ?></span> </p>
                                 <div class="viewed_block">
                                   <img class="view_icon" src="<?php echo base_url().'images/icons/view-icon.png' ?>"  >
                                   <span  ><?php echo $news->total_viewed; ?></span>
                                 </div>
                             </div>
                         <?php } ?>
                     <?php  } ?>

                 </div>
             </div>
         </div>
     <?php } ?>
    <div class="clear"></div>
  </div>
