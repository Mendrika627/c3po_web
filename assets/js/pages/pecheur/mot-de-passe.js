$(() => {

    const formulaire = {
  
      corps: $('#js-formulaire-modification-mdp'),
  
      id: $('#js-formulaire-modification-mdp .js-id'),

      nomPecheur: $('#js-formulaire-modification-mdp .js-nom-pecheur'),
  
      prenomPecheur: $('#js-formulaire-modification-mdp .js-prenom-pecheur'),

      motDePassePecheur: $('#js-formulaire-modification-mdp .js-mot-de-passe-pecheur')
  
    };
  
    formulaire.soumission = $('#js-enregistrer-modification-mdp');
  
    // formulaire.iconeAfficherChacherMotDePasse = formulaire.corps.parents('.modal').find('.js-enregistrer');
  
  
    // formulaire.afficherChacherMotDePasse.on('click', e => {
  
    //   const icone = $(e.currentTarget).find('i');
  
    //   if (icone.hasClass('fa-eye-slash')) icone.removeClass('fa-eye-slash').addClass('fa-eye');
  
    //   else icone.removeClass('fa-eye').addClass('fa-eye-slash');
  
    //   formulaire.motDePasse.attr('type', icone.hasClass('fa-eye-slash') ? 'password' : 'text');
  
    // });
  
  
  
    formulaire.soumission.on('click', () => {
  
      console.log('clicked')
  
      formulaire.corps.trigger('submit');
  
    });
  
  
  
    formulaire.corps.on('submit', e => {
  
      e.preventDefault();
      console.log(donneesFormulaire())

      const attente = $.alert({
  
          useBootstrap: true,
  
          theme: 'bootstrap',
  
          animation: 'rotatex',
  
          closeAnimation: 'rotatex',
  
          animateFromElement: false,
  
          content: function () {
  
            return $.ajax({
  
              url: `${BASE_URL}/pecheur/mot_de_passe`,
  
              data: donneesFormulaire(),
  
              type: 'post',
  
              dataType: 'json'
  
            }).done((reponse) => {
  
              if (!reponse.succes) {
  
                attente.onDestroy = () => {
  
                  $(document).trigger('recharger-datatable');
  
                   $('#modal-mot-de-passe').modal('hide');
  
                }
  
                attente.setContent('Une erreur s\'est produite! Veuillez contacter votre administrateur de système');
  
                attente.setTitle('Error');
  
              } else {
  
                attente.onDestroy = () => {
  
                  $(document).trigger('recharger-datatable');
  
                   $('#modal-mot-de-passe').modal('hide');
  
                }
  
                attente.setContent('Le Mot de passe a été ajouté avec succès!')
  
                attente.setTitle('Succès')
  
              }
  
            }).fail(() => {
  
              attente.setContent('Une erreur est survenue. Veuillez reessayer ou contacter un administrateur')
  
              attente.setTitle('Erreur')
  
            })
  
          }
  
        })
  
    });
  
    function donneesFormulaire() {

      return {
  
        pecheur_id: formulaire.id.val(),
  
        pecheur_nom: formulaire.nomPecheur.val(),
  
        pecheur_prenom: formulaire.prenomPecheur.val(),
    
        
        pecheur_mot_de_passe: formulaire.motDePassePecheur.val(),
  
      }
  
    }
  
  })