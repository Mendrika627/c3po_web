<div class="modal  fade" id="modal-insertion">

  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

        <h4 class="modal-title">Pêcheur</h4>

      </div>

      <div class="modal-body">

        <form autocomplete="off" id="js-formulaire-insertion">

          <input type="submit" hidden>

          
          <div class="form-group">

            <label>Nom du pêcheur <span class="text text-red">*</span></label>

            <input type="text" class="form-control js-nom-pecheur">

            <span class="form-text text-red" style="display: none;"></span>

          </div>
          <div class="form-group">

            <label>Prénom(s) du pêcheur</label>

            <input type="text" class="form-control js-prenom-pecheur">

          </div>
          <div class="form-group">

            <label>Date de naissance <span class="text text-red">*</span></label>

            <input type="date" class="form-control js-datenaissance-pecheur">
            <span class="form-text text-red" style="display: none;"></span>

          </div>
          <div class="form-group">

            <label>Sexe <span class="text text-red">*</span></label>

            <select class="form-control js-sexe-pecheur" id="insert-sexe">
              <option value="M">Masculin</option>
              <option value="F">Féminin</option>
              <option value="NG">Non Genré</option>
            </select>

          </div>
          <div class="form-group">

            <label>Téléphone <span class="text text-red">*</span></label>

            <input type="text" class="form-control js-telephone-pecheur">
            <span class="form-text text-red" style="display: none;"></span>

          </div>
          <div class="form-group">

            <label>Adresse email <span class="text text-red">*</span></label>

            <input type="mail" class="form-control js-mail-pecheur">
            <span class="form-text text-red" style="display: none;"></span>

          </div>
          <div class="form-group">

            <label>Numéro de permis de pêche <span class="text text-red">*</span></label>

            <input type="text" class="form-control js-permis-pecheur">
            <span class="form-text text-red" style="display: none;"></span>

          </div>
          <div class="form-group">

            <label><input type="checkbox" id="js-confidentiel-pecheur-insertion" class="minimal js-confidentiel-pecheur"> Garder les infos confidentielles <span class="text text-red">*</span></label>
            <span class="form-text text-red" style="display: none;"></span>

          </div>
        </form>

      </div>

      <div class="modal-footer justify-content-between">

        <button type="button" class="btn btn-primary js-enregistrer"><i class="fa fa-save mr-2"></i>Enregistrer</button>

      </div>

    </div>

    <!-- /.modal-content -->

  </div>

  <!-- /.modal-dialog -->

</div>

<!-- /.modal -->