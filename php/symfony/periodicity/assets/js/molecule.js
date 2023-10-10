const $ = require("jquery");
const _ = require("lodash");
const p5 = require("p5");
const d3 = require("d3");

import("./molecule/draw/water.js");

// let canvas = $("#molecule-canvas");
// let canvasDOM = canvas[0];

var moleculeContainer = $("#molecule-layout-container")[0];

$(document).ready(() => {
  $(".legenditem").on("click", (event) => {
    let moleculeName = event.currentTarget.id;

    console.log("molecule name: ", moleculeName);
  });
});
