import { Head } from "@inertiajs/react";
import NavBar from "../Components/NavBar.jsx";
import CallToAction from "@/Components/CallToAction.jsx";

export default function About({ auth }) {
    return (
        <>
            <Head title="About" />
            <NavBar auth={auth} />

            <div className="flex flex-col justify-center items-center my-10">
                <h1 className="text-5xl font-black p-5 lg:w-1/2 text-center">
                    Your one-stop solution for{" "}
                    <span className="text-primary">event management</span>
                </h1>
                <p className="text-md w-1/2 lg:w-2/5 text-center">
                    Event Mate streamlines event organization, ticket sales, and
                    attendee management in one easy-to-use web app.
                </p>
                <a className="btn btn-primary mt-5" href="/organizers/register">
                    Sign up
                </a>

                <img src="/images/header-tablet.png" />
            </div>

            <div className="">
                <div className="">
                    <h1 className="text-xl lg:text-4xl font-medium p-5 w-1/2 text-center">
                        Creating events made{" "}
                        <span className="text-primary">simple</span>
                    </h1>
                    <div className="flex flex-col justify-center items-center mt-[-5rem]">
                        <img
                            src="/images/event_creation_flow.png"
                            className="w-4/5"
                        />
                    </div>
                    <div className="flex flex-col justify-end items-center lg:mt-[-3rem] lg:flex-row">
                        <div className="flex flex-col justify-end lg:mr-10">
                            <h1 className="text-sm lg:text-lg font-light py-2">
                                Create you event seamlessly with{" "}
                                <span className="text-primary italic font-semibold text-xs lg:text-lg">
                                    {" "}
                                    four simple steps
                                </span>
                                :
                            </h1>
                            <ol className="list-decimal list-inside text-xs lg:text-lg">
                                <li>
                                    Provide basic information about your event.
                                </li>
                                <li>
                                    Add sub-events to diversify your program.
                                </li>
                                <li>Set up ticketing options for attendees.</li>
                                <li>
                                    Access support for any assistance needed
                                    along the way.
                                </li>
                            </ol>
                        </div>
                    </div>

                    <CallToAction />
                </div>
            </div>
        </>
    );
}
