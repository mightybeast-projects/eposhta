window.addEventListener('keydown', handleKey);

function handleKey(event){
   //Ctrl
   if (event.keyCode === 17) {
      window.addEventListener('keydown', handleCombination);
   }
   //Esc
   if (event.keyCode === 27) {
      exitScreen();
   }
   //F1
   if (event.keyCode === 112) {
      event.preventDefault();
      redirect("../requests/accept-package.php");
   }
   //F2
   if (event.keyCode === 113) {
      event.preventDefault();
      redirect("../requests/give-package.php");
   }
   //F3
   if (event.keyCode === 114) {
      event.preventDefault();
      redirect("../php/visit-page.php");
   }
   //F4
   if (event.keyCode === 115) {
      event.preventDefault();
      redirect("../php/visit-page.php");
   }
}

function handleCombination(event){
   //Ctrl+Enter
   if (event.keyCode === 13) {
      setTimeout(function(){
         createInvoice();
      },100);
   }
}

function exitScreen(){
   if(window.location.href == "http://localhost/EPoshta/php/visit-page.php"){
      setTimeout(function(){
         window.location.href = "../requests/exit-to-main-page.php";
      },100);
   }
   else if(window.location.href == "http://localhost/EPoshta/php/new-package-page.php"){
      setTimeout(function(){
         window.location.href = "../requests/cancel-accept.php";
      },100);
   }
   else if(window.location.href == "http://localhost/EPoshta/php/created-invoice-page.php"){
      setTimeout(function(){
         window.location.href = "../php/visit-page.php";
      },100);
   }
}

function redirect(url){
   setTimeout(function(){ 
      window.location.href = url;
   },100);
}