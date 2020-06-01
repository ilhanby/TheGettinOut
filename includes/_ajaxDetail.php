<?php
include "$_SERVER[DOCUMENT_ROOT]/includes/_config.php";
include "$_SERVER[DOCUMENT_ROOT]/includes/_database.php";
global $db;

if (isset($_POST['action']) && $_POST['action'] == 'eventDetail') {
    $data = $db->_EventsOnlySingle($_POST['Id']);
    foreach ($data as $key => $row) { ?>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="post-content" style="text-align: center">
                <img src="https://www.dash.thegettinout.com/assets/images/uploadFile/<?php e($row['image2']); ?>"
                     class="img-responsive" alt=""
                     style="margin-top: 20px; border-radius: 15px;width: 80%;max-height: 640px"/>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="sidebar-right">
                <div class="tab-content">
                    <h3 style="margin: 20px 0 50px 0; text-align:center; font-weight: normal;color:white;"><?php e($row['name']); ?></h3>
                    <div style="margin-top: 20px">
                        <div class="widget-div">
                            <h4 class="widget-title">Tarih / Zaman
                                <i class="material-icons" style="vertical-align: bottom; float: right;">access_time</i>
                            </h4>
                        </div>
                        <h3 style="margin: 20px 0 50px 0;font-weight: normal;color:white"><?php e($row['date']); ?> / <?php e($row['time']); ?></h3>
                    </div>
                    <div style="margin-top: 20px">
                        <div class="widget-div">
                            <h4 class="widget-title">Konum
                                <i class="material-icons" style="vertical-align: bottom; float: right;">my_location</i>
                            </h4>
                        </div>
                        <h3 style="margin: 20px 0 50px 0;font-weight: normal; color:white;"><?php e($row['konum']); ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div style="width:100%;background: white; opacity: 0.9; margin:15px; padding: 20px 35px 10px 35px;border-radius: 5px;box-shadow: 4px 4px grey;">
            <div class="row">
                <h3 class="widget-title">Etkinlik Açıklaması</h3>
            </div>
            <div class="entry-content" style="color: black">
                <p><?php e($row['description']); ?></p>
            </div>
        </div>

    <?php }
} ?>