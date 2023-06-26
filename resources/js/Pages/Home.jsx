import { Link, Head } from "@inertiajs/react";

export default function Home({ auth, events }) {
    return (
        <>
            <Head title="Welcome" />
            <div className="navbar bg-base-100">
                <div className="navbar-start">
                    <div className="dropdown">
                        <label tabIndex="0" className="btn btn-ghost lg:hidden">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                className="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth="2"
                                    d="M4 6h16M4 12h8m-8 6h16"
                                />
                            </svg>
                        </label>
                        <ul
                            tabIndex="0"
                            className="menu menu-sm dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52"
                        >
                            <li>
                                <a>Events</a>
                            </li>
                            <li>
                                <a>About</a>
                            </li>
                            <li>
                                <a>Contact</a>
                            </li>
                        </ul>
                    </div>
                    <a
                        href={route("dashboard")}
                        className="ml-4 normal-case text-xl"
                    >
                        EventMate
                    </a>
                </div>
                <div className="navbar-center hidden lg:flex">
                    <ul className="menu menu-horizontal px-1">
                        <li>
                            <a>Events</a>
                        </li>
                        <li>
                            <a>About</a>
                        </li>
                        <li>
                            <a>Contact</a>
                        </li>
                    </ul>
                </div>
                <div className="navbar-end">
                    {auth.user ? (
                        <a className="btn mr-4" href={route("dashboard")}>
                            Dashboard
                        </a>
                    ) : (
                        <a
                            className="btn btn-sm btn-outline btn-primary mr-4"
                            href={route("login")}
                        >
                            Log in
                        </a>
                    )}
                </div>
            </div>

            <div className="hero min-h-fit flex items-center justify-center">
                <div className="bg-cover bg-center w-11/12 rounded-lg shadow-xl">
                    <img
                        src="/images/banner.jpg"
                        alt="Banner"
                        className="w-full h-full object-cover rounded-lg"
                    />
                    {/* Content within the hero section */}
                </div>
            </div>

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
                                            <p>
                                                Click the button to listen on
                                                Spotiwhy app.
                                            </p>
                                        </div>
                                        <p>
                                            Click the button to listen on
                                            Spotiwhy app.
                                        </p>
                                        <div className="card-actions justify-end">
                                            <button className="btn btn-primary">
                                                Listen
                                            </button>
                                            <a
                                                href={route("event.view", {
                                                    id: event.id,
                                                })}
                                                className="btn btn-primary"
                                            >
                                                More Info
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    ))}
                </div>
            </div>
        </>
    );
}
