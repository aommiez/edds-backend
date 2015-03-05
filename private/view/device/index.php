<?php $this->import("/layout/header"); ?>
            <div class="innerLR spacing-x2">
                <h3 class="">Device</h3>
                <?php
                $table = "device";
                $table_playlist = "playlist";

                $db = \Main\DB\Medoo\MedooFactory::getInstance();
                $playlists = $db->select($table_playlist, '*');

                $db = \Main\DB\Medoo\MedooFactory::getInstance();
                $items = $db->select($table, '*');
                ?>
                <div class="widget">
                    <!-- Widget heading -->
                    <!--                    <div class="widget-head">-->
                    <!--                        <h4 class="heading">add: <a href="--><!--"><i class="icon-document-add" style="font-size: 20px;"></i></a></h4>-->
                    <!--                    </div>-->
                    <!-- // Widget heading END -->
                    <div class="widget-body innerAll inner-2x">
                        <!-- Table -->
                        <table class="table table-bordered table-primary">
                            <!-- Table heading -->
                            <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th>Device Name</th>
                                <th>Playlist</th>
                                <th>Status</th>
                                <th>Repair</th>
                            </tr>
                            </thead>
                            <!-- // Table heading END -->
                            <!-- Table body -->
                            <tbody>
                            <?php foreach($items as $key=> $item){ if($item["approve_status"] != 1) continue; ?>
                                <tr>
                                    <td class="center"><?php echo $item["device_id"];?></td>
                                    <td><?php echo $item["device_name"];?></td>
                                    <td>
                                        <select class="select-playlist" device-id="<?php echo $item["device_id"];?>" start-playlist-id="<?php echo $item["playlist_id"];?>"></select>
                                    </td>
                                    <td>
                                        <div class="device-status" device-id="<?php echo $item["device_id"];?>"></div>
                                    </td>
                                    <td><a href="#modal-login" data-toggle="modal" class="open-form-repair" device-id="<?php echo $item["device_id"];?>"><i class="icon-wrench-fill"></i></a></td>
                                </tr>
                            <?php }?>
                            </tbody>
                            <!-- // Table body END -->
                        </table>
                        <!-- // Table END -->
                    </div>
                </div>

                <hr>

                <h3 class="">Device not approve</h3>
                <?php
                $table = "device";
                $table_playlist = "playlist";

                $db = \Main\DB\Medoo\MedooFactory::getInstance();
                $playlists = $db->select($table_playlist, '*');

                $db = \Main\DB\Medoo\MedooFactory::getInstance();
                $items = $db->select($table, '*');
                ?>
                <div class="widget">
                    <!-- Widget heading -->
                    <!--                    <div class="widget-head">-->
                    <!--                        <h4 class="heading">add: <a href="--><!--"><i class="icon-document-add" style="font-size: 20px;"></i></a></h4>-->
                    <!--                    </div>-->
                    <!-- // Widget heading END -->
                    <div class="widget-body innerAll inner-2x">
                        <!-- Table -->
                        <table class="table table-bordered table-primary no-approve-table">
                            <!-- Table heading -->
                            <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th>Device Name</th>
                                <th>Approve</th>
                            </tr>
                            </thead>
                            <!-- // Table heading END -->
                            <!-- Table body -->
                            <tbody>
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
    .device-status {
        width: 20px;
        height: 20px;
        border-radius: 10px;
        background: rgb(255, 124, 124);
    }
    .device-status.active {
        background: rgb(135, 255, 141);
    }
</style>

<!-- Modal -->
<div class="modal fade" id="modal-login">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal heading -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Repair</h3>
            </div>
            <!-- // Modal heading END -->
            <!-- Modal body -->
            <div class="modal-body">
                <div class="innerAll">
                    <div class="innerLR">
                        <form class="form-horizontal form-repair" role="form">
                            <input type="hidden" name="device_id" id="repair_device_id">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="form-description" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- // Modal body END -->
        </div>
    </div>
</div>
<!-- // Modal END -->

<script src="<?php echo \Main\Helper\URL::absolute("/public");?>/assets/components/modules/admin/notifications/notyfy/assets/lib/js/jquery.notyfy.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public");?>/assets/components/modules/admin/notifications/notyfy/assets/custom/js/notyfy.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>


