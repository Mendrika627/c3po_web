<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">
      <h1>
        Gestion d'utilisateurs
      </h1>
  </section>

  

  <!-- Main content -->

  <section class="content">


      <!-- /.card -->

      <div class="box">

        <div class="box-header with-border">

          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-insertion">

          <i class="fa fa-plus-circle mr-2" ></i>Nouvel Utilisateur

          </button>

        </div>

        

        <!--les modals d'ajout et modification sous forme de composant-->

        <?= $insert_modal_component = isset($insert_modal_component) && !empty($insert_modal_component) ? $insert_modal_component : '' ?>

        <?= $update_modal_component = isset($update_modal_component) && !empty($update_modal_component) ? $update_modal_component : '' ?>

        <!--les modals d'ajout et modification sous forme de composant-->

        

        <!-- /.box-header -->

        <div class="box-body">

          <table id="datatable" class="table table-bordered table-striped" width="100%">

            <thead>

            <tr>

              <th>Utilisateur</th>

              <th>Nom</th>

              <th>Groupe</th>

              <th >Action</th>

            </tr>

            </thead>

            <tbody>

            </tbody>

            <tfoot>

            <tr>

              <th>Utilisateur</th>

              <th>Nom</th>

              <th>Groupe</th>

              <th>Action</th>

            </tr>

            </tfoot>

          </table>

        </div>

        <!-- /.box-body -->

      </div>

      <!-- /.box -->

      <!-- /.container-fluid -->

  </section>

  <!-- /.content -->

</div>

<!-- /.content-wrapper -->