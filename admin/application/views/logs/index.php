ՙ<h3><?php echo $this->lang->line('Logs'); ?></h3>

<table class="table table-striped table-bordered bootstrap-datatable responsive">
    <?php if (count($logs) > 0): ?>
        <thead>
            <tr>
                <th>
                    <?php echo $this->lang->line('User'); ?>
                </th>
                <th>
                    <?php echo $this->lang->line('Action'); ?>
                </th>
                <th>
                    Url
                </th>
                <th>
                    <?php echo $this->lang->line('Time'); ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $item): ?>
                <tr id="td<?php echo $item->id; ?>">
                    <td>
                        <?php echo $item->username; ?>
                    </td>
                    <td>
                        <?php echo $item->action; ?>
                    </td>
                    <td>
                        <?php echo $item->url; ?>
                    </td>
                    <td>
                        <?php echo $item->time; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan = "4" style="text-align: center" >
                    <ul class="pagination">
                        <?php echo $links; ?>
                    </ul>
                </td>
            </tr>
        </tbody>
    <?php else: ?>
        <tr>
            <td>
                <?php echo $this->lang->line('No items to show.'); ?>
            </td>
        </tr>
    <?php endif; ?>
</table>

