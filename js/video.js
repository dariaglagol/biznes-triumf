var link = document.querySelector(".past-event_link");
var popup = document.querySelector(".past-event_video");
var overlay = document.querySelector(".past-event_overlay");
link.addEventListener("click", function(event) {
  event.preventDefault();
  popup.classList.add("past-event_video--show");
  overlay.style.display = "block";
});
window.addEventListener("keydown", function(event) {
  if (event.keyCode === 27) {
    if (popup.classList.contains("past-event_video--show")) {
      popup.classList.remove("past-event_video--show");
    }
    if (overlay.style.display = "block") {
      overlay.style.display = "none";
    }
  }
});
overlay.addEventListener("click", function(event) {
  event.preventDefault();
  popup.classList.remove("past-event_video--show");
  overlay.style.display = "none";
});
