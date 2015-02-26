<?php $this->import("/layout/header"); ?>

            <div class="innerLR spacing-x2">
                <h3 class="">Playlist</h3>
                <?php
                $table = "playlist";

                $db = \Main\DB\Medoo\MedooFactory::getInstance();
                $items = $db->select($table, '*');
                ?>
                <div class="widget">
                    <!-- Widget heading -->
                    <div class="widget-head">
                        <h4 class="heading">Create Playlist : <a href="<?php echo \Main\Helper\URL::absolute("/playlist/add");?>"><i class="icon-document-add" style="font-size: 20px;"></i></a></h4>
                    </div>
                    <!-- // Widget heading END -->
                    <div class="widget-body innerAll inner-2x">
                        <!-- Table -->
                        <table class="table table-bordered table-primary">
                            <!-- Table heading -->
                            <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th>Device Name</th>
                                <th></th>
                            </tr>
                            </thead>
                            <!-- // Table heading END -->
                            <!-- Table body -->
                            <tbody>
                            <?php foreach($items as $key=> $item){?>
                            <tr>
                                <td class="center"><?php echo $item["playlist_id"];?></td>
                                <td><a href="<?php echo \Main\Helper\URL::absolute("/playlist/").$item["playlist_id"]."/item";?>"><?php echo $item["playlist_name"];?></a></td>
                                <td><a class="delete-btn" href="<?php echo \Main\Helper\URL::absolute("/playlist/delete/").$item["playlist_id"];?>">delete</a></td>
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
$('.delete-btn').click(function(e){
    if(!window.confirm("Are you shure?")){
        e.preventDefault();
        return false;
    }
});
</script>

<?php $this->import("/layout/footer"); ?>