// returns address object from bigger place given by google autocomplete api
function placeToAddress(place) {
    var address = {};
    place.address_components.forEach(function (c) {
        switch (c.types[0]) {
            case "street_number":
                address.StreetNumber = c;
                break;
            case "route":
                address.StreetName = c;
                break;
            case "neighborhood":
            case "locality": // North Hollywood or Los Angeles?
                address.City = c;
                break;
            case "administrative_area_level_1": // Note some countries don't have states
                address.State = c;
                break;
            case "postal_code":
                address.Zip = c;
                break;
            case "country":
                address.Country = c;
                break;
        }
    });
    return address;
}
