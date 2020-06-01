<?php
header('Access-Control-Allow-Origin: https://www.dash.thegettinout.com', false);
header('Access-Control-Allow-Origin: https://www.thegettinout.com', false);

include "$_SERVER[DOCUMENT_ROOT]/partials/_header.php";
global $db;

?>
<style>
    .card {
        background: #59637cb8 !important;
    }
</style>
<div class="jumbotron"
     style="background: url('/assets/img/images/back3.jpg'); background-size: cover; height: 100%; width: 100%; background-attachment:inherit;">
    <div class="row itemList"></div>
</div>
<!-- Modal -->
<div class="modal fade" id="darkModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog form-dark" role="document"
         style="background-image: url('/assets/img/pricing-table.jpg')!important; background-size: cover;">
        <div class="modal-content card card-image">
            <div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">
                <section class="mb-4">

                    <h2 class="h1-responsive font-weight-bold text-center my-4">Bize Ulaşın</h2>
                    <p class="text-center w-responsive mx-auto mb-5">SİZE NASIL DAHA İYİ HİZMET VEREBİLİRİZ?</p>

                    <div class="row">
                        <div class="col-md-12 mb-md-0 mb-5">
                            <form id="mailForm" method="post" name="mailForm" action="javascript:void( '0' )">
                                <div class=" row">
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <input type="text" id="mailisim" name="name" class="form-control"
                                                   required style="border-bottom:1px solid">
                                            <label for="mailisim">AD SOYAD</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <input type="email" id="mailAdres" name="email" class="form-control"
                                                   required style="border-bottom:1px solid">
                                            <label for="mailAdres" class="">E-MAIL</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="md-form mb-0">
                                            <input type="text" id="mailKonu" name="subject" class="form-control"
                                                   required style="border-bottom:1px solid">
                                            <label for="mailKonu" class="">KONU</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="md-form">
                                        <textarea type="text" id="mailMesaj" name="message" rows="3"
                                                  class="form-control md-textarea" required
                                                  style="border-bottom:1px solid"></textarea>
                                            <label for="mailMesaj">MESAJ</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center text-md-right" style="margin-top: 50px;">
                                    <input class="btn btn-info" id="mailGonder" type="submit">
                                </div>
                            </form>

                            <div class="status"></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<?php include "$_SERVER[DOCUMENT_ROOT]/partials/_footer.php"; ?>

