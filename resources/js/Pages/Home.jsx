import { Link, Head } from "@inertiajs/react";
import Footer from "../Components/Footer.jsx";
import NavBar from "../Components/NavBar.jsx";
import Hero from "../Components/Hero.jsx";

export default function Home({ auth, events }) {
    return (
        <>
            <Head title="Welcome" />

            <NavBar auth={auth} />

            <Hero img="/images/banner.jpg" />

            <div className="flex flex-col items-center justify-center">
                <div className="w-11/12">
                    <h1 className="text-4xl font-bold my-5">Events Calendar</h1>

                    {events.map((event) => (
                        <div key={event.id}>
                            <h1 className="flex items-center justify-between mb-3">
                                <span className="border-b-2 border-gray-300 w-full"></span>
                                <span className="mx-4 text-xl font-bold w-max whitespace-nowrap">
                                    {event.name}
                                </span>
                                <span className="border-b-2 border-gray-300 w-full"></span>
                            </h1>

                            {event.sub_events.map((sub_event) => (
                                <div
                                    className="card lg:card-side bg-gray-100 mb-3 max-h-96"
                                    key={sub_event.id}
                                >
                                    <figure>
                                        <img
                                            src="/images/banner.jpg"
                                            alt="Album"
                                        />
                                    </figure>
                                    <div className="card-body min-w-max">
                                        <h1 className="card-title text-3xl whitespace-nowrap">
                                            {sub_event.name}
                                        </h1>
                                        <p className="font-bold text-md">
                                            {sub_event.formatted_event_date}
                                        </p>
                                        <div>
                                            <p>{event.venue.address}</p>
                                        </div>
                                        <p>
                                            {event.venue.city},{" "}
                                            {event.venue.state},{" "}
                                            {event.venue.country}{" "}
                                        </p>
                                        <p className="text-2xl font-bold">
                                            {sub_event.ticket.currency}{" "}
                                            {sub_event.ticket.price}
                                        </p>
                                        <div className="card-actions justify-end">
                                            <a
                                                href={route("event.view", {
                                                    id: sub_event.id,
                                                })}
                                                className="btn btn-outline"
                                            >
                                                More Info
                                            </a>
                                            <a
                                                href={route("tickets.buy", {
                                                    id: sub_event.ticket.id,
                                                })}
                                                className="btn btn-primary"
                                            >
                                                Buy Ticket
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    ))}
                </div>
            </div>

            <Footer />
        </>
    );
}
