<?php
include "$_SERVER[DOCUMENT_ROOT]/partials/_header.php";
?>
<div class="main-panel">
    <div class="content-wrapper">

        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-file-image"></i>
                </span> Resimler </h3>
            <button type="button" class="btn btn-inverse-primary btn-fw componentAdd">Ekle</button>
        </div>
        <div class="row component">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">

                                <!-- Our markup, the important part here! -->
                                <div id="drag-and-drop-zone" class="dm-uploader p-5">
                                    <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files here</h3>

                                    <div class="btn btn-primary btn-block mb-5">
                                        <span>Open the file Browser</span>
                                        <input type="file" title='Click to add Files'/>
                                    </div>
                                </div><!-- /uploader -->

                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="card h-100">
                                    <div class="card-header">
                                        File List
                                    </div>

                                    <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                                        <li class="text-muted text-center empty">No files uploaded.</li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- /file list -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card h-100">
                                    <div class="card-header">
                                        Debug Messages
                                    </div>

                                    <ul class="list-group list-group-flush" id="debug">
                                        <li class="list-group-item text-muted empty">Loading plugin....</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row content">


            <?php
            $dizin = "../../assets/images/uploadFile";
            $tutucu = opendir($dizin);
            while ($dosya = readdir($tutucu)) {
                if (is_file($dizin . "/" . $dosya))
                    $resim[] = $dosya;
            }
            closedir($tutucu);
            if (!empty($resim)) {
                foreach ($resim as $res) { ?>
                    <div class="card" style="margin: 10px; 0px;">
                        <div class="card-body" style="padding: 20px;">
                            <div class="row" style="text-align: center;">
                                <img src="<?php e(URL); ?>/assets/images/uploadFile/<?php e($res); ?>"
                                     style="max-width: 150px;max-height: 150px; height: 150px;width: 150px"/>
                            </div>
                            <button class="btn btn-inverse-danger imageDelete" style="width: 100%;margin-top:10px;"
                                    value="<?php e($res); ?>">SİL
                            </button>
                        </div>
                    </div>
                <?php }
            } ?>

        </div>
    </div>

    <?php include "$_SERVER[DOCUMENT_ROOT]/partials/_footer.php" ?>
    <!-- File item template -->
    <script type="text/html" id="files-template">
        <li class="media">
            <div class="media-body mb-1">
                <p class="mb-2">
                    <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
                </p>
                <div class="progress mb-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                         role="progressbar"
                         style="width: 0%"
                         aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                <hr class="mt-1 mb-1"/>
            </div>
        </li>
    </script>

    <!-- Debug item template -->
    <script type="text/html" id="debug-template">
        <li class="list-group-item text-%%color%%"><strong>%%date%%</strong>: %%message%%</li>
    </script>
</div>