<script>
$(function(){
    $('.edit-btn, .delete-btn').removeClass("hidden");

    $('.delete-btn').click(function(e){
        if(!window.confirm("Are you shure?")){
            e.preventDefault();
            return false;
        }
    });

    function fetchColor(){
        $.get("<?php echo \Main\Helper\URL::absolute("/api/device");?>", function(data){
            var query = "";
            for(var i = 0; i < data.length; i++){
                query = '.device-status'+"[device-id='"+data[i].device_id+"']";
                if(data[i].active){
                    $(query).addClass("active");
                }
                else {
                    $(query).removeClass("active");
                }
            }
            setTimeout(fetchColor, 1000);
        }, "json");
    }

    fetchColor();

    var inputDeviceId = $('#repair_device_id');
    $('.open-form-repair').click(function(e){
        var id = $(this).attr("device-id");
        inputDeviceId.val(id);
    });

    $('.form-repair').submit(function(e){
        e.preventDefault();
        $('.close').click();

        var id = inputDeviceId.val();
        var a = $('.open-form-repair[device-id="'+id+'"]');
        a.after("<span>Repair send</span>");
        a.remove();
        $('#form-description').val("");
    });
});
</script>
<script>
    $(function(){
        var playlists = <?php echo json_encode($playlists);?>;
        var $selectInputs = $('.select-playlist');
        $selectInputs.each(function(index, el){
            makeEvent(el);
        });

        function makeEvent(el){
            var $el = $(el);
            var deviceId = $el.attr('device-id');

            for(var i =0; i< playlists.length; i++){
                $el.append('<option value="'+playlists[i].playlist_id+'">'+playlists[i].playlist_name+'</option>');
            }

            var start_id = $el.attr('start-playlist-id');
            var device_id = $el.attr('device-id');
            $el.val(start_id);

            $el.change(function(e){
                // form submit
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: "<?php echo \Main\Helper\URL::absolute("/device/change_playlist");?>",
                    data: {playlist_id: $el.val(), device_id: device_id},
//                    contentType: false,
                    success: function(data){
                        if(data.error == undefined){
                            notyfy({
                                text: 'Success',
                                type: 'success',
                                dismissQueue: true,
                                timeout: 3000
                            });
//                            setTimeout(function(){ window.location.reload(); }, 1000);
                        }
                        else {
                            notyfy({
                                text: data.error.message,
                                type: 'error',
                                dismissQueue: true,
                                timeout: 3000
                            });
                            $el.prop("disabled", false);
                        }
                    },
                    error: function(){
                        notyfy({
                            text: 'No success',
                            type: 'error',
                            dismissQueue: true,
                            timeout: 3000
                        });
                        $el.prop("disabled", false);
                    },
                    dataType: 'json'
//                    processData: false
                });

                return false;
            });
        }
    });
</script>
<script>
    $(function(){
        var $table = $('.no-approve-table');
        var $tbody = $('tbody', $table);

        var sendVar = {last_id: 0};

        function fetchListApprove(){
            $.ajax({
                type: "get",
                url: "<?php echo \Main\Helper\URL::absolute("/device/no_approve");?>",
                data: sendVar,
                success: function(data){
                    $(data).each(function(index, item){
                        var $tr = $('<tr></tr>');
                        $tr.append('<td class="center">'+item.device_id+'</td>');
                        $tr.append('<td>'+item.device_name+'</td>');
                        $tr.append('<td><a class="approve-btn" href="'+item.device_id+'">approve</a></td>');

                        $tbody.append($tr);
                        if(item.device_id > sendVar.last_id)
                            sendVar.last_id = item.device_id;

                        $('.approve-btn', $tr).click(function(e){
                            e.preventDefault();
                            $.post('<?php echo \Main\Helper\URL::absolute("/device/approve_device");?>', {device_id: item.device_id}, function(data){
                                if(data.error == undefined){
                                    notyfy({
                                        text: 'Success',
                                        type: 'success',
                                        dismissQueue: true,
                                        timeout: 3000
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
                                }
                            }, 'json').fail(function(){
                                notyfy({
                                    text: 'No success',
                                    type: 'error',
                                    dismissQueue: true,
                                    timeout: 3000
                                });
                            });
                            return false;
                        });
                    });
                },
                dataType: "json"
            });
        }
        fetchListApprove();
        setInterval(fetchListApprove, 5000);
    });
</script>
<?php $this->import("/layout/footer"); ?>