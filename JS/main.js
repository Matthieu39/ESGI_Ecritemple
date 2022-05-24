/*La fonction pour faire dérouler le menu principale*/
var content = document.querySelector('#hamburger-content');
var topbarBody = document.querySelector('#hamburger-topbar-body');
var button = document.querySelector('#hamburger-button');
var overlay = document.querySelector('#hamburger-overlay');
var activatedClass = 'hamburger-activated';
topbarBody.innerHTML = content.innerHTML;

button.addEventListener('click', function(e) {
  e.preventDefault();

  this.parentNode.classList.add(activatedClass);
});

overlay.addEventListener('click', function(e) {
  e.preventDefault();
  this.parentNode.classList.remove(activatedClass);
});


/*Fonction compteur de caractère*/
function reste(texte)
{
    var restants=1000-texte.length;
    document.getElementById('caracteres').innerHTML=restants;
}
