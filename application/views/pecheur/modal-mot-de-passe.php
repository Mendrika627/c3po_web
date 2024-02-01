<div class="modal fade" id="modal-mot-de-passe">

	<div class="modal-dialog modal-dialog-centered">

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">

					<span aria-hidden="true">&times;</span>

				</button>

				<h4 class="modal-title">Pêcheur</h4>

			</div>

			<div class="modal-body">

				<div class="text-center" id="chargeur-information-mot-de-passe">

					<div class="spinner-border" role="status">

						<span class="sr-only">Loading...</span>

					</div>

					<p><strong>Réquisition des données...</strong></p>

				</div>

				<form autocomplete="off" id="js-formulaire-modification-mdp">

					<input type="submit" hidden>

					<input type="hidden"  class="form-control js-id">

                    <input type="hidden" class="form-control js-nom-pecheur">

                    <input type="hidden" class="form-control js-prenom-pecheur">
                    
					<div class="form-group">

						<label>Mot de passe <span class="text text-red">*</span></label>

						<input type="text" class="form-control js-mot-de-passe-pecheur">
						<span class="form-text text-red" style="display: none;"></span>

					</div>

				</form>

			</div>

			<div class="modal-footer justify-content-between">

				<button type="button" class="btn btn-primary js-enregistrer" id="js-enregistrer-modification-mdp"><i class="fa fa-save mr-2"></i>Enregistrer</button>

			</div>

		</div>

		<!-- /.modal-content -->

	</div>

	<!-- /.modal-dialog -->

</div>

<!-- /.modal -->