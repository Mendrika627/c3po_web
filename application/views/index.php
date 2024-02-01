<!doctype html>

<html lang="en">



<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="icon" type="image/jpg" href="<?= img_url('favicon.jpg') ?>">

  <title><?= $title = isset($title) && !empty($title) ? $title : 'NouveauProjet'; ?></title>

  <?php if (isset($default_stylesheets)) echo charger_css($default_stylesheets); ?>

  <?php if (isset($custom_stylesheets)) echo charger_css($custom_stylesheets); ?>

  <style>

    html,

    body {

      user-select: none;

      -moz-user-select: none;

      -moz-user-select: none;

    }

    

    .login-page{
      /* background-color:'purple'; */
      /* background: 'purple'; */
    }



    /* Chrome, Safari, Edge, Opera */

    input[type=number]::-webkit-outer-spin-button,

    input[type=number]::-webkit-inner-spin-button {

      -webkit-appearance: none;

      margin: 0;

    }



    /* Firefox */

    input[type=number] {

      -moz-appearance: textfield;

    }



    .js-date-enquete {

      min-width: 150px;

    }




  


    

    .content-bienvenue {

      background: rgb(47,82,143);

      background: linear-gradient(180deg, rgba(47,82,143,1) 44%, rgba(47,92,172,1) 59%, rgba(55,105,196,1) 100%);

    }

    

    .conteneur-bienvenue {

      display: flex;

      flex-direction: column;

      -ms-flex-align: center;

      align-items: center;

      height: calc(100vh - 57px);

      justify-content: center;

    }
    

    .content-bienvenue {

      text-align: center;

      color: rgba(47,82,143,1);

      font-size: 3em;

      padding: 10px;

      background: rgb(255, 255, 255);

      width: 100%;

    }
    .toggle-group {
  display: inline-block;
  position: relative;
  width: 60px;
  height: 34px;
}

.toggle-group input[type="checkbox"] {
  display: none;
}

.label-checkbox {
  display: inline-block;
  position: absolute;
  top: 0;
  left: 0;
  width: 40px;
  height: 20px;
  border-radius: 15px;
  background-color: #dddddd;
  transition: background-color 0.2s;
}

.toggle-group input[type="checkbox"]:checked + .label-checkbox {
  background-color: #4CAF50;
}

.toggle-group .label-checkbox:after {
  content: "";
  display: block;
  position: absolute;
  width: 15px;
  height: 13px;
  top: 4px;
  left: 4px;
  border-radius: 50%;
  background-color: white;
  box-shadow: 1px 3px 3px 1px rgba(0, 0, 0, 0.05);
  transition: 0.2s;
}

.toggle-group input[type="checkbox"]:checked + .label-checkbox:after {
  left: calc(100% - 4px);
  transform: translateX(-100%);
}
.toggle-group span {
  display: block;
  margin-left: 25px;
}

    
    

  </style>

  <noscript>Les scripts ne sont pas pris en charge par ce navigateur. Veuillez activer ce module au risque que certaines foncitonnalités ne foncitonnera pas comme prévu</noscript>

</head>



<body <?php if (isset($body_classes)) echo charger_classes($body_classes); ?>>

  <?= $routes = isset($routes) && !empty($routes) ? $routes : ''; ?>

  <?php if (isset($default_javascripts)) echo charger_js($default_javascripts); ?>

  <?php if (isset($custom_javascripts)) echo charger_js($custom_javascripts); ?>

  <script type="text/javascript">

    $(() => {

      $('#js-bouton-deconnexion').on('click', e => {

        confirmerDeconnexion(() => {

          location.href = `${BASE_URL}/deconnexion.html`;

        })

      })

    })

  </script>

</body>



</html>