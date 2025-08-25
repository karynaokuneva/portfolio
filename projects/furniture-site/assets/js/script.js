function toggleMenu() {
  var sidebar = document.getElementById("sidebar");
  if (sidebar.style.width === "250px") {
    sidebar.style.width = "0";
  } else {
    sidebar.style.width = "250px";
  }
}
/*
function toggleMenu() {
  const sidebar = document.getElementById("sidebar");
  // Toggle sidebar width
  sidebar.style.width = sidebar.style.width === "250px" ? "0" : "250px";
}
*/