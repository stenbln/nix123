<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
</head>
<body>
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '579475388777062',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log(response);
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
  
  function logout(){
    FB.logout(function(response) {
      // user is now logged out
      console.log("User is logged out now, below is a response object when user logs out");
      console.log(response);
      statusChangeCallback(response);
    });
  }
</script>


<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<fb:login-button scope="public_profile,email,manage_pages" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>
<div id="pageBtn" class="btn btn-success clearfix">Click me to show the list of Pages you admin.</div>
<ul id="pagesList" class="btn-group btn-group-vertical clearfix"></ul>
  
<span id="pageName" class="label label-success">No page selected</span>
<span id="pageToken" class="label label-success">No page selected</span>
<p><a id="pageLink" href="#">Chosen Page</a> </p>

  
<button type="button" onclick="logout()">Logout!</button>

  
    
<script>
 //STIL TO DO: CHECK PAGINATION
 //Function for showing fan Pages that person admins
document.getElementById('pageBtn').onclick = function() {
  FB.api('/me/accounts?fields=name,access_token,link', function(response) {
    console.log('API response', response);
    var list = document.getElementById('pagesList');
    
    //Delete all child elements of the ul element (otherwise elements will be appended again)
    var listNode = list;
    while (listNode.firstChild) {
      listNode.removeChild(listNode.firstChild);
    }
    
    for (var i=0; i < response.data.length; i++) {
      var li = document.createElement('li');
      li.innerHTML = response.data[i].name;
      li.dataset.token = response.data[i].access_token;
      li.dataset.link = response.data[i].link;
      li.className = 'btn btn-mini';
      li.onclick = function() {
        document.getElementById('pageName').innerHTML = "Page Name" + this.innerHTML;
        document.getElementById('pageToken').innerHTML = "Page Token" + this.dataset.token;
        document.getElementById('pageLink').setAttribute('href', this.dataset.link);
      }
      list.appendChild(li);
    }
  });
  return false;
}  
</script>
</body>
</html>
