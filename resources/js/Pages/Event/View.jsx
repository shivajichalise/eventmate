import { Link, Head } from "@inertiajs/react";
import Footer from "../../Components/Footer.jsx";
import NavBar from "../../Components/NavBar.jsx";
import Hero from "../../Components/Hero.jsx";
import FlashMessage from "../../Components/FlashMessage";

export default function View({
    auth,
    event,
    sub_event,
    venue,
    ticket,
    support,
    message,
}) {
    return (
        <>
            <Head title="Welcome" />

            <NavBar auth={auth} />

            {message && (
                <FlashMessage message={message.message} type={message.type} />
            )}

            <Hero img="/images/banner.jpg" />

            <div className="flex items-center justify-center my-4">
                <div className="flex flex-col w-2/3">
                    <div>
                        <h1 className="text-4xl font-bold mt-8">
                            {sub_event.name}
                        </h1>

                        <p className="font-bold text-md">
                            {sub_event.formatted_event_date}
                        </p>
                    </div>
                    <div className="my-4">
                        <p>{venue.address}</p>
                        <p>
                            {venue.city}, {venue.state}, {venue.country}{" "}
                        </p>
                    </div>
                    <p className="text-2xl font-bold">
                        {ticket.currency} {ticket.price}
                    </p>
                    <div className="card-actions justify-end">
                        <a
                            href={route("tickets.buy", { id: ticket.id })}
                            className="btn btn-primary"
                        >
                            Buy Ticket
                        </a>
                    </div>
                </div>
            </div>

            <div className="flex justify-center bg-gray-100 py-4">
                <div className="w-2/3">
                    <p className="text-lg my-4">{event.description}</p>
                    <p className="text-lg font-bold">
                        Below are the included services you get if you purchase
                        the ticket:
                    </p>
                    <ul className="list-disc">
                        <div className="grid grid-cols-2 ml-8">
                            <li>
                                <div className="col-span-1">
                                    email1@example.com
                                </div>
                            </li>
                        </div>
                    </ul>

                    <p className="text-lg font-bold my-4">Support contact:</p>
                    <p>Address: {support.address}</p>
                    <p>Email: {support.email}</p>
                    <p>Phone: {support.phone}</p>
                    <p>Mobile: {support.mobile}</p>
                </div>
            </div>

            <Footer />
        </>
    );
}
