<div class="modal fade" id="modal-modification">

  <div class="modal-dialog modal-dialog-centered modal-lg">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

        <h4 class="modal-title">Groupe</h4>

      </div>

      <div class="modal-body">

        <form autocomplete="off" id="js-formulaire-modification">

          <input type="submit" hidden>

          <input type="text" hidden name="js-id">

          <div class="form-group">

            <label for="js-nom-modification">Nom du groupe <span class="text text-red">*</span></label>

            <input type="text" class="form-control" name="js-nom" id="js-nom-modification">

            <span class="form-text text-red" style="display: none;"></span>

          </div>

          <label>Permissions</label>

          <table class="table">

            <thead>

              <tr>

                <th>Opération</th>

                <th>Création</th>

                <th>Modification</th>

                <th>Visualisation</th>

                <th>Suppression</th>

              </tr>

            </thead>

            <tbody>

                <?php foreach ($operations as $iteration => $operation) { ?>

                    <tr class="js-operation">

                      <td>

                        <?= $operation['operation_nom'] ?>

                        <input type="text" name="js-permission<?= $iteration ?>" value="<?= $operation['operation_id'] ?>" hidden>

                      </td>

                      <td>

                        <?php if ($operation['creation'] === 'true') { ?>

                          <label class="toggle-group">

                            <input type="checkbox" class="custom-control-input" name="js-creation<?= $iteration ?>" id="js-creation-modification<?= $iteration ?>">
                            
                            <label class="label-checkbox" for="js-creation-modification<?= $iteration ?>"></label>
                            </label>
                          </label>


                        <?php } else { ?>

                          -

                        <?php } ?>

                      </td>

                      <td>

                        <?php if ($operation['modification'] === 'true') { ?>

                          <label class="toggle-group">

                            <input type="checkbox" class="custom-control-input" name="js-modification<?= $iteration ?>" id="js-modification-modification<?= $iteration ?>">
                            
                            <label class="label-checkbox" for="js-modification-modification<?= $iteration ?>"></label>
                            </label>

                          </label>

                        <?php } else { ?>

                          -

                        <?php } ?>

                      </td>

                      <td>

                        <?php if ($operation['visualisation'] === 'true') { ?>


                          <label class="toggle-group">

                            <input type="checkbox" class="custom-control-input" name="js-visualisation<?= $iteration ?>" id="js-visualisation-modification<?= $iteration ?>">
                            
                            <label class="label-checkbox" for="js-visualisation-modification<?= $iteration ?>"></label>
                            </label>

                          </label>

                        <?php } else { ?>

                          -

                        <?php } ?>

                      </td>

                      <td>

                        <?php if ($operation['suppression'] === 'true') { ?>

                          <label class="toggle-group">

                            <input type="checkbox" class="custom-control-input" name="js-suppression<?= $iteration ?>" id="js-suppression-modification<?= $iteration ?>">
                            
                            <label class="label-checkbox" for="js-suppression-modification<?= $iteration ?>"></label>
                            </label>

                          </label>


                        <?php } else { ?>

                          -

                        <?php } ?>

                      </td>

                    </tr>

                    <?php } ?>

            </tbody>

          </table>

        </form>

      </div>

      <div class="modal-footer justify-content-between">

        <button type="button" class="btn btn-primary" id="js-modifier"> <i class="fa fa-save mr-2" ></i> Enregistrer</button>

      </div>

    </div>

    <!-- /.modal-content -->

  </div>

  <!-- /.modal-dialog -->

</div>

<!-- /.modal -->