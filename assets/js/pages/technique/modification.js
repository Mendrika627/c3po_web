$(() => {
    const formulaire = {
        corps: $('#js-formulaire-modification'),
  
        id: $('#js-formulaire-modification .js-id'),

        nomTechniqueNiv1: $('#js-formulaire-modification .js-nom-technique-niv-1'),
    
        descriptionTechniqueNiv1: $('#js-formulaire-modification .js-description-technique-niv-1')
    }

    formulaire.soumission = $('#js-enregistrer-modification');

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
                    url: `${BASE_URL}/technique/Niveau1/modification`,
  
                    data: donneesFormulaire(),
        
                    type: 'post',
        
                    dataType: 'json'
                }).done((reponse) => {

                    if (!reponse.succes) {
  
                        attente.onDestroy = () => {
        
                            $(document).trigger('recharger-datatable');
            
                            $('#modal-modification').modal('hide');
        
                        }
        
                        attente.setContent('Une technique de pêche avec le même nom existe déjà dans la base de données!')
        
                        attente.setTitle('Error')
        
                    }else {
  
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
        return {
  
            technique_niv_1_id: formulaire.id.val(),
    
            technique_niv_1_nom: formulaire.nomTechniqueNiv1.val(),
    
            technique_niv_1_description: formulaire.descriptionTechniqueNiv1.val()
  
      }
    }

});