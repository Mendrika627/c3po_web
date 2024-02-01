<div class="modal fade" id="modal-insertion">

  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

        <h4 class="modal-title">Opération</h4>

      </div>

      <div class="modal-body">

        <form autocomplete="off" id="js-formulaire-insertion">

          <input type="submit" hidden>

          <div class="form-group">

            <label for="js-nom-insertion">Nom de l'opération <span class="text text-red">*</span></label>

            <input type="text" class="form-control" name="js-nom" id="js-nom-insertion">

            <span class="form-text text-red" style="display: none;"></span>

          </div>

          <label>Actions possibles</label>

          <div class="form-group">
            <div class="checkbox ">
              <label class="toggle-group">
                <input type="checkbox" class="custom-control-input" name="js-creation" id="js-creation-insertion" >
                <label class="label-checkbox" for="js-creation-insertion"></label>
                <span>Création</span>
              </label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label class="toggle-group" >
              <input type="checkbox" class="custom-control-input" name="js-modification" id="js-modification-insertion">
              <label class="label-checkbox" for="js-modification-insertion"></label>
                <span>Modification</span>
              </label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label class="toggle-group">
              <input type="checkbox" class="custom-control-input" name="js-visualisation" id="js-visualisation-insertion">
              <label class="label-checkbox" for="js-visualisation-insertion"></label>
                <span>Visualisation</span>
              </label>
              </label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox"> 
              <label class="toggle-group">
              <input type="checkbox" class="custom-control-input" name="js-suppression" id="js-suppression-insertion">
              <label class="label-checkbox" for="js-suppression-insertion"></label>
                <span>Suppression</span>
              </label>
              </label>
            </div>
          </div>

        </form>

      </div>

      <div class="modal-footer justify-content-between">

        <button type="button" class="btn btn-primary " id="js-enregistrer"><i class="fa fa-save mr-2"  ></i>Enregistrer</button>

      </div>

    </div>

    <!-- /.modal-content -->

  </div>

  <!-- /.modal-dialog -->

</div>

<!-- /.modal -->