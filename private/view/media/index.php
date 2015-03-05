<style>
    #screenshot{
        position:absolute;
        border:1px solid #333;
        display:none;
        color:#fff;
    }

</style>
<?php $this->import("/layout/header"); ?>
            <div class="innerLR spacing-x2">
                <h3 class="">Media Storage</h3>
                <h4><?php  $bytes = disk_free_space(".");
                    $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
                    $base = 1024;
                    $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
                    $ds = disk_total_space("C:");
                    echo getSymbolByQuantity($bytes) . ' Free of '.getSymbolByQuantity($ds);

                    function getSymbolByQuantity($bytes) {
                        $symbols = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
                        $exp = floor(log($bytes)/log(1024));
                        return sprintf('%.2f '.$symbols[$exp], ($bytes/pow(1024, floor($exp))));
                    }

                    ?></h4>
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
                        <form id="add-form">
                            <progress id="upload-progress" value="0" max="100" class="hidden"></progress>
                            <input id="media-input" type="file" name="medias[]" accept="video/mp4, image/jpeg, image/png, image/gif" multiple style="display: none;">
                            <h4 class="heading">Upload File : <a id="click-addfile" href="<?php echo \Main\Helper\URL::absolute("/media/add");?>"><i class="icon-document-add" style="font-size: 20px;"></i></a></h4>
                        </form>
                    </div>
                    <!-- // Widget heading END -->
                    <div class="widget-body innerAll inner-2x">
                        <!-- Table -->
                        <table class="table table-bordered table-primary">
                            <!-- Table heading -->
                            <thead>
                            <tr>
                                <th class="center">File ID.</th>
                                <th>Media Name</th>
                                <th>File Type</th>
                                <th>Del</th>
                            </tr>
                            </thead>
                            <!-- // Table heading END -->
                            <!-- Table body -->
                            <tbody>
                            <?php foreach($items as $key=> $item){?>
                                <tr>
                                    <td class="center"><?php echo $item["media_id"];?></td>
                                    <td><?php
                                        $ext = array_pop(explode(".", $item["media_path"]));
                                        if(in_array($ext, array("mp4"))){
                                            $iconPath = \Main\Helper\URL::absolute("/public/images/movie.png");
                                            echo "<img src=\"{$iconPath}\" style=\"width: 32px;margin-right: 10px;\">";
                                            echo "<a href=\"{$item["media_url"]}?iframe=true&width=100%&height=100%\" rel=\"prettyPhoto[iframes]\">{$item["media_name"]}</a>";
                                        } else if (in_array($ext, array("png","jpg","jpge")))  {
                                            $iconPath = \Main\Helper\URL::absolute("/public/images/images.png");
                                            echo "<img src=\"{$iconPath}\" style=\"width: 32px;margin-right: 10px;\">";
                                            echo "<a href=\"{$item["media_url"]}\"  class=\"screenshot\" rel=\"prettyPhoto[pp_gal]\">{$item["media_name"]}</a>";
                                        } else {
                                            $iconPath = \Main\Helper\URL::absolute("/public/images/unknown.png");
                                            echo "<img src=\"{$iconPath}\" style=\"width: 32px;margin-right: 10px;\">";
                                            echo "<a href=\"#{$item["media_url"]}\" >{$item["media_name"]}</a>";
                                        }?>
                                    </td>
                                    <td><?php
                                        $ext = array_pop(explode(".", $item["media_path"]));
                                        echo $ext;
                                        ?></td>
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
<script src="<?php echo \Main\Helper\URL::absolute("/public");?>/assets/components/modules/admin/notifications/notyfy/assets/lib/js/jquery.notyfy.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public");?>/assets/components/modules/admin/notifications/notyfy/assets/custom/js/notyfy.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>

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
    this.screenshotPreview = function(){

        xOffset = 10;
        yOffset = 30;

        /* END CONFIG */
        $("a.screenshot").hover(function(e){

                this.t = this.title;
                this.title = "";
                var c = (this.t != "") ? "<br/>" + this.t : "";
                $("body").append("<p id='screenshot'><img style='width: 140px;' src='"+ this.href +"' alt='images preview' />"+ c +"</p>");
                $("#screenshot")
                    .css("top",(e.pageY - xOffset) + "px")
                    .css("left",(e.pageX + yOffset) + "px")
                    .fadeIn("fast");
            },
            function(){
                this.title = this.t;
                $("#screenshot").remove();
            });
        $("a.screenshot").mousemove(function(e){
            $("#screenshot")
                .css("top",(e.pageY - xOffset) + "px")
                .css("left",(e.pageX + yOffset) + "px");
        });
    };
    screenshotPreview();
</script>
<script>
    $(function(){
        $('#click-addfile').click(function(e){
            e.preventDefault();
            $('#media-input').click();
            return false;
        });

        $('#media-input').change(function(e){
            if(e.target.files.length > 0)
                $('#add-form').submit();
        });

        // form submit
        $('#add-form').submit(function(e){
            e.preventDefault();
            var fd = new FormData(this);

            var inputs = $(":input", this);
            inputs.prop("disabled", true);

            var $progress = $('#upload-progress');

            $.ajax({
                type: 'POST',
                url: '<?php echo \Main\Helper\URL::absolute("/media/add");?>',
                data: fd,
                contentType: false,
                xhr: function()
                {
                    $progress.removeClass("hidden");

                    var xhr = new window.XMLHttpRequest();
                    //Upload progress
                    xhr.upload.addEventListener("progress", function(evt){
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = percentComplete * 100;
                            $progress.val(percentComplete);
                            //Do something with upload progress
                        }
                    }, false);
                    //Download progress
                    xhr.addEventListener("progress", function(evt){
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = percentComplete * 100;
                            $progress.attr('valut', percentComplete);
                            //Do something with download progress
                        }
                    }, false);
                    return xhr;
                },
                success: function(data){
                    if(data.error == undefined){
                        notyfy({
                            text: 'Success',
                            type: 'success',
                            dismissQueue: true
                        });
                        setTimeout(function(){ window.location.reload(); }, 1000);
                    }
                    else {
                        notyfy({
                            text: data.error.message,
                            type: 'error',
                            dismissQueue: true,
                            timeout: 3000
                        });
                        inputs.prop("disabled", false);
                        $progress.addClass("hidden");
                    }
                },
                error: function(){
                    notyfy({
                        text: 'No success',
                        type: 'error',
                        dismissQueue: true,
                        timeout: 3000
                    });
                    inputs.prop("disabled", false);
                    $progress.addClass("hidden");
                },
                dataType: 'json',
                processData: false
            });

            return false;
        });
    });
</script>
<?php $this->import("/layout/footer"); ?>