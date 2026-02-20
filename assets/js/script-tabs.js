function switchTab(tabName) {
  const tabs = document.querySelectorAll(".tab");
  const postsSection = document.getElementById("posts-section");
  const likesSection = document.getElementById("likes-section");

  tabs.forEach((tab) => tab.classList.remove("active"));

  if (tabName === "posts") {
    tabs[0].classList.add("active");
    postsSection.style.display = "flex";
    likesSection.style.display = "none";
  } else if (tabName === "likes") {
    tabs[1].classList.add("active");
    likesSection.style.display = "flex";
    postsSection.style.display = "none";
  }
}
