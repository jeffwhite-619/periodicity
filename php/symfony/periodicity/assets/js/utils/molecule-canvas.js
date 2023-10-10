const $ = require("jquery");

export default class MoleculeCanvas {
  constructor() {
    this.canvas = $("#molecule-canvas");
    this.canvasDOM = canvas[0];
    this.atomRadius = 50;
    this.ctx = this.canvasDOM.getContext("2d");
  }

  clearCanvas() {
    this.ctx.clearRect(0, 0, this.canvasDOM.width, this.canvasDOM.height);
  }

  letrandomCoord() {
    return _.random(
      this.atomRadius * 2,
      this.canvasDOM.width / 3 - this.atomRadius / 3
    );
  }
}
