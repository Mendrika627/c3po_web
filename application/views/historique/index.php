<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">
    <h1>
      Historiques
    </h1>

  </section>

  

  <!-- Main content -->

  <section class="content">

      <!-- /.card -->

      <div class="box">

        <div class="box-header">

          <button id="js-nettoyer-historique" class="btn btn-danger"><i class="fa fa-trash mr-2"></i> Nettoyer l'historique</button>

        </div>

        <!-- /.box-header -->

        <div class="box-body">

          <table class="table table-bordered table-striped" id="historiqueTable" width="100%">

            <thead>

            <tr>

              <th>Date</th>

              <th>Utilisateur</th>

              <th>Action</th>

              <th>Détail</th>

            </tr>

            </thead>

            <tbody>

            <?php foreach ($historiques as $historique) {?>

                <tr>

                  <td><?= $historique["date"] ?></td>

                  <td><?= $historique["utilisateur"] ?></td>

                  <td><?= $historique["action"] ?></td>

                  <td><?= $historique["detail"] ?></td>

                </tr>

            <?php } ?>

            </tbody>

          </table>

        </div>

        <!-- /.box-body -->

      </div>

      <!-- /.box -->



  </section>

  <!-- /.content -->

</div>

<!-- /.content-wrapper -->
