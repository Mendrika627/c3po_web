$(() => {
    const formulaire = {
        corps: $('#js-formulaire'), 
        identifiant:$('#js-identifiant'),
        motDePasse:$('#js-mot-de-passe'),
        affiche_mot_de_passe:$('.js-afficher-cacher-mot-de-passe')
    }

    
    formulaire.affiche_mot_de_passe.on('click', e => {
        
        const icone = $(e.currentTarget).find('i');

        if (icone.hasClass('fa-eye-slash')) icone.removeClass('fa-eye-slash').addClass('fa-eye');
    
        else icone.removeClass('fa-eye').addClass('fa-eye-slash');
    
        formulaire.motDePasse.attr('type', icone.hasClass('fa-eye-slash') ? 'password' : 'text');
    
      });

      formulaire.corps.on('submit', e => {

        e.preventDefault();
    
        $.ajax({
    
          url: `${BASE_URL}/connexion/verification`,
    
          method: 'post',
    
          dataType: 'json',
    
          data: genererDonneeVerification(),
    
          success: reponse => {
    
            if(!reponse.autorise) {
    
              $.alert({
    
                title: 'Erreur de conneexion',
    
                content: reponse.message,
    
              });
    
            } else {
    
              location.reload()
    
            }
    
          },
    
          error: (arg1, arg2, arg3) => {
    
            console.log(arg1, arg2, arg3);
    
          }
    
        });
    
      });

      function genererDonneeVerification() {

        return {
    
          identifiant: formulaire.identifiant.val(),
    
          motDePasse: formulaire.motDePasse.val()
    
        };
    
      }
})