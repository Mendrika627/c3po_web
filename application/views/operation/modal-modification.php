<div class="modal fade" id="modal-modification">

  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">

      <div class="modal-header">

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">

      <span aria-hidden="true">&times;</span>

      </button>

        <h4 class="modal-title">Opération</h4>

      </div>

      <div class="modal-body">

        <form autocomplete="off" id="js-formulaire-modification">

          <input type="submit" hidden>

          <input type="text" hidden name="js-id">

          <div class="form-group">

            <label for="js-nom-modification">Nom de l'opération <span class="text text-red">*</span></label>

            <input type="text" class="form-control" name="js-nom" id="js-nom-modification">

            <span class="form-text text-red" style="display: none;"></span>

          </div>

          <label>Actions possibles</label>

          <div class="form-group">
            <div class="checkbox ">
              <label class="toggle-group">
                <input type="checkbox" class="custom-control-input" name="js-creation" id="js-creation-modification" >
                <label class="label-checkbox" for="js-creation-modification"></label>
                <span>Création</span>
              </label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label class="toggle-group" >
              <input type="checkbox" class="custom-control-input" name="js-modification" id="js-modification-modification">
              <label class="label-checkbox" for="js-modification-modification"></label>
                <span>Modification</span>
              </label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label class="toggle-group">
              <input type="checkbox" class="custom-control-input" name="js-visualisation" id="js-visualisation-modification">
              <label class="label-checkbox" for="js-visualisation-modification"></label>
                <span>Visualisation</span>
              </label>
              </label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label class="toggle-group">
              <input type="checkbox" class="custom-control-input" name="js-suppression" id="js-suppression-modification">
              <label class="label-checkbox" for="js-suppression-modification"></label>
                <span>Suppression</span>
              </label>
              </label>
            </div>
          </div>

        </form>

      </div>

      <div class="modal-footer justify-content-between">

        <button type="button" class="btn btn-primary" id="js-modifier"><i class="fa fa-save mr-2" ></i>Enregistrer</button>

      </div>

    </div>

    <!-- /.modal-content -->

  </div>

  <!-- /.modal-dialog -->

</div>

<!-- /.modal -->