<?php $this->import("/layout/header"); ?>
            <div class="innerLR spacing-x2">
                <h3 class="">Event</h3>
                <?php
                $table = "event";

                $db = \Main\DB\Medoo\MedooFactory::getInstance();
                $items = $db->select($table, '*');
                ?>
                <div class="widget">
                    <!-- Widget heading -->
                    <div class="widget-head">
                        <h4 class="heading">add: <a href="<?php echo \Main\Helper\URL::absolute("/event/add");?>"><i class="icon-document-add" style="font-size: 20px;"></i></a></h4>
                    </div>
                    <!-- // Widget heading END -->
                    <div class="widget-body innerAll inner-2x">
                        <!-- Table -->
                        <table class="table table-bordered table-primary">
                            <!-- Table heading -->
                            <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th>Name</th>
                                <th></th>
                            </tr>
                            </thead>
                            <!-- // Table heading END -->
                            <!-- Table body -->
                            <tbody>
                            <?php foreach($items as $key=> $item){?>
                            <tr>
                                <td class="center"><?php echo $item["event_id"];?></td>
                                <td><?php echo $item["event_name"];?></td>
                                <td>
                                    <a class="edit-btn hidden" href="<?php echo \Main\Helper\URL::absolute("/event/edit/{$item["event_id"]}");?>"><i class="icon-compose"></i></a>
                                    <a class="delete-btn hidden" href="<?php echo \Main\Helper\URL::absolute("/event/delete/{$item["event_id"]}");?>"><i class="icon-circle-delete" style="color: red;"></i></a>
                                </td>
                            </tr>
                            <?php }?>
                            </tbody>
                            <!-- // Table body END -->
                        </table>
                        <!-- // Table END -->
                    </div>
                </div>
            </div>
<style>
    .thumb {
        height: 150px;
    }
</style>
<script>
$(function(){
    $('.edit-btn, .delete-btn').removeClass("hidden");

    $('.delete-btn').click(function(e){
        if(!window.confirm("Are you shure?")){
            e.preventDefault();
            return false;
        }
    });
});
</script>
<?php $this->import("/layout/footer"); ?>