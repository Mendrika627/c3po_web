$(() => {

    const formulaireInsertion = {
  
      corps: $('#js-formulaire-insertion'),
  
      groupe: $('#js-formulaire-insertion .js-groupe'),
  
      nomUtilisateur: $('#js-formulaire-insertion .js-nom-utilisateur'),
  
      identifiant: $('#js-formulaire-insertion .js-identifiant'),
  
      motDePasse: $('#js-formulaire-insertion .js-mot-de-passe'),
  
      afficherChacherMotDePasse: $('#js-formulaire-insertion .js-afficher-cacher-mot-de-passe'),
  
    };
  
    formulaireInsertion.soumission = formulaireInsertion.corps.parents('.modal').find('.js-enregistrer');
  
    formulaireInsertion.iconeAfficherChacherMotDePasse = formulaireInsertion.corps.parents('.modal').find('.js-enregistrer');
  
  
  
    const formulaireModification = {
  
      id: $('#js-formulaire-modification .js-id'),
  
      corps: $('#js-formulaire-modification'),
  
      groupe: $('#js-formulaire-modification .js-groupe'),
  
      nomUtilisateur: $('#js-formulaire-modification .js-nom-utilisateur'),
  
      identifiant: $('#js-formulaire-modification .js-identifiant'),
  
      motDePasse: $('#js-formulaire-modification .js-mot-de-passe'),
  
      afficherChacherMotDePasse: $('#js-formulaire-modification .js-afficher-cacher-mot-de-passe'),
  
    };
  
    formulaireModification.soumission = formulaireModification.corps.parents('.modal').find('.js-enregistrer');
  
    formulaireModification.iconeAfficherChacherMotDePasse = formulaireModification.corps.parents('.modal').find('.js-enregistrer');
  
  
  
    var datatable = $('#datatable').DataTable({
  
      language: {url: BASE_URL + '/assets/datatable-fr.json'},
  
      processing: true,
  
      serverSide: true,
  
      paging: true,
  
      lengthChange: true,
  
      searching: true,
  
      ordering: true,
  
      info: true,
  
      autoWidth: true,
  
      responsive: true,
  
      columnDefs: [{
  
        targets: [-1],
  
        orderable: false,
  
        className: ''
  
      }],
  
      order: [[0, 'asc']],
  
      ajax: {
  
        url: BASE_URL + '/utilisateur/datatable',
  
        method: 'post',
  
      },
  
    });
  
  
  
    $(document).on('recharger-datatable', () => {
  
      datatable.ajax.reload();
  
    });
  
  
  
    $(document).on('click', '.delete-button', e => {
  
      var information = $(e.currentTarget).attr('data-target');
  
      jConfirmRed('Supprimer la sélection', 'La suppression pourra entraîner la perte d\'autres données relatives à celle-ci.\nVeuillez confirmer la suppression', () => {
  
        $.ajax({
  
          url: BASE_URL + '/utilisateur/suppression/' + information,
  
          method: 'get',
  
          dataType: 'json',
  
          success: () => {
  
            $(document).trigger('recharger-datatable');
  
            $.alert('La suppression a été effectuée avec succès');
  
          }
  
        });
  
      });
  
    });
  
  
  
    $(document).on('click', '[data-target="#modal-modification"]', e => {
  
      let id = $(e.currentTarget).attr('id');
  
      id = id.substring(7, id.length);
  
      const chargeurInformationModification = $('#chargeur-information-modification')
  
      const modal = $('#modal-modification')
  
      const formulaire = $('#js-formulaire-modification')
  
      const boutonEnregisrer = $('#js-enregistrer-modification')
  
      formulaire.hide()
  
      chargeurInformationModification.show()
  
      boutonEnregisrer.attr('disabled', true)
  
      modal.modal('show')
  
      // Sélection des informations à modifier
  
      $.ajax({
  
        url: `${BASE_URL}/utilisateur/selectionner/${id}`,

        method: 'get',

        dataType: 'json',

        success: reponse => {

          const utilisateur = reponse.utilisateur;

          initialiserFormulaire(formulaireModification);

          formulaireModification.id.val(id);


          formulaireModification.groupe.val(utilisateur.groupe).trigger('change');


          formulaireModification.nomUtilisateur.val(utilisateur['login_nom_utilisateur']);

          formulaireModification.identifiant.val(utilisateur.login_identifiant);

          formulaire.show()

          chargeurInformationModification.hide()

          boutonEnregisrer.removeAttr('disabled')

        }

      })
  
    
  
    });
  
  
  
    $('[data-target="#modal-insertion"]').on('click', () => {
  
      initialiserFormulaire(formulaireInsertion)
  
    })
  
  
  
    function initialiserFormulaire(formulaire) {
  
      formulaire.corps.trigger('reset');
  
      formulaire.motDePasse.attr('type', 'text');
  
      formulaire.afficherChacherMotDePasse.find('i').removeClass('fa-eye-slash').addClass('fa-eye');
  
      formulaire.nomUtilisateur.parents('.form-group').show();
  
  
    }
  
  
  
  
  
  
  })