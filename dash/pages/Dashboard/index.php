<?php
include "$_SERVER[DOCUMENT_ROOT]/partials/_header.php";
global $db;

$user = $db->_User();
$note = $db->_Note();
$event = $db->_Events();
$comment = $db->_Comment();
$survey = $db->_Survey();

$userCount = 0; $userTotal = 0;
$eventCount = 0; $eventTotal=0;
$commentCount = 0; $commentTotal = 0;
$surveyCount = 0; $surveyTotal =0;
foreach ($user as $row) {
    if ($row['durum'] == "1")
        $userCount += 1;
    else
        $userTotal +=1;
}
foreach ($event as $row) {
    if ($row['durum'] == "1")
        $eventCount += 1;
    else
        $eventTotal +=1;
}
foreach ($comment as $row) {
    if ($row['durum'] == "1")
        $commentCount += 1;
    else
        $commentTotal +=1;
}
foreach ($survey as $row) {
    if ($row['durum'] == "1")
        $surveyCount += 1;
    else
        $surveyTotal +=1;
}
$userTotal += $userCount;
$eventTotal += $eventCount;
$commentTotal += $commentCount;
$surveyTotal += $surveyCount;
?>

<div class="main-panel">
    <div class="content-wrapper">

        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Ana Sayfa </h3>
        </div>

        <div class="row">
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?php e(URL); ?>/assets/images/dashboard/circle.png" class="card-img-absolute"
                             alt="circle-image"/>
                        <h4 class="font-weight-normal mb-3">Üye<i class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-3"><?php e($userCount); ?></h2>
                        <h6 class="card-text" style="float: right"><?php e($userTotal); ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?php e(URL); ?>/assets/images/dashboard/circle.png" class="card-img-absolute"
                             alt="circle-image"/>
                        <h4 class="font-weight-normal mb-3">Etkinlik<i
                                    class="mdi mdi-bookmark-outline mdi-24px float-right"></i></h4>
                        <h2 class="mb-1"><?php e($eventCount); ?></h2>
                        <h6 class="card-text" style="float: right"><?php e($eventTotal); ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?php e(URL); ?>/assets/images/dashboard/circle.png" class="card-img-absolute"
                             alt="circle-image"/>
                        <h4 class="font-weight-normal mb-3">Yorum <i class="mdi mdi-diamond mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-2"><?php e($commentCount); ?></h2>
                        <h6 class="card-text" style="float: right"><?php e($commentTotal); ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="<?php e(URL); ?>/assets/images/dashboard/circle.png" class="card-img-absolute"
                             alt="circle-image"/>
                        <h4 class="font-weight-normal mb-3">Anket<i class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-3"><?php e($surveyCount); ?></h2>
                        <h6 class="card-text" style="float: right"><?php e($surveyTotal); ?></h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="add-items d-flex">
                            <input type="text" class="form-control todo-list-input"
                                   placeholder="Nelere ihtiyacımız var?">
                            <button class="add btn btn-gradient-success font-weight-bold todo-list-add-btn"
                                    id="add-task">Add
                            </button>
                        </div>
                        <div class="list-wrapper">
                            <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                <?php foreach ($note as $row) { ?>
                                    <li>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox"
                                                       value="<?php e($row['durum']); ?>"
                                                       data-value="<?php e($row['Id']); ?>"> <?php e($row['note']); ?>
                                            </label>
                                        </div>
                                        <i class="remove mdi mdi-close-circle-outline"
                                           data-value="<?php e($row['Id']); ?>"></i>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "$_SERVER[DOCUMENT_ROOT]/partials/_footer.php" ?>
</div>
