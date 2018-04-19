<!--
 Copyright 2016 Google Inc.
 
 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at
 
      http://www.apache.org/licenses/LICENSE-2.0
 
 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
-->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Cache-control" content="no-cache">
  <link rel="canonical" href="https://weather-pwa-sample.firebaseapp.com/final/">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Club</title>
  <link rel="stylesheet" type="text/css" href="styles/inline.css">
  
  <!-- TODO add manifest here -->
</head>
<body>

  <header class="header">

    <h1 class="header__title">Book Club - Be gentle with the website bad inputs break everything.</h1>
    <button id="refresh_button" class="headerButton" aria-label="Refresh"></button>
    <button id="add_button" class="headerButton" aria-label="Add"></button>
  </header>
  <main class="main">
    <div class="card" id="username_card">
      <h1>Username</h1>
      <label>Username:</label><input id="username_input" type=text>
      <button type="button" id='username_button'>Submit</button>
    </div>
    <div class="card" id="welcome_card">
      <h1 id='welcome_h1'></h1>
      <button type="button" id='signout_button'>Sign Out</button>      
      <label>How far have you read this week? (Integer)</label><span contenteditable="true" id="pagenumber_input" type=text></span>
      <button type="button" id='pagenumber_button'>Submit</button>      
      <label>Anything you'd like to share?</label>
      <span contenteditable="true" id="comment_input"></span>
      <button type="button" id='share_button'>Submit</button>      
      <button type="button" id='anonymousshare_button'>Submit Anonymously</button>      
    </div>
    <?php 
     $server = "127.0.0.1";
     $conn = mysqli_connect($server, "root", "", "bookclub");
     if (mysqli_connect_errno())
     {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
     }
     $request = "SELECT * FROM comments ";
     $result = mysqli_query($conn, $request);
     if($result->num_rows >0) {
        while($row = $result->fetch_assoc()){
          echo "<div class='comment'>\n 
                <label>".$row['User']."</label>".$row['Comment']."\n".$row['time'].
               "\n</div>\n";
        }
     }
     mysqli_close($conn); 
    ?> 
    
  </main>
    
  <script src="scripts/app.js" async></script>

</body>
</html>
