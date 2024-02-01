const BASE_URL = 'http://192.168.88.238/c3p';

$(() => {

  // Désactiver la prise en charge des roulette de souris

  $(document).on('focus', 'input[type=number]', e => {

    $(e.currentTarget).select()

    $(e.currentTarget).on('wheel', e => {

      e.preventDefault()

    });

  });



  $(document).on('blur', 'input[type=number]', e => {

    $(e.currentTarget).off('wheel')

  })



  $('input[type=date]').trigger('change')



  $('input[type=number]').each((indexe, elementCible) => {

    if ($(elementCible).attr('min') === undefined) {

      $(elementCible).attr('min', 0);

    }

  })




});

function validateEmail(email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

function entierNaturelPositif(nombre){
  var valide = false;
  var valeur = Number(nombre)
  if(nombre>=0){
    if(Number.isInteger(valeur)){
      valide = true;
    }
  }
  return valide
}
function entierNaturelNegatif(nombre){
  var valide = false;
  var valeur = Number(nombre)
  if(nombre<0){
    if(Number.isInteger(valeur)){
      valide = true;
    }
  }
  return valide
}

function actualiserListeBassin(pays) {

  return new Promise((resolve, reject) => {


      $.ajax({

        method: 'post',

        data:{pays:pays},

        url: `${BASE_URL}/bassin_versant/selectionner_par_pays`,

        dataType: 'json',

        success: bassins => resolve(bassins),

        error: (arg1, arg2, arg3) => reject([arg1, arg2, arg3])

      })


  })

}
