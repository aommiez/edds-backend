<?php $this->import("/layout/header"); ?>

            <div class="innerLR spacing-x2">
                <h3 class="">Playlist</h3>
                <?php
                $id = $params["id"];
                $table = "playlist_media";
                $table_media = "media";

                $db = \Main\DB\Medoo\MedooFactory::getInstance();
                $items = $db->select($table, [
                    "[>]media"=> ["media_id"=> "media_id"]
                ], '*', ["playlist_id"=> $id, "ORDER"=> "sort_number"]);
                

                // items all


                $join = array(
                    "[>]media"=> array("media_id"=> "media_id")
                );
                $prefixdir = 'public/media/';

                $items = $db->select($table, $join, '*', ["playlist_id"=> $id, "ORDER"=> "sort_number"]);
                foreach($items as $key=> $item){
                    $items[$key]['media_url'] = \Main\Helper\URL::absolute("/").$prefixdir.$item['media_path'];
                }

                $items_media = $db->select($table_media, '*');
                foreach($items_media as $key=> $item){
                    $items_media[$key]['media_url'] = \Main\Helper\URL::absolute("/").$prefixdir.$item['media_path'];
                }

                ?>
                <div class="widget">
                    <div class="widget-head">
                        <h4 class="heading">Add item to playlist</h4>
                    </div>
                    <div class="widget-body innerAll inner-2x">
                        <form method="post" enctype="multipart/form-data" action="<?php echo \Main\Helper\URL::absolute("/playlist/{$id}/item/add");?>">
                            <div class="form-group">
                                <label>Add media</label>
                                <select id="select-media" name="media_id" required=""></select> <a id="media-example" href="">display</a>
                            </div>
                            <button type="submit">submit</button>
                        </form>
                    </div>
                    <script>
                        $(function(){
                            var medias_json = <?php echo json_encode($items_media);?>;
                            var i = 0;
                            var select = $('#select-media');
                            var medias = [];
                            for(i = 0; i < medias_json.length; i++){
                                (function(){
                                    var item = medias_json[i];
                                    var el = $('<option value="'+item.media_id+'">'+item.media_name+'</option>');
                                    medias.push(item);
                                    select.append(el);
                                }());
                            }

                            var mediaExample = $('#media-example');
                            select.change(function(){
                                var media_id = $(this).val();
                                var item = (function(){
                                    for(var i in medias){
                                        if(medias[i].media_id == media_id) return medias[i];
                                    }
                                }());

                                mediaExample.attr('href', item.media_url);
                                var ext = item.media_url.split(".").pop();
                                if(ext == "mp4"){
                                    mediaExample.attr('rel', "prettyPhoto[iframes]");
                                    mediaExample.attr('href', mediaExample.attr('href') + '?iframe=true&width=100%&height=100%');
                                }
                                else {
                                    mediaExample.attr('rel', "prettyPhoto[pp_gal]");
                                }
                                mediaExample.prettyPhoto({
                                    custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>'
                                });
                                mediaExample.show();
                            });
                            select.change();
                        });
                    </script>
                </div>

                <!-- Widget ---- -->

                <div class="widget">
                    <!-- Widget heading -->
                    <div class="widget-head">
                        <h4 class="heading">Media in playlist</h4>
                    </div>
                    <!-- // Widget heading END -->
                    <div class="widget-body innerAll inner-2x">
                        <!-- Table -->
                        <table class="table table-bordered table-primary">
                            <!-- Table heading -->
                            <thead>
                            <tr>
                                <th class="center"></th>
                                <th>Media Name</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <!-- // Table heading END -->
                            <!-- Table body -->
                            <tbody id="sortable-items">
                            <?php foreach($items as $key=> $item){?>
                            <tr item-id="<?php echo $item["id"];?>">
                                <td class="center"><i class="glyphicon glyphicon-align-justify drag-handle"></i></td>
                                <td><a href="#"><?php echo $item["media_name"];?></a></td>
                                <?php
                                $ext = array_pop(explode(".", $item["media_path"]));
                                if(in_array($ext, array("mp4"))){
                                ?>
                                    <td><a class="prettyP" href="<?php echo $item["media_url"];?>?iframe=true&width=100%&height=100%" rel="prettyPhoto[iframes]">display</a></td>
                                <?php }else{?>
                                    <td><a class="prettyP" href="<?php echo $item["media_url"];?>" rel="prettyPhoto[pp_gal]">display</a></td>
                                <?php }?>
                                <td><a class="delete-btn" href="<?php echo \Main\Helper\URL::absolute("/playlist/{$item["playlist_id"]}/item/delete/").$item["id"];?>">delete</a></td>
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
    .drag-handle {
        cursor: pointer;
    }
</style>

<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/gallery/prettyphoto/assets/lib/css/prettyPhoto.css">
<script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/gallery/prettyphoto/assets/lib/js/jquery.prettyPhoto.js"></script>
<script>
    $("a[rel^='prettyPhoto']").prettyPhoto({
        custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
        social_tools: false
    });
</script>

<script src="<?php echo \Main\Helper\URL::absolute("/");?>bower_components/Sortable/Sortable.min.js"></script>
    <script>
        $(function(){
            $('.delete-btn').click(function(e){
                if(!window.confirm("Are you shure?")){
                    e.preventDefault();
                    return false;
                }
            });

            var el = document.getElementById('sortable-items');
            var sortable = Sortable.create(el, {
                handle: ".drag-handle",
                animation: 200,
                onUpdate: function (/**Event*/evt) {
                    console.log(evt);
                    var rows = $('#sortable-items tr');
                    var id = [];
                    rows.each(function(index, el){
                        id.push($(el).attr("item-id"));
                    });
                    var send = {sort_id: id, playlist_id: <?php echo $id;?>};
                    $.post("<?php echo \Main\Helper\URL::absolute("/playlist/{$id}/item/sort");?>", send, function(data){

                        // bla bla bla

                    }, "json");
                }
            });
        });
    </script>
<?php $this->import("/layout/footer"); ?>