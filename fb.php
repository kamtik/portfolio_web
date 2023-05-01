<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<script type="text/javascript">
  function toggleDesc() {
  const updDesc = document.getElementById("updDesc");
  if(updDesc.hidden==true)
    updDesc.hidden = false;
  else
    updDesc.hidden = true;
}
</script>
</head>
<body>
  <a href="index.html"><div id="heading"><table><tbody><tr><td align="left" ><object data="svg/M.svg" width="100" height="100"></object></td><td valign="center"><font size="5">My Movie Review</font></td></tr></tbody></table></div></a>
  <div id="loading">Loading...</div>
  <div id="a1"></div>

  <div><table width="1100"><tbody><tr><td align="right"><button onClick="toggleDesc()" >Update Movie Description Form</button></td></tr></tbody></table></div>
  <div id="updDesc" hidden="true">
    <form id="descForm" action="api/public/movie/update/<?php echo $_GET["id"]; ?>">
      <textarea id="descText" name="description" cols="100" rows="12"></textarea>
      <input id="descButton" type="submit" value="Update Description" />
    </form>
</div>

  <div>Feedbacks : </div>
  <div id="aInput"></div>
  <div>
    <form id="feedbackForm" action="api/public/feedback/insert">
      <input type="hidden" name="movie_id" value="<?php echo $_GET["id"]; ?>" />
      <div>Name: <input type="text" name="name" /></div>
      <div>Rate: <select name="rating">
                   <option value="10">10</option>
                   <option value="9">9</option>
                   <option value="8">8</option>
                   <option value="7">7</option>
                   <option value="6">6</option>
                   <option value="5">5</option>
                   <option value="4">4</option>
                   <option value="3">3</option>
                   <option value="2">2</option>
                   <option value="1">1</option></select></div>
      <div>Comment: <textarea name="comment" cols="100" rows="10" ></textarea></div>
      <div><input id="button" type="submit" value="Add a new feedback!" /></div>
    </form>
    </div>
  <div id="a2"></div>
</body>
<!-- This setup is not suitable for production. -->
<!-- Only use it in development! -->
<script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
<script async src="https://ga.jspm.io/npm:es-module-shims@1.7.0/dist/es-module-shims.js"></script>
<script type="importmap">
{
  "imports": {
    "react": "https://esm.sh/react?dev",
    "react-dom/client": "https://esm.sh/react-dom/client?dev"
  }
}
</script>
<script type="text/babel" >
const api_url_movie =
    "api/public/movie/"+<?php echo $_GET["id"] ?>;

const api_url_fb = "api/public/feedbacks/"+<?php echo $_GET["id"] ?>;
</script>
<script type="text/babel" data-type="module" src="feedback.js">
</script>

<style>
* {
  box-sizing: border-box;
}

body {
  font-family: sans-serif;
  margin: 20px;
  padding: 0;
}

h1 {
  margin-top: 0;
  font-size: 22px;
}

h2 {
  margin-top: 0;
  font-size: 20px;
}

h3 {
  margin-top: 0;
  font-size: 18px;
}

h4 {
  margin-top: 0;
  font-size: 16px;
}

h5 {
  margin-top: 0;
  font-size: 14px;
}

h6 {
  margin-top: 0;
  font-size: 12px;
}

code {
  font-size: 1.2em;
}

ul {
  padding-left: 20px;
}

img { margin: 0 10px 10px 0; height: 90px; }

</style>
</html>
