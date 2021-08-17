"use strict";

// Creating the variables well w3 w/
let animatedDivForm = document.querySelector('.form-wrapper-first'),
    animatedDivTable = document.querySelector('.table-wrapper-first'),
    firstBlockForm = document.querySelector('.form-wrapper-second'),
    firstBlockTable = document.querySelector('.table-wrapper-second'),
    stop = false,
    deg = 0,
    formI = 0,
    tableI = 0;

animatedDivForm.style.background = `background linear-gradient(0deg, #D4DCFF 50% , #7D83FF 90% )`;

firstBlockForm.addEventListener("click", (e) => {
  if (stop === false && formI <= 1) {

    function animateDivForm() {
      animatedDivForm.style.background = `background linear-gradient(${deg++}deg, 
      #D4DCFF 50% , #7D83FF 90% )`;
      requestAnimationFrame(animateDivForm);
    }

    stop = true;
    formI++;
    console.error(stop);
    console.error('/2');
    requestAnimationFrame(animateDivForm);
  }
  else {
    animatedDivForm.style.background = `background linear-gradient(${deg}deg, #D4DCFF 50% , #7D83FF 90% )`;
    stop = false;
    console.error(stop);
    console.error('!/2');
  }
});

animatedDivTable.style.background = `background linear-gradient(0deg, #D4DCFF 50% , #7D83FF 90% )`;

firstBlockTable.addEventListener("click", (e) => {
  if (stop === false && tableI <= 1) {

    function animateDivForm() {
      animatedDivTable.style.background = `background linear-gradient(${deg++}deg, 
      #D4DCFF 50% , #7D83FF 90% )`;
      requestAnimationFrame(animateDivForm);
    }

    stop = true;
    tableI++;
    console.error(stop);
    console.error('/2');
    requestAnimationFrame(animateDivForm);
  }
  else {
    animatedDivTable.style.background = `background linear-gradient(${deg}deg, #D4DCFF 50% , #7D83FF 90% )`;
    stop = false;
    console.error(stop);
    console.error('!/2');
  }
});
