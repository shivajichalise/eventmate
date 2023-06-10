const dateTimeFields = document.querySelectorAll(".inputDateTime");
Array.from(dateTimeFields).forEach(function (element) {
    new tempusDominus.TempusDominus(element);
});
