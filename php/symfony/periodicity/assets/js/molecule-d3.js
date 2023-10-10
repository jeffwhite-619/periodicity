const $ = require("jquery");
const _ = require("lodash");
const d3 = require("d3");
(async () => {
  h20 = await import("./molecule/draw/water.js");
  await h20.default();
  console.log("const water", h20);
})();

let canvas = $("#molecule-canvas");
let canvasDOM = canvas[0];
let atomRadius = 50;

let fetchOptions = {
  cache: "no-cache",
  credentials: "same-origin",
  headers: { "Content-Type": "application/json" },
  referrerPolicy: "no-referrer",
};

$(document).ready(() => {
  $(".legenditem").on("click", (event) => {
    let moleculeName = event.currentTarget.id;

    console.log("molecule name: ", moleculeName);

    getMolecule(moleculeName)
      .then((moleculeData) => {
        moleculeJson = JSON.parse(moleculeData);
        console.log("drawn molecule", moleculeJson);
        // console.log(molecule.success);

        if (!moleculeJson.success) {
          throw new Error("MOLECULE NOT FOUND");
        }
        moleculeName =
          moleculeName.charAt(0).toUpperCase() + moleculeName.slice(1);

        let molecule = [];
        if (moleculeJson.hasOwnProperty(moleculeName)) {
          molecule = moleculeJson[moleculeName];
          if (!molecule.hasOwnProperty("atoms")) {
            throw new Error("MOLECULE MUST CONTAIN ATOMS ARRAY");
          }
          drawMolecule(molecule["atoms"]);
        }

        console.log("json", moleculeJson, moleculeName, molecule);
      })
      .then(console.log("finish"))
      .catch((error) => {
        console.error("Error:", error);
      });
  });
});

async function getMolecule(moleculeName) {
  fetchOptions.method = "GET";
  let moleculeData = await fetch(
    "/molecule/" + encodeURI(moleculeName),
    fetchOptions
  );

  return await moleculeData.json();
}

function drawMolecule(atoms) {
  if (canvasDOM.getContext) {
    let ctx = canvasDOM.getContext("2d");

    // clear for redrawing
    clearCanvas(ctx, canvasDOM);

    console.log(atoms);
    let x = canvasDOM.width / 3;
    let y = canvasDOM.height / 3;

    let elements = [];
    let elementCounter = [];

    for (atom of atoms) {
      console.log(atom);
      drawAtom(ctx, x, y, atom);

      let index = elementCounter.length + 1;
      if (!_.find(elements, atom["name"])) {
        let elementIndex = [atom["name"] + index];
        elementCounter[atom["name"] + index] = atom["element"];
        elements[elementIndex] = atom;
      }

      x = x + randomCoord();
      y = y + randomCoord();

      console.log("elements", elements, elementCounter);
    }
  }
}

function drawAtom(ctx, x, y, atom) {
  let radius = atomRadius;
  let endAngle = Math.PI * 2;

  ctx.moveTo(x, y);
  ctx.beginPath();
  ctx.arc(x, y, radius, 0, endAngle, false);
  ctx.fillStyle = "#ffffff";
  ctx.shadowColor = "#666";
  ctx.shadowOffsetX = 0;
  ctx.shadowOffsetY = 0;
  ctx.shadowBlur = 20;
  ctx.fill();
  ctx.strokeStyle = "#000000";
  ctx.stroke();
}

function clearCanvas(ctx, canvasDOM) {
  ctx.clearRect(0, 0, canvasDOM.width, canvasDOM.height);
}

function randomCoord() {
  return _.random(atomRadius * 2, canvasDOM.width / 3 - atomRadius / 3);
}
