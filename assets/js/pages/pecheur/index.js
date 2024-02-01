$(() => {

    const formulaireInsertion = {
  
      corps: $('#js-formulaire-insertion'),

      nomPecheur: $('#js-formulaire-insertion .js-nom-pecheur'),
  
      prenomPecheur: $('#js-formulaire-insertion .js-prenom-pecheur'),
  
      dateNaissancePecheur: $('#js-formulaire-insertion .js-datenasissance-pecheur'),

      sexePecheur: $('#js-formulaire-insertion .js-sexe-pecheur'),

      telephonePecheur: $('#js-formulaire-insertion .js-telephone-pecheur'),

      mailPecheur: $('#js-formulaire-insertion .js-mail-pecheur'),

      permisPecheur: $('#js-formulaire-insertion .js-permis-pecheur'),

      confidentielPecheur: $('#js-confidentiel-pecheur-insertion')
  
    };
  
    formulaireInsertion.soumission = formulaireInsertion.corps.parents('.modal').find('.js-enregistrer');
  
    // formulaireInsertion.iconeAfficherChacherMotDePasse = formulaireInsertion.corps.parents('.modal').find('.js-enregistrer');
  
  
  
    const formulaireModification = {
  
      id: $('#js-formulaire-modification .js-id'),
  
      corps: $('#js-formulaire-modification'),

      nomPecheur: $('#js-formulaire-modification .js-nom-pecheur'),
  
      prenomPecheur: $('#js-formulaire-modification .js-prenom-pecheur'),
  
      dateNaissancePecheur: $('#js-formulaire-modification .js-datenaissance-pecheur'),

      sexePecheur: $('#js-formulaire-modification .js-sexe-pecheur'),

      telephonePecheur: $('#js-formulaire-modification .js-telephone-pecheur'),

      mailPecheur: $('#js-formulaire-modification .js-mail-pecheur'),

      permisPecheur: $('#js-formulaire-modification .js-permis-pecheur'),

      confidentielPecheur: $('#js-confidentiel-pecheur-modification')
  
    };
  
    formulaireModification.soumission = formulaireModification.corps.parents('.modal').find('.js-enregistrer');



    const formulaireMotDePasse = {
  
      corps: $('#js-formulaire-modification-mdp'),
  
      id: $('#js-formulaire-modification-mdp .js-id'),

      nomPecheur: $('#js-formulaire-modification-mdp .js-nom-pecheur'),
  
      prenomPecheur: $('#js-formulaire-modification-mdp .js-prenom-pecheur'),

      motDePassePecheur: $('#js-formulaire-modification-mdp .js-mot-de-passe-pecheur')
  
  
    };
  
    formulaireMotDePasse.soumission = formulaireMotDePasse.corps.parents('.modal').find('.js-enregistrer');
  
    // formulaireModification.iconeAfficherChacherMotDePasse = formulaireModification.corps.parents('.modal').find('.js-enregistrer');
  
  
  
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
  
        url: BASE_URL + '/pecheur/datatable',
  
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
  
          url: BASE_URL + '/pecheur/suppression/' + information,
  
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
  
        url: `${BASE_URL}/pecheur/selectionner/${id}`,

        method: 'get',

        dataType: 'json',

        success: reponse => {

          const pecheur = reponse.pecheur;

          initialiserFormulaire(formulaireModification);

          formulaireModification.id.val(id);


          formulaireModification.nomPecheur.val(pecheur.pecheur_nom).trigger('change');
          formulaireModification.prenomPecheur.val(pecheur.pecheur_prenom).trigger('change');
          formulaireModification.dateNaissancePecheur.val(pecheur.pecheur_date_de_naissance).trigger('change');
          formulaireModification.sexePecheur.val(pecheur.pecheur_sexe).trigger('change');
          formulaireModification.telephonePecheur.val(pecheur.pecheur_telephone).trigger('change');
          formulaireModification.mailPecheur.val(pecheur.pecheur_mail).trigger('change');
          formulaireModification.permisPecheur.val(pecheur.pecheur_numero_permis).trigger('change');
          if(pecheur.pecheur_confidentialite == "t"){
            formulaireModification.confidentielPecheur.prop("checked", true);
          }else{
            formulaireModification.confidentielPecheur.removeAttr('checked');;
          }
          // formulaireModification.confidentielPecheur.val(pecheur.pecheur_confidentialite).trigger('change');

          formulaire.show()

          chargeurInformationModification.hide()

          boutonEnregisrer.removeAttr('disabled')

        }

      })
  
    
  
    }
    
    
    );


    $(document).on('click', '[data-target="#modal-mot-de-passe"]', e => {
  
      let id = $(e.currentTarget).attr('id');
  
      id = id.substring(5, id.length);
  
      const chargeurInformationModification = $('#chargeur-information-mot-de-passe')
  
      const modal = $('#modal-mot-de-passe')
  
      const formulaire = $('#js-formulaire-modification-mdp')
  
      const boutonEnregisrer = $('#js-enregistrer-modification-mdp')
  
      formulaire.hide()
  
      chargeurInformationModification.show()
  
      boutonEnregisrer.attr('disabled', true)
  
      modal.modal('show')
  
      // Sélection des informations à modifier
  
      $.ajax({
  
        url: `${BASE_URL}/pecheur/selectionner/${id}`,

        method: 'get',

        dataType: 'json',

        success: reponse => {

          const pecheur = reponse.pecheur;

          initialiserFormulaire(formulaireMotDePasse);

          formulaireMotDePasse.id.val(id);


          formulaireMotDePasse.nomPecheur.val(pecheur.pecheur_nom).trigger('change');
          formulaireMotDePasse.prenomPecheur.val(pecheur.pecheur_prenom).trigger('change');
          formulaireMotDePasse.motDePassePecheur.val(pecheur.pecheur_mot_de_passe).trigger('change');
          // formulaireModification.confidentielPecheur.val(pecheur.pecheur_confidentialite).trigger('change');

          formulaire.show()

          chargeurInformationModification.hide()

          boutonEnregisrer.removeAttr('disabled')

        }

      })
  
    
  
    }
    
    
    );
  
  
  
    $('[data-target="#modal-insertion"]').on('click', () => {
  
      initialiserFormulaire(formulaireInsertion)
  
    })
  
  
  
    function initialiserFormulaire(formulaire) {
  
      formulaire.corps.trigger('reset');
  
      // formulaire.motDePasse.attr('type', 'text');
  
      // formulaire.afficherChacherMotDePasse.find('i').removeClass('fa-eye-slash').addClass('fa-eye');
  
      formulaire.nomPecheur.parents('.form-group').show();
  
  
    }
  
  
  
  
  
  
  })