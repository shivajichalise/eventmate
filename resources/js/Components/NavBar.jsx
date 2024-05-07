import ApplicationLogo from "@/Components/ApplicationLogo";

export default function NavBar({ auth }) {
    return (
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
                            <a href="/home">Events</a>
                        </li>
                        <li>
                            <a href="/">About</a>
                        </li>
                    </ul>
                </div>
                <a href={route("about")} className="ml-4 normal-case text-xl">
                    <ApplicationLogo
                        className="block h-8 w-auto fill-current text-gray-800 dark:text-gray-200"
                        primary={true}
                    />
                </a>
            </div>
            <div className="navbar-center hidden lg:flex">
                <ul className="menu menu-horizontal px-1">
                    <li>
                        <a href="/home">Events</a>
                    </li>
                    <li>
                        <a href="/">About</a>
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
    );
}
