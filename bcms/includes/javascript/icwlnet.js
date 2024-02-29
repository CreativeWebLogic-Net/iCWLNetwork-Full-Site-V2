
function generateCustomGUID() {
  const randomHex = () => Math.floor(Math.random() * 16).toString(16);
  const segments = [8, 4, 4, 4, 12]; // Length of each segment

  let guid = '';
  segments.forEach((segmentLength, index) => {
    for (let i = 0; i < segmentLength; i++) {
      if (i === 0 && index === 0) {
        // The first character in the first segment should be in the range [1-4]
        guid += (Math.floor(Math.random() * 4) + 1).toString(16);
      } else {
        guid += randomHex();
      }
    }
    if (index < segments.length - 1) {
      guid += '-';
    }
  });

  return guid;
}

// Function to get the value of a cookie by its name
function getCookie(cookieName) {
  const name = cookieName + "=";
  const decodedCookie = decodeURIComponent(document.cookie);
  const cookieArray = decodedCookie.split(';');

  for (let i = 0; i < cookieArray.length; i++) {
    let cookie = cookieArray[i].trim();

    if (cookie.indexOf(name) === 0) {
      return cookie.substring(name.length, cookie.length);
    }
  }

  // Return null if the cookie is not found
  return null;
}

var server_url = 'https://access.bubblecms.biz/';

// Make an AJAX GET request


async function getAjax() {
	var server_details='https://access.bubblecms.biz/?dcmshost=sierra-tomato.bnr.la&dcmsuri=%2F&ajax=1';//?dcmshost='+encodeURIComponent(url)+'&dcmsuri='+encodeURIComponent(uri)+'&ajax=1';
  const response = await fetch(server_details);
  const content_details = await response.json();
  console.log(content_details);
}

var server_details='https://access.bubblecms.biz/?dcmshost=sierra-tomato.bnr.la&dcmsuri=%2F&ajax=1';//?dcmshost='+encodeURIComponent(url)+'&dcmsuri='+encodeURIComponent(uri)+'&ajax=1';
//alert("Hello World");

// Example POST method implementation:
$.get (server_details, function (data) { // Use the $.get() method to make a GET request
  console.log (data); // Log the URL of the request
  // Do something with the response data
});
/*
var xhr = new XMLHttpRequest (); // Create a new XMLHttpRequest object
xhr.open ("GET", server_details); // Specify the method and the URL of the request
xhr.onload = function () { // Define a function to handle the response
  console.log (this.url); // Log the URL of the request
  // Do something with the response data
};
xhr.send (); // Send the request
*/


//var json=getAjax(durl,duri);
function write_docs(html_json) {
	var cookieValue="";

	const myCookieName ="guid3";

	const myCookieValue = getCookie(myCookieName);
//alert(myCookieValue);
	if(myCookieValue!=null){
    //alert(myCookieValue);
    //const [cookieValue] = myCookieValue.split(" ");
    //var cookieValue = myCookieValue.split(/,| /);
    	var cookieValue = myCookieValue.split(' ');
//var cookieValue =cookieValue.split(",");
    //alert(cookieValue)
    	cookieValue =cookieValue[0];
    //alert(cookieValue[0]);
	}else{
    	var cookieValue ="";
	}
	alert(cookieValue);
//console.log("Cookie Value:", cookieValue);
	if(cookieValue==""){
    	const guid = generateCustomGUID();
    	document.cookie = myCookieName+'=' + guid + ' path=/'; 
	}else{

	}

	

	//var res=getAjax(durl,duri);
	let obj = JSON.parse(html_json); // Parse the JSON string
	console.log(obj.start_menu);

	alert(res);

}
alert("Hello World");
/*
var local_server=document.location.href;

	var local_server_array=local_server.split('/');
	var durl=local_server_array[2];
	var duri=local_server_array[3];
	if(duri==""){
    	duri="/";
	}
	alert(durl);
//var res=getAjax(durl,duri);
var res=getAjax();
*/