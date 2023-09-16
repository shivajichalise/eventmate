import { useState } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, usePage } from "@inertiajs/react";
import FlashMessage from "@/Components/FlashMessage";
import ResultModal from "@/Components/ResultModal";
import PopupModal from "@/Components/PopupModal";

export default function Dashboard({
    auth,
    message,
    purchasedTickets: { ongoing, upcoming, finished },
}) {
    const { flash } = usePage().props;

    const [result, setResult] = useState({
        id: "",
        title: "",
        description: "",
        hasFile: false,
    });

    const handleViewResult = (obj) => {
        setResult({
            ...result,
            id: obj.id,
            title: obj.title,
            description: obj.description,
            hasFile: obj.hasFile,
        });
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    My Tickets
                </h2>
            }
        >
            <Head title="My Tickets" />

            <PopupModal
                id={result.id}
                title={result.title}
                description={result.description}
                hasFile={result.hasFile}
            />

            {flash.message && (
                <FlashMessage
                    message={flash.message.message}
                    type={flash.message.type}
                />
            )}

            <div className="py-12">
                <div className="max-w-7xl my-4 mx-auto sm:px-6 lg:px-8">
                    <h2 className="text-xl text-white m-2">Ongoing</h2>
                    <div className="flex justify-start items-center">
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4">
                            {ongoing.length > 0 ? (
                                ongoing.map((ticket) => (
                                    <div
                                        key={ticket.id}
                                        className="card glass w-fit bg-secondary text-secondary-content text-lg"
                                    >
                                        <div className="card-body">
                                            <h2 className="card-title font-bold">
                                                {ticket.sub_event.name}
                                            </h2>
                                            <p className="italic">
                                                Date:{" "}
                                                {
                                                    ticket.sub_event
                                                        .formatted_event_date
                                                }
                                            </p>
                                            <div className="card-actions justify-end">
                                                {ticket.sub_event.result && (
                                                    <label
                                                        className="text-sm"
                                                        htmlFor={
                                                            ticket.sub_event
                                                                .result.id
                                                        }
                                                        onClick={handleViewResult(
                                                            {
                                                                id: ticket
                                                                    .sub_event
                                                                    .result.id,
                                                                title: ticket
                                                                    .sub_event
                                                                    .result
                                                                    .title,
                                                                description:
                                                                    ticket
                                                                        .sub_event
                                                                        .result
                                                                        .description,
                                                                hasFile: ticket
                                                                    .sub_event
                                                                    .result.file
                                                                    ? true
                                                                    : false,
                                                            }
                                                        )}
                                                    >
                                                        View result
                                                    </label>
                                                )}
                                                <a
                                                    href={
                                                        `/event/` +
                                                        ticket.sub_event.id
                                                    }
                                                    className="btn"
                                                >
                                                    More info
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <div className="card glass w-fit bg-secondary text-secondary-content text-lg">
                                    <div className="card-body">
                                        <p className="italic">
                                            No ongoing events.
                                        </p>
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>
                </div>

                <div className="max-w-7xl my-4 mx-auto sm:px-6 lg:px-8">
                    <h2 className="text-xl text-white m-2">Upcoming</h2>
                    <div className="flex justify-start items-center">
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4">
                            {upcoming.length > 0 ? (
                                upcoming.map((ticket) => (
                                    <div
                                        key={ticket.id}
                                        className="card glass w-fit bg-secondary text-secondary-content text-lg"
                                    >
                                        <div className="card-body">
                                            <h2 className="card-title font-bold">
                                                {ticket.sub_event.name}
                                            </h2>
                                            <p className="italic">
                                                Date:{" "}
                                                {
                                                    ticket.sub_event
                                                        .formatted_event_date
                                                }
                                            </p>
                                            <div className="card-actions justify-between items-center">
                                                {ticket.sub_event.result && (
                                                    <label
                                                        className="text-sm"
                                                        htmlFor={
                                                            ticket.sub_event
                                                                .result.id
                                                        }
                                                        onClick={() =>
                                                            handleViewResult({
                                                                id: ticket
                                                                    .sub_event
                                                                    .result.id,
                                                                title: ticket
                                                                    .sub_event
                                                                    .result
                                                                    .title,
                                                                description:
                                                                    ticket
                                                                        .sub_event
                                                                        .result
                                                                        .description,
                                                                hasFile: ticket
                                                                    .sub_event
                                                                    .result.file
                                                                    ? true
                                                                    : false,
                                                            })
                                                        }
                                                    >
                                                        View result
                                                    </label>
                                                )}
                                                <a
                                                    href={
                                                        `/event/` +
                                                        ticket.sub_event.id
                                                    }
                                                    className="btn"
                                                >
                                                    More info
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <div className="card glass w-fit bg-secondary text-secondary-content text-lg">
                                    <div className="card-body">
                                        <p className="italic">
                                            No upcoming events.
                                        </p>
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>
                </div>

                <div className="max-w-7xl my-4 mx-auto sm:px-6 lg:px-8">
                    <h2 className="text-xl text-white m-2">Finished</h2>
                    <div className="flex justify-start items-center">
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4">
                            {finished.length > 0 ? (
                                finished.map((ticket) => (
                                    <div
                                        key={ticket.id}
                                        className="card glass w-fit bg-secondary text-secondary-content text-lg"
                                    >
                                        <div className="card-body">
                                            <h2 className="card-title font-bold">
                                                {ticket.sub_event.name}
                                            </h2>
                                            <p className="italic">
                                                Date:{" "}
                                                {
                                                    ticket.sub_event
                                                        .formatted_event_date
                                                }
                                            </p>
                                            <div className="card-actions justify-between items-center">
                                                {ticket.sub_event.result && (
                                                    <label
                                                        className="text-sm"
                                                        htmlFor={
                                                            ticket.sub_event
                                                                .result.id
                                                        }
                                                        onClick={() =>
                                                            handleViewResult({
                                                                id: ticket
                                                                    .sub_event
                                                                    .result.id,
                                                                title: ticket
                                                                    .sub_event
                                                                    .result
                                                                    .title,
                                                                description:
                                                                    ticket
                                                                        .sub_event
                                                                        .result
                                                                        .description,
                                                                hasFile: ticket
                                                                    .sub_event
                                                                    .result.file
                                                                    ? true
                                                                    : false,
                                                            })
                                                        }
                                                    >
                                                        View result
                                                    </label>
                                                )}
                                                <a
                                                    href={
                                                        `/event/` +
                                                        ticket.sub_event.id
                                                    }
                                                    className="btn"
                                                >
                                                    More info
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <div className="card glass w-fit bg-secondary text-secondary-content text-lg">
                                    <div className="card-body">
                                        <p className="italic">
                                            No finished events.
                                        </p>
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
