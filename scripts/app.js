// Copyright 2016 Google Inc.
// 
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
// 
//      http://www.apache.org/licenses/LICENSE-2.0
// 
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.


(function() {
  'use strict';

  var app = {
    visibleCards: {},
    container: document.querySelector('.main')
  }; 
  document.querySelector('#signout_button').onclick = function(){
     localStorage.clear(); 
     hideWelcome();
  }
  var showWelcome = function(username){
     app.visibleCards["welcome_card"] = document.querySelector("#welcome_card");
     app.visibleCards["welcome_card"].style.display = "flex";
     document.querySelector('#welcome_h1').innerHTML = "Welcome "+username
  }
  var hideWelcome = function(){
     app.visibleCards["welcome_card"].style.display = "none";
     delete app.visibleCards["welcome_card"];
     showUsernameCard();
  }

  var showUsernameCard = function(){
     app.visibleCards["username_card"] = document.querySelector('#username_card');
     app.visibleCards["username_card"].style.display = "flex";
     var username_submit = document.querySelector('#username_button');
     username_submit.onclick = function() {
        hideUsernameCard();
        var username = document.querySelector('#username_input').value;
        console.log(username);
        localStorage.setItem("bookclubname", username);
        showWelcome(username);
     }
  }
  var hideUsernameCard = function(){
        var curr_card = app.visibleCards["username_card"];
        curr_card.style.display = "none";
        delete app.visibleCards["username_card"]; 
  }

  //User has logged in before
  if (localStorage.getItem("bookclubname") !== null){
     var username = localStorage.getItem("bookclubname");
     showWelcome(username);
  } else {
     showUsernameCard();
  }
  
  document.querySelector("#pagenumber_button").onclick = function(){
     var pagenumber_input = document.querySelector("#pagenumber_input");
     var pagenumber = pagenumber_input.textContent;
     pagenumber_input.textContent = '';
     
     var xhttp = new XMLHttpRequest();
     xhttp.open("POST", "scripts/pagenumber.php");
     xhttp.send("pagenumber="+pagenumber);  
  }
  document.querySelector("#share_button").onclick = function(){
     var comment = document.querySelector("#comment_input").innerText;
     var xhttp = new XMLHttpRequest();
     xhttp.open("POST", "scripts/comments.php");
     xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
     xhttp.send("user="+encodeURI(localStorage.getItem("bookclubname"))+"&comment="+encodeURI(comment));  
  }    
  document.querySelector("#anonymousshare_button").onclick = function(){
     var comment = document.querySelector("#comment_input").innerText;
     var xhttp = new XMLHttpRequest();
     xhttp.open("POST", "scripts/comments.php");
     xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
     xhttp.send("user=Anonymous&comment="+encodeURI(comment));  
  }
  
 
})();
