<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Gestion des opérations
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-insertion">
                  <i class="fa fa-plus-circle mr-2" ></i>Nouvelle Opération
                </button>
              
              </h3>
            </div>
             <!--les modals d'ajout et modification sous forme de composant-->

            <?= $insert_modal_component = isset($insert_modal_component) && !empty($insert_modal_component) ? $insert_modal_component : '' ?>

            <?= $update_modal_component = isset($update_modal_component) && !empty($update_modal_component) ? $update_modal_component : '' ?>

            <!--les modals d'ajout et modification sous forme de composant-->
            <div class="box-body">
              <table id="datatable" class="table table-bordered " width="100%">

                  <thead>

                    <tr>

                      <th>Id</th>

                      <th>Nom</th>

                      <th>Création</th>

                      <th>Modification</th>

                      <th>Visualisation</th>

                      <th>Suppression</th>

                      <th >Action</th>

                    </tr>

                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>

                    <tr>

                      <th>Id</th>

                      <th>Nom</th>

                      <th>Création</th>

                      <th>Modification</th>

                      <th>Visualisation</th>

                      <th>Suppression</th>

                      <th >Action</th>

                    </tr>

                  </tfoot>

              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


<!-- Content Wrapper. Contains page content -->

<!-- /.content-wrapper -->