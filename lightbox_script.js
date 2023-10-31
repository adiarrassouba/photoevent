// On définit les variables pour stocker les éléments du DOM afin de les manipuler (sélection de la lightbox et du bouton close)
let closeButtonLightbox = document.querySelector('.lightbox__close'); //bouton fermeture lightbox
const lightbox = document.querySelector('.lightbox'); //modal lightbox
let dataList = []; // tableau pour stocker les datas relatives aux photos
let currentIndex = 0;

//fonction pour construire un tableau des données de tout les Post affichés
function initialiserDataLightbox() {
    //recupere toute les photos de la page home
    let htmlPostsElement = document.querySelectorAll('.gallery-img');
    //pour chaque photo, on recupere les infos qu'on a besoin en javascript
    htmlPostsElement.forEach(htmlPostElement => {
        let img = htmlPostElement.querySelector('img').src;
        let titre = htmlPostElement.querySelector('.gallery-titre').textContent
        let reference = htmlPostElement.querySelector('.gallery-reference').textContent
        let category = htmlPostElement.querySelector('.gallery-category').textContent
        let id = htmlPostElement.querySelector('.gallery-id').textContent

        let slide = { img: img, titre: titre, reference: reference, category: category, id: id };
        dataList.push(slide);
    })
}

// affiche la lightbox en fonction de l'index passé en parametre
function afficherLightbox(index) {
    let slide = dataList[index];
    let imgModal = lightbox.querySelector(".lightbox__container img");
    imgModal.src = slide.img;
    lightbox.querySelector('.lightbox__reference').innerHTML = slide.reference
    lightbox.querySelector('.lightbox__category').innerHTML = slide.category

    //on affiche la lightbox en changeant le css Display 
    lightbox.style.display = "block";
}

closeButtonLightbox.addEventListener("click", function(e){
    lightbox.style.display = "none";
});

// EVENT DELEGATION SETUP
//pour les elements ajax qui apparaissent plus tard, sinon l'event click ne fonctionne pas
document.querySelector('.gallery-container').addEventListener('click', function(event) {
    // If the clicked element doesn't match our selector, bail
    if (!event.target.matches('.icon-full')) return;
    // Otherwise, run your code...
    clickIconFull(event);
});

function clickIconFull (event) {
    event.preventDefault();
    initialiserDataLightbox(); //initialise le tableau des données de tout les posts
    if(dataList.length == 0) return; //si aucune donnée on ne fait rien.
    
    //recherche l'ID correspondant au Post sur lequel on cliqué sur l'icone, 
    //pour rechercher les éléments necessaires dans le tableau
    let id = event.target.closest(".gallery-img").querySelector(".gallery-id").textContent;
    //via l'ID, on cherche l'index correspondant à celui ci dans le tableau :
    currentIndex = dataList.findIndex(slide => slide.id == id);
    afficherLightbox(currentIndex);
   }

    // FLÈCHES DE NAVIGATION DE LA LIGHTBOX
    lightbox
        .querySelector(".lightbox__prev")
        .addEventListener("click", function (e) {
            e.preventDefault();
            currentIndex--;
            if(currentIndex < 0) {
                currentIndex = dataList.length - 1;
            }
            afficherLightbox(currentIndex);
        });

    lightbox
        .querySelector(".lightbox__next")
        .addEventListener("click", function (e) {
            e.preventDefault();
            currentIndex++;
            if(currentIndex >= dataList.length) {
                currentIndex = 0;
            }
            afficherLightbox(currentIndex);
        });