<?php $this->import("/layout/header"); ?>
            <div class="innerLR spacing-x2">
                <h3 class="">Media</h3>
                <?php
                $table = "media";
                $prefixdir = 'public/media/';

                $db = \Main\DB\Medoo\MedooFactory::getInstance();
                $items = $db->select($table, '*');
                foreach($items as $key=> $item){
                    $items[$key]['media_url'] = $prefixdir.$item['media_path'];
                }
                ?>
                <div class="widget">
                    <!-- Widget heading -->
                    <div class="widget-head">
                        <h4 class="heading">add: <a href="<?php echo \Main\Helper\URL::absolute("/media/add");?>"><i class="icon-document-add" style="font-size: 20px;"></i></a></h4>
                    </div>
                    <!-- // Widget heading END -->
                    <div class="widget-body innerAll inner-2x">
                        <!-- Table -->
                        <table class="table table-bordered table-primary">
                            <!-- Table heading -->
                            <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th>Media Name</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <!-- // Table heading END -->
                            <!-- Table body -->
                            <tbody>
                            <?php foreach($items as $key=> $item){?>
                                <tr>
                                    <td class="center"><?php echo $item["media_id"];?></td>
                                    <td><?php echo $item["media_name"];?></td>
                                    <?php
                                    $ext = array_pop(explode(".", $item["media_path"]));
                                    if(in_array($ext, array("mp4"))){
                                        //prettyPhoto[pp_gal]
                                    ?>
                                    <td><a href="<?php echo $item["media_url"];?>?iframe=true&width=100%&height=100%" rel="prettyPhoto[iframes]">display</a></td>
                                    <?php }else{?>
                                    <td><a href="<?php echo $item["media_url"];?>" rel="prettyPhoto[pp_gal]">display</a></td>
                                    <?php }?>
                                    <td><a class="delete-btn" href="<?php echo \Main\Helper\URL::absolute("/media/delete/").$item["media_id"];?>">delete</a></td>
                                </tr>
                            <?php }?>
                            </tbody>
                            <!-- // Table body END -->
                        </table>
                        <!-- // Table END -->
                    </div>
                </div>
            </div>
<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/gallery/prettyphoto/assets/lib/css/prettyPhoto.css">
<script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/gallery/prettyphoto/assets/lib/js/jquery.prettyPhoto.js"></script>
<script>
    $(function(){
        $("a[rel^='prettyPhoto']").prettyPhoto({
            custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
            social_tools: false
        });

        $('.delete-btn').click(function(e){
            if(!window.confirm("Are you shure?")){
                e.preventDefault();
                return false;
            }
        });
    });
</script>
<?php $this->import("/layout/footer"); ?>