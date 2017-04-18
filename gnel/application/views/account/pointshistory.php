<div id="content">
    <?php
        $data["comment"] = 0;
        $data['rate'] = 0;
        $data['order'] = 0;
        if(!empty($points)){
            foreach($points as $item){
                $data[$item->name] = $item->points;
            }
        }
    //echo '<pre>';var_dump($data);exit;
    ?>
    <div class="breadcrumb"> <a href="<?php echo site_url(); ?>"><?php echo $this->lang->line('Home'); ?></a> » <a href="<?php echo site_url('account/'); ?>"><?php echo $this->lang->line('Account'); ?></a> » <?php echo $this->lang->line('Points History'); ?> </div>
    <h1><span class="h1-top"><?php echo $this->lang->line('Points History'); ?></span></h1>
    <div class="information_content">
        <table>
            <tbody>
            <tr>
                <td>
                    <?php echo $this->lang->line('Points of comments'); ?>
                </td>
                <td>
                    <?php echo $data["comment"].' '.$this->lang->line('AMD').'  ('. $this->lang->line('Points') .')'; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $this->lang->line('Points of votes'); ?>
                </td>
                <td>
                    <?php echo $data["rate"].' '.$this->lang->line('AMD').'  ('. $this->lang->line('Points') .')'; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $this->lang->line('Total:'); ?>
                </td>
                <td>
                    <?php echo ($data["comment"] + $data["rate"]) .' '.$this->lang->line('AMD').'  ('. $this->lang->line('Points') .')'; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $this->lang->line('Spent:'); ?>
                </td>
                <td>
                    <?php echo abs($data["order"]) .' '.$this->lang->line('AMD').'  ('. $this->lang->line('Points') .')'; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $this->lang->line('Stayed:'); ?>
                </td>
                <td>
                    <?php echo ($data["comment"] + $data["rate"] + $data["order"]) .' '.$this->lang->line('AMD').'  ('. $this->lang->line('Points') .')'; ?>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="buttons">
            <div class="right"><a href="<?php echo site_url('account'); ?>" class="button"><?php echo $this->lang->line('Continue'); ?></a></div>
        </div>
    </div>
</div>
