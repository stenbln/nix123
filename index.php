<!DOCTYPE html>
<html lang="en">
<head>
<meta property="og:url"                content="http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="When Great Minds Don’t Think Alike" />
<meta property="og:description"        content="How much does culture influence creative thinking?" />
<meta property="og:image"              content="http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg" />

<script
  src="https://code.jquery.com/jquery-3.1.1.js"
  integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
  crossorigin="anonymous"></script>
</head>
<body>
<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1021378104655956',
      xfbml      : true,
      version    : 'v2.8'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>


<h3>Sharing Links</h3>





<span>Go Live Dialog</span></br>
<button id="liveButton">Create Live Stream To Facebook</button>
<script>
document.getElementById('liveButton').onclick = function() {
  FB.ui({
    display: 'popup',
    method: 'live_broadcast',
    phase: 'create',
}, function(response) {
    if (!response.id) {
      alert('dialog canceled');
      return;
    }
    alert('stream url:' + response.secure_stream_url);
    FB.ui({
      display: 'popup',
      method: 'live_broadcast',
      phase: 'publish',
      broadcast_data: response,
    }, function(response) {
    alert("video status: \n" + response.status);
    });
  });
};
</script>
</body>
</html>
