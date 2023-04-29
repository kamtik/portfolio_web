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
<script type="text/babel" data-type="module">
import React, { StrictMode } from 'react';
import { createRoot } from 'react-dom/client';


function Rating({ rate }) {
    if(rate==-1)
      return (<><font size="3">average rating: </font><font size="5">N/A</font></>);
    else
      return (<><font size="3">average rating: </font><font size="8">{rate}</font><font size="4">/10</font></>);
}

function Title({ name }) {
    return (<font size="8">{name}</font>)
}

function Picture({ img }) {
  if(img)
     return (<img src={'img/'+img} className="titleImg" />);
  else
     return (<img src="img/na.png" className="titleImg" />);
}

// function Feedback({ cnt }) {
//   return (<font size="4">Feedbacks (Total: {cnt}) :</font>);
// }

let Info = function MyInfo(props) {
  return (
    <div className="topInfo">
      <table>
      <tbody>
        <tr>
          <th><table height="500" width="740"><tbody><tr height="80"><th align="left" valign="top"><Title name={props.name} /></th><th align="right" valign="top"><Rating rate={props.rate} /></th></tr><tr height="130"><th colSpan="2" valign="top" align="left">{props.description}</th></tr><tr><th colSpan="2" align="right"></th></tr></tbody></table></th>
          <th><Picture img={props.img} /></th>
        </tr>
      </tbody>
      </table>
    </div>
  );
}

function DeleteButton ({id}) {
  const handleClick = (e) => {
    e.preventDefault();
    deleteFb({id});
  }

  return (
    <button onClick={handleClick}>Delete</button>
  );
}

let FeedbackBox = function MyFeedbackBox(props) {
  return (
    <div className="fbBox" id={props.id} >
      <table width="1100">
      <tbody>
        <tr>
          <th align="left" width="400">Name: {props.name}</th>
          <th align="left">Rating: {props.rate}</th>
          <th align="right"><DeleteButton id={props.id} /></th>
        </tr>
        <tr>
          <th colSpan="3" align="left">Comment: {props.comment}</th>
        </tr>
      </tbody>
      </table>
    </div>
  );
}

let FeedbackInput = function FbInput(props) {
  return (
    <div>
    <form id="feedbackForm" action="api/feedback/Insert">
      <div>Name: <input type="text" name="name" /></div>
      <div>Rate: <select name="rate">
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
      <div>Comment: <textarea name="comment" cols="100" rows="10" /></div>
      <div><input type="submit" value="Add a new feedback!" /></div>
    </form>
    </div>
  );
}




//const aInput = createRoot(document.getElementById('aInput'));
//aInput.render(<FeedbackInput />);


const api_url_movie =
    "api/public/movie/"+<?php echo $_GET["id"] ?>;

const api_url_fb = "api/public/feedbacks/"+<?php echo $_GET["id"] ?>;

async function postFormDataAsJson({ url, formData }) {
	const plainFormData = Object.fromEntries(formData.entries());
	const formDataJsonString = JSON.stringify(plainFormData);

	const fetchOptions = {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
			Accept: "application/json",
		},
		body: formDataJsonString,
	};

	const response = await fetch(url, fetchOptions);

	if (!response.ok) {
		const errorMessage = await response.text();
		throw new Error(errorMessage);
	}

	return response.json();
}

async function putFormDataAsJson({ url, formData }) {
	const plainFormData = Object.fromEntries(formData.entries());
	const formDataJsonString = JSON.stringify(plainFormData);

	const fetchOptions = {
		method: "PUT",
		headers: {
			"Content-Type": "application/json",
			Accept: "application/json",
		},
		body: formDataJsonString,
	};

	const response = await fetch(url, fetchOptions);

	if (!response.ok) {
		const errorMessage = await response.text();
		throw new Error(errorMessage);
	}

	return response.json();
}

async function deleteApiCall(url) {

  console.log(url);

	const fetchOptions = {
		method: "DELETE",
		headers: {
			"Content-Type": "application/json",
			Accept: "application/json",
		},
	};

	const response = await fetch(url, fetchOptions);

	if (!response.ok) {
		const errorMessage = await response.text();
		throw new Error(errorMessage);
	}

	return response.json();
}

async function deleteFb(fbId) {
  //console.log(fbId);
  //alert(fbId.id);
  const delUrl = "api/public/feedback/delete/"+(fbId.id);
  console.log(delUrl);

  try {
    const responseData = await deleteApiCall(delUrl);

    console.log({responseData});
  } catch (error) {
    console.error(error);
  }

  getinfoapi(api_url_movie);
  getfbapi(api_url_fb);
}


async function handleFormSubmit(event) {
  event.preventDefault();
  const button = document.getElementById("button");
  button.disabled = true;

  const form = event.currentTarget;
  const url = form.action;

  try {
    const formData = new FormData(form);
    const responseData = await postFormDataAsJson({ url, formData });

    console.log({ responseData });
    form.reset();
  } catch (error) {
    console.error(error);
  }

  button.disabled = false;
  getinfoapi(api_url_movie);
  getfbapi(api_url_fb);
}

const fbForm = document.getElementById("feedbackForm");
fbForm.addEventListener("submit",handleFormSubmit);


async function handleDescFormSubmit(event) {
  event.preventDefault();
  const button = document.getElementById("descButton");
  button.disabled = true;

  const form = event.currentTarget;
  const url = form.action;

  try {
    const formData = new FormData(form);
    const responseData = await putFormDataAsJson({ url, formData });

    console.log({ responseData });
    form.reset();
  } catch (error) {
    console.error(error);
  }

  button.disabled = false;
  getinfoapi(api_url_movie);
  getfbapi(api_url_fb);
  toggleDesc();
}

const descForm = document.getElementById("descForm");
descForm.addEventListener("submit",handleDescFormSubmit);

const a1 = createRoot(document.getElementById('a1'));
const a2 = createRoot(document.getElementById('a2'));


// Defining async function
async function getinfoapi(url) {
	
	// Storing response
	const response = await fetch(url);
	
	// Storing data in form of JSON
	var data = await response.json();
	console.log(data);
	if (response) {
		hideloader();
	}
	showInfo(data);
}

// Defining async function
async function getfbapi(url) {
	
	// Storing response
	const response = await fetch(url);
	
	// Storing data in form of JSON
	var data = await response.json();
	console.log(data);
	if (response) {
		hideloader();
	}
	showFb(data);
}

function hideloader() {
	document.getElementById('loading').style.display = 'none';
}

function showInfo(r) {
  a1.render(<><Info key={'info'+r.id} img={r.img} name={r.name} description={r.description} rate={r.rate} /></>);

  const descText = document.getElementById('descText');
  descText.innerHTML = r.description;
}

function showFb(data) {
  
  
  const arr2 = [];
  for (let r of data) {
      arr2.push( React.createElement(FeedbackBox, {key:r.id, name:r.name,comment:r.comment,rate:r.rate,id:r.id}) );
      arr2.push( React.createElement("br",{key:'br'+r.id} ) );
  }

  a2.render(React.createElement(React.Fragment, null,  arr2) );
}

getinfoapi(api_url_movie);

getfbapi(api_url_fb);

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
