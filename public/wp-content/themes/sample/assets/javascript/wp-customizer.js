document.addEventListener("DOMContentLoaded", function() {
  // on utilise la bibliotèque js de worpress pour gérer le customizer

  // on vérifie si wordpress a chargé le composant js "customizer"
  if(typeof(wp.customize) !== 'undefined') {
    console.log('Customizer loaded');

    wp.customize(
      "header-image",  // nom de la variable que l'on surveille
      function( value ) {
        // fonction js qui se déclenche lorsque la variable a changé de valeur depuis le customizer
        value.bind( function( newValue ) {

          let header = document.querySelector('.customizer.header');
          console.log(header);
          console.log(newValue);
          header.style.backgroundImage = 'url(' + newValue +')';
        });
      }
    );


    wp.customize(
      "header-color",  // nom de la variable que l'on surveille
      function( value ) {
        // fonction js qui se déclenche lorsque la variable a changé de valeur depuis le customizer
        value.bind( function( newValue ) {

          let header = document.querySelector('.customizer.header');
          console.log(header);
          console.log(newValue);
          header.style.color = newValue;
        });
      }
    );
  }


});
