document.addEventListener("DOMContentLoaded", function () {
    let copyButtons = document.querySelectorAll(".bpr_btncpy");
    copyButtons.forEach(function(copyButton) {
        copyButton.addEventListener("mouseenter", function () {
            let tooltip = document.createElement("div");
            tooltip.classList.add("bpr_tooltip");
            tooltip.innerText = "Click to copy";
            this.parentElement.appendChild(tooltip);
        });

        copyButton.addEventListener("mouseleave", function () {
            let tooltip = this.parentElement.querySelector(".bpr_tooltip");
            if (tooltip) {
                tooltip.parentElement.removeChild(tooltip);
            }
        });

        copyButton.addEventListener("click", function () {
            let inputField = this.parentElement.querySelector("input.bpr_text");
            let valueToCopy = inputField.value.trim();
            navigator.clipboard.writeText(valueToCopy)
        });
    });
});
