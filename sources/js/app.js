var fileinput =document.getElementById("imagen");
var filestatus=document.querySelector(".file-status");

fileinput.addEventListener('change',function(){
    filestatus.textContent=this.files[0].name;
});