const mobileNumber = document.querySelector("#mobile");
var mobileNumberInput = window.intlTelInput(mobileNumber, {
    preferredCountries: ["np", "in"],
    separateDialCode: true,
    initialCountry: "np",
    hiddenInput: "mobile",
});

// $("#mobile").on("change", function (event) {
//     event.preventDefault();
//     var fullMobileNumber = mobileNumberInput.getNumber();
//     $('[name="mobile"]').val(fullMobileNumber);
// });

const phone = document.querySelector("#phone");
var phoneInput = window.intlTelInput(phone, {
    preferredCountries: ["np", "in"],
    separateDialCode: true,
    initialCountry: "np",
    customPlaceholder: function (
        selectedCountryPlaceholder,
        selectedCountryData
    ) {
        return "061-534323";
    },
});

// $("#phone").change(function (event) {
//     event.preventDefault();
//     var fullPhoneNumber = phoneInput.getNumber();
//     $('[name="phone"]').val(fullPhoneNumber);
// });
