import { Link, Head } from "@inertiajs/react";
import Footer from "../../Components/Footer.jsx";
import NavBar from "../../Components/NavBar.jsx";

export default function Invoice({ auth }) {
    return (
        <>
            <Head title="Invoice" />

            <NavBar auth={auth} />

            <Footer />
        </>
    );
}
