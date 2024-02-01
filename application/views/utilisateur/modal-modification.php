<div class="modal fade" id="modal-modification">

	<div class="modal-dialog modal-dialog-centered">

		<div class="modal-content">

			<div class="modal-header">

			<button type="button" class="close" data-dismiss="modal" aria-label="Close">

				<span aria-hidden="true">&times;</span>

			</button>

				<h4 class="modal-title">Utilisateur</h4>

			</div>

			<div class="modal-body">

        <div class="text-center" id="chargeur-information-modification">

          <div class="spinner-border" role="status">

            <span class="sr-only">Loading...</span>

          </div>

          <p><strong>Réquisition des données...</strong></p>

        </div>

				<form autocomplete="off" id="js-formulaire-modification">

					<input type="submit" hidden>

					<input type="hidden"  class="form-control js-id">

					<div class="form-group">

						<label for="insert-district">Groupe <span class="text text-red">*</span></label>

						<select class="form-control js-groupe">

							<option value="" selected hidden></option>

							<?php if (isset($groupes) && is_array($groupes)) foreach ($groupes as $groupe) { ?>

								<option value="<?= $groupe['groupe_id'] ?>"><?= $groupe['groupe_nom'] ?></option>

							<?php } ?>

						</select>

					</div>

					<div class="form-group">

						<label>Nom d'utilisateur <span class="text text-red">*</span></label>

						<input type="text" class="form-control js-nom-utilisateur">

					</div>

					<div class="form-group">

						<label>Identifiant <span class="text text-red">*</span></label>

						<input type="text" class="form-control js-identifiant">

					</div>

					<div class="form-group">

						<label>Mot de passe <span class="text text-red">*</span></label>

						<div class="input-group">

							<input type="text" class="form-control js-mot-de-passe">

							<div class="input-group-addon js-afficher-cacher-mot-de-passe">

								<span> <i class="fa fa-eye"></i></span>

							</div>

						</div>

					</div>

					<div class="form-group"></div>

				</form>

			</div>

			<div class="modal-footer justify-content-between">

				<button type="button" class="btn btn-primary" id="js-enregistrer-modification"><i class="fa fa-save mr-2"></i>Enregistrer</button>

			</div>

		</div>

		<!-- /.modal-content -->

	</div>

	<!-- /.modal-dialog -->

</div>

<!-- /.modal -->