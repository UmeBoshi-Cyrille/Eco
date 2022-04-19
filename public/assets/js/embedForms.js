const addSection = document.createElement("button");
addSection.classList.add("btn", "btnAddSection", "key_bg2");
addSection.innerText = "Add Section";
addSection.dataset.collectionHolderClass = "panel_section";

const newSection = document.createElement("div");
newSection.classList.add("newSectionBox");
newSection.append(addSection);

const collectionHolderSection = document.querySelector("#section_list");
collectionHolderSection.appendChild(addSection);

const addFormToCollection = (e) => {
  const collectionHolder = document.querySelector(
    "." + e.currentTarget.dataset.collectionHolderClass
  );

  const item = document.createElement("li");

  item.innerHTML = collectionHolder.dataset.prototype.replace(
    /__name__/g,
    collectionHolder.dataset.index
  );

  collectionHolder.appendChild(item);

  collectionHolder.dataset.index++;
};

addTagLink.addEventListener("click", addFormToCollection);
