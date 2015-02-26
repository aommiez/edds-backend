<?php $this->import("/layout/header"); ?>
    <h3>Add news</h3>
    <div class="innerLR">
        <div class="row">
            <div class="col-md-6">
                <div class="widget widget-heading-simple widget-body-white">
                    <!-- Widget heading -->
<!--                    <div class="widget-head">-->
<!--                        <h4 class="heading">Add News</h4>-->
<!--                    </div>-->
                    <!-- // Widget heading END -->
                    <div class="widget-body">
                        <div class="innerLR">
                            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="news_name" class="form-control" placeholder="News name" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Image</label>
                                    <div class="col-sm-10">
                                        <div class="fileupload fileupload-new margin-none" data-provides="fileupload">
                                            <div class="input-group">
                                                <div class="form-control col-md-3">
                                                    <i class="fa fa-file fileupload-exists"></i>
                                                    <span class="fileupload-preview"></span>
                                                </div>
                                                <span class="input-group-btn">
                                                <span class="btn btn-default btn-file">
                                                <span class="fileupload-new">Select file</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" name="news" class="margin-none" required="" />
                                                </span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Thumbnail</label>
                                    <div class="col-sm-10">
                                        <div class="fileupload fileupload-new margin-none" data-provides="fileupload">
                                            <div class="input-group">
                                                <div class="form-control col-md-3">
                                                    <i class="fa fa-file fileupload-exists"></i>
                                                    <span class="fileupload-preview"></span>
                                                </div>
                                                <span class="input-group-btn">
                                                <span class="btn btn-default btn-file">
                                                <span class="fileupload-new">Select file</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" name="thumbnail" class="margin-none" required="" />
                                                </span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a></span>
                                            </div>
                                        </div>
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
            </div>
        </div>
    </div>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/bootstrap-switch/assets/lib/js/bootstrap-switch.js?v=v1.0.3-rc2"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/bootstrap-switch/assets/custom/js/bootstrap-switch.init.js?v=v1.0.3-rc2"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/fuelux-checkbox/fuelux-checkbox.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>

    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/editors/wysihtml5/assets/lib/js/wysihtml5-0.3.0_rc2.min.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/editors/wysihtml5/assets/lib/js/bootstrap-wysihtml5-0.0.2.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/editors/wysihtml5/assets/custom/wysihtml5.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/wizards/assets/lib/jquery.bootstrap.wizard.js?v=v1.0.3-rc2"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/wizards/assets/custom/js/form-wizards.init.js?v=v1.0.3-rc2"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/fuelux-radio/fuelux-radio.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/jasny-fileupload/assets/js/bootstrap-fileupload.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/button-states/button-loading/assets/js/button-loading.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v1.0.3-rc2"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v1.0.3-rc2"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/select2/assets/lib/js/select2.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/select2/assets/custom/js/select2.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/multiselect/assets/lib/js/jquery.multi-select.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/multiselect/assets/custom/js/multiselect.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/inputmask/assets/lib/jquery.inputmask.bundle.min.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/inputmask/assets/custom/inputmask.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/bootstrap-datepicker/assets/lib/js/bootstrap-datepicker.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/bootstrap-datepicker/assets/custom/js/bootstrap-datepicker.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/bootstrap-timepicker/assets/lib/js/bootstrap-timepicker.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/bootstrap-timepicker/assets/custom/js/bootstrap-timepicker.init.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/colorpicker-farbtastic/assets/js/farbtastic.min.js?v=v1.0.3-rc2&sv=v0.0.1.1"></script>
    <script src="<?php echo \Main\Helper\URL::absolute();?>/public/assets/components/common/forms/elements/colorpicker-farbtastic/assets/js/colorpicker-farbtastic.init.js?v=v1.0.3-rc2"></script>
<?php $this->import("/layout/footer"); ?>