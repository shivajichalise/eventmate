import { Link, Head } from "@inertiajs/react";

export default function Home({ auth }) {
    return (
        <>
            <Head title="Welcome" />
            <div class="navbar bg-base-100">
                <div class="navbar-start">
                    <div class="dropdown">
                        <label tabindex="0" class="btn btn-ghost lg:hidden">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h8m-8 6h16"
                                />
                            </svg>
                        </label>
                        <ul
                            tabindex="0"
                            class="menu menu-sm dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52"
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
                        class="ml-4 normal-case text-xl"
                    >
                        EventMate
                    </a>
                </div>
                <div class="navbar-center hidden lg:flex">
                    <ul class="menu menu-horizontal px-1">
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
                <div class="navbar-end">
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

            <div
                className="hero min-h-screen"
                style={{
                    backgroundImage: `url("images/banner.jpg")`,
                }}
            ></div>

            <div className="flex flex-col items-center justify-center">
                <div className="w-11/12">
                    <h1 className="text-4xl font-bold my-5">Events Calendar</h1>

                    <div className="card w-full card-side bg-base-200 shadow-xl">
                        <div className="card-body">
                            <div className="grid grid-cols-2 gap-4">
                                <div>
                                    <h2 className="text-xl font-bold">
                                        Event Name: Name
                                    </h2>
                                    <p>Date:</p>
                                    <p>Date:</p>
                                    <p>Address:</p>
                                </div>
                                <div className="flex flex-col items-end justify-between">
                                    <div>
                                        <button className="btn btn-primary">
                                            More Info
                                        </button>
                                    </div>
                                    <div>
                                        <button className="btn btn-primary">
                                            Buy Ticket
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
