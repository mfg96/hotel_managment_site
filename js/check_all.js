function check_all(){

var colors = document.forms[1];

var i;
if (colors[0].checked)
for (i = 0; i < colors.length; i++)
  colors[i].checked=false;
else
for (i = 0; i < colors.length; i++)
  colors[i].checked=true;
}