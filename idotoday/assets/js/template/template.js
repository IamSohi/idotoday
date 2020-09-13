function mHdropEvent() {
    document.getElementById("mHoptions").classList.toggle("mHdrop");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.mHdropbtn')) {

    var dropdowns = document.getElementsByClassName("mHdropdown_content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('mHdrop')) {
        openDropdown.classList.remove('mHdrop');
      }
    }
  }
}

function dropItDownM(){
  document.getElementById("myDropdownMenuM").classList.toggle("show");
  
}
function dropItUp(){
  document.getElementById("myDropupMenu").classList.toggle("show");
  
}
function dropItDown(){
  document.getElementById("myDropdownMenu").classList.toggle("show");
  
}
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
