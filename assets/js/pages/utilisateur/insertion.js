$(() => {

    const modal = $('#modal-insertion')
  
    const formulaire = {
  
      corps: $('#js-formulaire-insertion'),
  
      groupe: $('#js-formulaire-insertion .js-groupe'),
  
      nomUtilisateur: $('#js-formulaire-insertion .js-nom-utilisateur'),
  
      identifiant: $('#js-formulaire-insertion .js-identifiant'),
  
      motDePasse: $('#js-formulaire-insertion .js-mot-de-passe'),
  
      afficherChacherMotDePasse: $('#js-formulaire-insertion .js-afficher-cacher-mot-de-passe'),
  
    };
  
    formulaire.soumission = formulaire.corps.parents('.modal').find('.js-enregistrer');
  
    formulaire.iconeAfficherChacherMotDePasse = formulaire.corps.parents('.modal').find('.js-enregistrer');
  
    formulaire.afficherChacherMotDePasse.on('click', e => {
  
      const icone = $(e.currentTarget).find('i');
  
      if (icone.hasClass('fa-eye-slash')) icone.removeClass('fa-eye-slash').addClass('fa-eye');
  
      else icone.removeClass('fa-eye').addClass('fa-eye-slash');
  
      formulaire.motDePasse.attr('type', icone.hasClass('fa-eye-slash') ? 'password' : 'text');
  
    });
  
  
  
    formulaire.soumission.on('click', () => {
  
      console.log('submit')
  
      formulaire.corps.trigger('submit');
  
    });
  
  
  
    formulaire.corps.on('submit', e => {
  
      e.preventDefault();
  
      console.log('submitting')

      console.log(champObligatoireOk())
  
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
  
              url: `${BASE_URL}/utilisateur/insertion`,
  
              data: donneesFormulaire(),
  
              type: 'post',
  
              dataType: 'json'
  
            }).done((reponse) => {
  
              if (!reponse.succes) {
  
                attente.setContent('Une erreur est survenue. Veuillez reessayer ou contacter un administrateur')
  
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
  
      return {
  
        nomUtilisateur: formulaire.nomUtilisateur.val(),
  
        motDePasse: formulaire.motDePasse.val(),
  
        identifiant: formulaire.identifiant.val(),
  
        groupe: formulaire.groupe.val(),
  
      }
  
    }
  
  
  
    function supprimerValidation() {
  
      $('.form-text').hide();
  
      $('.has-error').removeClass('has-error');
  
    }
  
  
  
    function champObligatoireOk() {
  
      let valide = true;
  
      const requises = [
  
        formulaire.groupe,
  
        formulaire.identifiant,
  
        formulaire.motDePasse,

        formulaire.nomUtilisateur
  
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
      if(formulaire.identifiant.val() !== ''){

        if(!validateEmail(formulaire.identifiant.val())){

          valide = false

          formulaire.identifiant.parents('.form-group').find('.form-text').text('Ce champ est de type email')

          formulaire.identifiant.parents('.form-group').find('.form-text').show();

          formulaire.identifiant.parents('.form-group').addClass('has-error');
          
        }
      }
  
      return valide;
  
    }
  
  })