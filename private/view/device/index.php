<?php $this->import("/layout/header"); ?>
            <div class="innerLR spacing-x2">
                <h3 class="">Device</h3>
                <?php
                $table = "device";

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
                                <th>Status</th>
                                <th>Repair</th>
                            </tr>
                            </thead>
                            <!-- // Table heading END -->
                            <!-- Table body -->
                            <tbody>
                            <?php foreach($items as $key=> $item){?>
                            <tr>
                                <td class="center"><?php echo $item["device_id"];?></td>
                                <td><?php echo $item["device_name"];?></td>
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
<?php $this->import("/layout/footer"); ?>