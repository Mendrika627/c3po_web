$(() => {

    const modal = $('#modal-insertion')
  
    const formulaire = {
  
      corps: $('#js-formulaire-insertion'),

      pecheur_nom: $('#js-formulaire-insertion .js-nom-pecheur'),
  
      pecheur_prenom: $('#js-formulaire-insertion .js-prenom-pecheur'),
  
      pecheur_date_de_naissance: $('#js-formulaire-insertion .js-datenaissance-pecheur'),

      pecheur_sexe: $('#js-formulaire-insertion .js-sexe-pecheur'),

      pecheur_telephone: $('#js-formulaire-insertion .js-telephone-pecheur'),

      pecheur_mail: $('#js-formulaire-insertion .js-mail-pecheur'),

      pecheur_numero_permis: $('#js-formulaire-insertion .js-permis-pecheur'),

      pecheur_confidentialite: $('#js-confidentiel-pecheur-insertion')
  
    };
  
    formulaire.soumission = formulaire.corps.parents('.modal').find('.js-enregistrer');
  
    // formulaire.iconeAfficherChacherMotDePasse = formulaire.corps.parents('.modal').find('.js-enregistrer');
  
    // formulaire.afficherChacherMotDePasse.on('click', e => {
  
    //   const icone = $(e.currentTarget).find('i');
  
    //   if (icone.hasClass('fa-eye-slash')) icone.removeClass('fa-eye-slash').addClass('fa-eye');
  
    //   else icone.removeClass('fa-eye').addClass('fa-eye-slash');
  
    //   formulaire.motDePasse.attr('type', icone.hasClass('fa-eye-slash') ? 'password' : 'text');
  
    // });
  
  
  
    formulaire.soumission.on('click', () => {
  
      console.log('submit')
  
      formulaire.corps.trigger('submit');
  
    });
  
  
  
    formulaire.corps.on('submit', e => {
  
      e.preventDefault();
  
      console.dir(formulaire.pecheur_confidentialite)

      console.log(donneesFormulaire())
  
      if (champObligatoireOk()) {
  
        console.log('sending')
  
        const attente = $.alert({
  
          useBootstrap: true,
  
          theme: 'bootstrap',
  
          animation: 'rotatex',
  
          closeAnimation: 'rotatex',
  
          animateFromElement: false,
  
          content: function () {
  
            return $.ajax({
  
              url: `${BASE_URL}/pecheur/insertion`,
  
              data: donneesFormulaire(),
  
              type: 'post',
  
              dataType: 'json'
  
            }).done((reponse) => {
  
              if (!reponse.succes) {

                attente.onDestroy = () => {
  
                  $(document).trigger('recharger-datatable');
  
                  modal.modal('hide');
  
                }
  
                attente.setContent('L\'adresse email a déjà été utilisée, veuillez en choisir une autre parce que cette propriété doit être unique pour chaque utilisateur')
  
                attente.setTitle('Erreur')
  
              } else {
  
                attente.onDestroy = () => {
  
                  $(document).trigger('recharger-datatable');
  
                  modal.modal('hide');
  
                }
  
                attente.setContent('L\'insertion a été effectuée avec succès')
  
                attente.setTitle('Succès')
  
              }
  
            }).fail(() => {
  
              attente.setContent('Une erreur est survenue. Veuillez reessayer ou contacter un administrateur')
  
              attente.setTitle('Erreur')
  
            })
  
          }
  
        })
  
      }
      
  
    });
  
  
  
    function donneesFormulaire() {
      var confidentiel = false;
      if(formulaire.pecheur_confidentialite.prop("checked")){
        confidentiel = true;
      }else{
        confidentiel = false;
      }
  
      return {

        pecheur_nom: formulaire.pecheur_nom.val(),
  
        pecheur_prenom: formulaire.pecheur_prenom.val(),
    
        pecheur_date_de_naissance: formulaire.pecheur_date_de_naissance.val(),

        pecheur_sexe: formulaire.pecheur_sexe.val(),

        pecheur_telephone: formulaire.pecheur_telephone.val(),

        pecheur_mail: formulaire.pecheur_mail.val(),

        pecheur_numero_permis: formulaire.pecheur_numero_permis.val(),

        pecheur_confidentialite: confidentiel
      }
  
    }
  
  
  
    function supprimerValidation() {
  
      $('.form-text').hide();
  
      $('.has-error').removeClass('has-error');
  
    }
  
  
  
    function champObligatoireOk() {
  
      let valide = true;
  
      const requises = [
  
        formulaire.pecheur_nom,
  
        formulaire.pecheur_date_de_naissance,
  
        formulaire.pecheur_sexe,

        formulaire.pecheur_telephone,

        formulaire.pecheur_mail,

        formulaire.pecheur_numero_permis

        // formulaire.pecheur_confidentialite
  
      ]
  
  
      supprimerValidation()
  
      for (let required of requises) {

  
        if (required.val() === '' || required.val() == null) {
  
          valide = false;

          
  
          required.parents('.form-group').find('.form-text').text('Ce champ est obligatoire')
  
          required.parents('.form-group').find('.form-text').show();
  
          required.parents('.form-group').addClass('has-error');
  
        }
  
      }
      if(formulaire.pecheur_mail.val() !== ''){

        if(!validateEmail(formulaire.pecheur_mail.val())){

          valide = false

          formulaire.pecheur_mail.parents('.form-group').find('.form-text').text('Ce champ est de type email')

          formulaire.pecheur_mail.parents('.form-group').find('.form-text').show();

          formulaire.pecheur_mail.parents('.form-group').addClass('has-error');
          
        }
      }
  
      return valide;
  
    }
  
  })