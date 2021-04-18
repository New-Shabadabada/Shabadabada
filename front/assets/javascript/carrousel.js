// console.log('%c' + "carrousel.js loaded", 'color:#0bf; font-size:1rem; background-color:#fff');


// const carrousel = {

    
//     init: function(){

//         //console.log('initialisation du carousel');

//         let itemClassName = "person";
//         items = document.getElementsByClassName(itemClassName),
//         console.log(items);
//         totalItems = items.length,
//         console.log(totalItems);
//         slide = 0,
//         moving = true; 

//         carrousel.setInitialClasses();

//         // ciblage des boutons d'affichage de "diapositive"
//         let previousButton = document.querySelector('.previous-button');
//         //console.log(previousButton);
//         let nextButton = document.querySelector('.next-button');
//         //console.log(nextButton);

//         // pour chaque bouton récupéré, nous allons enregistrer un event listener sur le click
    
//         previousButton.addEventListener('click', carrousel.handleMovePrev);
//         nextButton.addEventListener('click', carrousel.handleMoveNext);
//         //carrousel.startAutoSlide();
//         //console.log(buttons);
//     },

//     setInitialClasses(){
//         console.log('ici');
//         let itemClassName = "person";
//         items = document.getElementsByClassName(itemClassName),
//         console.log(items);
        
        
//     //let prevItem = items[totalItems - 1].classList.add("prev");
//     //console.log(prevItem);
//     //items[0].classList.add("active");
//     //items[1].classList.add("next");
//     },



//     handleMoveNext: function(event) {
//         //console.log('next');
//         // cibles les éléments à afficher
//         let items = document.querySelectorAll('.person');
//         //console.log(items);
        
        

//     },

//     handleMovePrev: function() {
//         //console.log('prev');
//     }



    

// }


// document.addEventListener('DOMContentLoaded',carrousel.init);