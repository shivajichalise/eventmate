import { Link, Head } from "@inertiajs/react";
import Footer from "../Components/Footer.jsx";
import NavBar from "../Components/NavBar.jsx";
import Hero from "../Components/Hero.jsx";

export default function Home({ auth, events, payments }) {
    const hasMadePayment = (ticket) => {
        if (payments !== null) return payments.some((t) => t.id === ticket.id);
    };

    return (
        <>
            <Head title="Welcome" />
            <NavBar auth={auth} />
            <div className="flex justify-center items-center">
                <div className="w-full flex flex-col items-center justify-center bg-gray-50 rounded-lg">
                    <div className="w-11/12">
                        <div className="flex justify-center items-center">
                            <h1 className="text-2xl font-medium my-5">
                                Events Calendar
                            </h1>
                        </div>

                        {events.map((event) => (
                            <div key={event.id}>
                                <h1 className="flex items-center justify-between mb-3">
                                    <span className="mx-4 text-lg font-bold w-max whitespace-nowrap">
                                        {event.name}
                                    </span>
                                </h1>
                                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                                    {event.sub_events.map((sub_event) => (
                                        <div
                                            key={sub_event.id}
                                            className="bg-white shadow-xl rounded-lg overflow-hidden mb-7"
                                        >
                                            <div className="relative mx-4 mt-4 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40">
                                                <img
                                                    src="images/banner.jpg"
                                                    alt="event banner"
                                                />
                                                <div className="to-bg-black-10 absolute inset-0 h-full w-full bg-gradient-to-tr from-transparent via-transparent to-black/60"></div>
                                            </div>
                                            <div className="p-4">
                                                <p className="text-md font-bold text-gray-700">
                                                    {sub_event.name}
                                                </p>
                                                <p className="text-3xl text-gray-900">
                                                    {sub_event.ticket.currency}{" "}
                                                    {sub_event.ticket.price}
                                                </p>
                                            </div>
                                            <div className="flex p-4 border-t border-gray-300 text-gray-700">
                                                <div className="flex-1 inline-flex items-center">
                                                    <svg
                                                        className="h-4 w-4 text-gray-600 fill-current mr-3"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 512 512"
                                                    >
                                                        <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" />
                                                    </svg>
                                                    <div>
                                                        <p className="text-gray-700">
                                                            {
                                                                event.venue
                                                                    .address
                                                            }
                                                        </p>
                                                        <p className="text-gray-700">
                                                            {event.venue.city},{" "}
                                                            {event.venue.state},{" "}
                                                            {
                                                                event.venue
                                                                    .country
                                                            }{" "}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div className="flex p-4 border-t border-gray-300 text-gray-700">
                                                <div className="flex-1 inline-flex items-center">
                                                    <svg
                                                        className="h-4 w-4 text-gray-600 fill-current mr-3"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 512 512"
                                                    >
                                                        <path
                                                            fillRule="evenodd"
                                                            d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z"
                                                        />
                                                    </svg>
                                                    <p>
                                                        {
                                                            sub_event.formatted_event_date
                                                        }
                                                    </p>
                                                </div>
                                            </div>

                                            <div className="px-4 pt-3 pb-4 border-t border-gray-300 bg-gray-100">
                                                <div className="flex items-center justify-between pt-2">
                                                    <a
                                                        href={route(
                                                            "event.view",
                                                            {
                                                                id: sub_event.id,
                                                            }
                                                        )}
                                                        className="btn btn-outline"
                                                    >
                                                        More Info
                                                    </a>
                                                    <a
                                                        href={route(
                                                            "tickets.buy",
                                                            {
                                                                id: sub_event
                                                                    .ticket.id,
                                                            }
                                                        )}
                                                        className="btn btn-primary"
                                                        disabled={hasMadePayment(
                                                            sub_event.ticket
                                                        )}
                                                    >
                                                        Buy Ticket
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>

            <Footer />
        </>
    );
}
