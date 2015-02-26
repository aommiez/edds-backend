<?php
include("layout/header.php");
?>
<div class="container">
    <!-- row-app -->
    <div class="row row-app">
        <!-- col -->
        <!-- col-separator.box -->
        <div class="col-separator col-unscrollable box">
            <!-- col-table -->
            <div class="col-table">

                <!-- col-table-row -->
                <div class="col-table-row">
                    <!-- col-app -->
                    <div class="col-app col-unscrollable">
                        <!-- col-app -->
                        <div class="col-app">
                            <div class="login">
                                <div class="placeholder text-center"><i class="fa fa-lock"></i>
                                </div>
                                <div class="panel panel-default col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-4">
                                    <div class="panel-body">
                                        <form role="form" action="index.html?lang=en">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Username</label>
                                                <input type="username" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>

                                        </form>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <!-- // END col-app -->
                    </div>
                    <!-- // END col-app.col-unscrollable -->
                </div>
                <!-- // END col-table-row -->
            </div>
            <!-- // END col-table -->
        </div>
        <!-- // END col-separator.box -->
    </div>
    <!-- // END row-app -->
<?php
include("layout/footer.php");
?>