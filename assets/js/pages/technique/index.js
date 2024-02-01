$(() => {


    const formulaireInsertion = {
  
        corps: $('#js-formulaire-insertion'),

        nomTechniqueNiv1: $('#js-formulaire-insertion .js-nom-technique-niv-1'),
    
        descriptionTechniqueNiv1: $('#js-formulaire-insertion .js-description-technique-niv-1')
  
    };
  
    formulaireInsertion.soumission = formulaireInsertion.corps.parents('.modal').find('.js-enregistrer');

    const formulaireInsertion2 = {
  
        corps: $('#js-formulaire-insertion-2'),

        nomTechniqueNiv2: $('#js-formulaire-insertion-2 .js-nom-technique-niv-2'),

        idTechniqueNiv1: $('#js-formulaire-insertion-2 .js-id-technique-niv-1'),
    
        descriptionTechniqueNiv1: $('#js-formulaire-insertion-2 .js-description-technique-niv-2')
  
    };

    formulaireInsertion2.soumission = formulaireInsertion2.corps.parents('.modal').find('.js-enregistrer');


    const formulaireModification = {
  
        corps: $('#js-formulaire-modification'),

        id: $('#js-formulaire-modification .js-id'),

        nomTechniqueNiv1: $('#js-formulaire-modification .js-nom-technique-niv-1'),
    
        descriptionTechniqueNiv1: $('#js-formulaire-modification .js-description-technique-niv-1')
  
    };
  
    formulaireModification.soumission = formulaireModification.corps.parents('.modal').find('.js-enregistrer');



    $('[data-target="#modal-insertion"]').on('click', () => {
  
      initialiserFormulaire(formulaireInsertion)
  
    })

    $('[data-target="#modal-insertion-2"]').on('click', () => {

    
        const chargeurInformationInsertion2 = $('#chargeur-information-insertion-2')
        const modal_2 = $('#modal-insertion-2')
        const formulaire = $('#js-formulaire-insertion-2')
        const boutonEnregisrer = $('#js-enregistrer-2')
        const selectTechniqueNiv1 = $('#insert-technique-niv-1')

        formulaire.hide()
        chargeurInformationInsertion2.show()
        boutonEnregisrer.attr('disabled', true)
        // modal_2.modal('show')
        // Sélection des informations à modifier
        $.ajax({
            url: `${BASE_URL}/technique/Niveau1/liste`,
            method: 'get',
            dataType: 'json',
            success: reponse => {
                const technique_niv_1 = reponse.technique_niv_1;
                console.log(technique_niv_1)
                initialiserFormulaire2(formulaireInsertion2);

                selectTechniqueNiv1.html('')
                
                selectTechniqueNiv1.append(`
                    <option value="" selected hidden></option>
                `)
                
                technique_niv_1.forEach(function(niv_1){
                    selectTechniqueNiv1.append(`
                    <option value="`+niv_1.technique_niv_1_id+`">`+niv_1.technique_niv_1_nom+`</option>
                `)
                })

                formulaire.show()
                chargeurInformationInsertion2.hide()
                boutonEnregisrer.removeAttr('disabled')
            }
        });
  
  
    })

    function initialiserFormulaire(formulaire) {
  
      formulaire.corps.trigger('reset');
  
      // formulaire.motDePasse.attr('type', 'text');
  
      // formulaire.afficherChacherMotDePasse.find('i').removeClass('fa-eye-slash').addClass('fa-eye');
  
      formulaire.nomTechniqueNiv1.parents('.form-group').show();
  
    }

    function initialiserFormulaire2(formulaire) {
  
      formulaire.corps.trigger('reset');
  
      // formulaire.motDePasse.attr('type', 'text');
  
      // formulaire.afficherChacherMotDePasse.find('i').removeClass('fa-eye-slash').addClass('fa-eye');
  
      formulaire.nomTechniqueNiv2.parents('.form-group').show();
  
    }




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
  
        url: BASE_URL + '/technique/Niveau1/datatable',
  
        method: 'post',
  
      },
});


var datatable_2 = $('#datatable-2').DataTable({
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
  
        url: BASE_URL + '/technique/Niveau2/datatable',
  
        method: 'post',
  
      },
});

$(document).on('recharger-datatable', () => {
  
      datatable.ajax.reload();
      datatable_2.ajax.reload();
  
});


$(document).on('click', '.delete-button', e => {
    var information = $(e.currentTarget).attr('data-target');
    jConfirmRed('Supprimer la sélection', 'La suppression pourra entraîner la perte d\'autres données relatives à celle-ci.\nVeuillez confirmer la suppression', () => {
        $.ajax({
            url: BASE_URL + '/technique/Niveau1/suppression/' + information,
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
        url: `${BASE_URL}/technique/Niveau1/selectionner/${id}`,
        method: 'get',
        dataType: 'json',
        success: reponse => {
            const technique_niv_1 = reponse.technique_niv_1;
            initialiserFormulaire(formulaireModification);
            formulaireModification.id.val(id);
            formulaireModification.nomTechniqueNiv1.val(technique_niv_1.technique_niv_1_nom).trigger('change');
            formulaireModification.descriptionTechniqueNiv1.val(technique_niv_1.technique_niv_1_description).trigger('change');
            formulaire.show()
            chargeurInformationModification.hide()
            boutonEnregisrer.removeAttr('disabled')
        }
    });
});


});