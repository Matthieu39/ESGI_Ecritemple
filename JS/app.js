/*Fonction pour la barre de recherche */
function onKeyUp(){
  const searchuser = document.getElementById("search_user");
  // var searchuserlist = document.getElementById("search-user-list");

  const user = searchuser.innerHTML;
  console.log(user);
  // if (product.value.length >= 3) {
  //   var ajax = new XMLHttpRequest();
  //   ajax.open("GET", "get-products.php?product=" + product.value, true);
  //
  //   ajax.onreadystatechange = function(){
  //     if (this.readyState == 4 && this.status == 200) {
  //       console.log(this.responseText);
  //     }
  //   };
  //   ajax.send();
  //
  // }

}
// function onKeyUp(){
//   const searchuser = document.getElementById("search-user");
//   // var searchuserlist = document.getElementById("search-user-list");
//
//   const user = searchuser.value;
//   console.log(user);
//   // if (product.value.length >= 3) {
//   //   var ajax = new XMLHttpRequest();
//   //   ajax.open("GET", "get-products.php?product=" + product.value, true);
//   //
//   //   ajax.onreadystatechange = function(){
//   //     if (this.readyState == 4 && this.status == 200) {
//   //       console.log(this.responseText);
//   //     }
//   //   };
//   //   ajax.send();
//   //
//   // }
//
// }

// function search() {
//  const sInput = document.getElementById('search_user');
//  const user =sInput.value;
//
//  if (user != ""){
//    const request = new XMLHttpRequest();
//    request.open('GET', 'user.php?user=' + user);
//   request.onreadystatechange = function() {
//     if(request.readyState === 4) {
//         const b = document.getElementById('result-search');
//        b.innerHTML=request.responseText;
//     }else {
//        // ("Oupps!!aucun utilisateur trouver pour cette recherche!");
//     }
//   };
//     request.send();
//   }
// }
