    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-3">
                <div class="input-group input-group-sm mt-3 penampung-textbox">
                    <input type="text" class="form-control" placeholder="Cari kata..." id="text-box">
                    <div class="input-group-append">
                        <button class="btn btn-sm btn-outline-success font-weight-bold" type="button" id="search-button">☌</button>
                    </div>
                    <p id="alert-container"></p>
                </div>

            </div>
            <div class="col-lg">
                <!-- ⛭ -->

                <div class="lang-toggle float-right" id="lang-toggle" data-html="true" data-toggle="tooltip" data-placement="top" title="Klik disini untuk membalik bahasa." data-lang="sunda">
                    <p class="float-right mt-3 mr-3 text-info pb-2 border-info border-bottom">
                        <span class="font-weight-bold" id="active-lang">Sunda</span> > Indonesia</p>
                    <p class="float-right mr-2 gear text-info lang-toggle">⟳</p>
                </div>

            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3 mt-2 ml-1 vocab-cont-parent">
                <table class="table table-hover table-sm">
                    <tbody id="vocabularies-container">

                    </tbody>
                </table>
            </div>
            <div class="col-lg border border-success bg-light rounded translation-box ml-2 mr-1">
            </div>
        </div>
    </div>