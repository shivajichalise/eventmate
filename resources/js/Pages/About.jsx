import { Head } from "@inertiajs/react";
import NavBar from "../Components/NavBar.jsx";
import CallToAction from "@/Components/CallToAction.jsx";
import Feature from "@/Components/Feature.jsx";
import {
    CalendarDots,
    CreditCard,
    Exam,
    Layout,
    Notification,
    User,
} from "@phosphor-icons/react";

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
                </div>
            </div>

            <div className="flex flex-col items-center justify-center my-10 gap-10">
                <h1 className="text-xl lg:text-3xl font-semibold py-2">
                    Remarkable Event Mate{" "}
                    <span className="text-primary font-bold text-xl lg:text-3xl">
                        Features
                    </span>
                </h1>
                <div className="flex flex-col lg:flex-row justify-between w-11/12">
                    <div className="">
                        <img src="/images/features.png" width={700} />
                    </div>
                    <div className="flex flex-col gap-5 items-center w-full lg:w-2/5">
                        <Feature
                            icon={
                                <CalendarDots
                                    size={25}
                                    className="text-white"
                                />
                            }
                            title="Quick event creation and ticket allocation"
                            description="Effortlessly create events and allocate tickets with ease."
                        />
                        <Feature
                            icon={
                                <CreditCard size={25} className="text-white" />
                            }
                            title="Online payment with dynamic invoice creation"
                            description="Facilitate online payments and generate dynamic invoices seamlessly for a hassle-free transaction experience."
                        />
                        <Feature
                            icon={<User size={25} className="text-white" />}
                            title="Attendee account"
                            description="Empower attendees with personalized accounts, providing them with easy access to event details and updates."
                        />
                        <Feature
                            icon={
                                <Notification
                                    size={25}
                                    className="text-white"
                                />
                            }
                            title="Email notification"
                            description="Keep attendees updated through timely email notifications, ensuring they never miss important event information."
                        />
                        <Feature
                            icon={<Layout size={25} className="text-white" />}
                            title="Dashboard feed"
                            description="Stay informed and organized with a comprehensive dashboard feed, offering real-time updates and insights."
                        />
                        <Feature
                            icon={<Exam size={25} className="text-white" />}
                            title="Quick results publication"
                            description="Speed up the process of result publication with quick and efficient tools, enhancing attendee satisfaction."
                        />
                    </div>
                </div>
            </div>

            <CallToAction />

            <footer className="flex flex-col justify-center items-center mt-10">
                <div className="flex flex-col lg:flex-row justify-around items-center border-y border-y-gray-400 w-full p-10">
                    <div className="flex flex-col w-full lg:w-1/4 my-5 lg:my-0">
                        <h1 className="text-sm lg:text-lg font-semibold py-2">
                            About Event Mate
                        </h1>
                        <p className="text-sm lg:text-md font-light">
                            EventMate is a web app that simplifies event
                            organization and ticket sales for organizers, while
                            providing attendees with a seamless registration
                            experience.
                        </p>
                    </div>
                    <div className="flex flex-col justify-start w-full lg:w-1/4">
                        <h1 className="text-sm lg:text-lg font-semibold py-1">
                            We would love to hear from you
                        </h1>
                        <a
                            href="mailto:respond2shivaji@gmail.com"
                            className="text-sm lg:text-md font-light"
                        >
                            respond2shivaji@gmail.com
                        </a>
                    </div>
                </div>
                <div className="p-4">
                    <h1>&copy; {new Date().getFullYear()} Shivaji Chalise</h1>
                </div>
            </footer>
        </>
    );
}
