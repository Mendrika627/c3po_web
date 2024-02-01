$(() => {
    const modal = $('#modal-insertion')

    const modal_2 = $('#modal-insertion-2')

    const formulaire = {
  
      corps: $('#js-formulaire-insertion'),

      nomTechniqueNiv1: $('#js-formulaire-insertion .js-nom-technique-niv-1'),
  
      descriptionTechniqueNiv1: $('#js-formulaire-insertion .js-description-technique-niv-1')
  
    };

    const formulaire_2 = {
  
        corps: $('#js-formulaire-insertion-2'),

        nomTechniqueNiv2: $('#js-formulaire-insertion-2 .js-nom-technique-niv-2'),

        idTechniqueNiv1: $('#js-formulaire-insertion-2 .js-id-technique-niv-1'),
    
        descriptionTechniqueNiv2: $('#js-formulaire-insertion-2 .js-description-technique-niv-2')
  
    };

    formulaire.soumission = formulaire.corps.parents('.modal').find('.js-enregistrer');

    formulaire_2.soumission = formulaire_2.corps.parents('.modal').find('.js-enregistrer');

    formulaire.soumission.on('click', () => {
  
      console.log('submit')
  
      formulaire.corps.trigger('submit');
  
    });

    formulaire_2.soumission.on('click', () => {
  
      console.log('submit')
  
      formulaire_2.corps.trigger('submit');
  
    });

    formulaire.corps.on('submit', e => {
        e.preventDefault();
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
  
                        url: `${BASE_URL}/technique/Niveau1/insertion`,
            
                        data: donneesFormulaire(),
            
                        type: 'post',
            
                        dataType: 'json'
        
                    }).done((reponse) => {
                        if (!reponse.succes) {

                            attente.onDestroy = () => {
            
                                $(document).trigger('recharger-datatable');
                
                                modal.modal('hide');
            
                            }
            
                            attente.setContent('Une technique de pêche portant le même nom existe déjà dans la base!')
            
                            attente.setTitle('Erreur')
            
                        }else {
  
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
            });
        }
    });

    formulaire_2.corps.on('submit', e => {
        e.preventDefault();
        console.log(donneesFormulaire2())
        if (champObligatoireOk2()) {
            console.log('sending')
            const attente = $.alert({
                useBootstrap: true,
  
                theme: 'bootstrap',
        
                animation: 'rotatex',
        
                closeAnimation: 'rotatex',
        
                animateFromElement: false,

                content: function () {
                    return $.ajax({
  
                        url: `${BASE_URL}/technique/Niveau2/insertion`,
            
                        data: donneesFormulaire2(),
            
                        type: 'post',
            
                        dataType: 'json'
        
                    }).done((reponse) => {
                        if (!reponse.succes) {

                            attente.onDestroy = () => {
            
                                $(document).trigger('recharger-datatable');
                
                                modal_2.modal('hide');
            
                            }
            
                            attente.setContent('Une technique de pêche de niveau 2 portant le même nom existe déjà dans la base!')
            
                            attente.setTitle('Erreur')
            
                        }else {
  
                            attente.onDestroy = () => {
            
                                $(document).trigger('recharger-datatable');
                
                                modal_2.modal('hide');
            
                            }
            
                            attente.setContent('L\'insertion a été effectuée avec succès')
            
                            attente.setTitle('Succès')
            
                        }
                    }).fail(() => {
  
                            attente.setContent('Une erreur est survenue. Veuillez reessayer ou contacter un administrateur')
                
                            attente.setTitle('Erreur')
            
                        })
                }
            });
        }
    });

    function donneesFormulaire() {
        return {

            technique_niv_1_nom: formulaire.nomTechniqueNiv1.val(),
    
            technique_niv_1_description: formulaire.descriptionTechniqueNiv1.val()
      }
    }

    function donneesFormulaire2() {
        return {

            technique_niv_2_nom: formulaire_2.nomTechniqueNiv2.val(),

            technique_niv_2_technique_niv_1: parseInt(formulaire_2.idTechniqueNiv1.val()),
    
            technique_niv_2_description: formulaire_2.descriptionTechniqueNiv2.val()
      }
    }

    function supprimerValidation() {
  
      $('.form-text').hide();
  
      $('.has-error').removeClass('has-error');
  
    }


    function champObligatoireOk() {
        let valide = true;
        const requises = [
        formulaire.nomTechniqueNiv1
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
      return valide;
    }
    function champObligatoireOk2() {
        let valide = true;
        const requises = [
        formulaire_2.nomTechniqueNiv2,
        formulaire_2.idTechniqueNiv1
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
      return valide;
    }


});