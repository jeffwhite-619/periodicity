const $ = require("jquery");

$("document").ready(function () {
  let any_element = $(".element");
  let modalContainer = $("#modal-container");

  function resetModal() {
    modalContainer.empty();
    modalContainer.css({ width: "1px", height: "1px" });
  }

  any_element.on("click", () => {
    resetModal(modalContainer);
  });

  modalContainer.on("click", (event) => {
    resetModal(event.currentTarget);
  });

  any_element.on("click", (event) => {
    resetModal(modalContainer);
    let target = event.currentTarget;
    let element = $(target);
    let elementModal = element.find(".element-modal").clone();

    modalContainer.append(elementModal);
    modalContainer.css({ top: "5%", left: "25%" });
    elementModal.css({ display: "block", width: "780px", height: "780px" });

    modalContainer.animate(
      { width: "780px", height: "780px", top: "25%" },
      150,
      "swing",
      () => {
        elementModal
          .find(".modal-content")
          .animate({ opacity: 100 }, 700, "swing", () => {
            elementModal.animate({ opacity: 0.65 }, 1000, "swing", () => {});
          });
      }
    );
  });
});
