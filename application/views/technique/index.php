<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <h1>
            Gestion des techniques de pêche
        </h1>
    </section>
    <!-- Main content -->

    <section class="content">
        <!-- /.card -->

    <div class="box">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#niveau1" data-toggle="tab">Techniques de niveau 1</a></li>
                <li><a href="#niveau2" data-toggle="tab">Techniques de niveau 2</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="niveau1">
                    <div class="box-header with-border">

                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-insertion">

                            <i class="fa fa-plus-circle mr-2" ></i>Nouvelle technique de niveau 1

                        </button>
                         <!--les modals d'ajout et modification sous forme de composant-->

                        <?= $insert_modal_component = isset($insert_modal_component) && !empty($insert_modal_component) ? $insert_modal_component : '' ?>

                        <?= $update_modal_component = isset($update_modal_component) && !empty($update_modal_component) ? $update_modal_component : '' ?>

                        <!--les modals d'ajout et modification sous forme de composant-->

                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table id="datatable" class="table table-bordered table-striped" width="100%">
                            <thead>

                                <tr>

                                    <th>Nom</th>

                                    <th>Déscription</th>

                                    <th >Action</th>

                                </tr>

                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>

                                <tr>

                                    <th>Nom</th>

                                    <th>Déscription</th>

                                    <th >Action</th>

                                </tr>

                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="niveau2">
                    <div class="box-header with-border">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-insertion-2">

                            <i class="fa fa-plus-circle mr-2" ></i>Nouvelle technique de niveau 2

                        </button>

                        <!--les modals d'ajout et modification sous forme de composant-->

                        <?= $insert_modal_component_2 = isset($insert_modal_component_2) && !empty($insert_modal_component_2) ? $insert_modal_component_2 : '' ?>

                        <!-- <?= $update_modal_component = isset($update_modal_component) && !empty($update_modal_component) ? $update_modal_component : '' ?> -->
                    </div>
                    <div class="box-body">
                        <table id="datatable-2" class="table table-bordered table-striped" width="100%">
                            <thead>

                                <tr>

                                    <th>Technique de niveau 1</th>

                                    <th>Nom</th>

                                    <th>Déscription</th>

                                    <th >Action</th>

                                </tr>

                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>

                                <tr>

                                    <th>Technique de niveau 1</th>

                                    <th>Nom</th>

                                    <th>Déscription</th>

                                    <th >Action</th>

                                </tr>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>