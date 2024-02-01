$(() => {

    const formulaire = {
  
      corps: $('#js-formulaire-modification'),
  
      id: $('#js-formulaire-modification .js-id'),
  
      groupe: $('#js-formulaire-modification .js-groupe'),
  
      nomUtilisateur: $('#js-formulaire-modification .js-nom-utilisateur'),
  
      identifiant: $('#js-formulaire-modification .js-identifiant'),
  
      motDePasse: $('#js-formulaire-modification .js-mot-de-passe'),
  
      afficherChacherMotDePasse: $('#js-formulaire-modification .js-afficher-cacher-mot-de-passe'),
  
    };
  
    formulaire.soumission = $('#js-enregistrer-modification');
  
    formulaire.iconeAfficherChacherMotDePasse = formulaire.corps.parents('.modal').find('.js-enregistrer');
  
  
    formulaire.afficherChacherMotDePasse.on('click', e => {
  
      const icone = $(e.currentTarget).find('i');
  
      if (icone.hasClass('fa-eye-slash')) icone.removeClass('fa-eye-slash').addClass('fa-eye');
  
      else icone.removeClass('fa-eye').addClass('fa-eye-slash');
  
      formulaire.motDePasse.attr('type', icone.hasClass('fa-eye-slash') ? 'password' : 'text');
  
    });
  
  
  
    formulaire.soumission.on('click', () => {
  
      console.log('clicked')
  
      formulaire.corps.trigger('submit');
  
    });
  
  
  
    formulaire.corps.on('submit', e => {
  
      e.preventDefault();
  
      $.ajax({
  
        url: `${BASE_URL}/utilisateur/modification`,
  
        method: 'post',
  
        data: donneesFormulaire(),
  
        dataType: 'json',
  
        success: reponse => {
  
          if (reponse.succes) {
  
            $(document).trigger('recharger-datatable');
  
            $('#modal-modification').modal('hide');
  
          } else {
  
            $.alert({
  
              title: 'Erreur du traitement',
  
              content: reponse.message
  
            });
  
          }
  
  
  
        },
  
        error: (arg1, arg2, arg3) => {
  
          console.log(arg1, arg2, arg3);
  
        },
  
      });
  
    });
  
  
  
    function donneesFormulaire() {
  
      return {
  
        id: formulaire.id.val(),
  
        nomUtilisateur: formulaire.nomUtilisateur.val(),
  
        motDePasse: formulaire.motDePasse.val(),
  
        identifiant: formulaire.identifiant.val(),
  
        groupe: formulaire.groupe.val(),
  
      }
  
    }
  
  })