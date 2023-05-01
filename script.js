import React, { StrictMode } from 'react';
import { createRoot } from 'react-dom/client';

function Rating({ rate }) {
    if(rate==-1)
      return (<><font size="3">average rating: </font><font size="5">N/A</font></>)
    else
      return (<><font size="3">average rating: </font><font size="8">{rate}</font><font size="4">/10</font></>)
}

function Title({ name}) {
    return (<font size="6">{name}</font>)
}

function Picture({ img,id }) {
  if(img)
     return (<a href={'fb.php?id='+id}><img src={'img/'+img} className="movieImg" /></a>)
  else
     return (<a href={'fb.php?id='+id}><img src="img/na.png" className="movieImg" /></a>)
}

function Feedback({ cnt }) {
  return (<font size="2">Total feedback: {cnt}</font>)
}

let Item = function MyItem(props) {
  return (
    <a href={'fb.php?id='+props.id}>
    <div className="itemframe">
      <table>
        <tbody>
        <tr>
          <th><Picture img={props.img} id={props.id} /></th>
          <th><table height="250" width="670">
            <tbody>
            <tr height="80">
              <th align="left" valign="top"><Title name={props.name} /></th>
              <th align="right" valign="top"><Rating rate={props.rate} /></th>
            </tr>
            <tr height="130">
              <th colSpan="2" valign="top" align="left">{props.description}</th>
            </tr>
            <tr>
              <th colSpan="2" align="right"><Feedback cnt={props.cnt} /></th>
            </tr>
            </tbody>
            </table></th>
        </tr>
        </tbody>
      </table>
    </div>
    </a>
  );
}

async function getapi(url) {
	
	const response = await fetch(url);
	
	var data = await response.json();
	console.log(data);
	if (response) {
		hideloader();
	}
	show(data);
}

function hideloader() {
	document.getElementById('loading').style.display = 'none';
}

function show(data) {
  const root = createRoot(document.getElementById('root'));
  
   const arr2 = [];
   for (let r of data) {
       arr2.push( React.createElement(Item, {key: r.id, img: r.img,name:r.name,description:r.description,rate:r.rate,cnt:r.cnt,id:r.id}) );
       arr2.push( React.createElement("br",{key:'br'+r.id} ) );
   }

  root.render(React.createElement(React.Fragment, null,  arr2) );

}

getapi("api/public/movies");