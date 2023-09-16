import logo_purple from "../../../public/images/logo/png/eventmate_purple-nav-logo.png";
import logo_blue from "../../../public/images/logo/png/eventmate_blue-nav-logo.png";

export default function ApplicationLogo({ className, primary }) {
    return (
        <img src={primary ? logo_blue : logo_purple} className={className} />
    );
}
