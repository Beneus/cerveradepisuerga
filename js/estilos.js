function setActiveStyleSheetCursor(title) {
if(window.event.keyCode == 13) {
setActiveStyleSheet(title)
}
}
function setActiveStyleSheet(title) {
var i, a, main;
for(i=0; (a = document.getElementsByTagName("link")[i]); i++) {
if(a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("title")) {
a.disabled = true;
if(a.getAttribute("title") == title) a.disabled = false;
}
}
}
function getActiveStyleSheet() {
var i, a;
for(i=0; (a = document.getElementsByTagName("link")[i]); i++) {
if(a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("title") && !a.disabled) return a.getAttribute("title");
}
return null;
}
function getPreferredStyleSheet() {
var i, a;
for(i=0; (a = document.getElementsByTagName("link")[i]); i++) {
if(a.getAttribute("rel").indexOf("style") != -1
&& a.getAttribute("rel").indexOf("alt") == -1
&& a.getAttribute("title")
) return a.getAttribute("title");
}
return null;
}

function createCookie(name,value,days) {
if (days) {
var date = new Date();
date.setTime(date.getTime()+(days*24*60*60*1000));
var expires = "; expires="+date.toGMTString();
}
else expires = "";
document.cookie = name+"="+value+expires+"; path=/";
}
function readCookie(name) {
var nameEQ = name + "=";
var ca = document.cookie.split(';');
for(var i=0;i < ca.length;i++) {
var c = ca[i];
while (c.charAt(0)==' ') c = c.substring(1,c.length);
if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
}
return null;
}
window.onload = function(e) {
var cookie = readCookie("style");
if ((cookie == "s1") || (cookie == "s2") || (cookie == "s3"))  {
cookie="";
}
var title = cookie ? cookie : getPreferredStyleSheet();
setActiveStyleSheet(title);
}
window.onunload = function(e) {
var title = getActiveStyleSheet();
createCookie("style", title, 365);
}
var cookie = readCookie("style");
var title = cookie ? cookie : getPreferredStyleSheet();
setActiveStyleSheet(title);
function ValidarFormularioBusquedas() {
var f = document.formbusquedas;
if(f.d.selectedIndex == 0) {
f.a.value="directorio";
f.tp.value="Búsquedas";
} else {
f.a.value="directorio";
f.tp.value="Directorio";
}
}
function EnviarMail(id,prof,b) {
url = "cont/directorio/enviamail.php?idp=" + escape(id) + "&" + b + "=" +  escape(prof) + "&t=" + (new Date()).getTime();
diremail = window.open(url,"DIRECTORIOIMAIL","resizable,scrollbars=yes,status=no,menubar=no,width=640,height=500");
diremail.focus();
}
function DatosIncorrectos() {
url = "https://www.ucm.es/info/ucmp/cont/directorio/datosincorrectos.php?t=" + (new Date()).getTime();
dirincorrecto = window.open(url,"DIRECTORIOINCORRECTO","resizable,scrollbars=auto,status=yes,menubar=no,width=710,height=640");
dirincorrecto.focus();
}
function SugerenciasCursor() {
if(window.event.keyCode == 13) {
Sugerencias()
}
}
function Sugerencias() {
url = "https://www.ucm.es/info/ucmp/cont/directorio/sugerencias.php?t=" + (new Date()).getTime();
dirincorrecto = window.open(url,"DIRECTORIOINCORRECTO","resizable,scrollbars=auto,status=yes,menubar=no,width=710,height=600");
dirincorrecto.focus();
}