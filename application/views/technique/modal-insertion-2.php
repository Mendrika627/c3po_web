<div class="modal  fade" id="modal-insertion-2">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

                </button>
                <h4 class="modal-title">Technique de niveau 2</h4>
                
            </div>
            <div class="modal-body">

                <div class="text-center" id="chargeur-information-insertion-2">

                    <div class="spinner-border" role="status">

                        <span class="sr-only">Loading...</span>

                    </div>

                    <p><strong>Réquisition des données...</strong></p>

                </div>
                <form autocomplete="off" id="js-formulaire-insertion-2">
                    <input type="submit" hidden>

                    <div class="form-group">

                        <label for="insert-technique-niv-1">Technique de niveau 1 <span class="text text-red">*</span></label>

                        <select class="form-control js-id-technique-niv-1" id="insert-technique-niv-1">

                        

                        <!-- <?php if (isset($techniques_niv_1) && is_array($techniques_niv_1)) foreach ($techniques_niv_1 as $technique_niv_1) { ?>

                            <option value="<?= $technique_niv_1['technique_niv_1_id'] ?>"><?= $technique_niv_1['technique_niv_1_nom'] ?></option>

                        <?php } ?> -->

                        </select>

                        <span class="form-text text-red" style="display: none;"></span>

                    </div>
                    <div class="form-group">

                        <label>Nom de la technique <span class="text text-red">*</span></label>

                        <input type="text" class="form-control js-nom-technique-niv-2">

                        <span class="form-text text-red" style="display: none;"></span>

                    </div>
                    <div class="form-group">

                        <label>Description</label>

                        <textarea class="form-control js-description-technique-niv-2" rows="3" placeholder="Description"></textarea>

                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">

                <button type="button" class="btn btn-primary js-enregistrer" id="js-enregistrer-2"><i class="fa fa-save mr-2"></i>Enregistrer</button>

            </div>
        </div>
    </div>  
</div>