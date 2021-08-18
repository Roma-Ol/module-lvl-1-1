"use strict";

// Creating the variables well w3 w/
const animatedDivForm = document.querySelector('.form-wrapper-first'),
      animatedDivTable = document.querySelector('.table-wrapper-first');

// Setting the default position of BGs.
function setDefaultBG(element) {
  element.style.background = `background linear-gradient(0deg,
  #D4DCFF 50%, #7D83FF 90% )`;
}

const firstBlockForm = document.querySelector('.form-wrapper-second'),
      firstBlockTable = document.querySelector('.table-wrapper-second');
let   formI = 0,
      tableI = 0;

// Starting the animation after clicking on certain area
function clicking(element, counter, animatedElement, deg) {
  element.addEventListener('click', () => {
    if (counter === 0) {
      function funcName() {
        animatedElement.style.background = `background linear-gradient(${counter++}deg,
        #D4DCFF 50% , #7D83FF 90% )`;
        requestAnimationFrame(funcName);
      }
      counter++;
      requestAnimationFrame(funcName);
    }
  });
}

// Headers animation.
const formText = 'General guest form',
      tableText = 'List of the guests',
      speed = 50,
      formHeader = document.querySelector('.form-header'),
      tableHeader = document.querySelector('.table-header');
let   textI = 0;


document.addEventListener("DOMContentLoaded", () => {
  function typeText() {
    if (textI < formText.length) {
      formHeader.innerHTML += formText.charAt(textI);
      if(animatedDivTable !== null) {
        tableHeader.innerHTML += tableText.charAt(textI);
      }
      textI++;
      setTimeout(typeText, speed);
    }
  }
  typeText();
});

// Calling the funcs.
setDefaultBG(animatedDivForm);
clicking(firstBlockForm, formI, animatedDivForm);

if (animatedDivTable !== null) {
  setDefaultBG(animatedDivTable);
  clicking(firstBlockTable, tableI, animatedDivTable);
}