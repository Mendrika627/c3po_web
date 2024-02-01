$(() => {

    const formulaire = {
  
      corps: $('#js-formulaire-modification'),
  
      id: $('#js-formulaire-modification .js-id'),
  
      corps: $('#js-formulaire-modification'),

      nomPecheur: $('#js-formulaire-modification .js-nom-pecheur'),
  
      prenomPecheur: $('#js-formulaire-modification .js-prenom-pecheur'),
  
      dateNaissancePecheur: $('#js-formulaire-modification .js-datenaissance-pecheur'),

      sexePecheur: $('#js-formulaire-modification .js-sexe-pecheur'),

      telephonePecheur: $('#js-formulaire-modification .js-telephone-pecheur'),

      mailPecheur: $('#js-formulaire-modification .js-mail-pecheur'),

      permisPecheur: $('#js-formulaire-modification .js-permis-pecheur'),

      confidentielPecheur: $('#js-formulaire-modification .js-confidentiel-pecheur')
  
    };
  
    formulaire.soumission = $('#js-enregistrer-modification');
  
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
  
              url: `${BASE_URL}/pecheur/modification`,
  
              data: donneesFormulaire(),
  
              type: 'post',
  
              dataType: 'json'
  
            }).done((reponse) => {
  
              if (!reponse.succes) {
  
                attente.onDestroy = () => {
  
                  $(document).trigger('recharger-datatable');
  
                   $('#modal-modification').modal('hide');
  
                }
  
                attente.setContent('L\'adresse email a déjà été utilisée, veuillez en choisir une autre parce que cette propriété doit être unique pour chaque utilisateur')
  
                attente.setTitle('Error')
  
              } else {
  
                attente.onDestroy = () => {
  
                  $(document).trigger('recharger-datatable');
  
                   $('#modal-modification').modal('hide');
  
                }
  
                attente.setContent('La modification a été effectuée avec succès')
  
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

      var confidentiel = false;
      if(formulaire.confidentielPecheur.prop("checked")){
        confidentiel = true;
      }else{
        confidentiel = false;
      }
  
      return {
  
        pecheur_id: formulaire.id.val(),
  
        pecheur_nom: formulaire.nomPecheur.val(),
  
        pecheur_prenom: formulaire.prenomPecheur.val(),
    
        pecheur_date_de_naissance: formulaire.dateNaissancePecheur.val(),

        pecheur_sexe: formulaire.sexePecheur.val(),

        pecheur_telephone: formulaire.telephonePecheur.val(),

        pecheur_mail: formulaire.mailPecheur.val(),

        pecheur_numero_permis: formulaire.permisPecheur.val(),

        pecheur_confidentialite: confidentiel
  
      }
  
    }
  
  })