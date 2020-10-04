document.getElementById("toggle-sidebar").addEventListener("click", () => {
  let sidebar = document.querySelector(".sidebar");
  if (sidebar.classList.contains("toggled"))
    document.querySelector(".sidebar").classList.remove("toggled");
  else document.querySelector(".sidebar").classList.add("toggled");
});